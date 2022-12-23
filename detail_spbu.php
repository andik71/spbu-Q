<!header>
    <?php include('template/header.php') ?>
    <!navbar>
        <?php include('template/navbar.php') ?>
        <!content>
            <?php

            include 'koneksi.php';

            $id = $_GET['id'];

            $query = $conn->query("SELECT * FROM spbu WHERE id='$id'");
            $row = $query->fetch_assoc();

            $id = $row['id'];
            $nama = $row['nama'];
            $perusahaan = $row['perusahaan'];
            $alamat = $row['alamat'];
            $kecamatan = $row['kecamatan'];
            $latitude = $row['latitude'];
            $longitude = $row['longitude'];
            ?>

            <div class="page-content p-5" id="content">

                <div class="row">

                    <div class="col-lg-12 mt-5">

                        <div class="card">
                            <div class="card-header">
                                <a class="btn btn-primary btn-sm" href="spbu.php"><i class="fa fa-arrow-left"></i>&nbsp;Kembali</a>
                            </div>

                            <div class="card-body">
                                <h5 class="card-text">Lihat Data SPBU</h5>

                                <table class="table table-bordered ">
                                    <thead class="bg-dark text-warning text-center">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama SPBU</th>
                                            <th scope="col">Nama Perusahaan</th>
                                            <th scope="col">Alamat</th>
                                            <th scope="col">Kecamatan</th>
                                            <th scope="col">Latitude</th>
                                            <th scope="col">Longitude</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="col"><?= $id; ?></th>
                                            <td><?= $nama; ?></td>
                                            <td><?= $perusahaan; ?></td>
                                            <td><?= $alamat; ?></td>
                                            <td><?= $kecamatan; ?></td>
                                            <td><?= $latitude; ?></td>
                                            <td><?= $longitude; ?></td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <! end content>
                <! footer>
                    <?php include('template/footer.php') ?>