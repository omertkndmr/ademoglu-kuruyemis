<?php
include "../baglantı.php";

$urunler = $baglanti->query("SELECT * FROM urunler ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Ademoğlu Admin Panel</title>
<meta charset="UTF-8">

<style>
body{
    font-family:Arial;
    background:#f5f5f5;
    padding:30px;
}

h1{
    color:#8b4513;
}

a{
    background:#8b4513;
    color:white;
    padding:10px 15px;
    text-decoration:none;
    border-radius:5px;
}

table{
    margin-top:20px;
    width:100%;
    background:white;
    border-collapse:collapse;
}

td,th{
    border:1px solid #ddd;
    padding:10px;
}
</style>

</head>

<body>

<h1>Ademoğlu Kuruyemiş Admin Panel</h1>

<a href="urun_ekle.php">+ Yeni Ürün Ekle</a>

<table>

<tr>
<th>ID</th>
<th>Ürün</th>
<th>Kategori</th>
<th>Fiyat</th>
<th>Resim</th>
<th>İşlem</th>
</tr>

<?php while($urun=$urunler->fetch_assoc()){ ?>

<tr>

<td><?= $urun['id']; ?></td>

<td><?= $urun['isim']; ?></td>

<td><?= $urun['kategori']; ?></td>

<td><?= $urun['fiyat']; ?> ₺</td>

<td><?= $urun['resim']; ?></td>

<td>
<a href="urun_duzenle.php?id=<?= $urun['id']; ?>">Düzenle</a>
<a href="urun_sil.php?id=<?= $urun['id']; ?>">Sil</a>
</td>

</tr>

<?php } ?>

</table>


</body>
</html>