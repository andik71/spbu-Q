<!-- header -->
<?php include('template/header.php') ?>
<!-- navbar -->
<?php include('template/navbar.php') ?>
<!-- content -->
<?php include 'koneksi.php';
session_start();
if (isset($_POST['simpan'])) {
    $id = $_GET['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perintah SQL untuk menginput data record
    $queryResult = $conn->query("UPDATE user SET nama='$nama', username='$username', password='$password' WHERE id='$id'");

    if ($queryResult) {
        $_SESSION['pesan'] = 'Data brhasil diubah';
        echo "<script>
        window.location.href = 'user.php';
        </script>";
    } else {
        echo "<script>alert('gagal diubah')</script>";
    }
}
?>

<div class="page-content p-5" id="content">
    <div class="data-pesan" data-pesan="<?php if (isset($_SESSION['pesan'])) {
                                            echo $_SESSION['pesan'];
                                        }
                                        unset($_SESSION['pesan']); ?>"></div>
    <div class="row">

        <div class="col-lg-12">

            <?php
            // Tangkap Request Data Kecamatan berdasarkan ID
            $id = $_GET['id'];
            $queryResult = $conn->query("SELECT * FROM user WHERE id='$id'");
            $nama = '';
            $username = '';
            $password = '';
            if ($queryResult) {
                // Perintah MySQLi
                $row = $queryResult->fetch_row();
                // Array
                $nama = $row[1];
                $username = $row[2];
                $password = $row[3];
            ?>

                <form action="" method="POST">

                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-pencil-square-o"></i>
                            <strong>Edit Data User</strong>
                            <p class="card-text small text-muted">Input data dengan mengisi input form</p>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Kecamatan..." value="<?= $nama ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="username" name="username" value="<?= $username ?>" required>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="password" name="password" value="<?= $password ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tombol" class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button class="btn btn-success col-lg-3" type="submit" name="simpan">Simpan</button>
                                    <a class="btn btn-info col-lg-3" href="user.php">Kembali</a>
                                </div>
                            </div>

                        </div>

                </form>

            <?php } // End
            ?>

        </div>

    </div>

</div>

<script>
    //swetalert
    //success
    let pesan = $(' .data-pesan').data('pesan');

    if (pesan) {
        Swal.fire({
            icon: 'success',
            title: pesan,
            showConfirmButton: false,
            timer: 1500
        })
    }
</script>
<!-- end content -->
<!-- footer -->
<?php include('template/footer.php') ?>