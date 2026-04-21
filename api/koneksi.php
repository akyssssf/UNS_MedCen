<?php
/**
 * api/koneksi.php — Database Connection
 * Membaca kredensial dari Environment Variables Vercel.
 * Set di: Vercel Dashboard → Project → Settings → Environment Variables
 *
 * Variabel yang perlu diset di Vercel:
 *   DB_HOST  → host database cloud (misal: dari Freemysqlhosting/Railway/Aiven)
 *   DB_USER  → username database
 *   DB_PASS  → password database
 *   DB_NAME  → nama database (uns_medicalcenterDB)
 *   DB_PORT  → port (biasanya 3306)
 */

ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);

// Baca dari ENV Vercel — fallback ke localhost untuk development lokal
$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';
$db   = getenv('DB_NAME') ?: 'uns_medicalcenterDB';
$port = (int)(getenv('DB_PORT') ?: 3306);

$koneksi = mysqli_connect($host, $user, $pass, $db, $port);

if (!$koneksi) {
    error_log("DB Connection Failed: " . mysqli_connect_error());
    http_response_code(503);
    die("Layanan sementara tidak tersedia. Silakan coba beberapa saat lagi.");
}

mysqli_set_charset($koneksi, 'utf8mb4');
?>
