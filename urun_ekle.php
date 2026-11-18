<?php
include("baglantı.php");

$urunler = [
    [
        "isim"=>"Kabuklu Fındık",
        "kategori"=>"kuruyemis",
        "fiyat"=>350,
        "resim"=>"kabuklufındık.png",
        "aciklama"=>"Taze kaliteli fındık"
    ],
    [
        "isim"=>"Meşhur Çorum Sade Leblebi",
        "kategori"=>"leblebi",
        "fiyat"=>250,
        "resim"=>"sarıleblebi.jpeg",
        "aciklama"=>"Çorum'un meşhur leblebisi"
    ]
];


foreach($urunler as $u){

    $sql = "INSERT INTO urunler 
    (isim,kategori,fiyat,resim,aciklama)
    VALUES 
    ('{$u['isim']}',
     '{$u['kategori']}',
     '{$u['fiyat']}',
     '{$u['resim']}',
     '{$u['aciklama']}')";

    $baglanti->query($sql);
}

echo "Ürünler eklendi";

?>