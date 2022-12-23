<?php include('template/header.php') ?>
<?php include('template/navbar.php') ?>
<?php include('koneksi.php');
session_start();
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $perusahaan = $_POST['perusahaan'];
    $alamat = $_POST['alamat'];
    $kecamatan = $_POST['kecamatan'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $query = $conn->query("INSERT INTO spbu(nama, perusahaan, alamat, kecamatan,latitude,longitude)
    VALUES('$nama','$perusahaan','$alamat','$kecamatan','$latitude','$longitude')");

    if ($query) {
        $_SESSION['pesan'] = 'Data berhasil ditambahkan';
        echo "<script>window.location.href = 'spbu.php'</script>";
    }
}
?>
<div class="page-content p-5" id="content">

    <div class="row">

        <div class="col-lg-12">
            <div id="maps" style="height:400px;"></div>
        </div>

        <div class="col-lg-12">

            <div class="card">
                <div class="card-header">
                    <i class="fa fa-plus"></i>
                    <strong>Tambah Data SPBU</strong>
                    <p class="card-text small text-muted">Input data dengan mengisi semua input form yang dibawah</p>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="nama" placeholder="Nama" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Perusahaan</label>
                                <input type="text" class="form-control" name="perusahaan" placeholder="perusahaan" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Alamat</label>
                                <input type="text" class="form-control" name="alamat" placeholder="Masukan Alamat" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputState">Kecamatan</label>
                                <select name="kecamatan" id="inputState" class="form-control">
                                    <option selected>--Silahkan Pilih--</option>
                                    <?php
                                    $kec = $conn->query("SELECT * FROM kecamatan");
                                    if ($kec->num_rows > 0) {
                                        while ($row = $kec->fetch_row()) { ?>
                                            <option><?= $row[1]; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Latitude</label>
                                <input type="text" class="form-control" name="latitude">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Longitude</label>
                                <input type="text" class="form-control" name="longitude">
                            </div>
                            <div class="form-group col-md-12 mt-4">
                                <button type="submit" name="simpan" class="btn btn-info btn-md">Simpan</button>
                                <a href="spbu.php" class="btn btn-secondary btn-md">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>

</div>
<script>
    let latlang = [0, 0];
    if (latlang[0] == 0 && latlang[1] == 0) {
        latlang = [-0.888027, 119.874639];
    }
    let mymap = L.map('maps').setView([-0.8931699926701577, 119.8647374574928], 14);
    let layerMap = L.tileLayer(
        'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}/?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors' +
                'Imagery <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/streets-v11'
        });
    mymap.addLayer(layerMap);

    let marker = new L.marker(latlang, {
        draggable: 'false'
    });

    marker.no('dragend', function(event) {
        let position = marker.getLatLng();
        marker.setLatLng(position).update();
        $("#latitude").val(position.lat);
        $("#longitude").val(position.lng);
    });

    mymap.addLayer(marker);
</script>
<?php include('template/footer.php') ?>