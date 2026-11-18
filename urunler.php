<?php
include "baglantı.php";

$sorgu = $baglanti->query("SELECT * FROM urunler");

$urunler = [];

while($satir = $sorgu->fetch_assoc()) {
   if($satir["resim_yeri"] == "yeni"){

    $satir["resim"] = "admin/resimler/" . basename($satir["resim"]);

}else{

    if(strpos($satir["resim"], "images/") === 0){
        $satir["resim"] = $satir["resim"];
    }else{
        $satir["resim"] = "images/" . $satir["resim"];
    }

}

$urunler[] = $satir;

}

header('Content-Type: application/json; charset=utf-8');

echo json_encode($urunler, JSON_UNESCAPED_UNICODE);

?>