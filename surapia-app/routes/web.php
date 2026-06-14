<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Models\PengajuanKelahiran;

Route::get('/', function () {
    return view('welcome');
});

// Route download akta lahir - hanya untuk user yang sudah login
Route::get('/download-akta/{id}', function ($id) {
    // Pastikan user sudah login
    if (!auth()->check()) {
        abort(403, 'Silakan login terlebih dahulu.');
    }

    $pengajuan = PengajuanKelahiran::findOrFail($id);

    // Pastikan file ada
    if (empty($pengajuan->file_akta_lahir)) {
        abort(404, 'File akta lahir tidak ditemukan.');
    }

    $filePath = $pengajuan->file_akta_lahir;

    // Cek di disk public dulu, lalu local/private
    if (Storage::disk('public')->exists($filePath)) {
        return Storage::disk('public')->download($filePath);
    } elseif (Storage::disk('local')->exists($filePath)) {
        return Storage::disk('local')->download($filePath);
    } else {
        abort(404, 'File tidak ditemukan di storage.');
    }
})->middleware('auth')->name('download.akta');

// Route download berkas (ZIP)
Route::get('/download-berkas/{id}', function ($id) {
    if (!auth()->check() || !auth()->user()->isDisdukcapil()) {
        abort(403, 'Akses ditolak.');
    }

    $record = PengajuanKelahiran::findOrFail($id);
    
    $zipFile = storage_path('app/public/berkas_' . $record->id . '_' . time() . '.zip');
    $zip = new \ZipArchive();
    if ($zip->open($zipFile, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
        
        $folderName = \Illuminate\Support\Str::slug($record->nama_bayi) . '-' . 
                      \Illuminate\Support\Str::slug($record->nama_ayah) . '-' . 
                      strtolower(str_replace('/', '-', $record->faskes->nama_faskes));

        $filesToProcess = [
            'KTP_Orang_Tua' => $record->file_ktp,
            'Kartu_Keluarga' => $record->file_kk,
            'Ket_Lahir' => $record->file_ket_lahir,
            'Buku_Nikah' => $record->file_buku_nikah,
        ];

        $filesAdded = 0;

        foreach ($filesToProcess as $docName => $paths) {
            if (empty($paths)) continue;

            $pathsArray = is_array($paths) ? $paths : [$paths];
            
            foreach ($pathsArray as $index => $path) {
                if (empty($path)) continue;
                
                $disk = \Illuminate\Support\Facades\Storage::disk('public');
                if (!$disk->exists($path)) {
                    $disk = \Illuminate\Support\Facades\Storage::disk('local');
                }

                if (!$disk->exists($path)) continue;

                $filePath = $disk->path($path);

                $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                $suffix = count($pathsArray) > 1 ? '_' . ($index + 1) : '';
                $zipPath = $folderName . '/' . $docName . $suffix;

                if (strtolower($extension) === 'pdf') {
                    if (class_exists('Imagick')) {
                        try {
                            $imagick = new \Imagick();
                            $imagick->setResolution(150, 150);
                            $imagick->readImage($filePath . '[0]');
                            $imagick->setImageFormat('jpeg');
                            $imagick->setImageCompressionQuality(80);
                            $zip->addFromString($zipPath . '.jpg', $imagick->getImageBlob());
                            $imagick->clear();
                            $imagick->destroy();
                            $filesAdded++;
                        } catch (\Exception $e) {
                            $zip->addFile($filePath, $zipPath . '.pdf');
                            $filesAdded++;
                        }
                    } else {
                        $zip->addFile($filePath, $zipPath . '.pdf');
                        $filesAdded++;
                    }
                } elseif (in_array(strtolower($extension), ['png', 'webp'])) {
                    if (class_exists('Imagick')) {
                        try {
                            $imagick = new \Imagick($filePath);
                            $imagick->setImageFormat('jpeg');
                            $imagick->setImageCompressionQuality(80);
                            $zip->addFromString($zipPath . '.jpg', $imagick->getImageBlob());
                            $imagick->clear();
                            $imagick->destroy();
                            $filesAdded++;
                        } catch (\Exception $e) {
                            $image = @imagecreatefromstring(file_get_contents($filePath));
                            if ($image) {
                                $bg = imagecreatetruecolor(imagesx($image), imagesy($image));
                                imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
                                imagealphablending($bg, TRUE);
                                imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
                                ob_start();
                                imagejpeg($bg, null, 80);
                                $imgData = ob_get_clean();
                                imagedestroy($bg);
                                imagedestroy($image);
                                $zip->addFromString($zipPath . '.jpg', $imgData);
                                $filesAdded++;
                            } else {
                                $zip->addFile($filePath, $zipPath . '.' . $extension);
                                $filesAdded++;
                            }
                        }
                    } else {
                        $image = @imagecreatefromstring(file_get_contents($filePath));
                        if ($image) {
                            $bg = imagecreatetruecolor(imagesx($image), imagesy($image));
                            imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
                            imagealphablending($bg, TRUE);
                            imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
                            ob_start();
                            imagejpeg($bg, null, 80);
                            $imgData = ob_get_clean();
                            imagedestroy($bg);
                            imagedestroy($image);
                            $zip->addFromString($zipPath . '.jpg', $imgData);
                            $filesAdded++;
                        } else {
                            $zip->addFile($filePath, $zipPath . '.' . $extension);
                            $filesAdded++;
                        }
                    }
                } else {
                    $zip->addFile($filePath, $zipPath . '.' . $extension);
                    $filesAdded++;
                }
            }
        }

        $zip->close();
        
        if ($filesAdded > 0) {
            return response()->download($zipFile)->deleteFileAfterSend(true);
        } else {
            @unlink($zipFile);
            abort(404, 'Berkas fisik tidak ditemukan di server.');
        }
    }
    abort(500, 'Gagal membuat file ZIP');
})->middleware('auth')->name('download.berkas');
