<?php

@include 'config.php';

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $gender = mysqli_real_escape_string($conn,$_POST['gender']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $phone = mysqli_real_escape_string($conn,$_POST['phone']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    // $user_type = $_POST['user_type'];

    $select = " SELECT * FROM users WHERE email='$email' && password = '$pass' ";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){
        $error[] = 'user already exists!';
    }else{
        if($pass != $cpass){
            $error[] = '*passwords not match';
        }else{
            $insert = "INSERT INTO users(name, gender, email, phone, password) VALUES('$name', '$gender','$email','$phone','$pass')";
            mysqli_query($conn, $insert);
            header('location:success.php');
        }
    }

};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main">
        <form action="" method="post">
            <h3>register now</h3>
            
            <input type="text" name="name" required placeholder="enter your name">

            <div class="form-group">
                <div class="genderHeading">
                    <label for="gender">Gender</label>
                    <div class="gender-inline">
                        <label for="male" class="radio-inline"
                            ><input
                            type="radio"
                            name="gender"
                            value="M"
                            id="male"
                            />Male</label
                        >
                        <label for="female" class="radio-inline"
                            ><input
                            type="radio"
                            name="gender"
                            value="F"
                            id="female"
                            />Female</label
                        >
                        <label for="others" class="radio-inline"
                            ><input
                            type="radio"
                            name="gender"
                            value="O"
                            id="others"
                            />Others</label
                        >
                    </div>
                </div>
              </div>


            <input type="email" name="email" required placeholder="abc@abc.com">
            <input type="tel" name="phone" required placeholder="+91 XXX XXX XXXXX">
            <input type="password" name="password" required placeholder="enter your password">
            <?php
                if(isset($error)){
                    foreach($error as $e){
                        echo '<span class="error-msg">'.$e.' </span>';
                    }
                }
            ?>
            <input type="password" name="cpassword" required placeholder="confirm your password">
            <input type="submit" name="submit" value="register" class="form-btn">
            <?php
                if(!inset($error)){
                    echo '<span class="pass-msg">'."SUCCESSFUL".'</span>';
                }
            ?>
        </form>
    </div>
</body>
</html>