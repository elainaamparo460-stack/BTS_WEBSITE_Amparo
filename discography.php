<?php
include "conn.php";

$result = mysqli_query($conn, "SELECT * FROM albums ORDER BY album_id ASC");
$albums = [];
if($result){

  while($row = mysqli_fetch_assoc($result)){
    $albums[] = $row;
  }
}else{
  die("QUERY ERROR: " . mysqli_error($conn));
}

if(count($albums) == 0){
  echo "
  <h2 style='
    text-align:center;
    margin-top:120px;
    color:white;
    font-family:Arial;
  '>
  </h2>";
  exit;
}
$chunks = array_chunk($albums, 6);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>BTS | Discography</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<link rel="stylesheet" href="disss.css">

</head>

<body>

<header class="header">

  <a href="index.php" class="logo">
    <img src="img/logo.png" alt="BTS Logo">
  </a>

  <button id="menuBtn" class="menu-btn">
    ☰
  </button>

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

  <div class="copyright">
    © HYBE Co., Ltd. ALL RIGHTS RESERVED.
  </div>

</div>

<div class="page-label">

  <span class="num">03</span>

  <div class="line"></div>

  <span class="text">DISCOGRAPHY</span>

</div>

<div class="socials-main">
  <a href="https://www.instagram.com/bts.bighitofficial/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
  <a href="https://twitter.com/bts_twt" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
  <a href="https://www.facebook.com/bangtan.official" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
  <a href="https://www.youtube.com/@BANGTANTV" target="_blank"><i class="fa-brands fa-youtube"></i></a>
</div>

<h1 class="section-title">
  DISCOGRAPHY
</h1>

<section class="discography-slider">

<div class="slider-wrapper">

<div class="slider-window">

<div class="slider-track" id="sliderTrack">

<?php foreach($chunks as $chunk){ ?>

<div class="slide">

<?php foreach($chunk as $a){ ?>

<a
class="album-card"
href="<?php echo !empty($a['spotify_link']) ? htmlspecialchars($a['spotify_link']) : '#'; ?>"
target="_blank"
>

<img
src="album/<?php echo !empty($a['cover_image']) ? htmlspecialchars($a['cover_image']) : 'default.jpg'; ?>"
alt="<?php echo htmlspecialchars($a['title']); ?>"
>

<div class="info">

<h4>
<?php echo htmlspecialchars($a['title']); ?>
</h4>

<span>
<?php echo htmlspecialchars($a['release_year']); ?>
</span>

</div>

</a>

<?php } ?>
</div>
<?php } ?>

</div>
</div>

<div class="slider-nav-bottom">

<button onclick="prevSlide()">‹</button>

<span id="current">1</span>
/
<span id="total"><?php echo count($chunks); ?></span>

<button onclick="nextSlide()">›</button>

</div>
</div>
</section>

<div class="homepage-copyright">
  © HYBE Co., Ltd. ALL RIGHTS RESERVED.
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

let currentSlide = 0;
const track = document.getElementById("sliderTrack");
const slides = document.querySelectorAll(".slide");
const current = document.getElementById("current");
const total = document.getElementById("total");

total.textContent = slides.length;

function updateSlider(){

  track.style.transform =
  `translateX(-${currentSlide * 100}%)`;

  current.textContent = currentSlide + 1;

  document.querySelectorAll(".album-card").forEach(card=>{
    card.classList.remove("animate");
  });

  const albums =
  slides[currentSlide].querySelectorAll(".album-card");

  albums.forEach((a,i)=>{

    setTimeout(()=>{
      a.classList.add("animate");
    }, i * 120);

  });
}

function nextSlide(){

  if(currentSlide < slides.length - 1){
    currentSlide++;
    updateSlider();
  }
}

function prevSlide(){
  if(currentSlide > 0){
    currentSlide--;
    updateSlider();
  }
}
window.onload = () => {
  updateSlider();
};

</script>
</body>
</html>