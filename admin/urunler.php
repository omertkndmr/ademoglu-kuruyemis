<?php
include "../baglantı.php";

$sorgu = $baglanti->query("SELECT * FROM urunler ORDER BY id DESC");

?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<title>Ürün Yönetimi</title>

<style>

body{
font-family:Arial;
background:#f5f5f5;
padding:30px;
}

table{
width:100%;
background:white;
border-collapse:collapse;
}

th{
background:#8b4513;
color:white;
padding:12px;
}

td{
padding:10px;
border-bottom:1px solid #ddd;
}

img{
width:80px;
height:80px;
object-fit:cover;
}

a{
padding:8px 12px;
color:white;
text-decoration:none;
border-radius:5px;
}

.duzenle{
background:#2980b9;
}

.sil{
background:#c0392b;
}

</style>

</head>

<body>


<h1>ADEMOĞLU Ürün Yönetimi</h1>


<table>

<tr>

<th>Resim</th>
<th>Ürün</th>
<th>Kategori</th>
<th>Fiyat</th>
<th>Açıklama</th>
<th>İşlem</th>

</tr>


<?php while($urun=$sorgu->fetch_assoc()){ ?>


<tr>

<td>

<img src="<?= (strpos($urun['resim'], 'http') === 0) ? $urun['resim'] : '../images/'.$urun['resim'] ?>" width="80">
</td>


<td>
<?= $urun['isim'] ?>
</td>


<td>
<?= $urun['kategori'] ?>
</td>


<td>
<?= $urun['fiyat'] ?> ₺
</td>


<td>
<?= $urun['aciklama'] ?>
</td>


<td>

<a class="duzenle" href="urun_duzenle.php?id=<?= $urun['id'] ?>">
Düzenle
</a>


<a class="sil" href="urun_sil.php?id=<?= $urun['id'] ?>">
Sil
</a>


</td>


</tr>


<?php } ?>


</table>


</body>
</html>