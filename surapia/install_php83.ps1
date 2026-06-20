$ErrorActionPreference = "Stop"
$phpDir = Join-Path $PSScriptRoot "php83"
$zipFile = Join-Path $PSScriptRoot "php83.zip"

Write-Host "Sedang mendownload PHP 8.3 Portable..." -ForegroundColor Cyan
[Net.ServicePointManager]::SecurityProtocol = [Net.SecurityProtocolType]::Tls12
Invoke-WebRequest -Uri 'https://windows.php.net/downloads/releases/php-8.3.14-nts-Win32-vs16-x64.zip' -OutFile $zipFile

Write-Host "Mengekstrak file ZIP..." -ForegroundColor Cyan
Expand-Archive -Path $zipFile -DestinationPath $phpDir -Force
Remove-Item $zipFile

Write-Host "Konfigurasi ekstensi PHP..." -ForegroundColor Cyan
$iniPath = Join-Path $phpDir "php.ini"
Copy-Item (Join-Path $phpDir "php.ini-development") $iniPath

$c = Get-Content $iniPath
$c = $c -replace '^;extension=curl', 'extension=curl'
$c = $c -replace '^;extension=fileinfo', 'extension=fileinfo'
$c = $c -replace '^;extension=mbstring', 'extension=mbstring'
$c = $c -replace '^;extension=openssl', 'extension=openssl'
$c = $c -replace '^;extension=pdo_mysql', 'extension=pdo_mysql'
$c = $c -replace '^;extension=pdo_sqlite', 'extension=pdo_sqlite'
$c = $c -replace '^;extension=sqlite3', 'extension=sqlite3'
$c = $c -replace '^;extension=zip', 'extension=zip'
$c = $c -replace '^;extension_dir = "ext"', 'extension_dir = "ext"'

Set-Content -Path $iniPath -Value $c
Write-Host "Instalasi selesai!" -ForegroundColor Green
