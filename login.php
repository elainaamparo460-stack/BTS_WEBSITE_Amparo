<?php
session_start();
require_once "conn.php";
if(!isset($_SESSION['username']))

$error = "";

if(isset($_POST["login"])){

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = hash('sha256', $_POST['password']);

     $sql = "SELECT * FROM users WHERE username='$username'";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1){

        $row = mysqli_fetch_assoc($result);

        $_SESSION['username'] = $row['username'];
        $_SESSION['fname'] = $row['fname'];
        $_SESSION['lname'] = $row['lname'];
        $_SESSION['mname'] = $row['mname'];

        header("Location: dashboard.php");
        exit();

    }else{
        $error = "Invalid username and/or password.";

    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin Login</title>
<?php include 'css.php'; ?>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link rel="stylesheet" href="login.css">

</head>

<body>

<div class="login-wrapper">

    <div class="login-image">

        <div>

            <h1>
                ADMIN<br>
                PORTAL
            </h1>

            <p>
                Authorized personnel only.
            </p>

        </div>

    </div>


    <div class="login-form">
 <div class="back-link"> <a href="index.php"> <i class="fa-solid fa-arrow-left"></i> Back to Main Page </a> </div>

        <img src="img/logo.png" class="logo">

        <h2>LOGIN</h2>

        <p class="subtitle">
            Welcome back — sign in to continue
        </p>

<?php if(isset($error) && $error != ""): ?> <div class="alert"> <?php echo $error; ?> </div> <?php endif; ?>

    
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

            <button type="submit"
            name="login"
            class="login-btn">

                <i class="fa-solid fa-right-to-bracket"></i>

                LOGIN

            </button>

        </form>

        <div class="register-link">

            No account yet?

            <a href="register.php">
                Register Here
            </a>

        </div>

    </div>

</div>

<?php include 'js.php'; ?>

</body>
</html>
