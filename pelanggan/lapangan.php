<?php

require '../config/koneksi.php';

$data = $db->query(
    "SELECT * FROM lapangan"
);

while ($row = $data->fetch(PDO::FETCH_ASSOC)) {

?>

    <div class="card mb-3">

        <div class="card-body">

            <h4>

                <?= $row['nama_lapangan'] ?>

            </h4>

            <p>

                <?= $row['jenis_olahraga'] ?>

            </p>

            <h5>

                Rp <?= number_format(
                        $row['harga_per_jam']
                    ) ?>

            </h5>

            <a
                href="booking.php?id=<?= $row['id_lapangan'] ?>"
                class="btn btn-success">

                Booking

            </a>

        </div>

    </div>

<?php
}
?>