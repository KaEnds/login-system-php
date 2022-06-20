<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>

<body>




    <?php include('server.php') ?>
    <?php
    session_start();

    $ERR = '';

    $username = $password = '';
    $Tusername = array();
    $Tpassword = array();
    $sql = "SELECT username, password FROM formuser";

    $result = mysqli_query($conn, $sql);


    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($Tusername, $row['username']);
            array_push($Tpassword, $row['password']);
        }
    } else {
        echo "0 results";
    }


    if (isset($_POST['user-login'])) {
        $username = $_POST['name'];
        $password = $_POST['password'];
        $isworng = false;

        $Dpassword = md5($password);


        for ($i = 0; $i <= count($Tusername) - 1; $i++) {
            if ($username == $Tusername[$i] and $Dpassword == $Tpassword[$i]) {
                $isworng = false;
                $_SESSION["accountname"] = $username;
                header('location: Homepage.php');
            } else {
                $isworng = true;
            }
        }

        if ($isworng) {
            $ERR = 'this username or password does not exist';
        }
    }

    ?>
    <div class="login">
        <h1>login</h1>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <label for="name">Name :</label>
            <input type="text" name='name'><br>
            <label for="password">Password :</label>
            <input type="password" name='password'><br>
            <p class="ERR"><?php echo $ERR; ?></p>
            <input type="submit" name='user-login' class="submit">
            <p>Are you new member? <a href="registerform.php">Sign in</a></p>
        </form>
    </div>
</body>

</html>