<?php

include "../baglantı.php";


if(isset($_GET["id"])){

    $id = $_GET["id"];


    $sql = "DELETE FROM urunler WHERE id=$id";


    if($baglanti->query($sql)){

        header("Location: urunler.php");
        exit;

    }else{

        echo "Silme hatası: ".$baglanti->error;

    }

}

?>