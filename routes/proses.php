<?php
include '../Controllers/db.php';

// PROSES LOGIN DAN LOGOUT
if (@$_POST['login']) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == '' || $password == '') {
        session_start();
        $_SESSION['fail'] = 'Anda Gagal Login!';
        header('location:../login.php');
    } else {
        $perpus->proseslogin($username, $password);
    }
}

if (@$_GET['aksi'] == 'logout') {
    $perpus->logout();
}
// PROSES LOGIN DAN LOGOUT

// PROSES TAMBAH USERS
if (@$_POST['simpan_user']) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $perpus->prosestambahusers($username, $password);
}
// PROSES TAMBAH USERS

// PROSES UBAH USERS
if (@$_POST['ubahusers']) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $id = $_POST['id'];

    $perpus->ubahusers($id, $username, $password);
}
// PROSES UBAH USERS

// PROSES HAPUS USERS
if (@$_GET['act'] == 'hapus_user') {
    $id = $_GET['id'];
    $perpus->hapus_user($id);
}
// PROSES HAPUS USERS


// PROSES TAMBAH SISWA
if (@$_POST['simpansiswa']) {
    $nisn = $_POST['nisn'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];

    $foto = $_FILES['foto']['name'];
    $ukuran = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];

    if ($ukuran > 0 || $error == 0) {
        $move = move_uploaded_file($_FILES['foto']['tmp_name'], '../assets/img/' . $foto);
        if ($move) {
            echo "File '$foto' dengan ukuran $ukuran sudah terupload";
        } else {
            echo "Terjadi kesalahan mengupload";
        }
    } else {
        echo "File Gagal Diupload" . $error;
    }

    $perpus->prosestambahsiswa($nisn, $nama, $kelas, $foto);
}
// PROSES TAMBAH SISWA

// PROSES UBAH SISWA
if (@$_POST['ubahsiswa']) {
    $nisn = $_POST['nisn'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $foto = $_POST['foto'];

    $id = $_POST['id'];

    $perpus->ubahsiswa($nisn, $nama, $kelas, $foto, $id);
}
// PROSES UBAH SISWA

// PROSES HAPUS SISWA
if (@$_GET['act'] == 'hapussiswa') {
    $id = $_GET['id'];
    $perpus->hapusbuku($id);
}

// PROSES TAMBAH BUKU
if (@$_POST['simpanbuku']) {
    $jubuk = $_POST['judul_buku'];
    $dk = $_POST['deskripsi'];
    $ps = $_POST['penulis'];
    $pn = $_POST['penerbit'];

    $foto = $_FILES['foto']['name'];
    $ukuran = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];

    if ($ukuran > 0 || $error == 0) {
        $move = move_uploaded_file($_FILES['foto']['tmp_name'], '../assets/img/' . $foto);
        if ($move) {
            echo "File '$foto' dengan ukuran $ukuran sudah terupload";
        } else {
            echo "Terjadi kesalahan mengupload";
        }
    } else {
        echo "File Gagal Diupload" . $error;
    }

    $perpus->prosestambahbuku($jubuk, $dk, $ps, $pn, $foto, $id);

// PROSES UBAH BUKU
if (@$_POST['ubahbuku']) {
    $jubuk = $_POST['judul_buku'];
    $dk = $_POST['deskripsi'];
    $ps = $_POST['penulis'];
    $pn = $_POST['penerbit'];
    $foto = $_POST['foto'];

    $id = $_POST['id'];

    $perpus->ubahsiswa($jubuk, $dk, $ps, $pn, $foto, $id);
}
}
