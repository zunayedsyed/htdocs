<?php 
include_once "connectdb.php";
session_start();
if($_SESSION['userphone'] == "" OR $_SESSION['userrole'] == "user") {
    header("location: index.php");
}
if(isset($_POST['doctorregister'])) {
    $doctorname = $_POST['doctorname'];
    $doctorspeciality = $_POST['doctorspeciality'];
    $doctorjoindate = $_POST['doctorjoindate'];
    $doctorschedulestarts = $_POST['doctorschedulestarts'];
    $doctorscheduleends = $_POST['doctorscheduleends'];
    if(!empty($doctorname AND $doctorspeciality AND $doctorjoindate AND $doctorschedulestarts AND $doctorscheduleends)){
        $sql = "insert into doctor(doctorname, doctorspeciality, doctorjoindate, doctorschedulestarts, doctorscheduleends) values('$doctorname', '$doctorspeciality', '$doctorjoindate', '$doctorschedulestarts', '$doctorscheduleends')";
        if(mysqli_query($conn, $sql)) {
            echo "Table of " .$doctorname." ". $doctorspeciality;
            $_SESSION['doctorinput'] = "Registration Successful";
        } else {
            $_SESSION['doctorinput'] = "Registration Failed";
        }
    } else {
        $_SESSION['doctorinput'] = "One or many fields are empty!";
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

include_once "header.php";
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
            <div class="header"><b id="doctorheader"> ADD NEW DOCTOR </b></div>
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
        if(isset($_POST['edit'])) {
            echo '
            <script>
                document.getElementById("doctorheader").innerHTML="Update Information";
            </script>
            ';
            $sql = "select * from doctor where doctorid=".$_POST['edit'];
            $select = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($select)) {
            echo '
            <div class="form-floating mb-3">
              <input type="hidden" name="doctorid" value="'.$row['doctorid'].'" placeholder="doctorid">
            </div>
             <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" name="doctorname" value="'.$row['doctorname'].'" placeholder="doctorname" >
              <label for="floatingInput">Doctor Name</label>
            </div>
            <div class="form-floating mb-3">
              <select class="form-select form-control" name="doctorspeciality" id="floatingInput">
              <option value="" disabled selected>Select Speciality</option>
              ';
            $sql = "select * from speciality";
            $select = mysqli_query($conn, $sql);
            while($row2 = mysqli_fetch_assoc($select)) {
                echo '
                    <option selected>'.$row['doctorspeciality'].'</option>
                    <option>'.$row2['specialityname'].'</option>
                ';
            }
                echo '
              </select>
              <label for="floatingInput">Speciality</label>
            </div>
             <div class="form-floating mb-3">
              <input type="date" class="form-control" id="floatingInput" name="doctorjoindate" value="'.$row['doctorjoindate'].'" placeholder="doctorjoindate">
              <label for="floatingInput">Joining Date</label>
            </div>
          <div class="form-floating mb-3">
            <select class="form-select form-control" name="doctorschedulestarts" id="floatingInput">
              <option value="'.$row['doctorschedulestarts'].'" selected>'.$row['doctorschedulestarts'].'</option>
              <option value="7.00">7:00</option>
              <option value="7.30">7:30</option>
              <option value="8.00">8:00</option>
              <option value="8.30">8:30</option>
              </select>
              <label for="floatingInput">Schedule Starts</label>
            </div>
          <div class="form-floating mb-3">
            <select class="form-select form-control" name="doctorscheduleends" id="floatingInput">
              <option value="'.$row['doctorscheduleends'].'" selected>'.$row['doctorscheduleends'].'</option>
              <option value="7.00">7:00</option>
              <option value="7.30">7:30</option>
              <option value="8.00">8:00</option>
              <option value="8.30">8:30</option>
              </select>
              <label for="floatingInput">Schedule Starts</label>
            </div>
            <div align="center">
                <input type="submit" value="Update" class="btn btn-success" name="doctorupdate">
            </div>
        </div>
            ';
            }}
     else {
            echo '
             <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" name="doctorname" placeholder="doctorname">
              <label for="floatingInput">Doctor Name</label>
            </div>
            <div class="form-floating mb-3">
              <select class="form-select form-control" name="doctorspeciality" id="floatingInput">
              <option value="" disabled selected>Select Speciality</option>
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
              <input type="date" class="form-control" id="floatingInput" name="doctorjoindate" placeholder="doctorjoindate">
              <label for="floatingInput">Joining Date</label>
            </div>
            <div class="form-floating mb-3">
                <select class="form-select form-control" name="doctorschedulestarts" id="floatingInput">
              <option value="" disabled selected>Select time</option>
              <option value="7.00">7:00</option>
              <option value="7.30">7:30</option>
              <option value="8.00">8:00</option>
              <option value="8.30">8:30</option>
              </select>
              <label for="floatingInput">Schedule Starts</label>
            </div>
            <div class="form-floating mb-3">
            <select class="form-select form-control" name="doctorscheduleends" id="floatingInput">
              <option value="" disabled selected>Select time</option>
              <option value="9.00">9:00</option>
              <option value="9.30">9:30</option>
              <option value="10.00">10:00</option>
              <option value="10.30">10:30</option>
              <option value="11.00">11:00</option>
              </select>
              <label for="floatingInput">Schedule Ends</label>
            </div>
            <div align="center">
                <input type="submit" value="Register" class="btn btn-success" name="doctorregister">
            </div>
        </div>
        ';
        }
        
        ?>
        <div class="col-md-9">
            <div class="header"><b> DOCTORS LIST </b> </div>
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>DOCTOR NAME</th>
                    <th>SPECIALITY</th>
                    <th>JOINING DATE</th>
                    <th>SCHEDULE STARTS</th>
                    <th>SCHEDULE ENDS</th>
                    <th>UPDATE</th>
                    <th>DELETE</th>
                </thead>
                <tbody>
                    <?php 
                        $sql = "select * from doctor order by doctorid desc";
                        $select = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($select)) {
                            echo '
                                <tr>
                                    <td>'.$row['doctorid'].'</td>
                                    <td>'.$row['doctorname'].'</td>
                                    <td>'.$row['doctorspeciality'].'</td>
                                    <td>'.$row['doctorjoindate'].'</td>
                                    <td>'.$row['doctorschedulestarts'].'</td>
                                    <td>'.$row['doctorscheduleends'].'</td>
                                    <td>
                                        <button type="submit" value="'.$row['doctorid'].'" class="btn btn-success" name="edit">UPDATE</button>
                                    </td>
                                    <td>
                                        <button type="submit" value="'.$row['doctorid'].'" class="btn btn-danger" name="id">DELETE</button>
                                    </td>
                                
                                
                                </tr>
                            
                            
                            
                            ';
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