<?php

include "baglantı.php";


$id = $_POST["id"];
$kargo_firma = $_POST["kargo_firma"];
$kargo_takip = $_POST["kargo_takip"];


$sql = "UPDATE siparisler 
SET kargo_firma=?, kargo_takip=? 
WHERE id=?";


$stmt = $baglanti->prepare($sql);


$stmt->bind_param(
    "ssi",
    $kargo_firma,
    $kargo_takip,
    $id
);


if($stmt->execute()){

    header("Location: admin_siparisler.php");
    exit;

}else{

    echo "Kargo bilgileri kaydedilemedi.";

}

?>