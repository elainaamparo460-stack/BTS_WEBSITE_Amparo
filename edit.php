<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

include "conn.php";

$type = $_GET['type'] ?? '';
$id   = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$error = "";

/* ALLOWED TYPES */
$types = ['members','albums','videos','tinytan','accounts','member_album'];

if(!in_array($type, $types) || $id < 1){
    header("Location: dashboard.php");
    exit();
}

/* CONFIG */
$config = [

    'members' => [
        'title' => 'EDIT MEMBER',
        'icon'  => 'fa-user-pen',
        'table' => 'members',
        'pk'    => 'id',
        'back'  => 'members',

        'fields' => [
            ['name'=>'stage_name','label'=>'Stage Name','type'=>'text','req'=>true],
            ['name'=>'real_name','label'=>'Real Name','type'=>'text','req'=>true],
            ['name'=>'position','label'=>'Position','type'=>'text','req'=>true],
            ['name'=>'birthday','label'=>'Birthday','type'=>'date','req'=>false],
            ['name'=>'image','label'=>'Member Image','type'=>'file','req'=>false],
        ]
    ],

    'albums' => [
        'title' => 'EDIT ALBUM',
        'icon'  => 'fa-compact-disc',
        'table' => 'albums',
        'pk'    => 'album_id',
        'back'  => 'discography',

        'fields' => [
            ['name'=>'title','label'=>'Album Title','type'=>'text','req'=>true],
            ['name'=>'release_year','label'=>'Release Year','type'=>'number','req'=>true],
            ['name'=>'spotify_link','label'=>'Spotify Link','type'=>'text','req'=>false],
            ['name'=>'cover_image','label'=>'Cover Image','type'=>'file','req'=>false],
        ]
    ],

    'videos' => [
        'title' => 'EDIT VIDEO',
        'icon'  => 'fa-film',
        'table' => 'videos',
        'pk'    => 'id',
        'back'  => 'videos',

        'fields' => [
            ['name'=>'title','label'=>'Video Title','type'=>'text','req'=>true],
            ['name'=>'youtube_url','label'=>'YouTube URL','type'=>'text','req'=>true],
            ['name'=>'category','label'=>'Category','type'=>'text','req'=>true],
            ['name'=>'year','label'=>'Year','type'=>'number','req'=>true],
        ]
    ],

    'tinytan' => [
        'title' => 'EDIT TINYTAN',
        'icon'  => 'fa-star',
        'table' => 'tinytan',
        'pk'    => 'id',
        'back'  => 'tinytan',

        'fields' => [
            ['name'=>'character_name','label'=>'Character Name','type'=>'text','req'=>true],
            ['name'=>'description','label'=>'Description','type'=>'text','req'=>true],
            ['name'=>'image','label'=>'Character Image','type'=>'file','req'=>false],
        ]
    ],

    'accounts' => [
        'title' => 'EDIT ACCOUNT',
        'icon'  => 'fa-user-shield',
        'table' => 'users',
        'pk'    => 'id',
        'back'  => 'accounts',

        'fields' => [
            ['name'=>'username','label'=>'Username','type'=>'text','req'=>true],
            ['name'=>'fname','label'=>'First Name','type'=>'text','req'=>true],
            ['name'=>'mname','label'=>'Middle Name','type'=>'text','req'=>false],
            ['name'=>'lname','label'=>'Last Name','type'=>'text','req'=>true],
            ['name'=>'password','label'=>'Password (leave blank if no change)','type'=>'password','req'=>false],
        ]
    ],

    'member_album' => [
        'title' => 'EDIT MEMBER ALBUM',
        'icon'  => 'fa-images',
        'table' => 'member_album',
        'pk'    => 'album_id',
        'back'  => 'member_album',

        'fields' => [
            ['name'=>'description','label'=>'Description','type'=>'text','req'=>true],
            ['name'=>'image','label'=>'Album Image','type'=>'file','req'=>false],
        ]
    ],
];

$c  = $config[$type];
$pk = $c['pk'];

/* FETCH RECORD */
$res = mysqli_query(
    $conn,
    "SELECT * FROM {$c['table']} WHERE $pk=$id"
);

if(!$res || mysqli_num_rows($res) == 0){
    header("Location: dashboard.php?page={$c['back']}");
    exit();
}

$row = mysqli_fetch_assoc($res);

/* UPDATE */
if(isset($_POST['save'])){

    $sets = [];

    foreach($c['fields'] as $f){

        $name = $f['name'];

        /* FILE */
        if($f['type'] == 'file'){

            if(isset($_FILES[$name]) && $_FILES[$name]['name'] != ''){

                $ext = pathinfo(
                    $_FILES[$name]['name'],
                    PATHINFO_EXTENSION
                );

                $filename =
                time()."_".rand(1000,9999).".".$ext;

                $tmp = $_FILES[$name]['tmp_name'];

                /* FOLDER */
                if($type == "albums"){
                    $folder = "album/";
                }
                elseif($type == "member_album"){
                    $folder = "album/";
                }
                else{
                    $folder = "img/";
                }

                if(!is_dir($folder)){
                    mkdir($folder, 0777, true);
                }

                move_uploaded_file(
                    $tmp,
                    $folder.$filename
                );

                $sets[] = "$name='$filename'";
            }

        } else {

            $val = trim($_POST[$name] ?? '');

            if($f['req'] && $val == ''){
                $error = "Please fill in required fields.";
                break;
            }

            /* PASSWORD */
            if($type == "accounts" && $name == "password"){

                if($val != ''){

                    $val = password_hash(
                        $val,
                        PASSWORD_DEFAULT
                    );

                    $sets[] = "$name='$val'";
                }

            } else {

                $val = mysqli_real_escape_string(
                    $conn,
                    $val
                );

                $sets[] = "$name='$val'";
            }
        }
    }

    /* UPDATE QUERY */
    if(empty($error)){

        $sql = "UPDATE {$c['table']}
                SET ".implode(",", $sets)."
                WHERE $pk=$id";

        if(mysqli_query($conn, $sql)){

            header(
                "Location: dashboard.php?page={$c['back']}&msg=Updated Successfully"
            );

            exit();

        } else {

            $error = mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>
<?php echo $c['title']; ?>
</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="edit.css">
</head>

<body>

<div class="wrap">

<a href="dashboard.php?page=<?php echo $c['back']; ?>"
class="back-btn">

    <i class="fa-solid fa-arrow-left"></i>
    Back

</a>

<div class="form-card">

<h3>

    <i class="fa-solid <?php echo $c['icon']; ?>"></i>

    <?php echo $c['title']; ?>

</h3>

<?php if($error): ?>

<div class="error">
    <?php echo $error; ?>
</div>

<?php endif; ?>

<form method="POST"
enctype="multipart/form-data">

<?php foreach($c['fields'] as $f): ?>

<label>

    <?php echo $f['label']; ?>

</label>

<?php if($f['type'] == 'file'): ?>

    <?php
    if(!empty($row[$f['name']])){

        $folder =
        ($type == "albums" || $type == "member_album")
        ? "album/"
        : "img/";
    ?>

    <img
    src="<?php echo $folder . $row[$f['name']]; ?>"
    class="preview">

    <?php } ?>

    <input
    type="file"
    name="<?php echo $f['name']; ?>"
    class="form-control">

<?php else: ?>

    <input
    type="<?php echo $f['type']; ?>"
    name="<?php echo $f['name']; ?>"
    class="form-control"
    value="<?php echo htmlspecialchars($row[$f['name']] ?? ''); ?>"
    <?php echo ($f['req'] ? 'required' : ''); ?>>

<?php endif; ?>

<?php endforeach; ?>

<button
type="submit"
name="save"
class="btn-save">

<i class="fa-solid fa-floppy-disk"></i>

UPDATE

</button>

</form>

</div>

</div>

</body>
</html>