<?php

$host = "localhost";
$kullanici = "root";
$sifre = "";
$veritabani = "ademoglu_db";

$baglanti = new mysqli($host, $kullanici, $sifre, $veritabani);

if ($baglanti->connect_error) {
    die("Veritabanı bağlantı hatası: " . $baglanti->connect_error);
}

?>