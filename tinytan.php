<?php
include "conn.php";

$result = mysqli_query($conn, "SELECT * FROM tinytan ORDER BY id ASC");
$members = [];

if($result){
    while($row = mysqli_fetch_assoc($result)){
        $members[] = $row;
    }
}

$delays = ['0s','0.2s','0.4s','0.6s','0.8s','1.0s','1.2s'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TinyTAN | Official Page</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="tinytannn.css">

<style>
:root{
    --primary:#6d21d2;
}
.v-title{
    color:var(--primary);
    font-weight:900;
}
.video-info{
    color:var(--primary);
}
</style>

</head>

<body>

<header class="header">
    <div class="logo">
        <a href="index.php"><img src="img/logo.png" alt="Logo"></a>
    </div>
    <button class="menu-btn" id="openBtn">☰</button>
</header>

<!-- SOCIALS SIDEBAR -->
<div class="socials-main">
    <a href="https://www.instagram.com/bts.bighitofficial/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
    <a href="https://twitter.com/bts_twt" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
    <a href="https://www.facebook.com/bangtan.official" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
    <a href="https://www.youtube.com/@BANGTANTV" target="_blank"><i class="fa-brands fa-youtube"></i></a>
</div>

<!-- MENU OVERLAY -->
<div class="menu-overlay" id="menu">
    <div class="menu-header">
        <img src="img/logo.png" style="height:70px;">
        <div id="closeBtn" class="close-btn">×</div>
    </div>

    <nav class="menu-links">
        <a href="index.php">HOME</a>
        <a href="profile.php">PROFILE</a>
        <a href="discography.php">DISCOGRAPHY</a>
        <a href="video.php">VIDEO</a>
        <a href="tinytan.php">TINYTAN</a>
    </nav>

    <div class="menu-socials">
        <a href="https://www.instagram.com/bts.bighitofficial/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
        <a href="https://twitter.com/bts_twt" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
        <a href="https://www.facebook.com/bangtan.official" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="https://www.youtube.com/@BANGTANTV" target="_blank"><i class="fa-brands fa-youtube"></i></a>
    </div>

    <div class="menu-copyright">
        © HYBE Co., Ltd. ALL RIGHTS RESERVED.
    </div>
</div>

<main class="container">

    <h1 class="hero-title">TinyTAN</h1>
    <p class="hero-sub">Magic Door to your Heart</p>

    <!-- MEMBERS -->
    <div class="members-row">

        <?php foreach($members as $i => $m): ?>
        <?php $delay = $delays[$i % count($delays)]; ?>

        <div class="member-box" onclick="sel(this)">

            <div class="char-wrap" style="animation-delay:<?= $delay ?>;">
                <img src="img/<?= htmlspecialchars($m['image']); ?>"
                     alt="<?= htmlspecialchars($m['character_name']); ?>">
            </div>

            <div class="member-name">
                <?= htmlspecialchars($m['character_name']); ?>
            </div>

            <div class="member-desc">
                <?= htmlspecialchars($m['description']); ?>
            </div>

        </div>

        <?php endforeach; ?>

    </div>

    <!-- VIDEOS -->
    <h2 class="section-header" style="margin-bottom:24px;">TinyTAN Animations</h2>

    <div class="video-grid v-2">

        <div class="video-item" onclick="window.open('https://youtu.be/_K2v-MmAj7E')">
            <img src="album/tinyDynamite.jpg" alt="Dynamite MV">
            <div class="video-info"><span class="v-title">DYNAMITE MV</span></div>
        </div>

        <div class="video-item" onclick="window.open('https://youtu.be/90ncej-8cjA')">
            <img src="album/Home.jpg" alt="Home CERT">
            <div class="video-info"><span class="v-title">HOME - CERT</span></div>
        </div>

    </div>

    <div class="video-grid v-3">

        <div class="video-item" onclick="window.open('https://youtu.be/K7BMF0ozFS0')">
            <img src="album/dream.jpg" alt="Dream On">
            <div class="video-info"><span class="v-title">DREAM ON</span></div>
        </div>

        <div class="video-item" onclick="window.open('https://youtu.be/Yf9Nlq5wrf8')">
            <img src="album/magic door.gif" alt="Magic Door">
            <div class="video-info"><span class="v-title">MAGIC DOOR</span></div>
        </div>

        <div class="video-item" onclick="window.open('https://youtu.be/LFeiGU35ZzA')">
            <img src="album/cha.jpg" alt="Character Trailer">
            <div class="video-info"><span class="v-title">CHARACTER TRAILER</span></div>
        </div>

    </div>

    <!-- PROMO -->
    <h2 class="section-header" style="margin-bottom:24px;">PROMOTIONAL IMAGES</h2>

    <div class="promo-row">
        <img src="tiny/6e9ac42664a41fdc3352aba906257367.gif" alt="TinyTAN Promo 1">
        <img src="tiny/ee.jpg" alt="TinyTAN Promo 2">
        <img src="tiny/e3688ad72d15e2f0b3a47f69432c6baa.gif" alt="TinyTAN Promo 3">
        <img src="tiny/450c8414f0f2755c5d6efce23f519766.jpg" alt="TinyTAN Promo 4">
    </div>

</main>

<!-- INTRO SECTION -->
<section class="intro-banner">
    <h2>BORAHAE, TINYTAN!</h2>
    <p>TinyTAN characters are inspired by BTS members to bring comfort and inspiration.</p>

    <div class="video-grid v-2" style="max-width:800px;margin:0 auto;">

        <div class="video-item" onclick="window.open('https://youtu.be/JPpvYUADefI')">
            <img src="https://img.youtube.com/vi/JPpvYUADefI/mqdefault.jpg" alt="Official Intro">
            <div class="video-info"><span class="v-title">OFFICIAL INTRO</span></div>
        </div>

        <div class="video-item" onclick="window.open('https://youtu.be/CqXlfmIbInQ')">
            <img src="https://img.youtube.com/vi/CqXlfmIbInQ/mqdefault.jpg" alt="Hi We are TinyTAN">
            <div class="video-info"><span class="v-title">Hi We are TinyTAN!</span></div>
        </div>

    </div>
</section>

<footer class="footer-copy">
    © HYBE Co., Ltd. ALL RIGHTS RESERVED.
</footer>

<script>
const menu = document.getElementById('menu');

document.getElementById('openBtn').onclick = () => {
    menu.classList.add('open');
    document.body.classList.add('menu-open');
};

document.getElementById('closeBtn').onclick = () => {
    menu.classList.remove('open');
    document.body.classList.remove('menu-open');
};

// Close menu when clicking outside the nav links
menu.addEventListener('click', (e) => {
    if(e.target === menu){
        menu.classList.remove('open');
        document.body.classList.remove('menu-open');
    }
});

function sel(x){
    document.querySelectorAll('.member-box').forEach(b => b.classList.remove('active'));
    x.classList.add('active');
}
</script>

</body>
</html>