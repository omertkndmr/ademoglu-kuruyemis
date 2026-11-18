<?php
include "../baglantı.php";

if(isset($_POST["ekle"])){

    $isim = $_POST["isim"];
    $kategori = $_POST["kategori"];
    $fiyat = $_POST["fiyat"];
    $resim = $_FILES["resim"]["name"];

$hedef = "../images/" . $resim;

move_uploaded_file(
    $_FILES["resim"]["tmp_name"],
    $hedef
);
    $aciklama = $_POST["aciklama"];

   $sql = "INSERT INTO urunler
(isim,kategori,fiyat,resim,aciklama,resim_yeri)
VALUES
('$isim','$kategori','$fiyat','$resim','$aciklama','yeni')";

    if($baglanti->query($sql)){
        echo "Ürün başarıyla eklendi";
    }else{
        echo "Hata: ".$baglanti->error;
    }

}

?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<title>Ürün Ekle</title>

<style>

body{
font-family:Arial;
background:#f5f5f5;
padding:30px;
}

input,textarea,select{

width:300px;
padding:10px;
margin:5px;

}

button{

background:#8b4513;
color:white;
border:0;
padding:12px 25px;
cursor:pointer;

}

</style>

</head>

<body>

<h1>Yeni Ürün Ekle</h1>


<form method="post" enctype="multipart/form-data">


<input type="text" name="isim" placeholder="Ürün adı">

<br>

<select name="kategori">

<option value="kuruyemis">Kuruyemiş</option>
<option value="leblebi">Leblebi</option>
<option value="kurumeyve">Kuru Meyve</option>
<option value="sekerleme">Şekerleme</option>
<option value="cikolata">Çikolata</option>
<option value="hediyelik">Hediyelik</option>
<option value="kolonya">Kolonya</option>

</select>

<br>


<input type="text" name="fiyat" placeholder="Fiyat">

<br>

<input type="file" name="resim">

<br>

<textarea name="aciklama" placeholder="Açıklama"></textarea>

<br>


<button name="ekle">
Ürünü Kaydet
</button>


</form>


</body>
</html>