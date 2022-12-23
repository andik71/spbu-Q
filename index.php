<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location:login.php");
}
?>
<?php include('template/header.php') ?>
<?php include('template/navbar.php') ?>


<!-- Content untuk halaman index -->
<div class="page-content p-5 bg-light" id="content">

    <!-- Banner  -->
    <div class="jumbotron jumbotron-fluid bg-warning">

        <div class="container-fluid">
            <div class="row mx-5">
                <div class="col-lg-10">
                    <h1 class="display-4 fs-4 fw-bold">SPBU-Q</h1>
                    <p class="lead">Sistem Informasi Geografis Untuk Pemetaan SPBU di Kota Palu Berbais Website</p>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <!-- Isi Konten -->
        <div class="col-lg-12 mb-3">

            <div class="card">
                <div class="card-header">
                    <i class="fa fa-newspaper-o"></i>
                    <strong>Definisi</strong>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Stasiun Pengisian Bahan Bakar Umum</h5>
                    <p class="card-text">
                        Stasiun pengisian bahan bakar adalah tempat di mana kendaraan bermotor bisa memperoleh bahan bakar. Di
                        Indonesia, Stasiun Pengisian Bahan Bakar dikenal dengan nama SPBU (singkatan dari Stasiun Pengisian Bahan
                        Bakar Umum). Namun, masyarakat juga memiliki sebutan lagi bagi SPBU.
                        <br><br>
                        Misalnya di kebanyakan daerah, SPBU disebut Pom Bensin yang adalah singkatan dari Pompa Bensin. Di
                        beberapa daerah terdapat penyebutan lain untuk SPBU, seperti contoh di Maluku, SPBU disebut Stasiun
                        bensin, di beberapa daerah di Medan, SPBU disebut Galon Minyak dan di sejumlah daerah di Bengkulu, SPBU
                        disebut Kios
                    </p>
                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    <!-- Gambar Artikel -->
                    <img class="img img-fluid" style="object-fit: cover; max-height: 450px;" src="img/hero_banner.jpg" class="card-img-top" alt="hero_banner.jpg">

                    <br>

                    <p>
                        Minyak.

                        Di luar negeri seperti Amerika Serikat dan Eropa, Stasiun Pengisian Bahan Bakar juga melayani pengisian daya
                        untuk kendaraan motor listrik yang disebut dengan Stasiun Pengisian Kendaraan Listrik Umum.
                        <br><br>
                        Stasiun Pengisian Bahan Bakar di Indonesia pada umumnya menyediakan beberapa jenis bahan bakar minyak dan gas,
                        misalnya:
                    <ul type="bullet">
                        <li>Bensin dan beragam varian produk Bensin</li>
                        <li>Bahan bakar diesel (Solar)</li>
                        <li>E85 (etanol+bensin)</li>
                        <li>LPG dalam berbagai ukuran tabung</li>
                        <li>Minyak tanah ("kerosene")</li>
                        <li>Compressed Natural Gas (CNG)</li>
                    </ul>
                    Banyak Stasiun Pengisian Bahan Bakar yang juga menyediakan layanan tambahan. Misalnya, musholla, pompa angin,
                    toilet dan lain sebagainya. Stasiun Pengisian Bahan Bakar modern, bisanya dilengkapi pula dengan minimarket
                    dan ATM. Tak heran apabila Stasiun Bahan Bakar juga menjadi meeting point atau tempat istirahat. Bahkan, ada
                    beberapa Stasiun Pengisian Bahan Bakar, terutama di jalan tol atau jalan antar kota, memiliki kedai kopi atau
                    berbagai waralaba restoran fast food.
                    <br><br>
                    Di beberapa negara, termasuk Indonesia, Stasiun Pengisian Bahan Bakar dijaga oleh petugas-petugas yang
                    mengisikan bahan bakar kepada pelanggan. Pelanggan kemudian membayarkan biaya pengisian kepada petugas. Di
                    negara-negara lainnya, misalnya di Amerika Serikat atau Eropa, pompa-pompa bensin tidak dijaga oleh petugas;
                    pelanggan mengisi bahan bakar sendiri dan kemudian membayarnya kepada petugas di sebuah loket/counter.
                    </p>
                </div>
            </div>

        </div>

        <!-- Maps -->
        <div class="col-lg-12 mb-3">

            <div class="card p-0 mx-0">
                <div class="card-header">
                    <i class="fa fa-map-o me-5"></i>
                    <strong>Pemetaan</strong>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <!-- Filter #1 -->
                        <div class="form-group col-lg-4">
                            <select id="lokasi_awal" class="form-control">
                                <option selected>-- Lokasi Awal --</option>
                                <?php
                                include 'koneksi.php';
                                $kec = $conn->query("SELECT * FROM spbu");
                                if ($kec->num_rows > 0) {
                                    while ($row = $kec->fetch_assoc()) {
                                ?>
                                        <!-- tambahkan spasi antara, dan longitude -->
                                        <option value="<?= $row['latitude']; ?>, <?= $row['longitude']; ?>" ?><?= $row['nama']; ?></option>
                                <?php }
                                } ?>
                            </select>
                        </div>
                        <!-- Filter #2 -->
                        <div class="form-group col-lg-4">
                            <select id="lokasi_tujuan" class="form-control">
                                <option selected>-- Lokasi Tujuan --</option>
                                <?php

                                include 'koneksi.php';
                                $kec = $conn->query("SELECT * FROM spbu");

                                if ($kec->num_rows > 0) {
                                    while ($row = $kec->fetch_assoc()) {
                                ?>
                                        <option value="<?= $row['latitude']; ?>,<?= $row['longitude']; ?>" ?><?= $row['nama']; ?></option>
                                <?php }
                                } ?>
                            </select>
                        </div>
                        <!-- Tombol Rute -->
                        <div class="col-lg-4 d-inline d-block">
                            <button id="rute" class="btn btn-success btn-md btn-success col-12">Rute</button>
                        </div>
                        <!-- Javascript Map OpenStreet -->
                        <div class="col-lg-12 p-0">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">

            <!-- Tabel Informasi -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-map-pin me-5"></i>
                    <strong>SPBU Kota Palu</strong>
                </div>
                <div class="card-body">
                    <!-- Table Alamat -->
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Perusahaan</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Kecamatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'koneksi.php';
                            $query = $conn->query("SELECT * FROM spbu");
                            $no = 1;
                            if ($query->num_rows > 0) {
                                while ($row = $query->fetch_row()) { ?>
                                    <tr>
                                        <th scope="col"><?= $no++; ?></th>
                                        <td><?= $row[1]; ?></td>
                                        <td><?= $row[2]; ?></td>
                                        <td><?= $row[3]; ?></td>
                                        <td><?= $row[4]; ?></td>
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
    var mymap = L.map('map').setView([-0.8931699926701577, 119.8647374574928], 14);
    var layerMap = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}/?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors,' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/satellite-v9'
    });
    mymap.addLayer(layerMap);



    //legend 
    let baseLayers = [{
        group: "Tipe Maps",
        layers: [{
                name: "light",
                layer: layerMap
            },
            {
                name: "street",
                layer: L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png?{foo}', {
                    foo: 'bar',
                    attribution: '& copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                })
            },
            {
                name: "dark",
                layer: L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors,' +
                        '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                    id: 'mapbox/dark-v10'
                })
            }
        ]
    }];

    let overLayers = [{
        group: "Mantikulore",
        collapsed: true,
        layers: [
            <?php
            $query = $conn->query("SELECT * FROM spbu WHERE kecamatan='Mantikulore'");
            if ($query->num_rows > 0) {
                while ($row = $query->fetch_assoc()) { ?> {
                        name: "<?= $row['nama'] ?>",
                        layer: L.marker([<?= $row['latitude'] ?>, <?= $row['longitude'] ?>]).bindPopup('<?= $row['nama'] ?>(<?= $row['alamat']; ?>)')
                    },
            <?php }
            } ?>
        ]
    }, {
        group: "Palu Barat",
        collapsed: true,
        layers: [
            <?php
            $query = $conn->query("SELECT * FROM spbu WHERE kecamatan='Palu Barat'");
            if ($query->num_rows > 0) {
                while ($row = $query->fetch_assoc()) { ?> {
                        name: "<?= $row['nama'] ?>",
                        layer: L.marker([<?= $row['latitude'] ?>, <?= $row['longitude'] ?>]).bindPopup('<?= $row['nama'] ?>(<?= $row['alamat']; ?>)')
                    },
            <?php }
            } ?>
        ]
    }, {
        group: "Palu Timur",
        collapsed: true,
        layers: [
            <?php
            $query = $conn->query("SELECT * FROM spbu WHERE kecamatan='Palu Timur'");
            if ($query->num_rows > 0) {
                while ($row = $query->fetch_assoc()) { ?> {
                        name: "<?= $row['nama'] ?>",
                        layer: L.marker([<?= $row['latitude'] ?>, <?= $row['longitude'] ?>]).bindPopup('<?= $row['nama'] ?>(<?= $row['alamat']; ?>)')
                    },
            <?php }
            } ?>
        ]
    }, {
        group: "Palu Selatan",
        collapsed: true,
        layers: [
            <?php
            $query = $conn->query("SELECT * FROM spbu WHERE kecamatan='Palu Selatan'");
            if ($query->num_rows > 0) {
                while ($row = $query->fetch_assoc()) { ?> {
                        name: "<?= $row['nama'] ?>",
                        layer: L.marker([<?= $row['latitude'] ?>, <?= $row['longitude'] ?>]).bindPopup('<?= $row['nama'] ?>(<?= $row['alamat']; ?>)')
                    },
            <?php }
            } ?>
        ]
    }, {
        group: "Palu Utara",
        collapsed: true,
        layers: [
            <?php
            $query = $conn->query("SELECT * FROM spbu WHERE kecamatan='Palu Utara'");
            if ($query->num_rows > 0) {
                while ($row = $query->fetch_assoc()) { ?> {
                        name: "<?= $row['nama'] ?>",
                        layer: L.marker([<?= $row['latitude'] ?>, <?= $row['longitude'] ?>]).bindPopup('<?= $row['nama'] ?>(<?= $row['alamat']; ?>)')
                    },
            <?php }
            } ?>
        ]
    }, {
        group: "Ulujadi",
        collapsed: true,
        layers: [
            <?php
            $query = $conn->query("SELECT * FROM spbu WHERE kecamatan='Ulujadi'");
            if ($query->num_rows > 0) {
                while ($row = $query->fetch_assoc()) { ?> {
                        name: "<?= $row['nama'] ?>",
                        layer: L.marker([<?= $row['latitude'] ?>, <?= $row['longitude'] ?>]).bindPopup('<?= $row['nama'] ?>(<?= $row['alamat']; ?>)')
                    },
            <?php }
            } ?>
        ]
    }, {
        group: "Tawaeli",
        collapsed: true,
        layers: [
            <?php
            $query = $conn->query("SELECT * FROM spbu WHERE kecamatan='Tawaeli'");
            if ($query->num_rows > 0) {
                while ($row = $query->fetch_assoc()) { ?> {
                        name: "<?= $row['nama'] ?>",
                        layer: L.marker([<?= $row['latitude'] ?>, <?= $row['longitude'] ?>]).bindPopup('<?= $row['nama'] ?>(<?= $row['alamat']; ?>)')
                    },
            <?php }
            } ?>
        ]
    }, {
        group: "Palu Selatan",
        collapsed: true,
        layers: [
            <?php
            $query = $conn->query("SELECT * FROM spbu WHERE kecamatan='Palu Selatan'");
            if ($query->num_rows > 0) {
                while ($row = $query->fetch_assoc()) { ?> {
                        name: "<?= $row['nama'] ?>",
                        layer: L.marker([<?= $row['latitude'] ?>, <?= $row['longitude'] ?>]).bindPopup('<?= $row['nama'] ?>(<?= $row['alamat']; ?>)')
                    },
            <?php }
            } ?>
        ]
    }, {
        group: "Tatanga",
        collapsed: true,
        layers: [
            <?php
            $query = $conn->query("SELECT * FROM spbu WHERE kecamatan='Tatanga'");
            if ($query->num_rows > 0) {
                while ($row = $query->fetch_assoc()) { ?> {
                        name: "<?= $row['nama'] ?>",
                        layer: L.marker([<?= $row['latitude'] ?>, <?= $row['longitude'] ?>]).bindPopup('<?= $row['nama'] ?>(<?= $row['alamat']; ?>)')
                    },
            <?php }
            } ?>
        ]
    }];
    layerControl = mymap.addControl(new L.Control.PanelLayers(baseLayers, overLayers, {
        collapsibleGroups: true
    }));

    //kecamatan
    <?php
    $sql = "SELECT * FROM kecamatan";
    $hasil = $conn->query($sql);
    if ($hasil->num_rows > 0) {
        while ($row = $hasil->fetch_assoc()) { ?>
            var drawItems = L.geoJson(<?= $row['poligon'] ?>, {
                color: "<?= $row['warna'] ?>"
            }).addTo(mymap);
    <?php
        }
    } ?>

    $('#rute').on('click', function() {
        let awal = $('#lokasi_awal').val();
        let awalLatLng = awal.split(',')
        let tujuan = $('#lokasi_tujuan').val();
        let tujuanLatLng = tujuan.split(',')
        console.log(awal)
        console.log(tujuan)
        // console.log(tuj)

        // routing machine
        L.Routing.control({
            waypoints: [
                L.latLng(awalLatLng[0], awalLatLng[1]),
                L.latLng(tujuanLatLng[0], tujuanLatLng[1])
            ],
            routeWhileDragging: false
        }).addTo(mymap);
    })
</script>
<?php include('template/footer.php') ?>