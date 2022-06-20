<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <style>
        
    </style>

    <?php
    session_start();

    if (!isset($_SESSION['accountname'])) {
        header('location: login.php');
    }

    if (isset($_GET['logout'])) {
        session_destroy();
    }
    ?>
    <nav class="show-user">
        <div class='user'>
            USER: <?php echo $_SESSION["accountname"]; ?>
        </div>
        <div class='logout'>
            <button><a href="Homepage.php?logout=1">logout</a></button>

        </div>
    </nav>
    <div class="header">
        <h1>Homepage php form</h1>
        <h2>welcome <?php echo $_SESSION['accountname']; ?></h2>
        <img src="https://cdn-icons-png.flaticon.com/512/785/785116.png" alt="fire">
    </div>
</body>

</html>