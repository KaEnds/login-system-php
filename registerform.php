<?php include("server.php")?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="register.css">
</head>

<body>
    <?php

    session_start();

    $nameErr = $emailErr = $genderErr = $websiteErr = $passwordErr = "";
    $name = $email = $gender = $comment = $website = $password = "";
    $Emname = empty($_POST["name"]);
    $Empassword = empty($_POST['password']);
    $Ememail = empty($_POST["email"]);
    $Emgender = empty($_POST["gender"]);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($Emname) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
        }

        if ($Ememail) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
        }

        if (empty($_POST["website"])) {
            $websiteErr = "";
        } else {
            $website = test_input($_POST["website"]);
        }

        if (empty($_POST["comment"])) {
            $comment = "";
        } else {
            $comment = test_input($_POST["comment"]);
        }

        if ($Emgender) {
            $genderErr = "Gender is required";
        } else {
            $gender = test_input($_POST["gender"]);
        }

        if ($Empassword) {
            $passwordErr = "Password is required";
        } else {
            $password = test_input($_POST['password']);
        }
    }


    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    ?>


    <div class="register">
        <h1>register</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label>Name :</label>
            <input type="text" name='name'><span class='err'><?php echo $nameErr ?></span><br>
            <label>Password :</label>
            <input type="password" name="password"><span class='err'><?php echo $passwordErr ?></span><br>
            <label>E-mail :</label>
            <input type="text" name='email'><span class='err'><?php echo $emailErr ?></span><br>
            <label>Gender :</label>
            <div class="radio-input">
                <input type="radio" name='gender' value='female'>Female
                <input type="radio" name='gender' value='male'>Male
                <input type="radio" name='gender' value='other'>Other
            </div>
            <span class='err'><?php echo $genderErr ?></span><br>
            <input type="submit" name='user_submit'>
            <p>if you have accout go to <a href="login.php">log in</a></p>
        </form>

    </div>


    <?php

    $cipher = md5($password);

    $sql = "INSERT INTO formuser (username, email, comments, gender, website, password) VALUES ('$name', '$email', '$comment', '$gender', '$website', '$cipher')";



    if (isset($_POST['user_submit']) and !$Ememail and !$Emname and !$Empassword and !$Emgender) {
        if (mysqli_query($conn, $sql)) {
            $last_id = mysqli_insert_id($conn);
            echo 'New record created successfully. Last id is ' . $last_id;
            $_SESSION['accountname'] = $name;
            header("location: Homepage.php");
        } else {
            echo 'Error' . $sql . '<br>' . mysqli_error($conn);
        }
    }



    ?>

</body>

</html>