<?php

include "../baglantı.php";


$id = $_POST["id"];
$isim = $_POST["isim"];
$kategori = $_POST["kategori"];
$fiyat = $_POST["fiyat"];
$aciklama = $_POST["aciklama"];


if(isset($_FILES["resim"]) && $_FILES["resim"]["name"] != ""){


    $resim = $_FILES["resim"]["name"];

    $hedef = "../images/" . $resim;

if (move_uploaded_file($_FILES["resim"]["tmp_name"], $hedef)) {
    echo "Resim başarıyla yüklendi.";
} else {
    die("Resim yüklenemedi.");
}

    $sql = "UPDATE urunler SET
    isim='$isim',
    kategori='$kategori',
    fiyat='$fiyat',
    aciklama='$aciklama',
    resim='$resim'
    WHERE id=$id";


}else{


    $sql = "UPDATE urunler SET
    isim='$isim',
    kategori='$kategori',
    fiyat='$fiyat',
    aciklama='$aciklama'
    WHERE id=$id";


}



if($baglanti->query($sql)){

    header("Location: urunler.php");
    exit;

}else{

    echo "Hata: ".$baglanti->error;

}


?>