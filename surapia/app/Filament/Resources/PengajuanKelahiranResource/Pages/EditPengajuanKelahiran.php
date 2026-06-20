<?php

namespace App\Filament\Resources\PengajuanKelahiranResource\Pages;

use App\Filament\Resources\PengajuanKelahiranResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditPengajuanKelahiran extends EditRecord
{
    protected static string $resource = PengajuanKelahiranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('download_berkas')
                ->label('Download Berkas')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->visible(fn () => auth()->user()->isDisdukcapil())
                ->url(fn () => route('download.berkas', $this->record->id))
                ->openUrlInNewTab(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $currentStatus = $this->getRecord()->status;

        $berkasLengkap = !empty($data['file_ktp'])
            && !empty($data['file_kk'])
            && !empty($data['file_ket_lahir']);

        if (!$berkasLengkap) {
            // Jika berkas tidak lengkap, tapi statusnya sedang "dikirim", kembalikan ke draft
            if ($currentStatus === 'pengajuan_dikirim') {
                $data['status'] = 'draft';
            }
        } else {
            // Jika berkas lengkap dan sedang di draft, otomatis kirim
            if ($currentStatus === 'draft') {
                $data['status'] = 'pengajuan_dikirim';
            }
        }

        return $data;
    }

    protected function afterSave(): void
    {
        $record = $this->getRecord();

        $missing = [];
        if (empty($record->file_ktp))       $missing[] = '📄 Scan KTP Orang Tua';
        if (empty($record->file_kk))        $missing[] = '📄 Scan Kartu Keluarga';
        if (empty($record->file_ket_lahir)) $missing[] = '📄 Surat Keterangan Lahir';

        if (count($missing) > 0) {
            if ($record->status === 'draft') {
                Notification::make()
                    ->title('⚠️ Tersimpan sebagai Draft')
                    ->body(
                        'Berkas yang belum diupload: ' . implode(', ', $missing) . '. '
                        . 'Lengkapi berkas lalu klik "Kirim ke Disdukcapil".'
                    )
                    ->warning()
                    ->persistent()
                    ->send();
            } elseif ($record->status === 'revisi_faskes') {
                Notification::make()
                    ->title('⚠️ Perubahan Tersimpan')
                    ->body(
                        'Masih ada berkas yang kurang: ' . implode(', ', $missing) . '. '
                        . 'Lengkapi sebelum menekan "Ajukan Ulang".'
                    )
                    ->warning()
                    ->persistent()
                    ->send();
            }
        } else {
            if ($record->status === 'pengajuan_dikirim') {
                Notification::make()
                    ->title('✅ Berhasil!')
                    ->body('Semua berkas lengkap dan sudah masuk ke sistem Disdukcapil.')
                    ->success()
                    ->send();

                if ($this->getRecord()->getOriginal('status') === 'draft') {
                    $disdukcapil = \App\Models\User::where('role', 'admin_disdukcapil')->get();
                    if ($disdukcapil->count() > 0) {
                        Notification::make()
                            ->title('Pengajuan Kelahiran Baru')
                            ->body('Pengajuan baru dari ' . $record->faskes->nama_faskes . ' untuk bayi ' . $record->nama_bayi)
                            ->info()
                            ->sendToDatabase($disdukcapil);
                    }
                }
            } else {
                Notification::make()
                    ->title('✅ Perubahan Disimpan')
                    ->success()
                    ->send();
            }
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
