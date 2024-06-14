<?php
session_start();

if (isset($_POST['photo'])) {
    $data = $_POST['photo'];

    // Decode the base64 data
    list($type, $data) = explode(';', $data);
    list(, $data) = explode(',', $data);
    $data = base64_decode($data);

    // Generate a unique filename
    $filename = 'uploads/' . uniqid() . '.png';
    $_SESSION['filename'] =  $filename;

    // Save the file
    if (file_put_contents($filename, $data)) {
        $_SESSION['success_message'] = "The photo has been uploaded: " . $filename;
    } else {
        $_SESSION['error_message'] = "There was an error uploading the photo.";
    }
} else {
    $_SESSION['error_message'] = "No photo data received!";
}

// Redirect to the referring page
$_SESSION['upload'] = 1;
$_SESSION['filename'] = $filename;
$_SESSION['tugas_id'] = $_GET['tugas_id'];
$_SESSION['komplain_id'] = $_GET['komplain_id'];


$_SESSION['tugas_id_k'] = $_POST['tugas_id_k'];
$_SESSION['namaKaryawan'] = $_POST['namaKaryawan'];
$_SESSION['cleanStatus'] = $_POST['status'];
$_SESSION['cleanNote'] = $_POST['catatan'];

$script = basename($_SERVER['HTTP_REFERER']);
require_once 'includes/'. $script;
header("Location: $script");
exit();
?>
