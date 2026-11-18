<?php

include "../baglantı.php";


$id = $_GET["id"];


$sorgu = $baglanti->query("SELECT * FROM urunler WHERE id=$id");

$urun = $sorgu->fetch_assoc();


?>


<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<title>Ürün Düzenle</title>

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

img{
width:100px;
height:100px;
object-fit:cover;
}

</style>

</head>


<body>


<h1>Ürün Düzenle</h1>


<form method="post" action="urun_guncelle.php" enctype="multipart/form-data">


<input type="hidden" name="id" value="<?= $urun['id'] ?>">


<br>

<input 
type="text" 
name="isim"
value="<?= $urun['isim'] ?>"
>


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


<input 
type="text"
name="fiyat"
value="<?= $urun['fiyat'] ?>"
>


<br>


<img src="../images/<?= $urun['resim'] ?>">


<br>


<input type="file" name="resim">


<br>


<textarea name="aciklama"><?= $urun['aciklama'] ?></textarea>


<br>


<button>
Güncelle
</button>


</form>


</body>
</html>