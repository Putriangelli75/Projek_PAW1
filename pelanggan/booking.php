<?php

session_start();

require '../config/koneksi.php';

$id_lapangan = $_GET['id'];

if (isset($_POST['booking'])) {

    $kode =
        "BK" . date("YmdHis");

    $stmt = $db->prepare("
    INSERT INTO booking
    (
        kode_booking,
        id_user,
        id_lapangan,
        tanggal_booking,
        jam_mulai,
        durasi,
        total_bayar
    )
    VALUES
    (
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?
    )
    ");

    $stmt->execute([

        $kode,

        $_SESSION['id_user'],

        $id_lapangan,

        $_POST['tanggal'],

        $_POST['jam'],

        $_POST['durasi'],

        $_POST['total']

    ]);

    echo "
    <script>
    alert('Booking berhasil');
    location='riwayat_booking.php';
    </script>
    ";
}
?>

<form method="POST">

    <input
        type="date"
        name="tanggal"
        class="form-control mb-2">

    <input
        type="time"
        name="jam"
        class="form-control mb-2">

    <input
        type="number"
        name="durasi"
        class="form-control mb-2">

    <input
        type="number"
        name="total"
        class="form-control mb-2">

    <button
        name="booking"
        class="btn btn-success">

        Booking Sekarang

    </button>

</form>