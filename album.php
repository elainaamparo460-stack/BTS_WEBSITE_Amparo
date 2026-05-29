<?php
include "conn.php";

$result = mysqli_query($conn, "SELECT * FROM member_album ORDER BY album_id DESC");

$albums = [];

if($result){
    while($row = mysqli_fetch_assoc($result)){
        $albums[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BTS Members Album</title>

<link rel="stylesheet" href="album.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>

<header class="top-header">

    <a href="profile.php" class="back-btn">
        <i class="fa-solid fa-arrow-left"></i> BACK
    </a>

    <div class="title-wrap">
        <h1>BTS MEMBERS ALBUM</h1>
        <p>Moments of BTS</p>
    </div>

</header>

<div class="album-container">

<?php if(count($albums) > 0){ ?>

    <?php foreach($albums as $a){ ?>

        <div class="album-card">

            <div class="album-img">
                <img src="album/<?php echo htmlspecialchars($a['image']); ?>">
            </div>

        </div>

    <?php } ?>

<?php } else { ?>

    <div class="empty-box">
        No album photos yet.
    </div>

<?php } ?>

</div>

<div class="footer">
    © HYBE Co., Ltd. ALL RIGHTS RESERVED.
</div>

</body>
</html>