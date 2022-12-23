<!-- header -->
<?php include('template/header.php') ?>
<!-- navbar -->
<?php include('template/navbar.php') ?>
<?php include('koneksi.php');
session_start();
if (isset($_POST['simpan'])) {
    $id = $_GET['id'];
    $nama = $_POST['nama'];
    $perusahaan = $_POST['perusahaan'];
    $alamat = $_POST['alamat'];
    $kecamatan = $_POST['kecamatan'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $query = $conn->query("UPDATE spbu SET nama='$nama', perusahaan='$perusahaan', alamat='$alamat', kecamatan='$kecamatan', latitude='$latitude', longitude='$longitude' WHERE id='$id'");

    if ($query) {
        $_SESSION['pesan'] = 'Data brhasil diubah';
        echo "<script>
window.location.href = 'spbu.php';
</script>";
    } else {
        echo "<script>alert('gagal diubah')</script>";
    }
}
?>
<!-- content -->
<div class="page-content p-5" id="content">
    <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i></button>
    <div class="row">

        <div class="col-lg-12">
            <div id="maps" style="height:400px;"></div>
        </div>

        <div class="col-lg-12">

            <div class="card">
                <div class="card-header">
                    <i class="fa fa-pencil-square-o"></i>
                    <strong>Edit Data SPBU</strong>
                    <p class="card-text small text-muted">Input data dengan mengisi semua input form yang dibawah</p>
                </div>

                <div class="card-body">
                    <?php
                    $id = $_GET['id'];
                    $query = $conn->query("SELECT * FROM spbu WHERE id='$id'");
                    $latitude = '';
                    $longitude = '';
                    if ($query->num_rows > 0) {
                        $row = $query->fetch_row();

                        $latitude = $row[5];
                        $longitude = $row[6];
                    ?>
                        <form action="" method="POST">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Nama" value="<?= $row[1]; ?>" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Perusahaan</label>
                                    <input type="text" class="form-control" name="perusahaan" placeholder="perusahaan" value="<?= $row[2]; ?>" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputAddress">Alamat</label>
                                    <input type="text" class="form-control" name="alamat" placeholder="Masukkan alamat" value="<?= $row[3]; ?>" required>
                                </div>
                                <div class="form-group col-md-6">
                                <label for="inputState">Kecamatan</label>
                                <select name="kecamatan" id="inputState" class="form-control">
                                        <option selected><?= $row[4]; ?></option>
                                        <?php
                                        $kec = $conn->query("SELECT * FROM kecamatan");

                                        if ($kec->num_rows > 0) {
                                            while ($row = $kec->fetch_row()) {
                                        ?>
                                                <option><?= $row[1]; ?></option>
                                        <?php }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Latitude</label>
                                    <input type="text" class="form-control" id="latitude" name="latitude" value="<?= $latitude; ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Longitude</label>
                                    <input type="text" class="form-control" id="longitude" name="longitude" value="<?= $longitude; ?>">
                                </div>
                                <div class="form-group col-md-12 mt-4">
                                    <button type="submit" name="simpan" class="btn btn-info btn-md">Simpan</button>
                                    <a href="spbu.php" class="btn btn-secondary btn-md">Kembali</a>
                                </div>

                            </div>
                        </form>
                    <?php }
                    ?>
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

    let layerMap = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}/?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
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