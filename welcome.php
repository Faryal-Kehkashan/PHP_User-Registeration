<?php

session_start();

    // checking if user have successfully logged in or not.

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
{
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome -
        <?php echo $_SESSION['username']?>
    </title>
</head>

<body>

    <?php require 'Comp/nav.php' ?>

    <div class="container my-3">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Welcome -
                <?php echo $_SESSION['username']?>
            </h4>
            <p> Greetings
                <?php echo $_SESSION['username']?>! You successfully logged in to User Management System as
                <?php echo $_SESSION['username']?>.
            </p>
            <hr>
            <p class="mb-0">Whenever you need to, be sure to logout using this <a href="logout.php"> Link</a>.</p>
        </div>
    </div>


</body>

</html>