@echo off
setlocal

:: Path ke folder PHP 8.3 lokal
set PHP_DIR=%~dp0php83

:: Jika PHP 8.3 belum ada, jalankan script downloader
if not exist "%PHP_DIR%\php.exe" (
    powershell -ExecutionPolicy Bypass -File "%~dp0install_php83.ps1"
)

:: Paksa sistem pakai PHP 8.3 lokal INI khusus untuk terminal ini
set PATH=%PHP_DIR%;%PATH%

:: Jalankan perintah yang diminta user
%*
