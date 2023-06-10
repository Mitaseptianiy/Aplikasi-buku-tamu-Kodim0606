<?php
    $server = "localhost";
    $user = "root";
    $password = "";
    $databae = "dbbukutamu";

    $koneksi = mysqli_connect($server, $user, $password, $databae) or  die(mysqli_error($koneksi));

?>