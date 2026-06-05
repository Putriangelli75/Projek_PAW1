<?php

require '../config/koneksi.php';

if (isset($_POST['simpan'])) {

    $nama = $_POST['nama'];
    $jenis = $_POST['jenis'];
    $harga = $_POST['harga'];

    $stmt = $db->prepare("
    INSERT INTO lapangan
    (
        nama_lapangan,
        jenis_olahraga,
        harga_per_jam
    )
    VALUES
    (
        ?,
        ?,
        ?
    )
    ");

    $stmt->execute([
        $nama,
        $jenis,
        $harga
    ]);

    header("Location: lapangan.php");
}
?>

<form method="POST">

    <input
        type="text"
        name="nama"
        placeholder="Nama Lapangan"
        class="form-control mb-2">

    <input
        type="text"
        name="jenis"
        placeholder="Jenis Olahraga"
        class="form-control mb-2">

    <input
        type="number"
        name="harga"
        placeholder="Harga"
        class="form-control mb-2">

    <button
        name="simpan"
        class="btn btn-success">

        Simpan

    </button>

</form>