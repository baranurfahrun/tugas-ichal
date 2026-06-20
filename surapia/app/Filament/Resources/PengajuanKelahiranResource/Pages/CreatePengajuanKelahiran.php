<?php

namespace App\Filament\Resources\PengajuanKelahiranResource\Pages;

use App\Filament\Resources\PengajuanKelahiranResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreatePengajuanKelahiran extends CreateRecord
{
    protected static string $resource = PengajuanKelahiranResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $berkasLengkap = !empty($data['file_ktp'])
            && !empty($data['file_kk'])
            && !empty($data['file_ket_lahir']);

        $data['status'] = $berkasLengkap ? 'pengajuan_dikirim' : 'draft';

        // Paksa isi faskes_id dan user_id dari auth user, menghindari manipulasi form
        if (auth()->user()->isFaskes()) {
            $data['faskes_id'] = auth()->user()->faskes_id;
            $data['user_id'] = auth()->id();
        }

        return $data;
    }

    protected function afterCreate(): void
    {
        $record = $this->getRecord();

        if ($record->status === 'draft') {
            $missing = [];
            if (empty($record->file_ktp))       $missing[] = '📄 Scan KTP Orang Tua';
            if (empty($record->file_kk))        $missing[] = '📄 Scan Kartu Keluarga';
            if (empty($record->file_ket_lahir)) $missing[] = '📄 Surat Keterangan Lahir';

            Notification::make()
                ->title('⚠️ Data Tersimpan sebagai Draft')
                ->body(
                    'Berkas yang belum diupload: ' . implode(', ', $missing) . '. '
                    . 'Silakan lengkapi berkas, lalu klik tombol "Kirim ke Disdukcapil".'
                )
                ->warning()
                ->persistent()
                ->send();
        } else {
            Notification::make()
                ->title('✅ Pengajuan Berhasil Dikirim!')
                ->body('Semua berkas lengkap. Pengajuan telah dikirim ke Disdukcapil untuk diverifikasi.')
                ->success()
                ->send();

            $disdukcapil = \App\Models\User::where('role', 'admin_disdukcapil')->get();
            if ($disdukcapil->count() > 0) {
                Notification::make()
                    ->title('Pengajuan Kelahiran Baru')
                    ->body('Pengajuan baru dari ' . $record->faskes->nama_faskes . ' untuk bayi ' . $record->nama_bayi)
                    ->info()
                    ->sendToDatabase($disdukcapil);
            }
        }
    }
}
