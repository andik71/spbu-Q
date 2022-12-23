<!header>
    <?php include('template/header.php') ?>
    <!navbar>
        <?php include('template/navbar.php') ?>
        <!content>
            <?php

            include 'koneksi.php';

            $id = $_GET['id'];

            $query = $conn->query("SELECT * FROM kecamatan WHERE id='$id'");
            $row = $query->fetch_assoc();

            $id = $row['id'];
            $nama = $row['nama'];
            $warna = $row['warna'];
            $poligon = $row['poligon'];

            ?>

            <div class="page-content p-5" id="content">

                <div class="row">

                    <div class="col-lg-12 mt-5">

                        <div class="card">
                            <div class="card-header">
                                <a class="btn btn-primary btn-sm" href="kecamatan.php"><i class="fa fa-arrow-left"></i>&nbsp;Kembali</a>
                            </div>

                            <div class="card-body">
                                <h5 class="card-text">Lihat Data Kecamatan</h5>

                                <table class="table table-bordered">
                                    <thead class="bg-dark text-warning text-center">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Kecamatan</th>
                                            <th scope="col">Warna</th>
                                            <th scope="col">Poligon</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="col"><?= $id; ?></th>
                                            <td><?= $nama; ?></td>
                                            <td style="background-color: <?= $warna; ?>;"><?= $warna; ?></td>
                                            <td><?= $poligon; ?></td>
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