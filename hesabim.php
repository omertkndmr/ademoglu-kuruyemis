```php
<?php

session_start();
include "baglantı.php";

if (!isset($_SESSION["uye_id"])) {
    header("Location: giris.php");
    exit;
}

$uye_id = $_SESSION["uye_id"];


/* ÜYE BİLGİLERİ */

$sorgu = $baglanti->prepare(
    "SELECT ad, soyad, email, telefon
     FROM uyeler
     WHERE id = ?"
);

$sorgu->bind_param("i", $uye_id);
$sorgu->execute();

$sonuc = $sorgu->get_result();
$uye = $sonuc->fetch_assoc();

if (!$uye) {
    session_destroy();
    header("Location: giris.php");
    exit;
}


/* SİPARİŞLER */

$siparisSorgu = $baglanti->prepare(
    "SELECT id, urunler, toplam, tarih, durum, kargo_firma, kargo_takip
     FROM siparisler
     WHERE uye_id = ?
     ORDER BY tarih DESC"
);

$siparisSorgu->bind_param("i", $uye_id);
$siparisSorgu->execute();

$siparisler = $siparisSorgu->get_result();

?>

<!DOCTYPE html>
<html lang="tr">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Hesabım - Ademoğlu Kuruyemiş</title>

<style>

* {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f5f5f5;
}

.ust {
    background: #8b4513;
    color: white;
    padding: 20px;
    text-align: center;
}

.ust h1 {
    margin: 0;
}

.container {
    width: 900px;
    max-width: 92%;
    margin: 30px auto;
}

.kart {
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    margin-bottom: 25px;
}

h2 {
    color: #8b4513;
    margin-top: 0;
}


/* ÜYE BİLGİLERİ */

.bilgi {
    padding: 15px 0;
    border-bottom: 1px solid #eee;
}

.baslik {
    font-weight: bold;
    color: #666;
    margin-bottom: 5px;
}

.deger {
    font-size: 17px;
}


/* SİPARİŞ */

.siparis {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 15px;
    background: #fafafa;
}

.siparis-baslik {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 15px;
}

.siparis-no {
    font-weight: bold;
    color: #8b4513;
}

.durum {
    background: #fff3cd;
    color: #856404;
    padding: 6px 10px;
    border-radius: 5px;
    font-size: 14px;
}

.siparis-bilgi {
    margin: 8px 0;
    color: #555;
}

.urunler {
    background: white;
    padding: 12px;
    border-radius: 6px;
    margin-top: 10px;
    white-space: pre-wrap;
    word-break: break-word;
}

.toplam {
    font-size: 19px;
    font-weight: bold;
    color: #8b4513;
    margin-top: 15px;
}


/* KARGO */

.kargo {
    margin-top: 15px;
    padding: 12px;
    background: #eee;
    border-radius: 6px;
}

.siparis-yok {
    text-align: center;
    padding: 25px;
    color: #777;
}


/* BUTONLAR */

.butonlar {
    display: flex;
    gap: 10px;
    margin-top: 25px;
    flex-wrap: wrap;
}

.buton {
    display: inline-block;
    padding: 12px 18px;
    background: #8b4513;
    color: white;
    text-decoration: none;
    border-radius: 5px;
}

.buton.cikis {
    background: #a00000;
}

</style>

</head>

<body>

<div class="ust">

    <h1>Ademoğlu Kuruyemiş</h1>

</div>


<div class="container">


    <!-- HESAP BİLGİLERİ -->

    <div class="kart">

        <h2>👤 Hesabım</h2>

        <div class="bilgi">

            <div class="baslik">
                Ad Soyad
            </div>

            <div class="deger">
                <?= htmlspecialchars($uye["ad"] . " " . $uye["soyad"]) ?>
            </div>

        </div>


        <div class="bilgi">

            <div class="baslik">
                E-Posta
            </div>

            <div class="deger">
                <?= htmlspecialchars($uye["email"]) ?>
            </div>

        </div>


        <div class="bilgi">

            <div class="baslik">
                Telefon
            </div>

            <div class="deger">
                <?= htmlspecialchars($uye["telefon"]) ?>
            </div>

        </div>

    </div>



    <!-- SİPARİŞLERİM -->

    <div class="kart">

        <h2>📦 Siparişlerim</h2>


        <?php if ($siparisler->num_rows > 0): ?>

            <?php while ($siparis = $siparisler->fetch_assoc()): ?>

                <div class="siparis">


                    <div class="siparis-baslik">

                        <div class="siparis-no">
                            Sipariş #<?= htmlspecialchars($siparis["id"]) ?>
                        </div>

                        <div class="durum">
                            <?= htmlspecialchars(
                                $siparis["durum"] ?: "Yeni Sipariş"
                            ) ?>
                        </div>

                    </div>


                    <div class="siparis-bilgi">

                        📅 Tarih:

                        <?= date(
                            "d.m.Y H:i",
                            strtotime($siparis["tarih"])
                        ) ?>

                    </div>


                    <div class="siparis-bilgi">

                        🛒 <strong>Ürünler:</strong>

                    </div>


                    <div class="urunler">

                        <?php

                        $urunler = json_decode(
                            $siparis["urunler"],
                            true
                        );

                        if (is_array($urunler)) {

                            foreach ($urunler as $urun) {

                                if (is_array($urun)) {

                                    $isim = $urun["isim"] ?? "Ürün";
                                    $adet = $urun["adet"] ?? 1;
                                    $fiyat = $urun["fiyat"] ?? "";

                                    echo htmlspecialchars($isim);
                                    echo " - ";
                                    echo htmlspecialchars($adet);
                                    echo " adet";

                                    if ($fiyat !== "") {
                                        echo " - ";
                                        echo htmlspecialchars($fiyat);
                                    }

                                    echo "\n";

                                } else {

                                    echo htmlspecialchars(
                                        (string)$urun
                                    );

                                    echo "\n";
                                }
                            }

                        } else {

                            echo htmlspecialchars(
                                $siparis["urunler"]
                            );
                        }

                        ?>

                    </div>


                    <div class="toplam">

                        Toplam:

                        <?= number_format(
                            $siparis["toplam"],
                            2,
                            ",",
                            "."
                        ) ?>

                        ₺

                    </div>


                    <!-- KARGO BİLGİLERİ -->

                    <div class="kargo">

                        🚚 <strong>Kargo Bilgileri</strong>

                        <br><br>


                        <?php if (!empty($siparis["kargo_firma"])): ?>

                            Kargo Firması:

                            <?= htmlspecialchars(
                                $siparis["kargo_firma"]
                            ) ?>

                            <br>

                        <?php else: ?>

                            Kargo firması henüz belirlenmedi.

                            <br>

                        <?php endif; ?>


                        <?php if (!empty($siparis["kargo_takip"])): ?>

                            Kargo Takip No:

                            <?= htmlspecialchars(
                                $siparis["kargo_takip"]
                            ) ?>

                        <?php else: ?>

                            Kargo takip numarası henüz belirlenmedi.

                        <?php endif; ?>

                    </div>


                </div>

            <?php endwhile; ?>


        <?php else: ?>

            <div class="siparis-yok">

                📦 Henüz verilmiş bir siparişiniz bulunmuyor.

            </div>

        <?php endif; ?>


    </div>



    <!-- BUTONLAR -->

    <div class="kart">

        <div class="butonlar">

            <a href="index.php" class="buton">
                Alışverişe Devam Et
            </a>

            <a href="cikis.php" class="buton cikis">
                Çıkış Yap
            </a>

        </div>

    </div>


</div>

</body>

</html>
```
