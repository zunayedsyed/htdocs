<?php 
include_once "connectdb.php";
session_start();
if($_SESSION['userphone'] == "") {
    header("location: index.php");
}
if(isset($_POST['id'])){
    echo $_POST['id'];
    $sql = 'delete from appointment where appointmentid='.$_POST['id'];
      if(mysqli_query($conn, $sql)) {
          $_SESSION['flag'] =0;
        }else{
        
            }
}
if($_SESSION['userrole'] == "admin") {
    include_once "header.php";
} else if($_SESSION['userrole'] == "user") {
    include_once "headeruser.php";
}
?>
<div class="row">
    <div class="col-md-6">
        <div class="header"><b> DOCTORS INFORMATION </b> </div>
    </div>
    <div class="col-md-3">
        <div class="header2"><p> <?php echo $_SESSION['username'];?> </p>.</div>
    </div>
    <div class=" col-md-3">
        <a href="logout.php" class="btn btn-danger">Sign out</a>
    </div>
</div>
<form action="" method="post">
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>PATIENT ID</th>
            <th>PATIENT NAME</th>
            <th>DOCTOR ID</th>
            <th>DOCTOR NAME</th>
            <th>DOCTOR SPECIALITY</th>
            <th>SCHEDULE STARTS</th>
            <th>DELETE</th>
        </tr>
    </thead>
    <tbody>
                    <?php 
                        if($_SESSION['userrole'] == 'admin') {
                        $sql = "select * from appointment order by appointmentid desc";
                        $select = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($select)) {
                            echo '
                                <tr>
                                    <td>'.$row['appointmentid'].'</td>
                                    <td>'.$row['userid'].'</td>
                                    <td>'.$row['username'].'</td>
                                    <td>'.$row['doctorid'].'</td>
                                    <td>'.$row['doctorname'].'</td>
                                    <td>'.$row['doctorspeciality'].'</td>
                                    
                                    <td>'.$row['doctorschedulestarts'].'</td>
                                  
                                    <td>
                                        <button type="submit" value="'.$row['appointmentid'].'" class="btn btn-danger" name="id">DELETE</button>
                                    </td>
                                
                                
                                </tr>
                            
                            
                            
                            ';
                        } } else if($_SESSION['userrole'] == 'user') {
                        $userid = $_SESSION['userid'];
                        $sql = "select * from appointment where userid='$userid'";
                        $select = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($select)) {
                            echo '
                                <tr>
                                    <td>'.$row['appointmentid'].'</td>
                                    <td>'.$row['userid'].'</td>
                                    <td>'.$row['username'].'</td>
                                    <td>'.$row['doctorid'].'</td>
                                    <td>'.$row['doctorname'].'</td>
                                    <td>'.$row['doctorspeciality'].'</td>
                                    
                                    <td>'.$row['doctorschedulestarts'].'</td>
                                  
                                    <td>
                                        <button type="submit" value="'.$row['appointmentid'].'" class="btn btn-danger" name="id">DELETE</button>
                                    </td>
                                
                                
                                </tr>
                            
                            
                            
                            ';
                        } }
                    
                    ?>
    </tbody>
</table>
</form>
<?php 
include_once "footer.php";
?>