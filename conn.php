<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "bts_website_db"
);

if(!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}

?>