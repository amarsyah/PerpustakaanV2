<?php

?>

<a class="btn btn-success mb-3 shadow" href="dashboard.php?pages=buku&act=tambah">Tambah Data Buku</a>

<table class='table border shadow'>

    <tr class="bg-primary text-light">
        <th>No</th>
        <th>Judul Buku</th>
        <th>Deskripsi</th>
        <th>Penulis</th>
        <th>Pernerbit</th>
        <th>Gambar Buku</th>
        <th>Opsi</th>
    </tr>

    <?php
    $no = 1;
    foreach ($perpus->list_buku() as $b) {
    ?>
        <tr>
            <td><?= $no; ?></td>
            <td><?= $b->judul_buku; ?></td>
            <td><?= $b->deskripsi; ?></td>
            <td><?= $b->penulis; ?></td>
            <td><?= $b->penerbit; ?></td>
            <td><img src='assets/img/<?= $b->image ?>' width='100' height="100"></td>
            <td>
                <a class="btn btn-primary" href="dashboard.php?pages=buku&act=ubahbuku&id=<?= $b->id_buku ?>">Ubah</a>
                <a class="btn btn-danger" href="Routes/proses.php?act=hapusbuku&id=<?= $b->id_buku ?>" onclick="return confirm('yakin  ingin dihapus?')">Hapus</a>
            </td>
        </tr>

    <?php
        $no++;
    }
    ?>

</table>