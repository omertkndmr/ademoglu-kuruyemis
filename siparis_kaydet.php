
<?php
session_start();

include "baglantı.php";

header('Content-Type: application/json; charset=utf-8');


// Giriş yapan kullanıcı kontrolü
if (!isset($_SESSION["uye_id"])) {

    echo json_encode([
        "durum" => "hata",
        "mesaj" => "Önce giriş yapmalısınız."
    ]);

    exit;
}


$uye_id = $_SESSION["uye_id"];


$veri = json_decode(file_get_contents("php://input"), true);


if (!$veri) {

    echo json_encode([
        "durum" => "hata",
        "mesaj" => "Veri gelmedi"
    ]);

    exit;
}


$ad = $veri["ad"];
$telefon = $veri["telefon"];
$adres = $veri["adres"];
$aciklama = $veri["aciklama"];
$odeme_turu = $veri["odeme_turu"];

$urunler = json_encode(
    $veri["urunler"],
    JSON_UNESCAPED_UNICODE
);

$toplam = $veri["toplam"];


// Siparişi giriş yapan üyeye bağla
$sql = "INSERT INTO siparisler
(uye_id, ad, telefon, adres, aciklama, odeme_turu, urunler, toplam)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)";


$stmt = $baglanti->prepare($sql);


$stmt->bind_param(
    "issssssd",
    $uye_id,
    $ad,
    $telefon,
    $adres,
    $aciklama,
    $odeme_turu,
    $urunler,
    $toplam
);


if ($stmt->execute()) {

    echo json_encode([
        "durum" => "ok"
    ]);

} else {

    echo json_encode([
        "durum" => "hata",
        "mesaj" => $stmt->error
    ]);

}

?>

