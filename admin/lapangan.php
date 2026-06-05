<?php

session_start();

require '../config/koneksi.php';

include '../layouts/header.php';

?>

<div class="container-fluid">

    <div class="row">

        <?php include '../layouts/sidebar_admin.php'; ?>

        <div class="col-md-10">

            <div class="p-4">

                <h3>Data Lapangan</h3>

                <a href="tambah_lapangan.php"
                    class="btn btn-success mb-3">

                    Tambah Lapangan

                </a>

                <table class="table table-bordered bg-white">

                    <tr>

                        <th>ID</th>
                        <th>Nama</th>
                        <th>Jenis</th>
                        <th>Harga</th>
                        <th>Aksi</th>

                    </tr>

                    <?php

                    $data = $db->query(
                        "SELECT * FROM lapangan"
                    );

                    while ($row = $data->fetch(PDO::FETCH_ASSOC)) {

                    ?>

                        <tr>

                            <td><?= $row['id_lapangan'] ?></td>

                            <td><?= $row['nama_lapangan'] ?></td>

                            <td><?= $row['jenis_olahraga'] ?></td>

                            <td>
                                Rp <?= number_format(
                                        $row['harga_per_jam']
                                    ) ?>
                            </td>

                            <td>

                                <a href="edit_lapangan.php?id=<?= $row['id_lapangan'] ?>"
                                    class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                                <a href="hapus_lapangan.php?id=<?= $row['id_lapangan'] ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus data?')">

                                    Hapus

                                </a>

                            </td>

                        </tr>

                    <?php } ?>

                </table>

            </div>

        </div>

    </div>

</div>