<?php
include "conn.php";

$result = mysqli_query($conn, "SELECT * FROM members ORDER BY id ASC");

$members = [];
while($row = mysqli_fetch_assoc($result)){
  $members[] = $row;
}

$first = $members[0] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BTS | Profile</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="profile.css">
</head>

<body>

<header class="header">
  <a href="index.php" class="logo">
    <img src="img/logo.png" alt="BTS Logo">
  </a>
  <button id="menuBtn" class="menu-btn">☰</button>
</header>

<div class="menu-overlay" id="menu">

  <div class="menu-header">
    <a href="index.php" class="menu-logo">
      <img src="img/logo.png" alt="BTS Logo">
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
    <a href="https://www.youtube.com/@BTS" target="_blank"><i class="fa-brands fa-youtube"></i></a>
  </div>

</div>

<div class="socials-main">
  <a href="https://www.instagram.com/bts.bighitofficial/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
  <a href="https://twitter.com/bts_twt" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
  <a href="https://www.facebook.com/bangtan.official" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
  <a href="https://www.youtube.com/@BTS" target="_blank"><i class="fa-brands fa-youtube"></i></a>
</div>


<div class="page-label">
  <span class="num">02</span>
  <div class="line"></div>
  <span class="text">PROFILE</span>
</div>

<section class="profile-section">
  <div class="profile-wrapper">

    <div class="member-list">
      <ul>
        <?php foreach($members as $i => $m){ ?>
          <li class="<?= $i == 0 ? 'active' : '' ?>">
            <?= htmlspecialchars($m['stage_name']) ?>
          </li>
        <?php } ?>
      </ul>
    </div>

    <div class="profile-image-box">
      <img id="profileImg"
           src="img/<?= !empty($first['image']) ? $first['image'] : 'default.jpg' ?>"
           onerror="this.src='img/default.jpg'">
    </div>

   
    <div class="profile-info" id="profileInfo">
      <h1><?= $first['stage_name'] ?? '' ?></h1>
      <p><strong>Full Name:</strong> <?= $first['real_name'] ?? '' ?></p>
      <p><strong>Born:</strong> <?= $first['birthday'] ?? '' ?></p>
      <p><strong>Position:</strong> <?= $first['position'] ?? '' ?></p>
      <p><strong>Debut:</strong> June 13, 2013</p>
    </div>


</section>
 
<div class="album-btn-wrapper">
    <a href="album.php" class="album-btn">MEMBERS ALBUM</a>
</div>

<div class="homepage-copyright">
  © HYBE Co., Ltd. ALL RIGHTS RESERVED.
</div>

<!-- SCRIPT -->
<script>

// MENU
const menu = document.getElementById("menu");
const menuBtn = document.getElementById("menuBtn");
const closeBtn = document.getElementById("closeBtn");

menuBtn.onclick = () => menu.classList.add("open");
closeBtn.onclick = () => menu.classList.remove("open");

// DATA FROM PHP
const data = <?= json_encode($members) ?>;
const items = document.querySelectorAll(".member-list li");
const img = document.getElementById("profileImg");
const info = document.getElementById("profileInfo");

items.forEach((item, index) => {

  item.addEventListener("click", () => {

    items.forEach(x => x.classList.remove("active"));
    item.classList.add("active");

    const d = data[index];

    if(d){


      img.src = d.image
        ? "img/" + d.image
        : "img/default.jpg";

      info.innerHTML = `
        <h1>${d.stage_name}</h1>
        <p><strong>Full Name:</strong> ${d.real_name}</p>
        <p><strong>Born:</strong> ${d.birthday}</p>
        <p><strong>Position:</strong> ${d.position}</p>
        <p><strong>Debut:</strong> June 13, 2013</p>
      `;
    }

  });

});

</script>

</body>
</html>