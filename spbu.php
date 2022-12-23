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
                        Data SPBU
                    </strong>
                </div>
                <div class="card-body">
                    <p class="card-text">Page ini menampilkan halaman untuk melihat dan mengelola Data SPBU</p>
                </div>
            </div>

        </div>

        <div class="col-lg-12 mt-4">

            <div class="card">
                <div class="card-header">
                    <a href="add_spbu.php" class="btn btn-primary btn-sm">
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
                                <th scope="col">Nama</th>
                                <th scope="col">Perusahaan</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Kecamatan</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = $conn->query("SELECT * FROM spbu");
                            $no = 1;
                            if ($query->num_rows > 0) {
                                while ($row = $query->fetch_row()) { ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row[1]; ?></td>
                                        <td><?= $row[2]; ?></td>
                                        <td><?= $row[3]; ?></td>
                                        <td><?= $row[4]; ?></td>
                                        <td class="d-inline d-block text-center">
                                            <a class="btn btn-warning btn-sm" href="detail_spbu.php?id=<?= $row[0]; ?>"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-info btn-sm" href="edit_spbu.php?id=<?= $row[0]; ?>"><i class="fa fa-pencil-square-o"></i></a>
                                            <a class="btn btn-danger btn-sm" href="delete_spbu.php?id=<?= $row[0]; ?>"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>

</div>
<script>
    let pesan = $('.data-pesan').data('pesan');
    if (pesan) {
        Swal.fire({
            icon: 'success',
            title: pessan,
            showConfirmButton: false,
            timer: 1500
        })
    }
    $('.btn-hapus-spbu').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');

        Swal.fire({
            title: 'Yakin dek?',
            text: "data akan dihapus?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'blue',
            cencelButtonColor: 'red',
            confirmButtonText: "hapus data!"
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