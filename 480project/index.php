<?php 
include "connectdb.php";
session_start();
if(isset($_POST['register'])) {
    header('location:register.php');
}
$log = "";
if(isset($_POST['login'])) {
    $userphone = $_POST['userphone'];
    $userpassword = $_POST['userpassword'];
    $sql = "select * from user where userphone='$userphone' and userpassword='$userpassword'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if($row['userphone']==$userphone AND $row['userpassword']==$userpassword AND $row['userrole']=='admin') {
        $_SESSION['flag'] =0;
        $_SESSION['userid'] = $row['userid'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['userphone'] = $row['userphone'];
        $_SESSION['userrole'] = $row['userrole'];
        header('refresh:1;dashboard.php');
    } else if($row['userphone']==$userphone AND $row['userpassword']==$userpassword AND $row['userrole']=='user') {
            $_SESSION['flag'] =0;
        $_SESSION['userid'] = $row['userid'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['userphone'] = $row['userphone'];
        $_SESSION['userrole'] = $row['userrole'];
        header('refresh:1;dashboard.php');
    }
    } else {
        $log = "Wrong userphone or password";
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
    <title>login | DAS</title>
  </head>
  <body style="background-color: #0ec9aa;">
    
    <div class="form">
    <div class="group">
       <?php if(isset($_SESSION['registration'])) { ?>
        <div class="success" style="background-color: darkgreen; color: white; padding: 0.5rem; margin-bottom: 0.5rem; border-radius: 10px;">
            <?php echo $_SESSION['registration']; ?>
        </div>
        <?php } ?>
        <?php 
        unset($_SESSION['registration']);
        ?>
    </div>
    <h1 class="registrationheader">DOCTOR APPOINTMENT SYSTEM</h1>
    <form action="" method="post">
    <div class="form-floating mb-3">
      <input type="text" class="form-control" id="floatingInput" name="userphone" placeholder="phonenumber">
      <label for="floatingInput">Phone no.</label>
    </div>
    <div class="form-floating mb-3">
      <input type="password" class="form-control" id="floatingPassword" name="userpassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>
    <input type="submit" style="margin: 0.3rem; margin-top:0rem;" class="btn btn-success btn-lg" name="login" value="login">
    <input type="submit" style="margin: 0.3rem; margin-top:0rem;" class="btn btn-primary btn-lg" name="register" value="Register!">
    <div class="group">
       <?php if(isset($_POST['login'])) { ?>
        <div class="success" style="background-color: orange; color: white; padding: 0.5rem; margin-bottom: 0.5rem; border-radius: 10px;">
            <?php echo $log; ?>
        </div>
        <?php } ?>
    </div>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

  </body>
</html>