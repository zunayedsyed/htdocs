<?php 

session_start();
if($_SESSION['userphone'] == "") {
    header("location: index.php");
}
if($_SESSION['userrole'] == "admin") {
    include_once "header.php";
} else if($_SESSION['userrole'] == "user") {
    include_once "headeruser.php";
}
?>
<div class="row">
    <div class="col-md-6">
        <div class="header">Welcome <b> <?php echo $_SESSION['username']; ?>! </b> Have a nice day.</div>
    </div>
    <div class="col-md-3">
        <div class="header2"><p> <?php echo $_SESSION['username'];?> </p>.</div>
    </div>
    <div class=" col-md-3">
        <a href="logout.php" class="btn btn-danger">Sign out</a>
    </div>
</div>
<div class="info">
    <div></div>
</div>
<?php 
include_once "footer.php";
?>