<?php

session_start();

include "baglantı.php";

$mesaj = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $sifre = $_POST["sifre"];

    if ($email == "" || $sifre == "") {

        $mesaj = "Lütfen e-posta ve şifrenizi girin.";

    } else {

        $sorgu = $baglanti->prepare(
            "SELECT id, ad, soyad, email, telefon, sifre
             FROM uyeler
             WHERE email = ?"
        );

        $sorgu->bind_param("s", $email);
        $sorgu->execute();

        $sonuc = $sorgu->get_result();

        if ($sonuc->num_rows == 1) {

            $uye = $sonuc->fetch_assoc();

            if (password_verify($sifre, $uye["sifre"])) {

                $_SESSION["uye_id"] = $uye["id"];
                $_SESSION["uye_ad"] = $uye["ad"];
                $_SESSION["uye_soyad"] = $uye["soyad"];
                $_SESSION["uye_email"] = $uye["email"];

                header("Location: index.php");
                exit;

            } else {

                $mesaj = "E-posta veya şifre yanlış.";

            }

        } else {

            $mesaj = "E-posta veya şifre yanlış.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="tr">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Giriş Yap - Ademoğlu Kuruyemiş</title>

<style>

body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f5f5f5;
}

.kutu {
    width: 400px;
    max-width: 90%;
    margin: 70px auto;
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
    margin-bottom: 15px;
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

.kayit {
    text-align: center;
    margin-top: 20px;
}

.kayit a {
    color: #8b4513;
    text-decoration: none;
    font-weight: bold;
}

</style>

</head>

<body>

<div class="kutu">

<h1>Giriş Yap</h1>

<?php if ($mesaj != ""): ?>

<div class="mesaj">
    <?= htmlspecialchars($mesaj) ?>
</div>

<?php endif; ?>

<form method="POST">

<input
    type="email"
    name="email"
    placeholder="E-posta adresiniz"
    required
>

<input
    type="password"
    name="sifre"
    placeholder="Şifreniz"
    required
>

<button type="submit">
    GİRİŞ YAP
</button>

</form>

<div class="kayit">
    Hesabınız yok mu?
    <a href="kayit.php">Kayıt Ol</a>
</div>

</div>

</body>

</html>