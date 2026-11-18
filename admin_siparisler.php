<?php
include "baglantı.php";

$sorgu = $baglanti->query("SELECT * FROM siparisler ORDER BY id DESC");

?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>ADEMOĞLU Sipariş Paneli</title>

<style>
body{
    font-family: Arial, sans-serif;
    background:#f5f5f5;
    padding:30px;
}

h1{
    color:#b58342;
}

.siparis{
    background:white;
    padding:20px;
    margin-bottom:20px;
    border-radius:10px;
    box-shadow:0 2px 10px #ddd;
}

.siparis strong{
    color:#1a110b;
}

.urunler{
    background:#fafafa;
    padding:10px;
    margin-top:10px;
    border-radius:5px;
}

</style>

</head>

<body>

<h1>ADEMOĞLU KURUYEMİŞ - Siparişler</h1>


<?php while($siparis = $sorgu->fetch_assoc()){ ?>


<div class="siparis">

<h3>Sipariş #<?= $siparis["id"] ?></h3>

<p>
<strong>Müşteri:</strong>
<?= $siparis["ad"] ?>
</p>

<p>
<strong>Telefon:</strong>
<?= $siparis["telefon"] ?>
</p>

<p>
<strong>Adres:</strong>
<?= $siparis["adres"] ?>
</p>


<p>
<strong>Açıklama:</strong>
<?= $siparis["aciklama"] ?>
</p>


<div class="urunler">

<strong>Ürünler:</strong>

<?php

$urunler = json_decode($siparis["urunler"], true);

foreach($urunler as $urun){

echo "<p>";
echo $urun["isim"] . " - ";
echo $urun["fiyat"] . "₺";
echo "</p>";

}

?>

</div>


<p>
<strong>Toplam:</strong>
<?= $siparis["toplam"] ?>₺
</p>


<p>
<strong>Tarih:</strong>
<?= $siparis["tarih"] ?>
</p>
<p>
<strong>Durum:</strong>

<form method="post" action="durum_guncelle.php">

<input type="hidden" name="id" value="<?= $siparis["id"] ?>">

<select name="durum" onchange="this.form.submit()">

<option <?= $siparis["durum"]=="Yeni Sipariş"?"selected":"" ?>>
Yeni Sipariş
</option>

<option <?= $siparis["durum"]=="Hazırlanıyor"?"selected":"" ?>>
Hazırlanıyor
</option>

<option <?= $siparis["durum"]=="Kargoya Verildi"?"selected":"" ?>>
Kargoya Verildi
</option>

<option <?= $siparis["durum"]=="Tamamlandı"?"selected":"" ?>>
Tamamlandı
</option>

</select>

</form>

</p>
<p>
<strong>Kargo Bilgileri:</strong>

<form method="post" action="kargo_guncelle.php">

<input type="hidden" name="id" value="<?= $siparis["id"] ?>">

<br>

<label>Kargo Firması:</label>
<input 
type="text" 
name="kargo_firma" 
value="<?= $siparis["kargo_firma"] ?>"
placeholder="Örn: Yurtiçi Kargo">


<br><br>

<label>Takip No:</label>
<input 
type="text" 
name="kargo_takip" 
value="<?= $siparis["kargo_takip"] ?>"
placeholder="Kargo takip numarası">


<br><br>

<button type="submit">
Kaydet
</button>

</form>

</p>
</div>


<?php } ?>


</body>
</html>