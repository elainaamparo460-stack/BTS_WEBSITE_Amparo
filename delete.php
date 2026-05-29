<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "conn.php";

$type = $_GET['type'] ?? '';
$id   = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$map = [

    'members' => [
        'table' => 'members',
        'id'    => 'id',
        'back'  => 'members'
    ],

    'albums' => [
        'table' => 'albums',
        'id'    => 'album_id',
        'back'  => 'discography'
    ],

    'discography' => [
        'table' => 'albums',
        'id'    => 'album_id',
        'back'  => 'discography'
    ],

    'videos' => [
        'table' => 'videos',
        'id'    => 'id',
        'back'  => 'videos'
    ],

    'tinytan' => [
        'table' => 'tinytan',
        'id'    => 'id',
        'back'  => 'tinytan'
    ],

     'member_album' => [
        'table' => 'member_album',
        'id'    => 'album_  id',
        'back'  => 'member_album'
        ],

    'accounts' => [
        'table' => 'users',
        'id'    => 'id',
        'back'  => 'accounts'
    ]  

];

if (!isset($map[$type]) || $id < 1) {

    header("Location: dashboard.php");
    exit();
}

$table   = $map[$type]['table'];
$idField = $map[$type]['id'];
$back    = $map[$type]['back'];

$check = mysqli_query(
    $conn,
    "SELECT * FROM `$table` WHERE `$idField`='$id'"
);

if (!$check) {

    die("CHECK ERROR: " . mysqli_error($conn));

}
if (mysqli_num_rows($check) == 0) {

    header(
        "Location: dashboard.php?page=$back&msg=" .
        urlencode("Item not found.")
    );

    exit();
}

$sql = "DELETE FROM `$table` WHERE `$idField`='$id'";

if (mysqli_query($conn, $sql)) {

    header(
        "Location: dashboard.php?page=$back&msg=" .
        urlencode("Deleted successfully.")
    );

    exit();

} else {

    die("DELETE ERROR: " . mysqli_error($conn));
}
?>