<?php
require_once 'connection.php';
session_start();

// GET list tugas harian untuk $lokasi
$lokasi = $_SESSION['lokasi'];
$sql = "SELECT k.tugas_id, th.details, k.nama, 
            CASE 
                WHEN k.status = 0 THEN 'Bersih'
                WHEN k.status = 1 THEN 'Kurang Bersih'
                WHEN k.status = 2 THEN 'Kotor'
                END as statusBersih,
            k.catatan, k.filename, date_format(created_at, '%H:%i') as 'created_at' 
        FROM komplain k 
            JOIN tugas_harian th ON k.tugas_id = th.id
        WHERE th.lokasi = '$lokasi'
        ORDER BY k.tugas_id;";
$result1 = mysqli_query($conn, $sql);
if (!$result1) die('Error executing query: ' . mysqli_error($conn));

$_SESSION['allKomplain'] =  mysqli_fetch_all($result1);
header('Location: ../lihatKomplain.php');
