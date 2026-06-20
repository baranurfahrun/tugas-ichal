@echo off
echo =========================================
echo Pengecekan Kebutuhan Sistem (Laravel+Vite)
echo =========================================
echo.

set missing=0

:: Check PHP
echo Mengecek PHP...
where php >nul 2>&1
if %errorlevel% neq 0 (
    echo [X] PHP TIDAK DITEMUKAN atau belum masuk ke PATH Environment Variables.
    echo     Silakan install XAMPP/Laragon dan tambahkan ke PATH.
    set /A missing+=1
) else (
    echo [OK] PHP Ditemukan.
    php -v | findstr /i "php"
)
echo.

:: Check Composer
echo Mengecek Composer...
where composer >nul 2>&1
if %errorlevel% neq 0 (
    echo [X] COMPOSER TIDAK DITEMUKAN.
    echo     Silakan install Composer dari (https://getcomposer.org/).
    set /A missing+=1
) else (
    echo [OK] Composer Ditemukan.
    composer -V | findstr /i "Composer"
)
echo.

:: Check Node.js/NPM
echo Mengecek NPM / Node.js...
where npm >nul 2>&1
if %errorlevel% neq 0 (
    echo [X] NPM/NODE.JS TIDAK DITEMUKAN.
    echo     Silakan install Node.js dari https://nodejs.org/
    set /A missing+=1
) else (
    echo [OK] NPM/Node.js Ditemukan.
    echo NPM version:
    npm -v
)
echo.

echo =========================================
if %missing% gtr 0 (
    echo KESIMPULAN: Ada aplikasi yang belum terinstal / belum masuk PATH.
    echo Silakan perbaiki error yang memiliki tanda [X] di atas sebelum menjalankan aplikasi.
) else (
    echo KESIMPULAN: SEMUA KEBUTUHAN SUDAH TERINSTAL DENGAN BAIK!
    echo Kamu bisa langsung menjalankan perintah:
    echo 1. php artisan serve
    echo 2. npm run dev
)
echo =========================================
pause
