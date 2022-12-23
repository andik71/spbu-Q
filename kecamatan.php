<!-- header -->
<?php include('template/header.php') ?>
<!-- navbar -->
<?php include('template/navbar.php') ?>
<!-- content -->
<?php include 'koneksi.php';
session_start();
?>

<div class="page-content p-5" id="content">
    <div class="data-pesan" data-pesan="<?php if (isset($_SESSION['pesan'])) {
                                            echo $_SESSION['pesan'];
                                        }
                                        unset($_SESSION['pesan']); ?>"></div>
    <div class="row">

        <div class="col-lg-12">

            <div class="card">
                <div class="card-header">
                    <i class="fa fa-table"></i>
                    <strong>
                        Data Kecamatan
                    </strong>
                </div>
                <div class="card-body">
                    <p class="card-text">Page ini menampilkan halaman untuk melihat dan mengelola data Kecamatan</p>
                </div>
            </div>

        </div>

        <div class="col-lg-12 mt-4">

            <div class="card">
                <div class="card-header">
                    <a href="add_kecamatan.php" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i>
                        Tambah Data
                    </a>
                    <a href="#" class="btn btn-secondary btn-sm">
                        <i class="fa fa-file"></i>
                        Unduh PDF
                    </a>
                </div>

                <div class="card-body">

                    <!-- Tabel Kecamatan -->
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Kecamatan</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = $conn->query("SELECT * FROM kecamatan");
                            $no = 0;
                            if ($query->num_rows > 0) {
                                while ($row = $query->fetch_row()) {
                            ?>
                                    <tr>
                                        <td><?= $no += 1; ?></td>
                                        <td><?= $row[1]; ?></td>
                                        <td class="d-inline d-block text-center">
                                            <a class="btn btn-warning btn-sm" href="detail_kecamatan.php?id=<?= $row[0]; ?>"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-info btn-sm btn-edit-kecamatan" href="edit_kecamatan.php?id=<?= $row[0]; ?>"><i class="fa fa-pencil-square-o"></i></a>
                                            <a class="btn btn-danger btn-sm btn-hapus-kecamatan" href="delete_kecamatan.php?id=<?= $row[0]; ?>"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                            <?php }
                            } ?>
                        </tbody>

                    </table>

                </div>
            </div>

        </div>

    </div>

    <script>
        //swetalert
        //success
        let pesan = $('.data-pesan').data('pesan');

        if (pesan) {
            Swal.fire({
                icon: 'success',
                title: pesan,
                showConfirmButton: false,
                timer: 1500
            })
        }
        //hapus kecamatan
        $('.btn-hapus-kecamatan').on('click', function(e) {
            e.preventDefaulth();
            const href = $(this).attr('href');

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "data kecamatan akan dihapus?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus data!'
            }).then((result) => {
                if (result.value) {
                    document.location.href = href;
                }
            })
        });
    </script>

    <!-- end content -->
    <!-- footer -->
    <?php include('template/footer.php') ?>