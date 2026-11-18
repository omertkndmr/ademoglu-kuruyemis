<?php

include "baglantı.php";

$id = $_POST["id"];
$durum = $_POST["durum"];


$sql = "UPDATE siparisler SET durum=? WHERE id=?";

$stmt = $baglanti->prepare($sql);

$stmt->bind_param("si", $durum, $id);


if($stmt->execute()){

    header("Location: admin_siparisler.php");
    exit;

}else{

    echo "Güncelleme başarısız";

}

?>