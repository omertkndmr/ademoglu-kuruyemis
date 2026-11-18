<?php

include "baglantı.php";

$mesaj = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ad = trim($_POST["ad"]);
    $soyad = trim($_POST["soyad"]);
    $email = trim($_POST["email"]);
    $telefon = trim($_POST["telefon"]);
    $sifre = $_POST["sifre"];
    $sifreTekrar = $_POST["sifreTekrar"];

    if ($ad == "" || $soyad == "" || $email == "" || $telefon == "" || $sifre == "") {

        $mesaj = "Lütfen tüm alanları doldurun.";

    } elseif ($sifre !== $sifreTekrar) {

        $mesaj = "Şifreler eşleşmiyor.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $mesaj = "Geçerli bir e-posta adresi girin.";

    } else {

        $kontrol = $baglanti->prepare("SELECT id FROM uyeler WHERE email = ?");
        $kontrol->bind_param("s", $email);
        $kontrol->execute();
        $sonuc = $kontrol->get_result();

        if ($sonuc->num_rows > 0) {

            $mesaj = "Bu e-posta adresi zaten kayıtlı.";

        } else {

            $sifreHash = password_hash($sifre, PASSWORD_DEFAULT);

            $ekle = $baglanti->prepare(
                "INSERT INTO uyeler (ad, soyad, email, telefon, sifre)
                 VALUES (?, ?, ?, ?, ?)"
            );

            $ekle->bind_param(
                "sssss",
                $ad,
                $soyad,
                $email,
                $telefon,
                $sifreHash
            );

            if ($ekle->execute()) {

                header("Location: giris.php?kayit=basarili");
                exit;

            } else {

                $mesaj = "Kayıt sırasında bir hata oluştu.";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="tr">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Üye Ol - Ademoğlu Kuruyemiş</title>

<style>

body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f5f5f5;
}

.kutu {
    width: 400px;
    max-width: 90%;
    margin: 60px auto;
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

h1 {
    text-align: center;
    color: #8b4513;
    margin-bottom: 25px;
}

input {
    width: 100%;
    box-sizing: border-box;
    padding: 12px;
    margin-bottom: 12px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

button {
    width: 100%;
    padding: 13px;
    background: #8b4513;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background: #6f350f;
}

.mesaj {
    background: #ffe5e5;
    color: #a00000;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 5px;
    text-align: center;
}

.giris {
    text-align: center;
    margin-top: 20px;
}

.giris a {
    color: #8b4513;
    text-decoration: none;
    font-weight: bold;
}

</style>

</head>

<body>

<div class="kutu">

<h1>Üye Ol</h1>

<?php if ($mesaj != ""): ?>

<div class="mesaj">
    <?= htmlspecialchars($mesaj) ?>
</div>

<?php endif; ?>

<form method="POST">

<input
    type="text"
    name="ad"
    placeholder="Adınız"
    required
>

<input
    type="text"
    name="soyad"
    placeholder="Soyadınız"
    required
>

<input
    type="email"
    name="email"
    placeholder="E-posta adresiniz"
    required
>

<input
    type="text"
    name="telefon"
    placeholder="Telefon numaranız"
    required
>

<input
    type="password"
    name="sifre"
    placeholder="Şifreniz"
    required
>

<input
    type="password"
    name="sifreTekrar"
    placeholder="Şifrenizi tekrar girin"
    required
>

<button type="submit">
    KAYIT OL
</button>

</form>

<div class="giris">
    Zaten hesabınız var mı?
    <a href="giris.php">Giriş Yap</a>
</div>

</div>

</body>

</html>