<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

include "conn.php";

$type  = $_GET['type'] ?? '';
$error = "";

/* ALLOWED TYPES */
$types = ['members','albums','videos','tinytan','accounts','member_album'];

if(!in_array($type, $types)){
    header("Location: dashboard.php");
    exit();
}
$config = [

    'members' => [
        'title' => 'ADD MEMBER',
        'icon'  => 'fa-user-plus',
        'table' => 'members',
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
        'title' => 'ADD ALBUM',
        'icon'  => 'fa-compact-disc',
        'table' => 'albums',
        'back'  => 'discography',

        'fields' => [

            ['name'=>'title','label'=>'Album Title','type'=>'text','req'=>true],
            ['name'=>'release_year','label'=>'Release Year','type'=>'number','req'=>true],
            ['name'=>'spotify_link','label'=>'Spotify Link','type'=>'text','req'=>false],
            ['name'=>'cover_image','label'=>'Cover Image','type'=>'file','req'=>false],
        ]
    ],
    'videos' => [
        'title' => 'ADD VIDEO',
        'icon'  => 'fa-film',
        'table' => 'videos',
        'back'  => 'videos',

        'fields' => [
            ['name'=>'title','label'=>'Video Title','type'=>'text','req'=>true],
            ['name'=>'youtube_url','label'=>'YouTube URL','type'=>'text','req'=>true],
            ['name'=>'category','label'=>'Category','type'=>'text','req'=>true],
            ['name'=>'year','label'=>'Year','type'=>'number','req'=>true],
        ]
    ],
    'tinytan' => [
        'title' => 'ADD TINYTAN',
        'icon'  => 'fa-star',
        'table' => 'tinytan',
        'back'  => 'tinytan',

        'fields' => [
            ['name'=>'character_name','label'=>'Character Name','type'=>'text','req'=>true],
            ['name'=>'description','label'=>'Description','type'=>'text','req'=>true],
            ['name'=>'image','label'=>'Character Image','type'=>'file','req'=>false],
        ]
    ],
    'accounts' => [
        'title' => 'ADD ACCOUNT',
        'icon'  => 'fa-user-shield',
        'table' => 'users',
        'back'  => 'accounts',

        'fields' => [

            ['name'=>'username','label'=>'Username','type'=>'text','req'=>true],
            ['name'=>'fname','label'=>'First Name','type'=>'text','req'=>true],
            ['name'=>'mname','label'=>'Middle Name','type'=>'text','req'=>false],
            ['name'=>'lname','label'=>'Last Name','type'=>'text','req'=>true],
            ['name'=>'password','label'=>'Password','type'=>'password','req'=>true],
        ]
    ],

    
    'member_album' => [
        'title' => 'ADD MEMBER PHOTO',
        'icon'  => 'fa-images',
        'table' => 'member_album',
        'back'  => 'dashboard',

        'fields' => [
            ['name'=>'image','label'=>'Album Image','type'=>'file','req'=>true],
        ]
    ]

];

$c = $config[$type];

if(isset($_POST['save'])){

    $cols = [];
    $vals = [];

    foreach($c['fields'] as $f){

        $fieldName = $f['name'];

        $val = "";    
        if($f['type'] == 'file'){

            if(
                isset($_FILES[$fieldName]) &&
                $_FILES[$fieldName]['name'] != ''
            ){

                $ext = pathinfo(
                    $_FILES[$fieldName]['name'],
                    PATHINFO_EXTENSION
                );

                $filename =
                time() . "_" .
                rand(1000,9999) .
                "." . $ext;

                $tmp =
                $_FILES[$fieldName]['tmp_name'];

                /* SAVE TO ALBUM FOLDER */
                if(
                    $type == "albums" ||
                    $type == "member_album"
                ){

                    if(!is_dir("album")){
                        mkdir("album");
                    }

                    move_uploaded_file(
                        $tmp,
                        "album/" . $filename
                    );

                } else {

                    if(!is_dir("img")){
                        mkdir("img");
                    }

                    move_uploaded_file(
                        $tmp,
                        "img/" . $filename
                    );
                }

                $val = $filename;

            } else {

                $val = "default.jpg";
            }

        } else {

            $val = trim(
                $_POST[$fieldName] ?? ''
            );

            
            if($f['req'] && $val == ''){

                $error =
                "Please fill in all required fields.";

                break;
            }

            /* PASSWORD HASH */
            if(
                $type == "accounts" &&
                $fieldName == "password"
            ){

                $val = password_hash(
                    $val,
                    PASSWORD_DEFAULT
                );
            }

            $val =
            mysqli_real_escape_string(
                $conn,
                $val
            );
        }

        $cols[] = $fieldName;

        $vals[] = "'$val'";
    }

    /* INSERT */
    if(empty($error)){

        $sql =
        "INSERT INTO {$c['table']}
        (" . implode(",", $cols) . ")
        VALUES
        (" . implode(",", $vals) . ")";

        if(mysqli_query($conn, $sql)){

            header(
                "Location: dashboard.php?page={$c['back']}&msg=Added Successfully"
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
<link rel="stylesheet" href="add.css">

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

                    <?php if($f['req']): ?>

                        <span style="color:red">*</span>

                    <?php endif; ?>

                </label>
                <input
                    type="<?php echo $f['type']; ?>"
                    name="<?php echo $f['name']; ?>"
                    class="form-control"
                    <?php echo $f['req'] ? 'required' : ''; ?>
                >
            <?php endforeach; ?>

            <button
                type="submit"
                name="save"
                class="btn-save"
            >

                <i class="fa-solid fa-floppy-disk"></i>

                SAVE

            </button>

        </form>

    </div>

</div>

</body>
</html>