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

        <div class="col-lg-12 mt-4">

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><i class="fa fa-user-circle-o"></i> Pengguna</h5>
                </div>

                <div class="card-body">

                    <!-- Tabel User -->
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama User</th>
                                <th scope="col">Username</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // SQL Command
                            $query = $conn->query("SELECT * FROM user");
                            $no = 0;
                            // Looping Data
                            if ($query->num_rows > 0) {
                                while ($row = $query->fetch_row()) {
                            ?>
                                    <tr>
                                        <td><?= $no += 1; ?></td>
                                        <td><?= $row[1]; ?></td>
                                        <td><?= $row[2]; ?></td>
                                        <td class="d-inline d-block text-center">
                                            <!-- <a class="btn btn-warning btn-sm" href="detail_user.php?id=<?= $row[0]; ?>"><i class="fa fa-eye"></i></a> -->
                                            <a class="btn btn-info btn-sm btn-edit-user" href="edit_user.php?id=<?= $row[0]; ?>"><i class="fa fa-pencil-square-o"></i></a>
                                            <a class="btn btn-danger btn-sm btn-hapus-user" href="delete_user.php?id=<?= $row[0]; ?>"><i class="fa fa-trash"></i></a>
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

    <!-- end content -->
    <!-- footer -->
    <?php include('template/footer.php') ?>