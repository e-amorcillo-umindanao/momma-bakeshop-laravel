$proc = Get-Process mysqld -ErrorAction SilentlyContinue
if ($proc) {
    $path = $proc.Path
    Write-Host "Killing mysqld at $path"
    Stop-Process -Name mysqld -Force
    Start-Sleep -Seconds 3
    Write-Host "Restarting mysqld..."
    Start-Process $path -WindowStyle Hidden
    Write-Host "Restarted."
} else {
    Write-Host "mysqld not found."
}
