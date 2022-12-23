<!-- header -->
<?php include('template/header.php') ?>
<!-- navbar -->
<?php include('template/navbar.php') ?>
<!-- content -->
<?php include 'koneksi.php';
session_start();
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $poligon = $_POST['poligon'];
    $warna = $_POST['warna'];

    // Perintah SQL untuk menginput data record
    $queryResult = $conn->query("INSERT INTO kecamatan(nama,warna,poligon) VALUES('$nama','$warna','$poligon')");

    if ($queryResult) {
        $_SESSION['pesan'] = 'Data berhasil Ditambahkan';
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
            <div id="map" style="height: 500px; "></div>
        </div>

        <div class="col-lg-12">

            <form action="" method="POST">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-plus"></i>
                        <strong>Tambah Data Kecamatan</strong>
                        <p class="card-text small text-muted">Input data dengan cara menekan gambar poligon pada openstreetmap untuk menentukan koordinat poligonnya.</p>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Kecamatan..." required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="warna" class="col-sm-3 col-form-label">Warna</label>
                            <div class="col-sm-9">
                                <input type="color" class="form-control" id="warna" name="warna" required>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="poligon" class="col-sm-3 col-form-label">Koordinat Poligon</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="poligon" id="poligon" rows="6" placeholder="Koordinat poligon..." required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tombol" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <button class="btn btn-success col-lg-3" type="submit" name="simpan">Simpan</button>
                                <a class="btn btn-info col-lg-3" href="kecamatan.php">Kembali</a>
                            </div>
                        </div>

                    </div>
            </form>

        </div>

    </div>

</div>

<script>
    var map = L.map('map').setView([-0.8931699926701577, 119.8647374574928], 13);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}/?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors,' +
            'Imagery <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11'
    }).addTo(map);

    var drawnItems = new L.FeatureGroup();
    map.addLayer(drawnItems);
    var drawControl = new L.Control.Draw({
        draw: {
            polyline: false,
            rectangle: false,
            circle: false,
            marker: false,
            circlemarker: false,
        },
        edit: {
            featureGroup: drawnItems
        }
    });
    map.addControl(drawControl);

    map.on('draw:created', function(event) {
        var layer = event.layer,
            feature = layer.feature = layer.feature || {};

        feature.type = feature.type || "Feature";
        var props = feature.properties = feature.properties || {};
        drawnItems.addLayer(layer);

        var hasil = $('#poligon').val(JSON.stringify(drawnItems.toGeoJSON()));
    });

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