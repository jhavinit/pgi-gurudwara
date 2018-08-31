<?php
	include_once 'db.php';
  session_start();

  $patientname = $_POST['patientname'];
  $relation = $_POST['relation'];
  $district = $_POST['district'];
  $state = $_POST['state']; 
  $phoneno = $_POST['phoneno'];
  $idnumber = $_POST['idnumber'];
  $attendentname = $_POST['attendentname'];
  $attendentPhone = $_POST['attendentPhone'];
  $relation1 = $_POST['relation1'];
  $address = $_POST['address'];
  $checkin = $_POST['checkin']; 
  $checkout = $_POST['checkout'];
  $hallno = $_POST['hallno']; 
  $bedno = $_POST['bedno'];
  $bedsheet = $_POST['bedsheet']; 
  $gender = $_POST['gender'];
  $id = $_POST['id']; 
  $idnumber = $_POST['idnumber'];
  $card = $_POST['card']; 
  $quilt = $_POST['quilt'];
  $pillow = $_POST['pillow'];
  $mattress = $_POST['mattress'];
  $flag = 1;


  if($bedno != "")
  {
  		$result = mysqli_query($conn, "SELECT * FROM bed WHERE bednumber = '$bedno' AND checkout <= $checkin");
            //or die("Failed to query database".mysql_error());
  
	  $row = mysqli_fetch_array($result);
	  if(!$row)
	  {
	    echo "<script>
	    alert('The requested bed number is not available, Enter other bed number');
	    window.location.href = 'dashboard.php';
	    </script>";
	    $flag = 2;
	  }

	  $extraBed = NULL;

	  if($attendentname != NULL)
	  {
	    $extraBed = $bedno . 'A';
	    $result = mysqli_query($conn, "SELECT * FROM bed WHERE bednumber = '$extraBed' AND checkout <= $checkin")
	              or die("Failed to query database".mysql_error());

	    echo "SELECT * FROM bed WHERE bednumber = '$extraBed' AND checkout <= $checkin";

	    $row = mysqli_fetch_array($result);
	    if(!$row)
	    {
	      echo "<script>
	      alert('The requested double bed is not available, Enter other bed number');
	      window.location.href = 'dashboard.php';
	      </script>";
	      $flag = 2;
	    } 
	  }

	  if($extraBed != NULL)
	    $result = mysqli_query($conn, "UPDATE bed SET checkout = '$checkout' WHERE bednumber = '$extraBed'")
	            or die("Failed to query database".mysql_error());	
  }
  

  if ($patientname == NULL) {
    $patientname = "";
  }
  if ($relation == NULL) {
    $relation = "";
  }
  if ($district == NULL) {
    $district = "";
  }
  if ($state == NULL) {
    $state = "";
  }
  if ($phoneno == NULL) {
    $phoneno = "";
  }
  if ($idnumber == NULL) {
    $idnumber = "";
  }
  if ($attendentname == NULL) {
    $attendentname = "";
  }
  if($attendentPhone == NULL){
    $attendentPhone = "";
  }
  if ($relation1 == NULL) {
    $relation1 = "";
  }
  if ($address == NULL) {
    $address = "";
  }
  if ($checkin == NULL) {
    $checkin = "";
  }
  if ($checkout == NULL) {
    $checkout = "";
  }

  if ($hallno == NULL) {
    $hallno = "";
  }
  if ($bedno == NULL) {
    $bedno = "";
  }
  if ($bedsheet == NULL) {
    $bedsheet = "";
  }
  if ($gender == NULL) {
    $gender = "";
  }
  if ($id == NULL) {
    $id = "";
  }
  if ($card == NULL) {
    $card = "";
  }
  if ($quilt == NULL) {
    $quilt = "";
  }
  if ($pillow == NULL) {
    $pillow = "";
  }
  if ($mattress == NULL) {
    $mattress = "";
  }
  if ($idnumber == NULL) {
    $idnumber = "";
  }

  /*if(isset($_GET['srno']))
  {
    $srno = $_GET['srno'];
    $query = "UPDATE userdetails SET patientname = '$patientname', relation = '$relation', district = '$district', state = '$state', phoneno = '$phoneno', idnumber = '$idnumber', attendentname = '$attendentname', attendentPhone = '$attendentPhone', relation1 = '$relation1', address = '$address', checkin = '$checkin', checkout = '$checkout', hallno = '$hallno', bedno = '$bedno', bedsheet = '$bedsheet', gender = '$gender', id = '$id', card = '$card', quilt = '$quilt', pillow = '$pillow', mattress = '$mattress' WHERE srno = $srno";
  }

  else{*/

  if($flag != 2)
  {
  		$query = "INSERT INTO userdetails(patientname, relation, district, state, phoneno, idnumber, attendentname, attendentPhone, relation1, address, checkin, checkout, hallno, bedno, bedsheet, gender, id, card, quilt, pillow, mattress) VALUES ('$patientname', '$relation', '$district', '$state', '$phoneno', '$idnumber', '$attendentname', '$attendentPhone', '$relation1', '$address', '$checkin', '$checkout', '$hallno', '$bedno', '$bedsheet', '$gender', '$id', '$card', '$quilt', '$pillow', '$mattress')";

	    $result = mysqli_query($conn, "UPDATE bed SET checkout = '$checkout' WHERE bednumber = '$bedno'")
	            or die("Failed to query database".mysql_error());
	  //}

	  $result = mysqli_query($conn, $query);

	  $query = "SELECT MAX(srno) FROM userdetails WHERE patientname = '$patientname' AND card = '$card'";

	  $result = mysqli_query($conn, $query);

	  $row = mysqli_fetch_array($result);

	  $srno = $row['MAX(srno)'];

	  $_SESSION['srno'] = $row['MAX(srno)'];

	  $name = $_FILES['id_path']['name'];
	  $tmp_name = $_FILES['id_path']['tmp_name'];

	  if(isset($name)&&!empty($name))
	  {
	    $path = $srno;
	    if(move_uploaded_file($tmp_name, "id/$path")){
	          $sql = "UPDATE userdetails SET id_path = 'id/$path' WHERE srno = $srno";
	          echo $sql;
	          mysqli_query($conn, $sql);
	    } 
	  }

	  $name = $_FILES['card_path']['name'];
	  $tmp_name = $_FILES['card_path']['tmp_name'];

	  if(isset($name)&&!empty($name))
	  {
	    $path = $srno;
	    if(move_uploaded_file($tmp_name, "card/$path")){
	          $sql = "UPDATE userdetails SET card_path = 'card/$path' WHERE srno = $srno";
	          echo $sql;
	          mysqli_query($conn, $sql);
	    } 
	  }

	  echo "<script>
	      window.location.href = 'dashboard.php';
	      </script>";	
  }
?>