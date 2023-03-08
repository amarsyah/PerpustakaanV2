<?php

// CLASS
class perpustakaan
{

    // PROPERTY
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "perpustakaan_v2";
    private $koneksi;

    // METHOD
    public function __construct()
    {
        $this->koneksi = mysqli_connect(
            $this->host,
            $this->username,
            $this->password,
            $this->database
        );
    }

    public function proseslogin($username, $password)
    {
        $query = $this->koneksi->query("SELECT * FROM users 
        WHERE
        username = '$username' AND
        password = md5('$password')");
        $data = $query->fetch_object();
        $count = $query->num_rows;

        if ($count > 0) {
            session_start();
            $_SESSION['login'] = 1;
            $_SESSION['username'] = $data->username;
            $_SESSION['level'] = $data->level;
            $_SESSION['nis'] = $data->nis;
            header('location:../dashboard.php');
        } else {
            session_start();
            $_SESSION['fail'] = 'Anda Gagal Login';
            header('location:../login.php');
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();

        // ALERT
        session_start();
        $_SESSION['success'] = 'Anda Berhasil Logout!';
        // unset($_SESSION['success']);

        header('location:../login.php');
    }

    // DATA USERS
    public function listusers()
    {
        $query = $this->koneksi->query("SELECT * FROM users");
        while ($data = $query->fetch_object()) {
            $hasil[] = $data;
        }
        return $hasil;
    }

    public function tampilubah($id)
    {
        $query = $this->koneksi->query("SELECT * FROM users WHERE user_id = '$id'");
        return $query->fetch_object();
    }

    public function ubahusers($id, $username, $password)
    {
        if ($password == '') {
            $query = $this->koneksi->query("UPDATE users SET username = '$username' WHERE user_id = '$id'");
        } else {
            $query = $this->koneksi->query("UPDATE users SET username = '$username', password = md5('$password') WHERE user_id = '$id'");
        }

        if ($query) {
            session_start();
            $_SESSION['success'] = "User Berhasil Diubah";
            header("location:../dashboard.php?pages=users");
        }
    }

    public function hapus_user($id)
    {
        $query = $this->koneksi->query("DELETE FROM users WHERE user_id = '$id'");
        if ($query) {
            session_start();
            $_SESSION['success'] = "User Berhasil Dihapus";
            header("location:../dashboard.php?pages=users");
        }
    }

    public function prosestambahusers($username, $password)
    {
        if ($username == '' || $password == '') {
            session_start();
            $_SESSION['fail'] = "Data Gagal Disimpan!";
            // $_SESSION['fail'] = "Data Gagal Disimpan!";
            header("location:../dashboard.php?pages=users");
        } else {
            $query = $this->koneksi->query("INSERT INTO users VALUES (null,'$username',md5('$password'),'Petugas','0')");
            session_start();
            $_SESSION['success'] = "Data Berhasil Disimpan!";
            // $_SESSION['fail'] = "Data Gagal Disimpan!";
            header("location:../dashboard.php?pages=users");
        }
    }

    public function jumlahusers()
    {
        $query = $this->koneksi->query("SELECT * FROM users");
        return $query->num_rows;
    }
    // DATA siswa

    public function list_siswa()
    {

        $query = $this->koneksi->query("SELECT * FROM siswa");
        while ($data = $query->fetch_object()) {
            $hasil[] = $data;
        }
        return $hasil;
    }

    

    public function ubahsiswa($nisn, $nama, $kelas, $foto, $id)
    {
        if ($nisn == '' || $nama == '' || $kelas == '' || $foto == '') {
            $query = $this->koneksi->query("UPDATE siswa SET nisn='$nisn',nama='$nama',kelas='$kelas',foto='$foto' WHERE siswa_id=$id");
        } else {
            $query = $this->koneksi->query("UPDATE siswa SET nisn='$nisn',nama='$nama',kelas='$kelas',foto='$foto' WHERE siswa_id=$id");
        }
        if ($query) {
            session_start();
            $_SESSION['success'] = "User berhasil di ubah";
            header('location:../dashboard.php?pages=siswa');
        }
    }

    public function tampilubahsiswa($id)
    {
        $query = $this->koneksi->query("SELECT * FROM siswa where siswa_id=$id");
        $data = $query->fetch_object();
        return $data;
    }

    public function hapussiswa($id)
    {
        $query = $this->koneksi->query("DELETE FROM siswa where siswa_id=$id");

        if ($query) {
            session_start();
            $_SESSION['success'] = "Siswa Berhasil di Hapus";
            header('location:../dashboard.php?pages=siswa');
        }
    }
    public function prosestambahsiswa($nisn, $nama, $kelas, $foto)
    {
        if ($nisn == '' || $nama == '' || $kelas == '' || $foto == '') {
            session_start();
            $_SESSION['warning'] = " isi Data, isi terlebih dahulu";
            header('location:../dashboard.php?pages=siswa&act=tambahsiswa');
        } else {
            $query = $this->koneksi->query("INSERT INTO siswa VALUES(null,'$nisn','$nama','$kelas','$foto')");

            if ($query) {
                session_start();
                $_SESSION['success'] = "Siswa berhasil di tambah";
                header('location:../dashboard.php?pages=siswa');
            }
        }
    }
    public function jumlahsiswa()
    {   
        $query = $this->koneksi->query("SELECT * FROM siswa");
        return $query->num_rows;
    }

    // DATA Buku

    public function prosestambahbuku($jubuk, $dk, $ps, $pn, $foto)
    {
        if ($jubuk == '' || $dk == '' || $ps == '' || $pn == '' || $foto == '') {
            session_start();
            $_SESSION['warning'] = "isi Data , isi terlebih dahulu";
            header('location:../dashboard.php?pages=buku&act=tambahbuku');
        } else {
            $query = $this->koneksi->query("INSERT INTO buku VALUES(null,'$jubuk','$dk','$ps','$pn',' $foto')");

            if ($query) {
                session_start();
                $_SESSION['success'] = "Buku berhasil di tambah";
                header('location:../dashboard.php?pages=buku');
            }
        }
    }
    public function list_buku()
    {

        $query = $this->koneksi->query("SELECT * FROM buku");
        while ($data = $query->fetch_object()) {
            $hasil[] = $data;
        }
        return $hasil;
    }


    public function ubahbuku($jubuk, $dk, $ps, $pn, $foto, $id)
    {
        if ($jubuk == '' || $dk == '' || $ps == '' || $pn == '' || $foto == '') {
            $query = $this->koneksi->query("UPDATE buku SET judul_buku='$jubuk',deskripsi='$dk',penulis='$ps',penerbit='$pn', foto ='$foto' WHERE id_buku=$id");
        } else {
            $query = $this->koneksi->query("UPDATE buku SET judul_buku='$jubuk',deskripsi='$dk',penulis='$ps',penerbit='$pn',foto='$foto' WHERE id_buku=$id");
        }
        if ($query) {
            session_start();
            $_SESSION['success'] = "buku berhasil di ubah";
            header('location:../dashboard.php?pages=buku');
        }
    }

    public function tampilubahbuku($id)
    {
        $query = $this->koneksi->query("SELECT * FROM buku where id_buku=$id");
        $data = $query->fetch_object();
        return $data;
    }

    public function hapusbuku($id)
    {
        $query = $this->koneksi->query("DELETE FROM buku where id_buku=$id");

        if ($query) {
            session_start();
            $_SESSION['success'] = "buku Berhasil di Hapus";
            header('location:../dashboard.php?pages=buku');
        }
    }
    public function jumlahbuku()
    {
        $query = $this->koneksi->query("SELECT * FROM buku");
        return $query->num_rows;
    }
}


$perpus = new perpustakaan();
