<?php
include "conn.php";

/* GET VIDEOS */
$result = mysqli_query(
    $conn,
    "SELECT * FROM videos ORDER BY year DESC"
);

$videos = [];

if($result){

    while($row = mysqli_fetch_assoc($result)){

        $videos[] = $row;
    }
}

/* EMPTY */
if(count($videos) == 0){

    echo "
    <h2 style='
        text-align:center;
        margin-top:120px;
        font-family:Arial;
    '>
        No videos found.
    </h2>";

    exit();
}

/* GET YOUTUBE ID FROM URL */
function getYoutubeID($url){

    $patterns = [

        '/youtube\.com\/watch\?v=([^\&\?\/]+)/',
        '/youtu\.be\/([^\&\?\/]+)/',
        '/youtube\.com\/embed\/([^\&\?\/]+)/'

    ];

    foreach($patterns as $pattern){

        if(preg_match($pattern, $url, $matches)){

            return $matches[1];
        }
    }

    return '';
}

/* FIRST VIDEO */
$firstURL = $videos[0]['youtube_url'] ?? '';

$firstID = getYoutubeID($firstURL);
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>BTS | Video</title>

<link rel="stylesheet" href="video.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>

<!-- HEADER -->
<header class="header">

    <a href="index.php" class="logo">

        <img src="img/logo.png" alt="BTS Logo">

    </a>

    <button id="menuBtn" class="menu-btn">
        ☰
    </button>

</header>

<!-- MENU -->
<div class="menu-overlay" id="menu">

    <div class="menu-header">

        <a href="index.php" class="menu-logo">

            <img src="img/logo.png" alt="BTS Logo">

        </a>

        <div id="closeBtn" class="close-btn">
            ×
        </div>

    </div>

    <nav class="menu-links">

        <a href="index.php">HOME</a>

        <a href="profile.php">PROFILE</a>

        <a href="discography.php">DISCOGRAPHY</a>

        <a href="video.php">VIDEO</a>

        <a href="tinytan.php">TINYTAN</a>

    </nav>

    <div class="menu-socials">

        <a href="#">
            <i class="fa-brands fa-instagram"></i>
        </a>

        <a href="#">
            <i class="fa-brands fa-x-twitter"></i>
        </a>

        <a href="#">
            <i class="fa-brands fa-facebook-f"></i>
        </a>

        <a href="#">
            <i class="fa-brands fa-youtube"></i>
        </a>

    </div>

    <div class="copyright">
        © HYBE Co., Ltd. ALL RIGHTS RESERVED.
    </div>

</div>

<!-- PAGE LABEL -->
<div class="page-label">

    <span class="num">04</span>

    <div class="line"></div>

    <span class="text">VIDEO</span>

</div>

<!-- MAIN -->
<main class="video-section">

    <h1>VIDEO</h1>

    <div class="video-wrapper">

        <iframe
            id="mainVideo"
            src="https://www.youtube.com/embed/<?php echo $firstID; ?>"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
        </iframe>

    </div>

</main>

<!-- VIDEO LIST -->
<section class="video-list-container">

    <section class="video-list">

        <div class="slider-window">

            <div class="video-track" id="videoTrack">

                <?php
                $active = true;

                foreach($videos as $v):

                    $youtubeURL = $v['youtube_url'] ?? '';

                    $youtubeID = getYoutubeID($youtubeURL);

                    if(empty($youtubeID)){
                        continue;
                    }
                ?>

                <div
                    class="video-item <?php echo $active ? 'active' : ''; ?>"
                    onclick="changeVideo('<?php echo $youtubeID; ?>', this)"
                >

                    <img
                        src="https://img.youtube.com/vi/<?php echo $youtubeID; ?>/mqdefault.jpg"
                        alt="<?php echo htmlspecialchars($v['title']); ?>"
                    >

                    <div class="video-info">

                        <span>
                            <?php echo htmlspecialchars($v['category']); ?>
                        </span>

                        <span>
                            <?php echo htmlspecialchars($v['year']); ?>
                        </span>

                    </div>

                </div>

                <?php
                $active = false;
                endforeach;
                ?>

            </div>

        </div>

    </section>

    <!-- NAV -->
    <div class="slider-nav-bottom">

        <button onclick="prevSlide()">‹</button>

        <span id="slideCurrent">1</span>

        /

        <span id="slideTotal">
            <?php echo count($videos); ?>
        </span>

        <button onclick="nextSlide()">›</button>

    </div>

</section>

<!-- SOCIAL -->
<div class="socials-main">

    <a href="#">
        <i class="fa-brands fa-instagram"></i>
    </a>

    <a href="#">
        <i class="fa-brands fa-x-twitter"></i>
    </a>

    <a href="#">
        <i class="fa-brands fa-facebook-f"></i>
    </a>

    <a href="#">
        <i class="fa-brands fa-youtube"></i>
    </a>

</div>

<!-- COPYRIGHT -->
<div class="homepage-copyright">
    © HYBE Co., Ltd. ALL RIGHTS RESERVED.
</div>

<script>

/* MENU */
const menu =
document.getElementById("menu");

const menuBtn =
document.getElementById("menuBtn");

const closeBtn =
document.getElementById("closeBtn");

menuBtn.onclick = () => {

    menu.classList.add("open");
};

closeBtn.onclick = () => {

    menu.classList.remove("open");
};

/* CHANGE VIDEO */
function changeVideo(videoId, el){

    const mainVideo =
    document.getElementById("mainVideo");

    mainVideo.src =
    "https://www.youtube.com/embed/" +
    videoId +
    "?autoplay=1";

    document
    .querySelectorAll(".video-item")
    .forEach(item => {

        item.classList.remove("active");
    });

    el.classList.add("active");
}

/* SLIDER */
const track =
document.getElementById("videoTrack");

const items =
document.querySelectorAll(".video-item");

const slideCurrent =
document.getElementById("slideCurrent");

const slideTotal =
document.getElementById("slideTotal");

let slideIndex = 0;

const totalSlides = items.length;

slideTotal.textContent = totalSlides;

/* UPDATE */
function updateSlide(){

    if(items.length > 0){

        const itemWidth =
        items[0].offsetWidth + 32;

        track.style.transform =
        `translateX(-${slideIndex * itemWidth}px)`;

        slideCurrent.textContent =
        slideIndex + 1;
    }
}

/* NEXT */
function nextSlide(){

    if(slideIndex < totalSlides - 1){

        slideIndex++;

        updateSlide();
    }
}

/* PREV */
function prevSlide(){

    if(slideIndex > 0){

        slideIndex--;

        updateSlide();
    }
}

/* RESIZE */
window.addEventListener(
    "resize",
    updateSlide
);

/* INIT */
updateSlide();

</script>

</body>
</html>