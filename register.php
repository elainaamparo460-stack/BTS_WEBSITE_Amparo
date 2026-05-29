
<?php
session_start();
require_once "conn.php";

$error = "";

$tablelogin = "users";

if(isset($_POST["register"])){

    $fname = mysqli_real_escape_string($conn, trim($_POST['fname']));
    $lname = mysqli_real_escape_string($conn, trim($_POST['lname']));
    $mname = mysqli_real_escape_string($conn, trim($_POST['mname']));
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));

    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if(
        empty($fname) ||
        empty($lname) ||
        empty($username) ||
        empty($password) ||
        empty($confirm_password)
    ){

        $error = "Please fill in all required fields.";

    }
    elseif($password != $confirm_password){

        $error = "Passwords do not match.";

    }
    else{

        $check = "SELECT * FROM $tablelogin 
                  WHERE username='$username'";

        $check_result = mysqli_query($conn, $check);

        if(mysqli_num_rows($check_result) > 0){

            $error = "Username already exists.";

        }
        else{

            $hashed_password = hash('sha256', $password);

            $sql = "INSERT INTO $tablelogin
            (username,password,fname,lname,mname)
            VALUES
            ('$username','$hashed_password','$fname','$lname','$mname')";

            if(mysqli_query($conn, $sql)){

                header("Location: login.php");
                exit();

            }else{

                $error = "Registration failed.";

            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Register</title>

<?php include("css.php"); ?>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link rel="stylesheet" href="register.css">

</head>

<body>

<div class="register-wrapper">

    <!-- LEFT -->

    <div class="register-image">

        <div>

            <h1>
                JOIN THE<br>
                UNIVERSE
            </h1>

            <p>
                Create your BTS Universe account today.
            </p>

        </div>

    </div>

    <!-- RIGHT -->

    <div class="register-form">

        <!-- BACK BUTTON -->

        <div class="back-link">

            <a href="index.php">

                <i class="fa-solid fa-arrow-left"></i>

                Back to Main Page

            </a>

        </div>

        <!-- LOGO -->

        <img src="img/logo.png" class="logo">

        <h2>REGISTER</h2>

        <p class="subtitle">
            Create your BTS Universe account
        </p>

        <!-- ERROR -->

        <?php if($error != ""): ?>

            <div class="alert">
                <?php echo $error; ?>
            </div>

        <?php endif; ?>

        <!-- FORM -->

        <form method="POST">

            <div class="form-group">

                <label>Username</label>

                <div class="input-box">

                    <span>
                        <i class="fa-solid fa-user"></i>
                    </span>

                    <input type="text"
                    name="username"
                    placeholder="Enter username"
                    required>

                </div>

            </div>

            <div class="form-group">

                <label>Password</label>

                <div class="input-box">

                    <span>
                        <i class="fa-solid fa-lock"></i>
                    </span>

                    <input type="password"
                    name="password"
                    placeholder="Enter password"
                    required>

                </div>

            </div>

            <div class="form-group">

                <label>Confirm Password</label>

                <div class="input-box">

                    <span>
                        <i class="fa-solid fa-lock"></i>
                    </span>

                    <input type="password"
                    name="confirm_password"
                    placeholder="Confirm password"
                    required>

                </div>

            </div>

            <div class="name-row">

                <div class="form-group">

                    <label>First Name</label>

                    <div class="input-box">

                        <span>
                            <i class="fa-solid fa-id-card"></i>
                        </span>

                        <input type="text"
                        name="fname"
                        placeholder="First name"
                        required>

                    </div>

                </div>

                <div class="form-group">

                    <label>Middle Name</label>

                    <div class="input-box">

                        <span>
                            <i class="fa-solid fa-id-card"></i>
                        </span>

                        <input type="text"
                        name="mname"
                        placeholder="Middle name">

                    </div>

                </div>

            </div>

            <div class="form-group">

                <label>Last Name</label>

                <div class="input-box">

                    <span>
                        <i class="fa-solid fa-id-card"></i>
                    </span>

                    <input type="text"
                    name="lname"
                    placeholder="Last name"
                    required>

                </div>

            </div>

            <button type="submit"
            name="register"
            class="register-btn">

                <i class="fa-solid fa-user-plus"></i>

                CREATE ACCOUNT

            </button>

        </form>

        <div class="login-link">

            Already have an account?

            <a href="login.php">
                Login Here
            </a>

        </div>

    </div>

</div>

<?php include("js.php"); ?>

</body>
</html>

