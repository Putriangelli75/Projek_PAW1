<?php

session_start();

require '../config/koneksi.php';

$id_user =
    $_SESSION['id_user'];

$stmt = $db->prepare(
    "SELECT *
FROM booking
WHERE id_user=?"
);

$stmt->execute([
    $id_user
]);

while (
    $row =
    $stmt->fetch(PDO::FETCH_ASSOC)
) {
?>

    <tr>

        <td>
            <?= $row['kode_booking'] ?>
        </td>

        <td>
            <?= $row['tanggal_booking'] ?>
        </td>

        <td>
            <?= $row['status'] ?>
        </td>

    </tr>

<?php
}
?>