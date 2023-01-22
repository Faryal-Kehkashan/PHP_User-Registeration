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
        form{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
    </style>
    <title>Signup</title>
</head>

<body>

    <?php

    $Alert = false;
    $Error = false;
    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit']))
    {
        include'Comp/dbconnect.php';

        $username = $_POST['username'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        // $exists = false;

        // checking if user already exist in our database or not

        $existSql = "SELECT * FROM `users` WHERE username = '$username'";
        $result = mysqli_query($conn, $existSql);
        $numExistRows = mysqli_num_rows($result);

        if($numExistRows > 0)
        {
            $exists = true;
            $Error = " User already exists.";
        }
        else{
            $exists = false;

            // creating account if user does not exist in our database. 

            if($password == $cpassword)
            {
                $sql = "
                INSERT INTO `users` (`username`, `password`, `dt`) 
                VALUES ( '$username', '$password', current_timestamp());
                ";
                $result = mysqli_query($conn, $sql);
                if($result)
                {
                    $Alert = true;
                }
            }
            else
            {
                $Error = " Password do not match.";
            }
        }


    }
    
    ?>

    <!-- adding navbar to the page -->
    <?php require 'Comp/nav.php' ?>


    <!-- showing allert for success and error -->

    <?php
        if($Alert)
        {
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Congratulations!</strong> You have successfully created an account and now you can login.

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


        <!-- HTML code for Signup Form -->

    <div class="container mt-5 mb-5">
        <h2 class="text-center">
            Signup to our website
        </h2>
    </div>

    <div class="container">
        <form id='myform' action="/UMS/signup.php" method="post">
            <div class="mb-3 col-md-6">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
            </div>
            <div class="mb-3 col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3 col-md-6">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword">
                <div id="emailHelp" class="form-text">Make sure you enter the same password.</div>

            </div>

            <button id='signup' type="submit" class="btn btn-primary">Signup</button>
        </form>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {

            var form = $('#myform');
            $('#signup').click(function () {

                $.ajax({
                    url: 'signup.php',
                    type: 'post',
                    data: $("#myform input").serialize(),

                    success: function (data) {
                        console.log(data);
                    }
                });
            });
        });
    </script>

</body>

</html>