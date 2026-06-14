@echo off
echo =========================================
echo Auto Installer Kebutuhan Sistem
echo Pastikan komputer terhubung ke Internet!
echo =========================================
echo.

:: Check for Winget (Bawaan Windows 10/11)
where winget >nul 2>&1
if %errorlevel% neq 0 (
    echo [ERROR] Komputer kamu tidak memiliki 'winget' ^(Windows Package Manager^).
    echo Fitur install otomatis ini membutuhkan Windows 10/11 versi terbaru.
    pause
    exit /b
)

:: Install PHP
echo [*] Mengecek PHP...
where php >nul 2>&1
if %errorlevel% neq 0 (
    echo PHP belum terinstal. Sedang mendownload dan menginstal PHP otomatis...
    echo Mohon tunggu, proses ini memakan waktu beberapa menit...
    winget install -e --id PHP.PHP --accept-package-agreements --accept-source-agreements --silent
    echo [OK] Instalasi PHP Selesai!
) else (
    echo [OK] PHP sudah terinstal.
)
echo.

:: Install Composer
echo [*] Mengecek Composer...
where composer >nul 2>&1
if %errorlevel% neq 0 (
    echo Composer belum terinstal. Sedang mendownload dan menginstal Composer otomatis...
    winget install -e --id getcomposer.Composer --accept-package-agreements --accept-source-agreements --silent
    echo [OK] Instalasi Composer Selesai!
) else (
    echo [OK] Composer sudah terinstal.
)
echo.

:: Install Node.js (LTS)
echo [*] Mengecek Node.js / NPM...
where npm >nul 2>&1
if %errorlevel% neq 0 (
    echo Node.js belum terinstal. Sedang mendownload dan menginstal Node.js otomatis...
    echo Mohon tunggu, proses ini memakan waktu beberapa menit...
    winget install -e --id OpenJS.NodeJS.LTS --accept-package-agreements --accept-source-agreements --silent
    echo [OK] Instalasi Node.js Selesai!
) else (
    echo [OK] Node.js sudah terinstal.
)
echo.

echo =========================================
echo [*] Mengecek Dependensi Proyek...
echo =========================================

where composer >nul 2>&1
if %errorlevel% equ 0 (
    if not exist "vendor\" (
        echo [!] Menginstal dependensi PHP ^(composer install^)...
        call composer install
    ) else (
        echo [OK] Dependensi PHP sudah terinstal.
    )
) else (
    echo [WARNING] Perintah 'composer' belum terbaca di terminal ini.
    echo Silakan tutup terminal lalu jalankan 'composer install' secara manual nanti.
)

echo.
where npm >nul 2>&1
if %errorlevel% equ 0 (
    if not exist "node_modules\" (
        echo [!] Menginstal dependensi Node.js ^(npm install^)...
        call npm install
    ) else (
        echo [OK] Dependensi Node.js sudah terinstal.
    )
) else (
    echo [WARNING] Perintah 'npm' belum terbaca di terminal ini.
    echo Silakan tutup terminal lalu jalankan 'npm install' secara manual nanti.
)

echo.
echo =========================================
echo PROSES SELESAI!
echo Jika ada peringatan [WARNING] di atas, kamu WAJIB menutup jendela Terminal / PowerShell / VS Code ini sekarang.
echo Lalu buka kembali terminal dan jalankan perintah yang diminta secara manual.
echo Jika tidak ada peringatan, kamu bisa langsung menjalankan server.
echo =========================================
pause
