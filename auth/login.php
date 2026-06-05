<?php

session_start();
require '../config/koneksi.php';

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $db->prepare("
        SELECT *
        FROM users
        WHERE email = ?
    ");

    $stmt->execute([$email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {

        if (password_verify(
            $password,
            $user['password']
        )) {

            $_SESSION['id_user']
                = $user['id_user'];

            $_SESSION['nama']
                = $user['nama'];

            $_SESSION['role']
                = $user['role'];

            if ($user['role'] == 'admin') {

                header(
                    "Location: ../admin/dashboard.php"
                );
            } else {

                header(
                    "Location: ../pelanggan/dashboard.php"
                );
            }

            exit;
        }
    }

    echo "Login gagal";
}
