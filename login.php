<?php require 'Comp/nav.php' ?>

<?php

    $login = false;
    $Error = false;
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        include'Comp/dbconnect.php';
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "
        Select * from users1.users where username = '$username' AND password = '$password'
        ";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if($num == 1)
        {
            $login = true;
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = "$username";
            header("location: welcome.php");
        }
        else
        {
            $Error = "Invalid Credentials.";
        }

    }

?>

<?php
    if($login)
    {
        echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Congratulations!</strong> You have successfully logged in to your account.

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    }
    if($Error)
    {
        echo '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Sorry!</strong> '.$Error.'

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
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
    <style>
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
    </style>
    <title>Login</title>
</head>

<body>

    <div class="container-fluid mt-5 mb-5" id="cdiv">
        <h2 class="text-center">
            Login to continue.
        </h2>
    </div>

    <div class="conatiner">

        <form id='myform' action="/UMS/login.php" method="post">
            <div class="mb-3 col-md-6">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
            </div>
            <div class="mb-3 col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <button id='login' type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>

    <script type='text/javascript'>

        console.log("Hello Ajax");

        let login = document.getElementById("login");
        login.addEventListener("click", buttonclickHandler);

        function buttonclickHandler() {
        console.log("Clicked");
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "login.php", true);

        xhr.onprogress = function () {
            console.log("On progress");
        };

        xhr.onload = function () {
            if (this.status === 200) {
            console.log(this.responseText);
            } else {
            console.error("some error occured");
            }
        };

        xhr.send();
        }
    </script>


</body>

</html>