<?php
session_start();
if($_SESSION['auth'] != 1)
  header("Location: login.php");
require 'db.php';
$row = false;
$status = "";
if(isset($_GET['crno']) ){
    if($_GET['status']=="edit"){
        $sql = "select * from userdetails where card = ".$_GET['crno'].";";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $srno = $row['srno'];
        $status = "?srno=" . $srno;
    }
}

else if(isset($_GET['phone']) ){
    if($_GET['status']=="edit"){
        $sql = "select * from userdetails where phoneno = ".$_GET['phone'].";";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $srno = $row['srno'];
        $status = "?srno=" . $srno;
    }
} 
?>

<script type="text/javascript">
function search(){
  crno = document.getElementById('patient_crno').value;
  phone = document.getElementById('patient_phone').value;
  if(crno != "")
    window.open("dashboard.php" + "?status=edit&crno=" + crno,"_self");
  else if(phone != "")
  {
    window.open("dashboard.php" + "?status=edit&phone=" + phone,"_self");  
  } 
  else
    alert("Both fields can't be empty.");
}
</script>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>TELELABS UIET</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="jquery-3.3.1.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="code.js"></script>
</head>
<body>

<div id="hide">       <!-- // print hidden -->


<div class="container-fluid" id="jb" class="jumbotron"><center><h1>GURDWARA PRATAKH DARSHAN PATSHAHI CHHAINVEEN SEC-12 CHANDIGARH - 160012</h1>
<p><br>Free food and accomodation for the needy</p></center></div>

<div class="row">
  <div class="col-sm-11"></div>
  <div class="col-sm-1">
    <button onclick="logout()">Logout</button>  
  </div>
</div>

<div class="container">
  
  <center><h2 style="margin-top:50px">DASHBOARD</h2></center>

  <ul class="nav nav-tabs">
    <li class="active" id="tagTogg" style="margin-left: 280px"><a data-toggle="tab" href="#home"><h4>FILL FORM</h4></a></li>
    <li id="tagTogg"><a data-toggle="tab" href="#menu1"><h4>SEARCH AND EDIT</h4></a></li>
    <li id="tagTogg"><a data-toggle="tab" href="#menu2"><h4>AVAILABILITY</h4></a></li>
    <li id="tagTogg"><a data-toggle="tab" href="#menu3"><h4>ANALYSIS</h4></a></li>
  </ul>

  <div class="tab-content">
    
    <div id="home" class="tab-pane fade in active">            <!--  form started -->
      
    <form class="form-horizontal" action="addpatient.php<?php echo $status?>" method="POST" enctype="multipart/form-data">
  
  <div class="form-group">
    <label class="control-label col-sm-2" for="name">Patient Name:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="pname" placeholder="Enter Patient Name" name="patientname" value = "<?php echo $row['patientname']; $_SESSION['photoPatient'] = $row['id_path']; ?>">
    </div>
  </div>
  
  <div class="form-group">
    <label class="control-label col-sm-2" for="relation">S/O D/O W/O : </label>
    <div class="col-sm-10"> 
      <input type="text" class="form-control" id="text" placeholder="Enter relation" name="relation" value = "<?php echo $row['relation']; ?>">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="date">Gender:</label>
    <div class="col-sm-10"> 
      <input type="text" class="form-control" id="text" placeholder="Enter gender" name="gender" value = "<?php echo $row['gender']; ?>">
    </div>
  </div>
  
  <div class="form-group">
    <label class="control-label col-sm-2" for="district">District:</label>
    <div class="col-sm-10"> 
      <input type="text" class="form-control" id="text" placeholder="Enter District" name="district" value = "<?php echo $row['district']; ?>">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="state">State:</label>
    <div class="col-sm-10"> 
      <input type="text" class="form-control" id="text" placeholder="Enter State" name="state" value = "<?php echo $row['state']; ?>">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="relation">Address:</label>
    <div class="col-sm-10"> 
      <input type="text" class="form-control" id="text" placeholder="Enter Address" name="address" value = "<?php echo $row['address']; ?>">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="relation">Phone Number:</label>
    <div class="col-sm-10"> 
      <input type="text" class="form-control" id="phoneno" name="phoneno" pattern = "[0-9]{10,10}" value = "<?php echo $row['phoneno']; ?>">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="id">ID:</label>
    <div class="col-sm-10"> 
      <select class="form-control" id="text" placeholder="Enter Id" name="id" value = "<?php echo $row['id']; ?>">
        <option value="Aadhar Card" <?php if($row['id']=="Aadhar Card") echo 'selected="selected"'; ?>>Aadhar card</option>
        <option value="License" <?php if($row['id']=="License") echo 'selected="selected"'; ?>>License</option>
        <option value="Other" <?php if($row['id']=="Other") echo 'selected="selected"'; ?>>Other</option>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="Id no.">ID NUMBER:</label>
    <div class="col-sm-10"> 
      <input type="text" class="form-control" id="text" placeholder="Enter Id number" pattern = "[0-9]{0,12}" name="idnumber" value = "<?php echo $row['idnumber']; ?>">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="date">CR no:</label>
    <div class="col-sm-10"> 
      <input type="text" class="form-control" id="pgiCard" placeholder="Enter card number" pattern = "[0-9]{0,12}" name="card" value = "<?php echo $row['card']; ?>">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="att name">Attendent Name:</label>
    <div class="col-sm-10"> 
      <input type="text" class="form-control" id="text" placeholder="Enter Attendent Name" name="attendentname" value = "<?php echo $row['attendentname']; ?>">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-4" for="att phone">Attendent Phone Number:</label>
    <div class="col-sm-10"> 
      <input type="text" class="form-control" id="text" placeholder="Enter Attendent Phone Number" name="attendentPhone" value = "<?php echo $row['attendentPhone']; ?>">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="relation">S/O D/O W/O : </label>
    <div class="col-sm-10"> 
      <input type="text" class="form-control" id="text" placeholder="Enter relation of attendent" name="relation1" value = "<?php echo $row['relation1']; ?>">
    </div>
  </div>
  
  <div class="form-group">
    <label class="control-label col-sm-2" for="date">Date Of Check In:</label>
    <div class="col-sm-10"> 
      <input type="date" class="form-control" id="checkin" placeholder="Enter Check IN Date" name="checkin" value = "<?php echo substr($row['checkin'], 0, 10); ?>">
    </div>
  </div>
  
  <div class="form-group">
    <label class="control-label col-sm-2" for="date">Date Of Check Out:</label>
    <div class="col-sm-10"> 
      <input type="date" class="form-control" id="checkout" placeholder="Enter Check Out Date" name="checkout" value = "<?php echo substr($row['checkout'], 0, 10);; ?>">
    </div>
  </div>

  
  
  <div class="form-group">
    <label class="control-label col-sm-2" for="">Alloted HALL:</label>                    
    <div class="col-sm-10">  
      <input list="halls"  class="form-control"  placeholder="Enter alloted hall name" name="hallno" value = "<?php echo $row['hallno']; ?>">
        <datalist id="halls">
          <option value="HALL 1">
          <option value="HALL 2">
          <option value="HALL 3">
        </datalist>
    </div>
  </div>

  
  <div class="form-group">
    <label class="control-label col-sm-2" for="date">Bed Number:</label>                        
    <div class="col-sm-10"> 
      <input type="text" class="form-control" id="bedNo" placeholder="Enter Bed number eg: 10 or 10A" name="bedno" value = "<?php echo $row['bedno']; ?>">
     
    </div>
  </div>
  
  <div class="form-group">
    <label class="control-label col-sm-2" for="date">Additionals:</label>         <!--bedsheet -->
    <div class="col-sm-10">  
      <div class="row">
      
      <div class="col-sm-3"><input type="number" name="quilt" min="0" class="form-control" placeholder="Enter Number Of Quilts" id="quiltNo" value = "<?php echo $row['quilt']; ?>"></div>

        <div class="col-sm-3"><input type="number" name="pillow" min="0" class="form-control" placeholder="Enter Number Of Pillows" id="pillowNo" value = "<?php echo $row['pillow']; ?>"></div> 

        <div class="col-sm-3"><input type="number" name="bedsheet" min="0" class="form-control" placeholder="Enter Number Of Bedsheets" id="bedsheetNo" value = "<?php echo $row['bedsheet']; ?>"></div>

        <div class="col-sm-3"><input type="number" name="mattress" min="0" class="form-control" placeholder="Enter Number Of mattresses" id="mattressNo" value = "<?php echo $row['mattress']; ?>"></div>
      
      </div>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="date">Photo Of Id:</label>
    <div class="col-sm-10"> 
      <input type="file" name="id_path"  class="form-control">
    </div>
  </div>
  
    <div class="form-group">
    <label class="control-label col-sm-2" for="date">Photo Of PGI card:</label>
    <div class="col-sm-10"> 
      <input type="file" name="card_path" class="form-control">
    </div>
  </div>
  
  <button class="btn btn-success" type="submit" style="margin-bottom: 12px">SUBMIT FORM</button>
  
  
 </form>                                                                     <!-- form ended -->

  <button onclick="printSlip()">print</button>
 

    </div>

    <div id="menu1" class="tab-pane fade">                 <!-- search -->
      <h5 style="margin-top: 40px">SEARCH ACCORDING TO CR NUMBER OF PATIENT</h5>
      <div class="row">
       <div class="col-sm-6">
         <input type="text" placeholder="Search by CR number" name="crnoSearch" class="form-control" id="patient_crno">
        </div>
        
        <div class="col-sm-6">
          <button class="btn btn-success" onclick="search()">SEARCH NOW</button>
        </div>
      </div>
  
      <h5 style="margin-top: 40px">SEARCH ACCORDING TO PHONE NUMBER OF PATIENT</h5>
      <div class="row">
       <div class="col-sm-6">
         <input type="text" placeholder="Search by phone number" name="phoneSearch" class="form-control" id="patient_phone">
        </div>
        
        <div class="col-sm-6">
          <button class="btn btn-success" onclick="search()">SEARCH NOW</button>
        </div>
      </div>
      <br>
      <br>
      <br>

      <?php
        $query = "SELECT * FROM userdetails";

        $result = mysqli_query($conn, $query);
      ?>

      <div class="row">
          <div class="col-sm-10">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>CR Number</th>
                  <th>Name</th>
                  <th>Phone Number</th>
                </tr>
              </thead>

              <tbody>
                <?php while($row = mysqli_fetch_array($result)) {?>
                <tr>
                  <td><?php echo $row['card'] ?></td>
                  <td><?php echo $row['patientname'] ?></td>
                  <td><?php echo $row['phoneno'] ?></td>
                </tr>
                <?php } ?> 
              </tbody>
            </table>
          </div>
        </div>
    </div>





    <div id="menu2" class="tab-pane fade">

       <h4 style="margin-top: 20px">BEDS AVAILABLE</h4>       
       <?php
        $query = "SELECT bednumber FROM bed WHERE hall = 1 AND checkout <= now()";
        $result = mysqli_query($conn, $query);
      ?>

       <div class="row">
         <div class="col-sm-4">
            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo1">HALL1</button>
                 <div id="demo1" class="collapse">
                  <?php
                    while($row = mysqli_fetch_array($result))
                    {
                      echo 'BED NUMBER : ' . $row['bednumber'] . '<br>';
                    }
                  ?>
                  </div>

         </div>
    
         <div class="col-sm-4">
             
             <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo2">HALL2</button>
                 <div id="demo2" class="collapse">
                  <?php
                    require 'db.php';
                    $query = "SELECT bednumber FROM bed WHERE hall = 2 AND checkout <= now()";
                    $result = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_array($result))
                    {
                      echo 'BED NUMBER : ' . $row['bednumber'] . '<br>';
                    }
                  ?>
                  </div>

         </div>
    
         <div class="col-sm-4">
              
              <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo3">HALL3</button>
                 <div id="demo3" class="collapse">
                  <?php
                    require 'db.php';
                    $query = "SELECT bednumber FROM bed WHERE hall = 3 AND checkout <= now()";
                    $result = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_array($result))
                    {
                      echo 'BED NUMBER : ' . $row['bednumber'] . '<br>';
                    }
                  ?>
                  </div>

         </div>
     
       </div>
     
     </div>

     <div id="menu3" class="tab-pane fade"> 
        <br>

        <form method="POST" action="dashboard.php">
          
          <div class="row">
            <div class="col-sm-3">
              <input type="text" name="year" placeholder="Enter year">
            </div>
            <div class="col-sm-3">
              <input type="text" name="state" placeholder="Enter state">
            </div>
            <div class="col-sm-3">
              <input type="text" name="month" placeholder="Enter month">
            </div>
            <div class="col-sm-3">
              <input type="date" name="day" placeholder="Enter date">
            </div>
          </div>

          <br>

          <div class="row">
            <div class="col-sm-3">
              <input type="text" name="aadhar" placeholder="Enter Aadhar">
            </div>
          </div>

          <br>
          <br>

          <div>
            <input type="submit" name="search">
          </div>
        </form>

        <?php
          if(isset($_POST['search']))
          {
            $date = 'WHERE checkin = "';
            $year = 'WHERE checkin LIKE "%' ;
            $state = ' AND state LIKE "%"';
            $month = '%"';
            $aadhar = ' AND card LIKE "%"';

            if(isset($_POST['day']) && $_POST['day'] != "")
              $date = $date . $_POST['day'] . '"';

            else
              $date = "";

            if(isset($_POST['month']) && $_POST['month'] != "")
              $month = '-' . $_POST['month'] . '%"';

            if(isset($_POST['year']) && $_POST['year'] != "")
              $year = 'WHERE checkin LIKE "'. $_POST['year'] . '%';

            if(isset($_POST['state']) && $_POST['state'] != "")
              $state = ' AND state = "' . $_POST['state'] . '"';

            if(isset($_POST['aadhar']) && $_POST['aadhar'] != "")
              $aadhar = ' AND card = "' . $_POST['aadhar'] . '"';

            if($date != "")
              $query = "SELECT * FROM userdetails " . $date . $state . $aadhar;              

            else
              $query = "SELECT * FROM userdetails $year$month" . $state . $aadhar;

            $result = mysqli_query($conn, $query);
          }
        ?>

        <br>

        <div class="row">
          <div class="col-sm-10">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>CR number</th>
                  <th>Phone number</th>
                  <th>Name</th>
                </tr>
              </thead>

              <tbody>
                <?php 
                if($result)
                while($row = mysqli_fetch_array($result)) {?>
                <tr>
                  <td><?php echo $row['card'] ?></td>
                  <td><?php echo $row['phoneno'] ?></td>
                  <td><?php echo $row['patientname'] ?></td>
                </tr>
                <?php } ?> 
              </tbody>
            </table>
          </div>
        </div>

      </div>
  </div>

</div>

</div>     

<!-- div hidden closed -->

<div id="printDiv" class="container" style="border 15px solid black">
  
  <div class="row">
  	
  	<div class="col-sm-6">
  	GURDWARA PRATAKH DARSHAN PATSHAHI CHHAINVEEN SEC-12 CHANDIGARH - 160012	
  	</div>
     
    <div class="col-sm-6">
     	ISSUED BY: <?php echo $_SESSION["name"]?>
     	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button class="btn btn-success" onclick="window.location.reload()">GO HOME</button>
    </div> 

  </div>

  <br>
  <div class="row">
    <div class="col-sm-3">
      <h3>Sr no: </h3><span><br><h2 id="rNumber">Serial number</h2></span>  
      <br>
      <h3>Name: </h3><span><br><h2 id="nameOfPatient">Name of patient</h2></span>  
    </div>
    <div class="col-sm-4">
      <h3>Bed number: </h3><span><br><h2 id="bedNumber">Bed number</h2></span>
    </div>
    <div class="col-sm-5">
      <img height="250px" id="photoPatient" alt="Photo">
      <script type="text/javascript">
        document.getElementById("photoPatient").src = "<?php echo $_SESSION['photoPatient'] ?>";
      </script>
    </div>
  </div>
    
  <br>

  <div class="row">
    <div class="col-sm-3">
      <h3>No of quilts: </h3><span><br><h2 id="quiltNumber">quiltNumber</h2></span>  
    </div>
    <div class="col-sm-3">
      <h3>No of bedsheets: </h3><span><br><h2 id="bedsheetNumber"></h2></span>  
    </div>
    <div class="col-sm-3">
      <h3>No of pillows: </h3><span><br><h2 id="pillowNumber"></h2></span>  
    </div>
    <div class="col-sm-3">
      <h3>No of mattress: </h3><span><br><h2 id="mattressNumber"></h2></span>  
    </div>
  </div>

  <br>

  <div class="row">
    <div class="col-sm-4">
      <h3>Phone no: </h3><span><br><h2 id="phoneNumber">phoneNumber</h2></span>
    </div>
    <div class="col-sm-8">
      <h3>PGI CR no: </h3><span><br><h2 id="pgiCardNumber">pgiCardNumber</h2></span>
    </div>
  </div>

  <br>

  <div class="row">
    <div class="col-sm-4">
      <h3>Check In: </h3><span><br><h2 id="checkIn">checkIn</h2></span>
    </div>
    <div class="col-sm-4">
      <h3>Check Out: </h3><span><br><h2 id="checkOut">checkOut</h2></span>
    </div>
  </div>

 <button class="btn btn-success" onclick="window.location.reload()">GO HOME</button>
</div>

</body>
</html>