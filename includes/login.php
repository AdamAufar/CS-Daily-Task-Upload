
<?php
require_once 'connection.php';
session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(!empty($_POST['username'] && !empty($_POST['password']))) {
        $username = $_POST['username'];
        $password = $_POST['password'];
    }

    $sql = "SELECT id, nik, nama, jabatan 
            FROM users 
            WHERE username='$username' AND BINARY password='$password' 
            LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die('Error executing query: ' . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) == 1) {
        $qry =  mysqli_fetch_assoc($result);
        $_SESSION['id'] = $qry['id'];
        $_SESSION['nama'] = $qry['nama'];
        $_SESSION['nik'] = $qry['nik'];
        $_SESSION['jabatan'] = $qry['jabatan'];

        $userid = $_SESSION['id'];
        $sql = "UPDATE users SET status = 1 WHERE id = $userid";
        print_r($sql);
        $login_q = mysqli_query($conn, $sql);

        header('Location: ../petugasMenu.php');
    } else {
        echo "<script>alert('User Tidak Valid')</script>";
        header('Location: ../login.php');
    }
}