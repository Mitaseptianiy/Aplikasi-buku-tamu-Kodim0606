<!-- panggil file header -->
<?php 
include "header.php";
include "koneksi.php";
?>

<?php

// Uji jika tombol simpan diklik
    if  (isset($_POST['bsimpan'])){
    $tgl = date('Y-m-d');

   // htmlspecialchars agar inputan lebih aman dari injection
    $nik = htmlspecialchars($_POST['nik'],ENT_QUOTES);
    $nama = htmlspecialchars($_POST['nama'],ENT_QUOTES);
    $alamat = htmlspecialchars($_POST['alamat'], ENT_QUOTES);
    $tujuan = htmlspecialchars($_POST['tujuan'], ENT_QUOTES);
    $kontak = htmlspecialchars($_POST['kontak'], ENT_QUOTES);


//persiapan query simpan data
$simpan = mysqli_query($koneksi,"INSERT INTO ttamu VALUES ('','$tgl','$nik','$nama','$alamat','$tujuan','$kontak')");

//Uji jika simpan data sukses
if ($simpan) {
    echo "<script>alert('Simpan data sukses, Terima kasih...!');
    document.location='?'</script>";
} else { "<script>alert('Simpan data GAGAL!!!');document.location='?'</script>";
}


}


?>



    <!-- Head -->
    <div class="head text-center">
        <img src="assets/img/Logo-korem-061.png" width="100">
        <h2 class="text-white">Sistem Informasi Buku Tamu <br> Kodim0606</h2>
    </div>
    <!-- end Head -->

    <!-- Awal Row -->
    <div class="row mt-2"><div>
        <!-- col-lg-7 -->
        <div class="col-lg-12 mb-3">
            <div class="card shadow bg-gradient-light">
                <!-- card body -->
                <div class="card-body">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Identitas Pengunjung</h1>
                    </div>
                        <form class="user" method="POST" action="">
                                <div class="form-group">
                                    <input type="text" class="form-control 
                                    form-control-user" name="nik" placeholder="Nik Pengunjung" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control 
                                    form-control-user" name="nama" placeholder="Nama Pengunjung" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control 
                                    form-control-user" name="alamat" placeholder="Alamat Pengunjung" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control 
                                    form-control-user" name="tujuan" placeholder="Tujuan Pengunjung" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control 
                                    form-control-user" name="kontak" placeholder="Kontak Pengunjung" required>
                                </div>
                                <button type="submit" name="bsimpan" class="btn-primary btn-user btn-block">Simpan Data</button>

                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="#">By. Mita&Hera |</a>
                            </div>
                </div>
                <!-- end card-body -->
            </div>
        </div>
        <!-- end col-lg-7 -->
         
        <!-- col-lg-5 -->
        <div class="col-lg-5 mb-3">
            <!-- card -->
            <div class="card shadow -light">
                <!-- card body -->
                <div class="card-body">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Statistik Pengunjung</h1>
                    </div>
                    <?php
                    //deklarasi tanggal
                    
                    //menampilkan tanggal sekarang
	                $tgl_sekarang = date('Y-m-d');

                    // menampilkan tgl kemarin
                    $kemarin= date ('Y-m-d', strtotime('-1 day',strtotime(date('Y-m-d'))));

                    // mendapatkan 6 hari sebelum tgl skrg
                    $kemarin= date ('Y-m-d h:i:s', strtotime('-1 week 
                    + day',strtotime($tgl_sekarang)));
                    
                    $sekarang = date('Y-m-d h:i:s');

                    // persiapan query tampilkan jumlah data pengunjung

                    $tgl_sekarang = mysqli_fetch_array(mysqli_query(
                        $koneksi,
                        "SELECT count(*) FROM ttamu where tanggal like '%$tgl_sekarang%'"));

                    $kemarin = mysqli_fetch_array(mysqli_query(
                        $koneksi,
                        "SELECT count(*) FROM ttamu where tanggal like '%$kemarin%'"));
                     
                    $seminggu = mysqli_fetch_array(mysqli_query(
                        $koneksi,
                        "SELECT count(*) FROM ttamu where tanggal BETWEEN 'seminggu' and 'sekarang'"));
                      
                    $bulan_ini = date('m');

                    $sebulan = mysqli_fetch_array(mysqli_query(
                        $koneksi,
                        "SELECT count(*) FROM ttamu where month(tanggal) = '$bulan_ini'"));
                    
                        $keseluruhan = mysqli_fetch_array(mysqli_query(
                            $koneksi,
                            "SELECT count(*) FROM ttamu"));

                    ?>
                    <table class="table table-bordered">
                        <tr>
                            <td>Hari Ini</td>
                            <td>: <?= $tgl_sekarang[0]?></td>
                        </tr>
                        <tr>
                            <td>Kemarin</td>
                            <td>: <?= $kemarin[0]?></td>
                        </tr>
                        <tr>
                            <td>Minggu ini</td>
                            <td>: <?= $seminggu[0]?></td>
                        </tr>
                        <tr>
                            <td>Bulan ini</td>
                            <td>: <?= $sebulan[0]?></td>
                        </tr>
                        <tr>
                            <td>Keseluruhan</td>
                            <td>: <?= $keseluruhan[0]?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col-lg-5 -->
 
        
</div>
<!-- end Row -->
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                        <a href="rekapitulasi.php" class="btn btn-success mb-3"><i class="fa fa-table"></i> Rekapitulasi Pengunjung </a>
                        <a href="logout.php" class="btn btn-danger mb-3"><i class="fa fa-sign-out-alt"></i> Logout</a>


                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Nik</th>
                                            <th>Nama Pengunjung</th>
                                            <th>Alamat</th>
                                            <th>Tujuan</th>
                                            <th>Kontak</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                    <?php
                                        $tgl = date('Y-m-d'); //2023-06-25
                                        $tampil = mysqli_query($koneksi, "SELECT * FROM ttamu where
                                        tanggal like '%$tgl%' order by id desc");
                                        $no = 1;

                                        while($data = mysqli_fetch_array($tampil)){
                                        ?>

                                        <tr>
                                            <td><?=$no++ ?></td>
                                            <td><?=$data['tanggal']?></td>
                                            <td><?=$data['nik']?></td>
                                            <td><?=$data['nama']?></td>
                                            <td><?=$data['alamat']?></td>
                                            <td><?=$data['tujuan']?></td>
                                            <td><?=$data['kontak']?></td>

                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

<!-- panggil file footer -->
<?php include "footer.php"; ?>