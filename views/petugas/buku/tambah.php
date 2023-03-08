<h5>Form Tambah Buku</h5>
<hr style="height: 12px; background-color: black; border-radius: 10px;">

    <form action="Routes/proses.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
        <label for="">judul buku :</label>
            <input class="form-control" type="text" name="nisn" placeholder="Masukkan Judul buku"><br>
                <label for="">Deskripsi :</label>
                <input class="form-control" type="text" name="nama" placeholder="Masukkan Deskripsi"><br>
                <label for="">Penulis :</label>
                <input class="form-control" type="text" name="kelas" placeholder="Masukkan Kelas"><br>
                <label for="">Penerbit :</label>
                <input class="form-control" type="text" name="foto" placeholder="Masukkan penerbit"><br>
                <label for="">Foto :</label>
                <input class="form-control" type="file" name="foto" placeholder="Masukkan Foto"><br>
            <input class="btn btn-success form-control" type="submit" name="tambahbuku" id="">
        <a class="btn btn-danger" href="dashboard.php?pages=buku">Kembali</a>
    </div>
    </form>