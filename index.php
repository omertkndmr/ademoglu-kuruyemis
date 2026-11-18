<?php
session_start();
include "baglantı.php";
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ademoğlu Kuruyemiş - Dünyanın Merkezi Leblebi</title>
    <style>
        /* GENEL AYARLAR */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background-color: #fcfcfc;
            color: #333;
        }
        a {
            text-transform: none;
            text-decoration: none;
            color: inherit;
        }
        ul {
            list-style: none;
        }

        /* TOP BAR */
        .top-bar {
            background-color: #1a110b;
            color: #fff;
            font-size: 12px;
            padding: 8px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .top-bar-right a {
            margin-left: 15px;
            color: #ccc;
        }
        .top-bar-right a:hover {
            color: #fff;
        }

        /* HEADER */
        .main-header {
            background-color: #fff;
            padding: 15px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #f0f0f0;
        }
        .logo {
            cursor: pointer;
        }
        .search-box {
            width: 45%;
            position: relative;
        }
        .search-box input {
            width: 100%;
            padding: 10px 40px 10px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            outline: none;
            background-color: #f9f9f9;
        }
        .header-actions {
            display: flex;
            gap: 25px;
            font-size: 14px;
        }
        .action-item {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }
        .cart-badge {
            background-color: #b58342;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 11px;
        }

        /* NAVIGASYON (MENÜ) */
        .nav-container {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            padding: 0 50px;
        }
        .all-categories-btn {
            background-color: #1e1209;
            color: #fff;
            padding: 15px 25px;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
        }
        .main-menu {
            display: flex;
            gap: 20px;
            margin-left: 30px;
            font-size: 13px;
            font-weight: 600;
            color: #222;
        }
        .main-menu li a {
            cursor: pointer;
            padding: 15px 0;
            display: inline-block;
        }
        .main-menu li a:hover, .main-menu li a.active {
            color: #b58342;
        }

        /* HERO / SLIDER ALANI */
        .hero-section {
            width: 100%;
            position: relative;
            display: block;
            overflow: hidden;
            background-color: #1a110b;
        }
        .hero-bg-img {
            width: 100%;
            height: auto;
            display: block;
        }
        .cta-btn-overlay {
            position: absolute;
            left: 3.7%;
            bottom: 22.5%;
            width: 13.3%;
            height: 12.5%;
            background: rgba(0, 0, 0, 0); 
            cursor: pointer;
            border-radius: 4px;
            z-index: 10;
        }
        .cta-btn-overlay:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        /* BİLGİ ŞERİDİ */
        .features-bar {
            background-color: #fdf6ec;
            display: flex;
            justify-content: space-around;
            padding: 20px 50px;
            border-bottom: 1px solid #f3e5d0;
        }
        .feature-item {
            text-align: center;
            font-size: 13px;
        }
        .feature-item strong {
            display: block;
            color: #1a110b;
            margin-bottom: 3px;
        }
        .feature-item span {
            color: #666;
        }

        /* MAIN CONTENT CONTAINER */
        .container {
            max-width: 1400px;
            margin: 40px auto;
            padding: 0 20px;
        }
        .section-title {
            font-size: 18px;
            color: #1a110b;
            text-transform: uppercase;
            margin-bottom: 20px;
            border-bottom: 2px solid #1a110b;
            padding-bottom: 8px;
            display: inline-block;
        }

        /* POPÜLER KATEGORİLER */
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 15px;
            margin-bottom: 50px;
        }
        .category-card {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 6px;
            text-align: center;
            overflow: hidden;
            padding-bottom: 15px;
            transition: 0.3s;
            cursor: pointer;
        }
        .category-card:hover {
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .category-card img {
            width: 100%;
            height: 120px;
            object-fit: cover;
        }
        .category-card h3 {
            font-size: 14px;
            margin-top: 10px;
            color: #333;
        }
        .category-card span {
            font-size: 12px;
            color: #888;
        }

        /* ÇOK SATANLAR VE REKLAM DÜZENİ */
        .products-section-layout {
            display: flex;
            gap: 20px;
        }
        .products-side {
            flex: 3;
        }
        .banner-side {
            flex: 1;
            background: linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.2)), url('images/aslan.jpeg') no-repeat center center/100% 100%;
            border-radius: 8px;
            padding: 40px 20px;
            color: #fff;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 500px;
        }
        .banner-side h2 {
            font-size: 24px;
            font-weight: bold;
        }
        .banner-btn {
            background-color: #b58342;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            align-self: center;
            font-weight: bold;
        }

        /* ÜRÜN KARTLARI GRID */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        .products-grid.full-width {
            grid-template-columns: repeat(4, 1fr);
        }
        
        .product-card {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 6px;
            padding: 15px;
            text-align: left;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .product-card img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            border-radius: 4px;
        }
        .product-title {
            font-size: 14px;
            font-weight: bold;
            margin: 10px 0 5px 0;
        }
        .price {
            font-size: 16px;
            font-weight: bold;
            color: #1a110b;
            margin-bottom: 10px;
            margin-top: 5px;
        }
        
        /* GRAMAJ SEÇİM ALANI */
        .weight-selector {
            display: flex;
            gap: 5px;
            margin-bottom: 12px;
        }
        .weight-btn {
            flex: 1;
            padding: 6px 0;
            border: 1px solid #ddd;
            background: #fff;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
            text-align: center;
        }
        .weight-btn.active {
            background-color: #1a110b;
            color: #fff;
            border-color: #1a110b;
        }

        .add-to-cart-btn {
            background-color: #b58342;
            color: white;
            width: 100%;
            text-align: center;
            padding: 10px;
            border-radius: 4px;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            border: none;
        }
        .add-to-cart-btn:hover {
            background-color: #946830;
        }

        /* YORUM YAPMA ALANI STİLLERİ */
        .comment-section-box {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 30px;
            margin-top: 40px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.02);
        }
        .comment-form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-top: 20px;
        }
        .comment-form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .comment-form-group.full-width {
            grid-column: span 2;
        }
        .comment-form-group label {
            font-size: 13px;
            font-weight: 600;
            color: #1a110b;
        }
        .comment-form-group input, .comment-form-group select, .comment-form-group textarea {
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            outline: none;
            font-size: 14px;
            background-color: #fafafa;
        }
        .comment-form-group input:focus, .comment-form-group select:focus, .comment-form-group textarea:focus {
            border-color: #b58342;
            background-color: #fff;
        }

        /* FLOATING WHATSAPP BUTTON */
        .whatsapp-float {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #25d366;
            color: white;
            padding: 12px 20px;
            border-radius: 30px;
            font-weight: bold;
            font-size: 14px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            z-index: 1000;
        }

        /* MODAL GENEL STİLLERİ */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 2000;
        }
        .modal-container {
            background-color: #fff;
            width: 90%;
            max-width: 400px;
            border-radius: 8px;
            padding: 25px;
            position: relative;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }
        .modal-close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 22px;
            cursor: pointer;
            color: #888;
        }
        .modal-tabs {
            display: flex;
            border-bottom: 2px solid #eee;
            margin-bottom: 20px;
        }
        .modal-tab {
            flex: 1;
            text-align: center;
            padding: 10px;
            cursor: pointer;
            font-weight: bold;
            color: #888;
        }
        .modal-tab.active {
            color: #b58342;
            border-bottom: 2px solid #b58342;
            margin-bottom: -2px;
        }
        .modal-form {
            display: none;
            flex-direction: column;
            gap: 15px;
        }
        .modal-form.active {
            display: flex;
        }
        .modal-form label {
            font-size: 13px;
            font-weight: 600;
            color: #444;
            display: block;
            margin-bottom: 5px;
        }
        .modal-form input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            outline: none;
        }
        .modal-submit-btn {
            background-color: #b58342;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
            width: 100%;
        }
        .modal-submit-btn:hover {
            background-color: #946830;
        }

        /* SEPET LİSTESİ */
        .sepet-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }
        .sepet-item-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        .sepet-item-title {
            font-size: 14px;
            font-weight: bold;
            color: #222;
        }
        .sepet-item-price {
            font-size: 13px;
            color: #b58342;
            font-weight: 600;
        }
        .sepet-item-remove {
            color: #ff4d4d;
            cursor: pointer;
            font-size: 12px;
            font-weight: bold;
            padding: 5px;
        }

        /* SİPARİŞ BAŞARILI MODALI */
        .success-box {
            text-align: center;
            padding: 10px 0;
        }
        .success-icon {
            font-size: 50px;
            color: #2ecc71;
            margin-bottom: 15px;
            animation: popIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        @keyframes popIn {
            0% { transform: scale(0); }
            100% { transform: scale(1); }
        }
        .success-title {
            font-size: 20px;
            color: #1a110b;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .success-text {
            font-size: 14px;
            color: #666;
            line-height: 1.5;
            margin-bottom: 20px;
        }
        .success-details {
            background-color: #f9f9f9;
            border: 1px dashed #ddd;
            border-radius: 6px;
            padding: 12px;
            font-size: 13px;
            text-align: left;
            margin-bottom: 20px;
        }
        .success-details div {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        /* TOAST BİLDİRİM */
        .toast-notification {
            position: fixed;
            bottom: -100px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #1a110b;
            color: #fff;
            padding: 12px 25px;
            border-radius: 50px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
            z-index: 3000;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: bottom 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), opacity 0.3s ease;
            opacity: 0;
            pointer-events: none;
            border: 1px solid #b58342;
            text-align: center;
            max-width: 90%;
            width: max-content;
        }
        .toast-notification.show {
            bottom: 30px;
        }
        .toast-icon {
            background-color: #b58342;
            color: white;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }

        /* RESPONSIVE (MOBİL UYUMLULUK) */
        @media (max-width: 1024px) {
            .top-bar, .main-header, .nav-container, .features-bar { padding: 15px 20px; }
            .categories-grid { grid-template-columns: repeat(3, 1fr); }
            .products-grid, .products-grid.full-width { grid-template-columns: repeat(2, 1fr); }
            .products-section-layout { flex-direction: column; }
            .banner-side { min-height: 300px; }
            .comment-form-grid { grid-template-columns: 1fr; }
            .comment-form-group.full-width { grid-column: span 1; }
        }
        @media (max-width: 768px) {
            .top-bar { flex-direction: column; gap: 5px; text-align: center; }
            .main-header { flex-direction: column; gap: 15px; text-align: center; }
            .search-box { width: 100%; }
            .nav-container { flex-direction: column; padding: 0; }
            .all-categories-btn { width: 100%; text-align: center; }
            .main-menu { margin-left: 0; padding: 10px; flex-wrap: wrap; justify-content: center; gap: 10px; }
            .features-bar { flex-direction: column; gap: 15px; }
            .categories-grid { grid-template-columns: repeat(2, 1fr); }
            .products-grid, .products-grid.full-width { grid-template-columns: repeat(2, 1fr); gap: 10px; }
            .product-card { padding: 10px; }
            .product-card img { height: 130px; }
            .toast-notification { font-size: 13px; padding: 10px 20px; bottom: -80px; }
            .toast-notification.show { bottom: 85px; }
        }
    </style>
</head>
<body>

<div class="top-bar">
    <div>Çorum'dan Tüm Türkiye'ye Taptaze Kuruyemiş ve Leblebi</div>
    <div class="top-bar-right">
        <a href="#">Hakkımızda</a>
        <a href="#">İletişim</a>
        <a href="#">Sipariş Takibi</a>
        <a href="#">📞 0 (555) 123 45 67</a>
    </div>
</div>

<header class="main-header">
    <div class="logo" onclick="kategoriDegistir('anasayfa')">
        <h2 style="color: #1a110b; font-weight: 800; letter-spacing: 1px;">ADEMOĞLU <span style="color: #b58342; font-size: 14px; block-size: auto; display: block; font-weight: normal;">KURUYEMİŞ</span></h2>
    </div>
    <div class="search-box">
        <input type="text" id="arama-kutusu" placeholder="Aradığınız ürün, kategori veya marka..." oninput="urunAra(this.value)">
    </div>
    <div class="header-actions">
      <?php if (isset($_SESSION["uye_id"])): ?>

<div class="action-item" onclick="window.location.href='hesabim.php'">
    <span>👤</span>
    <div>
        <strong><?= htmlspecialchars($_SESSION["uye_ad"]) ?></strong><br>
        <small>Hesabım</small>
    </div>
</div>

<?php else: ?>

<div class="action-item" onclick="window.location.href='giris.php'">
    <span>👤</span>
    <div>
        <strong>Giriş Yap</strong><br>
        <small>Üye Ol</small>
    </div>
</div>

<?php endif; ?>
        <div class="action-item" onclick="sepetModalAc()">
            <span>🛒</span>
            <div><strong>Sepetim</strong> <span class="cart-badge" id="sepet-adet">0</span><br><small id="sepet-ozet">0 Ürün - 0,00₺</small></div>
        </div>
    </div>
</header>

<div class="nav-container">
    <div class="all-categories-btn">☰ TÜM KATEGORİLER</div>
    <ul class="main-menu">
        <li><a onclick="kategoriDegistir('anasayfa')" id="btn-anasayfa" class="active">ANA SAYFA</a></li>
        <li><a onclick="kategoriDegistir('kuruyemis')" id="btn-kuruyemis">KURUYEMİŞ</a></li>
        <li><a onclick="kategoriDegistir('leblebi')" id="btn-leblebi">LEBLEBİ ÇEŞİTLERİ</a></li>
        <li><a onclick="kategoriDegistir('kurumeyve')" id="btn-kurumeyve">KURU MEYVE</a></li>
        <li><a onclick="kategoriDegistir('sekerleme')" id="btn-sekerleme">LOKUM ÇEŞİTLERİ</a></li>
        <li><a onclick="kategoriDegistir('cikolata')" id="btn-cikolata">ÇİKOLATA</a></li>
        <li><a onclick="kategoriDegistir('hediyelik')" id="btn-hediyelik">HEDİYELİK</a></li>
        <li><a onclick="kategoriDegistir('kolonya')" id="btn-kolonya">KOLONYA ÇEŞİTLERİ</a></li>
        <li><a onclick="kategoriDegistir('campaigns')" id="btn-campaigns">KAMPANYALAR</a></li>
    </ul>
</div>

<div id="home-only-content">
    <section class="hero-section">
        <img src="images/leblebı.png" alt="Ademoğlu Kuruyemiş Banner" class="hero-bg-img">
        <a onclick="kategoriDegistir('leblebi')" class="cta-btn-overlay" title="Alışverişe Başla"></a>
    </section>
    <div class="features-bar">
        <div class="feature-item"><strong>ÜCRETSİZ KARGO</strong><span>5000 TL ve üzeri siparişlerde</span></div>
        <div class="feature-item"><strong>AYNI GÜN KARGO</strong><span>Hafta içi 15:00'a kadar</span></div>
        <div class="feature-item"><strong>GÜVENLİ ÖDEME</strong><span>256 Bit SSL ile koruma</span></div>
        <div class="feature-item"><strong>KOLAY İADE</strong><span>14 gün içinde iade imkanı</span></div>
        <div class="feature-item"><strong>%100 MÜŞTERİ MEMNUNİYETİ</strong><span>Mutlu müşteri, kaliteli hizmet</span></div>
    </div>
</div>

<div class="container" id="main-content-area"></div>

<!-- MÜŞTERİ YORUM YAPMA ALANI -->
<div class="container">
    <div class="comment-section-box">
        <h2 style="font-size: 18px; color: #1a110b; text-transform: uppercase; border-bottom: 2px solid #b58342; padding-bottom: 8px; display: inline-block;">Değerli Yorumlarınız</h2>
        <p style="font-size: 13px; color: #666; margin-top: 10px;">Ürünlerimiz ve hizmetimiz hakkındaki düşüncelerinizi bizimle paylaşarak kendimizi geliştirmemize yardımcı olabilirsiniz.</p>
        
        <form onsubmit="yorumGonder(event)">
            <div class="comment-form-grid">
                <div class="comment-form-group">
                    <label>Adınız Soyadınız *</label>
                    <input type="text" id="yorum-ad" required placeholder="Örn: Ahmet Yılmaz">
                </div>
                <div class="comment-form-group">
                    <label>Memnuniyet Puanınız *</label>
                    <select id="yorum-puan" required>
                        <option value="5">⭐⭐⭐⭐⭐ (5 / 5) - Mükemmel</option>
                        <option value="4">⭐⭐⭐⭐ (4 / 5) - Çok İyi</option>
                        <option value="3">⭐⭐⭐ (3 / 5) - Ortalama</option>
                        <option value="2">⭐⭐ (2 / 5) - Kötü</option>
                        <option value="1">⭐ (1 / 5) - Çok Kötü</option>
                    </select>
                </div>
                <div class="comment-form-group comment-form-group.full-width">
                    <label>Görüşünüz / Mesajınız *</label>
                    <textarea id="yorum-mesaj" rows="4" required placeholder="Tazelik, kargo hızı ve lezzet hakkındaki deneyimlerinizden bahsedebilirsiniz..."></textarea>
                </div>
            </div>
            <button type="submit" class="modal-submit-btn" style="width: auto; padding: 12px 30px; margin-top: 20px; float: right;">Yorumu Gönder</button>
            <div style="clear: both;"></div>
        </form>
    </div>
</div>

<a href="#" class="whatsapp-float">💬 WhatsApp Sipariş</a>

<div id="auth-modal" class="modal-overlay" onclick="modalKapatdisAlan(event)">
    <div class="modal-container">
        <span class="modal-close-btn" onclick="modalKapat()">&times;</span>
        <div class="modal-tabs">
            <div class="modal-tab active" id="tab-giris" onclick="modalTabDegistir('giris')">Giriş Yap</div>
            <div class="modal-tab" id="tab-kayit" onclick="modalTabDegistir('kayit')">Kayıt Ol</div>
        </div>
        
        <form id="form-giris" class="modal-form active" onsubmit="authSistemi(event, 'giris')">
            <div>
                <label>E-Posta Adresi</label>
                <input type="email" required placeholder="ornek@eposta.com">
            </div>
            <div>
                <label>Şifre</label>
                <input type="password" required placeholder="••••••••">
            </div>
            <button type="submit" class="modal-submit-btn">Giriş Yap</button>
        </form>

        <form id="form-kayit" class="modal-form" onsubmit="authSistemi(event, 'kayit')">
            <div>
                <label>Adınız Soyadınız</label>
                <input type="text" required placeholder="Ahmet Yılmaz">
            </div>
            <div>
                <label>E-Posta Adresi</label>
                <input type="email" required placeholder="ornek@eposta.com">
            </div>
            <div>
                <label>Şifre</label>
                <input type="password" required placeholder="En az 6 karakter">
            </div>
            <button type="submit" class="modal-submit-btn">Kayıt Ol</button>
        </form>
    </div>
</div>

<div id="cart-modal" class="modal-overlay" onclick="sepetModalKapatdisAlan(event)">
    <div class="modal-container" style="max-width: 450px;">
        <span class="modal-close-btn" onclick="sepetModalKapat()">&times;</span>
        <h3 style="margin-bottom: 15px; color: #1a110b; border-bottom: 2px solid #b58342; padding-bottom: 5px;">Alışveriş Sepetim</h3>
        
        <div id="sepet-listesi" style="max-height: 280px; overflow-y: auto; margin-bottom: 15px;"></div>
        <div class="comment-form-group">
    <label>Ad Soyad *</label>
    <input type="text" id="musteri-ad" placeholder="Ad Soyad">
</div>

<div class="comment-form-group">
    <label>Telefon *</label>
    <input type="text" id="musteri-telefon" placeholder="05xx xxx xx xx">
</div>

<div class="comment-form-group">
    <label>Adres *</label>
    <textarea id="musteri-adres" rows="3" placeholder="Teslimat adresiniz"></textarea>
</div>
		
		<div class="comment-form-group full-width">
    <label for="siparis-aciklama">Sipariş Açıklaması</label>
    <textarea id="siparis-aciklama" rows="4" placeholder="Örneğin: Tuzsuz olsun, hediye paketi yapılsın, kapıyı çalmayın vb."></textarea>
</div>
<div class="comment-form-group full-width">

<label for="odeme-turu">
Ödeme Yöntemi
</label>

<select id="odeme-turu">

<option value="Kapıda Ödeme">
Kapıda Ödeme
</option>

<option value="Havale / EFT">
Havale / EFT
</option>

</select>

</div>
        
        <div style="display: flex; justify-content: space-between; align-items: center; font-weight: bold; font-size: 16px; margin-bottom: 15px; border-top: 1px solid #eee; padding-top: 15px;">
            <span>Toplam Tutar:</span>
            <span id="sepet-toplam-tutar" style="color: #1a110b;">0,00₺</span>
        </div>
        
        <button class="modal-submit-btn" onclick="sepetiOnayla()">Alışverişi Tamamla</button>
    </div>
</div>

<div id="success-modal" class="modal-overlay">
    <div class="modal-container" style="max-width: 420px; text-align: center;">
        <div class="success-box">
            <div class="success-icon">✓</div>
            <div class="success-title">Siparişiniz Başarıyla Alındı!</div>
            <p class="success-text">Harika seçim! Çorum'un en taze lezzetleri sizin için paketlenmek üzere hazırlığa alındı.</p>
            
            <div class="success-details">
                <div><strong>Sipariş Durumu:</strong> <span style="color:#2ecc71; font-weight:bold;">Onaylandı</span></div>
                <div><strong>Kargo Firması:</strong> <span>Yurtiçi Kargo (Ücretsiz)</span></div>
                <div><strong>Tahmini Teslimat:</strong> <span>2-3 İş Günü</span></div>
                <div style="margin-top: 5px; border-top: 1px solid #eee; padding-top: 5px;">
                    <strong>Ödenen Tutar:</strong> <span id="onaylanan-tutar" style="font-weight:bold; color:#b58342;">0,00₺</span>
                </div>
            </div>
            
            <button class="modal-submit-btn" onclick="basariliModalKapat()" style="margin-top:0;">Alışverişe Devam Et</button>
        </div>
    </div>
</div>

<div id="toast" class="toast-notification">
    <span class="toast-icon">✓</span>
    <span id="toast-text">Ürün başarıyla sepetinize eklendi!</span>
</div>

<script>
   
    let urunlerVerisi = {
        
    kuruyemis:[],
    leblebi:[],
    kurumeyve:[],
    sekerleme:[],
    cikolata:[],
    hediyelik:[],
    kolonya:[]
};
console.log("FETCH ÖNCESİ KOLONYA:", urunlerVerisi.kolonya.length);

    fetch("urunler.php")
      

.then(response => response.json())
.then(data => {
    console.log("FETCH GELDİ, KOLONYA TEMİZ:", urunlerVerisi.kolonya);
    console.log("BAŞLANGIÇ VERİ:", urunlerVerisi);
    console.log("FETCH ÇALIŞTI");
// Eski ürünleri temizle
Object.keys(urunlerVerisi).forEach(kategori => {
    urunlerVerisi[kategori] = [];
});

    data.forEach(urun => {
        console.log("PHP GELEN:", urun.id, urun.isim);
        console.log("GELEN HAM VERİ:", urun);
        console.log("GELEN ÜRÜN:", urun.isim, urun.kategori);
        console.log("VERİTABANINDAN GELEN:", data);
console.log("VERİTABANI ÜRÜN SAYISI:", data.length);

        if(!urunlerVerisi[urun.kategori]){
            urunlerVerisi[urun.kategori] = [];
        }

       // Aynı isimli ürün varsa ekleme
const varMi = urunlerVerisi[urun.kategori].some(
    x => x.isim === urun.isim
);

if(!varMi){
    urunlerVerisi[urun.kategori].push({
        isim: urun.isim,
        fiyat: Number(urun.fiyat).toLocaleString('tr-TR', {
            minimumFractionDigits:2
        }) + "₺",
        resim: urun.resim,
        aciklama: urun.aciklama
    });
}

    });

    console.log("Yeni ürün sistemi:", urunlerVerisi);
anasayfaArayuzCiz();
});

    let sepet = [];
    let aktifKategori = 'anasayfa';

    // Fiyat Yardımcı Fonksiyonu
    function fiyataDonustur(fiyatStr) {
        return parseFloat(fiyatStr.replace('.', '').replace(',', '.').replace('₺', '').trim());
    }

    // SEPETE EKLEME FONKSİYONU
    function sepeteEkle(urunIsim, fiyatStr, agirlik) {
        const netFiyat = fiyataDonustur(fiyatStr);
        let carpan = 1;
        if(agirlik === '500g') carpan = 0.5;
        if(agirlik === '250g') carpan = 0.25;
        
        const nihaiFiyat = netFiyat * carpan;
        
        sepet.push({
            isim: `${urunIsim} (${agirlik})`,
            fiyat: nihaiFiyat
        });
        console.log("Sepet:", sepet);
        sepetArayuzGuncelle();
        toastGoster(`${urunIsim} (${agirlik}) sepetinize eklendi.`);
    }

    function sepetArayuzGuncelle() {
        document.getElementById('sepet-adet').innerText = sepet.length;
        let toplam = 0;
        let html = '';
        
        sepet.forEach((item, index) => {
            toplam += item.fiyat;
            html += `
                <div class="sepet-item">
                    <div class="sepet-item-info">
                        <span class="sepet-item-title">${item.isim}</span>
                        <span class="sepet-item-price">${item.fiyat.toLocaleString('tr-TR', {minimumFractionDigits:2})}₺</span>
                    </div>
                    <span class="sepet-item-remove" onclick="sepettenCikar(${index})">Kaldır</span>
                </div>
            `;
        });
        
        document.getElementById('sepet-ozet').innerHTML = `${sepet.length} Ürün - ${toplam.toLocaleString('tr-TR', {minimumFractionDigits:2})}₺`;
        document.getElementById('sepet-toplam-tutar').innerText = `${toplam.toLocaleString('tr-TR', {minimumFractionDigits:2})}₺`;
        document.getElementById('sepet-listesi').innerHTML = html || '<p style="text-align:center; color:#888; padding:20px 0;">Sepetiniz henüz boş.</p>';
    }

    function sepettenCikar(index) {
        sepet.splice(index, 1);
        sepetArayuzGuncelle();
    }

    // LİSTELEME VE KATEGORİ DEĞİŞTİRME
    function kategoriDegistir(kategori) {
        aktifKategori = kategori;
        const menuLinkleri = document.querySelectorAll('.main-menu a');
        menuLinkleri.forEach(link => link.classList.remove('active'));
        
        const aktifLink = document.getElementById(`btn-${kategori}`);
        if(aktifLink) aktifLink.classList.add('active');

        const homeContent = document.getElementById('home-only-content');
        const area = document.getElementById('main-content-area');

        if(kategori === 'anasayfa') {
            homeContent.style.display = 'block';
            console.log("ÇİZİM ÖNCESİ:", urunlerVerisi);
            anasayfaArayuzCiz();
        } else if(kategori === 'campaigns') {
            homeContent.style.display = 'none';
            area.innerHTML = "";
            area.innerHTML = `
                <h2 class="section-title">KAMPANYALAR & FIRSATLAR</h2>
                <div style="background-color:#fff; border:1px solid #eee; padding:40px; text-align:center; border-radius:8px;">
                    <h3 style="color:#b58342; margin-bottom:10px; font-size:24px;">Çorum'dan Doğal Lezzet Festivali!</h3>
                    <p style="color:#666; font-size:15px; max-width:600px; margin:0 auto 20px auto;">Seçeceğiniz tüm taze kuruyemiş ve meşhur Çorum leblebilerinde 5000 TL ve üzeri alışverişlerinizde anında ücretsiz kargo ve özel sürpriz hediyeler kapınızda!</p>
                    <button class="banner-btn" onclick="kategoriDegistir('leblebi')" style="border:none; cursor:pointer;">Hemen Alışverişe Başla</button>
                </div>
            `;
        } else {
            homeContent.style.display = 'none';
            let urunlerHtml = '';
            const liste = urunlerVerisi[kategori] || [];
            console.log("KATEGORİ:", kategori);
console.log("ÜRÜN SAYISI:", liste.length);
console.log(liste.map(x => x.isim));
            console.log(liste);
            
            liste.forEach((u, i) => {
                urunlerHtml += `
                    <div class="product-card">
           ${(() => {
let resim = u.resim || "";

resim = resim.replace(/\[|\]|\(|\)/g,'');

if(resim.startsWith("http")){
    return `<img src="${resim}" alt="${u.isim}">`;
}

if(resim.startsWith("images/") || resim.startsWith("admin/")){
    return `<img src="${resim}" alt="${u.isim}">`;
}

return `<img src="images/${resim}" alt="${u.isim}">`;

})()}
<div>
    <div class="product-title">${u.isim}</div>
                            <div class="price" id="p-price-${kategori}-${i}">${u.fiyat}</div>
                           ${(
    kategori === 'kolonya' ||
    kategori === 'hediyelik' ||
    (kategori === 'lokum' && u.isim.trim().toLowerCase() === 'bisküvi arası lokum')
) ? '' : `
    <div class="weight-selector">
        <div class="weight-btn active" id="w-kg-${kategori}-${i}" onclick="agirlikSec('${kategori}', ${i}, '1kg')">1 KG</div>
        <div class="weight-btn" id="w-500-${kategori}-${i}" onclick="agirlikSec('${kategori}', ${i}, '500g')">500G</div>
        <div class="weight-btn" id="w-250-${kategori}-${i}" onclick="agirlikSec('${kategori}', ${i}, '250g')">250G</div>
    </div>
`}
                        </div>
                        <button class="add-to-cart-btn" onclick="sepetEklemeTetikle('${kategori}', ${i})">SEPETE EKLE</button>
                    </div>
                `;
            });

            area.innerHTML = `
                <h2 class="section-title">${kategori.toUpperCase()} REYONU</h2>
                <div class="products-grid full-width">${urunlerHtml || '<p>Bu kategoride ürün bulunamadı.</p>'}</div>
            `;
        }
    }

    function anasayfaArayuzCiz() {
        const area = document.getElementById('main-content-area');
        let cokSatanlarHtml = '';
        const populerler = (urunlerVerisi.kuruyemis || []).slice(0, 6);
        
        
        populerler.forEach((u, i) => {
            cokSatanlarHtml += `
                <div class="product-card">
               <img src="${u.resim.startsWith('http') || u.resim.startsWith('images/') || u.resim.startsWith('admin/') ? u.resim : 'images/' + u.resim}">
                        <div class="product-title">${u.isim}</div>
                        <div class="price" id="p-price-pop-${i}">${u.fiyat}</div>
                        <div class="weight-selector">
                            <div class="weight-btn active" id="w-kg-pop-${i}" onclick="agirlikSec('pop', ${i}, '1kg')">1 KG</div>
                            <div class="weight-btn" id="w-500-pop-${i}" onclick="agirlikSec('pop', ${i}, '500g')">500G</div>
                            <div class="weight-btn" id="w-250-pop-${i}" onclick="agirlikSec('pop', ${i}, '250g')">250G</div>
                        </div>
                 
                    <button class="add-to-cart-btn" onclick="sepetEklemeTetikle('pop', ${i})">SEPETE EKLE</button>
                </div>
            `;
        });

        area.innerHTML = `
            <h2 class="section-title">POPÜLER KATEGORİLER</h2>
            <div class="categories-grid">
                <div class="category-card" onclick="kategoriDegistir('kuruyemis')"><img src="images/antep.png" onerror="this.src='https://images.unsplash.com/photo-1596547609652-9cf5d8d76921?q=80&w=400'"><h3>Taze Kuruyemiş</h3><span>27 Çeşit Ürün</span></div>
                <div class="category-card" onclick="kategoriDegistir('leblebi')"><img src="images/sarıleblebi.jpeg" onerror="this.src='https://images.unsplash.com/photo-1596547609652-9cf5d8d76921?q=80&w=400'"><h3>Çorum Leblebisi</h3><span>12 Çeşit Ürün</span></div>
                <div class="category-card" onclick="kategoriDegistir('kurumeyve')"><img src="images/kuru.jpeg" onerror="this.src='https://images.unsplash.com/photo-1596547609652-9cf5d8d76921?q=80&w=400'"><h3>Doğal Kuru Meyve</h3><span>11 Çeşit Ürün</span></div>
                <div class="category-card" onclick="kategoriDegistir('sekerleme')"><img src="images/şekerleme.jpeg" onerror="this.src='https://images.unsplash.com/photo-1596547609652-9cf5d8d76921?q=80&w=400'"><h3>Saray Lokumları</h3><span>20 Çeşit Ürün</span></div>
                <div class="category-card" onclick="kategoriDegistir('cikolata')"><img src="images/çikolata.jpeg" onerror="this.src='https://images.unsplash.com/photo-1596547609652-9cf5d8d76921?q=80&w=400'"><h3>Çikolata & Draje</h3><span>10 Çeşit Ürün</span></div>
                <div class="category-card" onclick="kategoriDegistir('hediyelik')"><img src="https://images.unsplash.com/photo-1513201099705-a9746e1e201f?q=80&w=400" alt=""><h3>Hediyelik Kutular</h3><span>7 Çeşit Ürün</span></div>
            </div>

            <h2 class="section-title">HAFTANIN ÇOK SATANLARI</h2>
            <div class="products-section-layout">
                <div class="products-side">
                    <div class="products-grid">${cokSatanlarHtml}</div>
                </div>
                <div class="banner-side">
                    <h2>ÇORUM'DAN<br>KAPINIZA TAZELİK</h2>
                    <p style="font-size:14px; line-height:1.4;">Geleneksel yöntemlerle kavrulan leblebilerimiz ve en seçkin çiftliklerden toplanan lüks kuruyemişlerimiz Ademoğlu güvencesiyle tek tıkla evinizde.</p>
                    <div class="banner-btn" onclick="kategoriDegistir('campaigns')" style="cursor:pointer;">Kampanyaları Gör</div>
                </div>
            </div>
        `;
    }

    const seciliAgirliklar = {};
    
    // ANLIK FİYAT DEĞİŞİMİ VE GRAMAJ BUTON SEÇİMİ
    function agirlikSec(kategori, index, agirlik) {
        const key = `${kategori}-${index}`;
        seciliAgirliklar[key] = agirlik;
        
      let btnKg;
let btn500;
let btn250;

if (kategori === 'pop') {
    btnKg = document.getElementById(`w-kg-pop-${index}`);
    btn500 = document.getElementById(`w-500-pop-${index}`);
    btn250 = document.getElementById(`w-250-pop-${index}`);
} else {
    btnKg = document.getElementById(`w-kg-${kategori}-${index}`);
    btn500 = document.getElementById(`w-500-${kategori}-${index}`);
    btn250 = document.getElementById(`w-250-${kategori}-${index}`);
}
        
        if(btnKg) btnKg.classList.remove('active');
        if(btn500) btn500.classList.remove('active');
        if(btn250) btn250.classList.remove('active');
        
        if(agirlik === '1kg' && btnKg) btnKg.classList.add('active');
        if(agirlik === '500g' && btn500) btn500.classList.add('active');
        if(agirlik === '250g' && btn250) btn250.classList.add('active');

        // Fiyat etiketini dinamik değiştirme
        let urun;
        if (kategori === 'pop') {
            urun = urunlerVerisi.kuruyemis[index];
        } else if (kategori.startsWith('search-')) {
            const gercekKat = kategori.replace('search-', '');
            urun = urunlerVerisi[gercekKat][index];
        } else {
            urun = urunlerVerisi[kategori][index];
        }

        if (urun) {
            const anaFiyat = fiyataDonustur(urun.fiyat);
            let carpan = 1;
            if(agirlik === '500g') carpan = 0.5;
            if(agirlik === '250g') carpan = 0.25;

            const guncelTutar = anaFiyat * carpan;
            let priceId;

if(kategori === "pop"){
    priceId = `p-price-pop-${index}`;
}else{
    priceId = `p-price-${kategori}-${index}`;
}

const priceLabel = document.getElementById(priceId);
            if (priceLabel) {
                priceLabel.innerText = `${guncelTutar.toLocaleString('tr-TR', {minimumFractionDigits:2})}₺`;
            }
        }
    }

    function sepetEklemeTetikle(kategori, index) {
        const key = `${kategori}-${index}`;
        const agirlik = seciliAgirliklar[key] || '1kg';
        let urun;
        if(kategori === 'pop') {
            urun = urunlerVerisi.kuruyemis[index];
        } else if (kategori.startsWith('search-')) {
            const gercekKat = kategori.replace('search-', '');
            urun = urunlerVerisi[gercekKat][index];
        } else {
            urun = urunlerVerisi[kategori][index];
        }
        if(urun) {
            sepeteEkle(urun.isim, urun.fiyat, agirlik);
        }
    }

    // ARAMA SİSTEMİ
    function urunAra(kelime) {
        if(!kelime.trim()) {
            kategoriDegistir(aktifKategori);
            return;
        }
        
        document.getElementById('home-only-content').style.display = 'none';
        const area = document.getElementById('main-content-area');
        let sonuclarHtml = '';
        let aramaSifati = kelime.toLowerCase();
        console.log("ARAMA VERİSİ:", urunlerVerisi);
console.log("KOLONYA SAYISI:", urunlerVerisi.kolonya.length);
        
        Object.keys(urunlerVerisi).forEach(kat => {
            urunlerVerisi[kat].forEach((u, i) => {
                if(u.isim.toLowerCase().includes(aramaSifati)) {
                    sonuclarHtml += `
                        <div class="product-card">
                           <img src="${u.resim}" alt="${u.isim}" onerror="this.src='https://images.unsplash.com/photo-1596547609652-9cf5d8d76921?q=80&w=400'">
                            <div>
                                <div class="product-title">${u.isim}</div>
                                <div class="price" id="p-price-search-${kat}-${i}">${u.fiyat}</div>
                                <div class="weight-selector">
                                    <div class="weight-btn active" id="w-kg-search-${kat}-${i}" onclick="agirlikSec('search-${kat}', ${i}, '1kg')">1 KG</div>
                                    <div class="weight-btn" id="w-500-search-${kat}-${i}" onclick="agirlikSec('search-${kat}', ${i}, '500g')">500G</div>
                                    <div class="weight-btn" id="w-250-search-${kat}-${i}" onclick="agirlikSec('search-${kat}', ${i}, '250g')">250G</div>
                                </div>
                            </div>
                            <button class="add-to-cart-btn" onclick="sepetEklemeTetikle('search-${kat}', ${i})">SEPETE EKLE</button>
                        </div>
                    `;
                }
            });
        });
        
        area.innerHTML = `
            <h2 class="section-title">ARAMA SONUÇLARI: "${kelime}"</h2>
            <div class="products-grid full-width">${sonuclarHtml || '<p style="padding:20px; color:#666;">Aramanızla eşleşen taze ürün bulunamadı.</p>'}</div>
        `;
    }

    // MÜŞTERİ YORUMU GÖNDERME TETİKLEYİCİSİ
    function yorumGonder(event) {
        event.preventDefault();
        const ad = document.getElementById('yorum-ad').value;
        const puan = document.getElementById('yorum-puan').value;
        
        toastGoster(`Teşekkürler ${ad}! ${puan} yıldızlı yorumunuz incelendikten sonra yayınlanacaktır.`);
        
        // Formu temizle
        document.getElementById('yorum-ad').value = '';
        document.getElementById('yorum-puan').value = '5';
        document.getElementById('yorum-mesaj').value = '';
    }

    // MODAL & AUTH İŞLEMLERİ
    function modalAc(tip) {
        document.getElementById('auth-modal').style.display = 'flex';
        modalTabDegistir(tip);
    }
    function modalKapat() { document.getElementById('auth-modal').style.display = 'none'; }
    function modalKapatdisAlan(e) { if(e.target.id === 'auth-modal') modalKapat(); }
    
    function modalTabDegistir(tip) {
        const tabGiris = document.getElementById('tab-giris');
        const tabKayit = document.getElementById('tab-kayit');
        const formGiris = document.getElementById('form-giris');
        const formKayit = document.getElementById('form-kayit');
        
        if(tip === 'giris') {
            tabGiris.classList.add('active');
            tabKayit.classList.remove('active');
            formGiris.classList.add('active');
            formKayit.classList.remove('active');
        } else {
            tabKayit.classList.add('active');
            tabGiris.classList.remove('active');
            formKayit.classList.add('active');
            formGiris.classList.remove('active');
        }
    }

    function authSistemi(e, tip) {
        e.preventDefault();
        modalKapat();
        toastGoster(tip === 'giris' ? "Başarıyla giriş yaptınız." : "Üyeliğiniz başarıyla oluşturuldu.");
    }

    function sepetModalAc() { document.getElementById('cart-modal').style.display = 'flex'; }
    function sepetModalKapat() { document.getElementById('cart-modal').style.display = 'none'; }
    function sepetModalKapatdisAlan(e) { if(e.target.id === 'cart-modal') sepetModalKapat(); }

   function sepetiOnayla() {

    if(sepet.length === 0) {
        alert("Sepetiniz boş olduğu için sipariş tamamlanamaz.");
        return;
    }

    let ad = document.getElementById("musteri-ad").value;
    let telefon = document.getElementById("musteri-telefon").value;
    let adres = document.getElementById("musteri-adres").value;
    let aciklama = document.getElementById("siparis-aciklama").value;
    let odeme = document.getElementById("odeme-turu").value;

    if(ad === "" || telefon === "" || adres === "") {
        alert("Lütfen ad, telefon ve adres bilgilerini doldurun.");
        return;
    }

    let toplam = 0;
    sepet.forEach(i => toplam += i.fiyat);

console.log(sepet);
    let siparisVerisi = {
    ad: ad,
    telefon: telefon,
    adres: adres,
    aciklama: aciklama,
    odeme_turu: odeme,
    urunler: sepet,
    toplam: toplam
};

    fetch("siparis_kaydet.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(siparisVerisi)
    })
    .then(res => res.json())
    .then(data => {

        if(data.durum === "ok") {

            let mesaj = 
`ADEMOĞLU KURUYEMİŞ SİPARİŞİ

Müşteri: ${ad}
Telefon: ${telefon}
Adres: ${adres}

Ürünler:
${sepet.map(x => x.isim + " - " + x.gram + " - " + x.fiyat + "₺").join("\n")}

Toplam: ${toplam}₺

Not:
${aciklama}`;


            let whatsappNo = "905551234567";

            window.open(
                "https://wa.me/" + whatsappNo + "?text=" + encodeURIComponent(mesaj),
                "_blank"
            );


            sepetModalKapat();

            document.getElementById('onaylanan-tutar').innerText =
            `${toplam.toLocaleString('tr-TR',{minimumFractionDigits:2})}₺`;

            document.getElementById('success-modal').style.display='flex';


            sepet = [];
            sepetArayuzGuncelle();

        } else {

            alert("Sipariş kaydedilemedi!");

        }

    });

}

    function basariliModalKapat() { document.getElementById('success-modal').style.display = 'none'; }

    // TOAST BİLDİRİM SİSTEMİ
    let toastTimeout;
    function toastGoster(mesaj) {
        const t = document.getElementById('toast');
        document.getElementById('toast-text').innerText = mesaj;
        t.classList.add('show');
        clearTimeout(toastTimeout);
        toastTimeout = setTimeout(() => { t.classList.remove('show'); }, 3500);
    }

 
</script>
</body>
</html>