<?php
include "conn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>BTS Universe</title>

  <link rel="stylesheet" href="indexx.css">

  <link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>

<header class="header">

  <a href="index.php" class="logo">
    <img src="img/logo.png" alt="BTS Logo">
  </a>

  <div class="header-right">

    <a href="login.php" class="admin-btn">
      ADMIN
    </a>

    <button id="menuBtn" class="menu-btn">☰</button>

  </div>

</header>

<div class="socials-main">
  <a href="https://www.instagram.com/bts.bighitofficial/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
  <a href="https://twitter.com/bts_twt" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
  <a href="https://www.facebook.com/bangtan.official" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
  <a href="https://www.youtube.com/@BANGTANTV" target="_blank"><i class="fa-brands fa-youtube"></i></a>
</div>

<section class="hero">

  <div class="hero-overlay"></div>

  <img src="img/download (2).gif" alt="">

  <div class="hero-content">

    <h1>BTS UNIVERSE</h1>

    <p>
      Explore BTS members, albums, music videos, and TinyTan characters.
    </p>

    <a href="profile.php" class="explore-btn">
      EXPLORE NOW
    </a>

  </div>

</section>

<div class="homepage-copyright">
  © HYBE Co., Ltd. ALL RIGHTS RESERVED.
</div>

<div class="menu-overlay" id="menu">

  <div class="menu-header">

    <a href="index.php" class="menu-logo">
      <img src="img/logo.png" alt="">
    </a>

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

<script>

const menu = document.getElementById("menu");
const menuBtn = document.getElementById("menuBtn");
const closeBtn = document.getElementById("closeBtn");

menuBtn.onclick = () => {
  menu.classList.add("open");
};

closeBtn.onclick = () => {
  menu.classList.remove("open");
};

</script>

</body>
</html>