<?php 
include_once "connectdb.php";
session_start();
if($_SESSION['userphone'] == "") {
    header("location: index.php");
}
error_reporting(0);
if(isset($_POST['make'])) {
    $flag = $_SESSION['flag'];
    if($flag == 0) {
            $doctorid = $_POST['make'];
            $userid= $_SESSION['userid'];
            $sql0= "select * from user where userid='$userid'";
            $select0 = mysqli_query($conn, $sql0);
            $row0 = mysqli_fetch_assoc($select0);
            $username = $row0['username'];
            $sql = "select * from doctor where doctorid='$doctorid'";
            $select = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($select)) {
                $doctorname = $row['doctorname'];
                $doctorspeciality = $row['doctorspeciality'];
                $doctorschedulestarts = $row['doctorschedulestarts'];
                $sql2 = "insert into appointment(userid, username, doctorid, doctorname, doctorspeciality, doctorschedulestarts) values('$userid','$username','$doctorid','$doctorname', '$doctorspeciality', '$doctorschedulestarts')";
                if(mysqli_query($conn, $sql2)) {
                    echo $_SESSION['flag'];
                    $_SESSION['doctorinput'] = "Appointment Successful";
                    $_SESSION['flag'] =1;
                    echo $_SESSION['flag'];
                } else {
                    $_SESSION['doctorinput'] = "Appointment Failed";
                }
                echo $_SESSION['flag'];
            } 
            } else {
                $_SESSION['doctorinput'] = "There is already an appointment";
    }
        
    }


if(isset($_POST['doctorupdate'])) {
    $doctorid = $_POST['doctorid'];
    $doctorname = $_POST['doctorname'];
    $doctorspeciality = $_POST['doctorspeciality'];
    $doctorjoindate = $_POST['doctorjoindate'];
    $doctorschedulestarts = $_POST['doctorschedulestarts'];
    $doctorscheduleends = $_POST['doctorscheduleends'];
    if(!empty($doctorname AND $doctorspeciality AND $doctorjoindate AND $doctorschedulestarts AND $doctorscheduleends)){
        $sql = "update doctor set doctorname='$doctorname', doctorspeciality='$doctorspeciality', doctorjoindate='$doctorjoindate', doctorschedulestarts='$doctorschedulestarts', doctorscheduleends='$doctorscheduleends' where doctorid='$doctorid'";
        if(mysqli_query($conn, $sql)) {
            echo "Table of " .$doctorname." ". $doctorspeciality;
            $_SESSION['doctorinput'] = "Update Successful";
        } else {
            $_SESSION['doctorinput'] = "Update Failed";
        }
    } else {
        $_SESSION['doctorinput'] = "One or many fields are empty!";
    }
}

if(isset($_POST['id'])){
    echo $_POST['id'];
    $sql = 'delete from doctor where doctorid='.$_POST['id'];
      if(mysqli_query($conn, $sql)) {
            $_SESSION['doctorinput'] = "Deleted Successfully ..";
        }else{
        
            $_SESSION['doctorinput'] = "Deletion Failed ..";
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
<div class="info">
    <form action="" method="post">
    <div class="row">
      <div class="col-md-3">
            <div class="header"><b id="doctorheader"> SEARCH DOCTOR </b></div>
            <div class="group">
                <?php if(isset($_SESSION['doctorinput'])) {
                ?>
                 <div class="success" style="background-color: #f7dd16; color: white; padding: 0.5rem; margin-bottom: 0.5rem; border-radius: 10px;">
                     <?php echo $_SESSION['doctorinput']; ?>
                 </div>
                 <?php }?>
                 <?php 
                    unset($_SESSION['doctorinput']);
                ?>
            </div>
            
       <?php 
            echo '
             <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" name="doctorname" placeholder="doctorname">
              <label for="floatingInput">Doctor Name</label>
            </div>
            <div class="form-floating mb-3">
              <select class="form-select form-control" name="doctorspeciality">
              <option value="" disabled selected>Speciality</option>
              ';
            $sql = "select * from speciality";
            $select = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($select)) {
                echo '
                    <option>'.$row['specialityname'].'</option>
                ';
            }
            echo '
              </select>
              <label for="floatingInput">Speciality</label>
            </div>
           <div class="form-floating mb-3">
                <select class="form-select form-control" name="doctorschedulestarts" id="floatingInput">
              <option disabled selected>Select time</option>
              <option value="7.00">7:00</option>
              <option value="7.30">7:30</option>
              <option value="8.00">8:00</option>
              <option value="8.30">8:30</option>
              </select>
              <label for="floatingInput">Schedule Starts</label>
            </div>
            <div align="center">
                <input type="submit" value="Search" class="btn btn-success" name="doctorsearch">
            </div>
        </div>
        ';
        
        ?>
        <div class="col-md-9">
            <div class="header"><b> DOCTORS LIST </b> </div>
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>DOCTOR NAME</th>
                    <th>SPECIALITY</th>
                    <th>SCHEDULE STARTS</th>
                    <th>APPOINTMENT</th>
                </thead>
                <tbody>
            <?php 
    if(isset($_POST['doctorsearch'])) {
    if(empty($_POST['doctorname'])) {
        $doctorname = "";
        $doctorspeciality = $_POST['doctorspeciality'];
        $doctorschedulestarts = $_POST['doctorschedulestarts'];
        $sql = "select * from doctor where doctorname='$doctorname' or doctorspeciality='$doctorspeciality' or doctorschedulestarts='$doctorschedulestarts'";
        $select=mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($select)) {
                            echo '
                                <tr>
                                    <td>'.$row['doctorid'].'</td>
                                    <td>'.$row['doctorname'].'</td>
                                    <td>'.$row['doctorspeciality'].'</td>
                                    <td>'.$row['doctorschedulestarts'].'</td>
                                    <td>
                                        <button type="submit" value="'.$row['doctorid'].'" class="btn btn-success" name="make">MAKE APPOINTMENT</button>
                                    </td>
                                
                                
                                </tr>
                            
                            
                            
                            ';
                        }
        
    } else if(empty($_POST['doctorspeciality'])) {
        $doctorname = $_POST['doctorname'];
        $doctorspeciality = "";
        $doctorschedulestarts = $_POST['doctorschedulestarts'];
        $sql = "select * from doctor where doctorname='$doctorname' or doctorspeciality='$doctorspeciality' or doctorschedulestarts='$doctorschedulestarts'";
        $select=mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($select)) {
                            echo '
                                <tr>
                                    <td>'.$row['doctorid'].'</td>
                                    <td>'.$row['doctorname'].'</td>
                                    <td>'.$row['doctorspeciality'].'</td>
                                    <td>'.$row['doctorschedulestarts'].'</td>
                                    <td>
                                        <button type="submit" value="'.$row['doctorid'].'" class="btn btn-success" name="make">MAKE APPOINTMENT</button>
                                    </td>
                                
                                
                                </tr>
                            
                            
                            
                            ';
                        }
    } else if(empty($_POST['doctorschedulestarts'])) {
        $doctorname = $_POST['doctorname'];
        $doctorspeciality = $_POST['doctorspeciality'];
        $doctorschedulestarts = "";
        $sql = "select * from doctor where doctorname='$doctorname' or doctorspeciality='$doctorspeciality' or doctorschedulestarts='$doctorschedulestarts'";
        $select=mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($select)) {
                            echo '
                                <tr>
                                    <td>'.$row['doctorid'].'</td>
                                    <td>'.$row['doctorname'].'</td>
                                    <td>'.$row['doctorspeciality'].'</td>
                                    <td>'.$row['doctorschedulestarts'].'</td>
                                    <td>
                                        <button type="submit" value="'.$row['doctorid'].'" class="btn btn-success" name="make">MAKE APPOINTMENT</button>
                                    </td>
                                
                                
                                </tr>
                            
                            
                            
                            ';
                        }
    } else if(empty($_POST['doctorname'] AND $_POST['doctorspeciality'])) {
        $doctorname = "";
        $doctorspeciality = "";
        $doctorschedulestarts = $_POST['doctorschedulestarts'];
        $sql = "select * from doctor where doctorname='$doctorname' or doctorspeciality='$doctorspeciality' or doctorschedulestarts='$doctorschedulestarts'";
        $select=mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($select)) {
                            echo '
                                <tr>
                                    <td>'.$row['doctorid'].'</td>
                                    <td>'.$row['doctorname'].'</td>
                                    <td>'.$row['doctorspeciality'].'</td>
                                    <td>'.$row['doctorschedulestarts'].'</td>
                                    <td>
                                        <button type="submit" value="'.$row['doctorid'].'" class="btn btn-success" name="make">MAKE APPOINTMENT</button>
                                    </td>
                                
                                
                                </tr>
                            
                            
                            
                            ';
                        }
    } else if(empty($_POST['doctorspeciality'] AND $_POST['doctorschedulestarts'])) {
        $doctorname = $_POST['doctorname'];
        $doctorspeciality = "";
        $doctorschedulestarts = "";
        $sql = "select * from doctor where doctorname='$doctorname' or doctorspeciality='$doctorspeciality' or doctorschedulestarts='$doctorschedulestarts'";
        $select=mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($select)) {
                            echo '
                                <tr>
                                    <td>'.$row['doctorid'].'</td>
                                    <td>'.$row['doctorname'].'</td>
                                    <td>'.$row['doctorspeciality'].'</td>
                                    <td>'.$row['doctorschedulestarts'].'</td>
                                    <td>
                                        <button type="submit" value="'.$row['doctorid'].'" class="btn btn-success" name="make">MAKE APPOINTMENT</button>
                                    </td>
                                
                                
                                </tr>
                            
                            
                            
                            ';
                        }
    } else if(empty($_POST['doctorname'] AND $_POST['doctorschedulestarts'])) {
        $doctorname = "";
        $doctorspeciality = $_POST['doctorspeciality'];
        $doctorschedulestarts = "";
        $sql = "select * from doctor where doctorname='$doctorname' or doctorspeciality='$doctorspeciality' or doctorschedulestarts='$doctorschedulestarts'";
        $select=mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($select)) {
                            echo '
                                <tr>
                                    <td>'.$row['doctorid'].'</td>
                                    <td>'.$row['doctorname'].'</td>
                                    <td>'.$row['doctorspeciality'].'</td>
                                    <td>'.$row['doctorschedulestarts'].'</td>
                                    <td>
                                        <button type="submit" value="'.$row['doctorid'].'" class="btn btn-success" name="make">MAKE APPOINTMENT</button>
                                    </td>
                                
                                
                                </tr>
                            
                            
                            
                            ';
                        }
    }  
}

                    
                    ?>
                </tbody>
            </table>
        </div>
    </div>
        </div>
    </form>
</div>
<?php 
include_once "footer.php";
?>