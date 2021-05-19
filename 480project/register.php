<?php
include "connectdb.php";
session_start();
$valid_number="";
    $match_password="";
   if(isset($_POST['register'])) {
       $username = $_POST['username'];
       $userphone = $_POST['userphone'];
       $userpassword = $_POST['userpassword'];
       $userconfirmpassword = $_POST['userconfirmpassword'];
       $userrole = "user";
       if(preg_match("/^(\+){1}[0-9]{13}$/", $userphone)) {
           if($userpassword == $userconfirmpassword) {
               $sql = "select * from user where userphone='$userphone'";
               $result = mysqli_query($conn, $sql);
               if(mysqli_num_rows($result) > 0) {
                    $valid_number = "phone no. already exists.";
               } else {
                $sql = "insert into user(username, userphone,userpassword, userrole) values('$username', '$userphone', '$userpassword', '$userrole')";
                if(mysqli_query($conn, $sql)) {
                   echo "Table of " .$username." ". $userphone." ". $userpassword . " created";
                    $_SESSION['registration'] = "Registration Successful ..";
                    header("location:index.php");
                }
                
               }
               
           } else {
               $match_password = "Password Does not match";
           }
       } else {
           $valid_number= "Invalid Number";
       }
  
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <title>register | DAS</title>
  </head>
  <body style="background-color: #0ec9aa;">
    
    <div class="form">
    <h1 class="registrationheader">DOCTOR APPOINTMENT SYSTEM</h1>
    <form action="" method="post">
    <div class="form-floating mb-3">
      <input type="text" class="form-control" id="floatingInput" name="username" placeholder="username" required>
      <label for="floatingInput">username </label>
    </div>
    <div class="form-floating">
      <input type="text" class="form-control" id="floatingInput" name="userphone" placeholder="phonenumber" required>
      <label for="floatingInput">Phone Number </label>
    </div>
    <div class="error">
        <p style="color: red; padding:0;">
        <?php
             echo $valid_number;
            
        ?>
        </p>
    </div>
    <div class="form-floating mb-3">
      <input type="password" class="form-control" id="floatingPassword" name="userpassword" placeholder="Password" required>
      <label for="floatingPassword">Password</label>
    </div>
     <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" name="userconfirmpassword" placeholder="Password" required>
      <label for="floatingPassword">Confirm Password</label>
    </div>
    <div class="error">
        <p style="color: red; padding:0;">
        <?php
            echo $match_password;
        ?>
        </p>
    </div>
    <center>
    <input type="submit" style="margin: 0.3rem; margin-top:0rem;" class="btn btn-success btn-lg" name="register" value="register">
    </center>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

  </body>
</html>