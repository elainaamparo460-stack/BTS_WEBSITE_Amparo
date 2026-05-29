<?php
session_start();
include "conn.php";

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

$key = trim($_POST['key'] ?? '');

if($key == ''){
    header("Location: dashboard.php");
    exit();
}

$key = mysqli_real_escape_string($conn, $key);
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Search Results</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="search.css">


</head>
<body>

<div class="container-box">

<div class="top">

    <h2>
        Search Results for
        <span>"<?php echo htmlspecialchars($key); ?>"</span>
    </h2>

    <a href="dashboard.php" class="back-btn">
        <i class="fa-solid fa-arrow-left"></i>
        BACK TO DASHBOARD
    </a>

</div>

<?php
$found = false;

    /* MEMBERS */
    $members = mysqli_query($conn,"
    SELECT * FROM members
    WHERE
    stage_name LIKE '%$key%'
    OR real_name LIKE '%$key%'
    OR position LIKE '%$key%'
    ");

    if($members && mysqli_num_rows($members) > 0):

    $found = true;
    ?>

    <div class="card-box">

    <div class="card-title">
        <i class="fa-solid fa-users"></i>
        MEMBERS
    </div>

    <div class="table-responsive">

    <table class="table align-middle">

    <tr>
    <th>Stage Name</th>
    <th>Real Name</th>
    <th>Position</th>
    <th>Action</th>
    </tr>

    <?php while($m = mysqli_fetch_assoc($members)): ?>

    <tr>

    <td><b><?php echo htmlspecialchars($m['stage_name']); ?></b></td>

    <td><?php echo htmlspecialchars($m['real_name']); ?></td>

    <td><?php echo htmlspecialchars($m['position']); ?></td>

    <td>
    <a href="edit.php?type=members&id=<?php echo $m['id']; ?>"
    class="action-btn edit-btn">
    <i class="fa-solid fa-pen"></i>
    </a>
    </td>

    </tr>

    <?php endwhile; ?>
    </table>
    </div>
    </div>

    <?php endif; ?>

    <?php
    /* ALBUMS */
    $albums = mysqli_query($conn,"
    SELECT * FROM albums
    WHERE
    title LIKE '%$key%'
    OR release_year LIKE '%$key%'
    ");

    if($albums && mysqli_num_rows($albums) > 0):

    $found = true;
    ?>

    <div class="card-box">

    <div class="card-title">
        <i class="fa-solid fa-compact-disc"></i>
        ALBUMS
    </div>

    <div class="table-responsive">

    <table class="table align-middle">

    <tr>
    <th>Title</th>
    <th>Year</th>
    <th>Action</th>
    </tr>

    <?php while($a = mysqli_fetch_assoc($albums)): ?>

    <tr>

    <td><b><?php echo htmlspecialchars($a['title']); ?></b></td>

    <td><?php echo htmlspecialchars($a['release_year']); ?></td>

    <td>
    <a href="edit.php?type=albums&id=<?php echo $a['album_id']; ?>"
    class="action-btn edit-btn">
    <i class="fa-solid fa-pen"></i>
    </a>
    </td>

    </tr>

    <?php endwhile; ?>

    </table>

    </div>

    </div>

    <?php endif; ?>

    <?php
    /* VIDEOS */
    $videos = mysqli_query($conn,"
    SELECT * FROM videos WHERE title LIKE '%$key%' OR category LIKE '%$key%'");

    if($videos && mysqli_num_rows($videos) > 0):

    $found = true;
    ?>

    <div class="card-box">

    <div class="card-title">
        <i class="fa-solid fa-film"></i>
        VIDEOS
    </div>

    <div class="table-responsive">

    <table class="table align-middle">

    <tr>
    <th>Title</th>
    <th>Category</th>
    <th>Year</th>
    <th>Action</th>
    </tr>

    <?php while($v = mysqli_fetch_assoc($videos)): ?>

    <tr>

    <td><b><?php echo htmlspecialchars($v['title']); ?></b></td>

    <td><?php echo htmlspecialchars($v['category']); ?></td>

    <td><?php echo htmlspecialchars($v['year']); ?></td>

    <td>
    <a href="edit.php?type=videos&id=<?php echo $v['id']; ?>"
    class="action-btn edit-btn">
    <i class="fa-solid fa-pen"></i>
    </a>
    </td>

    </tr>

    <?php endwhile; ?>

    </table>

    </div>

    </div>

    <?php endif; ?>

    <?php
    /* TINYTAN */
    $tinytan = mysqli_query($conn,"
    SELECT * FROM tinytan
    WHERE character_name LIKE '%$key%'
    ");

    if($tinytan && mysqli_num_rows($tinytan) > 0):

    $found = true;
    ?>

    <div class="card-box">

    <div class="card-title">
        <i class="fa-solid fa-star"></i>
        TINYTAN
    </div>

    <div class="table-responsive">

    <table class="table align-middle">

    <tr>
    <th>Character</th>
    <th>Action</th>
    </tr>

    <?php while($t = mysqli_fetch_assoc($tinytan)): ?>

    <tr>

    <td><b><?php echo htmlspecialchars($t['character_name']); ?></b></td>

    <td>
    <a href="edit.php?type=tinytan&id=<?php echo $t['id']; ?>"
    class="action-btn edit-btn">
    <i class="fa-solid fa-pen"></i>
    </a>
    </td>

    </tr>

    <?php endwhile; ?>

    </table>

    </div>

    </div>

    <?php endif; ?>

    <?php
    /* USERS */
    $users = mysqli_query($conn,"
    SELECT * FROM users
    WHERE
    username LIKE '%$key%'
    OR fname LIKE '%$key%'
    OR lname LIKE '%$key%'
    ");

    if($users && mysqli_num_rows($users) > 0):

    $found = true;
    ?>

    <div class="card-box">

    <div class="card-title">
        <i class="fa-solid fa-user-shield"></i>
        ACCOUNTS
    </div>

    <div class="table-responsive">

    <table class="table align-middle">

    <tr>
    <th>Username</th>
    <th>Name</th>
    </tr>

    <?php while($u = mysqli_fetch_assoc($users)): ?>

    <tr>

    <td><b><?php echo htmlspecialchars($u['username']); ?></b></td>

    <td>
    <?php
    echo htmlspecialchars(
    trim($u['fname'].' '.$u['lname'])
    );
    ?>
    </td>

    </tr>

    <?php endwhile; ?>

    </table>

    </div>

    </div>

    <?php endif; ?>

    <?php if(!$found): ?>

    <div class="card-box empty-box">

    <i class="fa-solid fa-magnifying-glass"></i>

    <h3>No Results Found</h3>

    <p>
    No matching records for
    "<b><?php echo htmlspecialchars($key); ?></b>"
    </p>

    </div>

    <?php endif; ?>

    </div>

    </body>
    </html>