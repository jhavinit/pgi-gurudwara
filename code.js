function Div(){
	var x= document.getElementById("sPsw").value;
	if(x==12345)
		{	
    	    document.getElementById('sss').style.backgroundColor="green"; 
			document.getElementById('signDiv').style.visibility="visible";  }
    else
    	document.getElementById('sss').style.backgroundColor="red"; 
}

function logout()
{
  window.location.href="login.html";  
}

function printSlip(){ 
  var patientName = document.getElementById("pname").value;
  var bedNumber = document.getElementById("bedNo").value;
  var quiltNumber = document.getElementById("quiltNo").value;
  var bedsheetNumber = document.getElementById("bedsheetNo").value;
  var pillowNumber = document.getElementById("pillowNo").value;
  var mattressNumber = document.getElementById("mattressNo").value;
  var phoneno = document.getElementById("phoneno").value;
  var pgiCard = document.getElementById("pgiCard").value;
  var checkin = document.getElementById("checkin").value;
  var checkout = document.getElementById("checkout").value;

  var patientName1=document.getElementById("nameOfPatient");
  patientName1.innerHTML=patientName;
  var bedNumber1=document.getElementById("bedNumber");
  bedNumber1.innerHTML=bedNumber;
  var quiltNumber1=document.getElementById("quiltNumber");
  quiltNumber1.innerHTML=quiltNumber;
  var pillowNumber1=document.getElementById("pillowNumber");
  pillowNumber1.innerHTML=pillowNumber;
  var bedsheetNumber1=document.getElementById("bedsheetNumber");
  bedsheetNumber1.innerHTML=bedsheetNumber;
  var mattressNumber1=document.getElementById("mattressNumber");
  mattressNumber1.innerHTML=mattressNumber;
  var serialNumber1=document.getElementById("rNumber")
  serialNumber1.innerHTML=12;
  var phoneNumber =  document.getElementById("phoneNumber");
  phoneNumber.innerHTML = phoneno;

  checkin = checkin.slice(8, 10) + '-' + checkin.slice(5, 7) + '-' + checkin.slice(0, 4);
  checkout = checkout.slice(8, 10) + '-' + checkout.slice(5, 7) + '-' + checkout.slice(0, 4);

  document.getElementById("pgiCardNumber").innerHTML = pgiCard;
  document.getElementById("checkIn").innerHTML = checkin;
  document.getElementById("checkOut").innerHTML = checkout;

  document.getElementById("hide").style.visibility = "hidden";
  document.getElementById("printDiv").style.visibility = "visible";
  document.getElementById("printDiv").style.marginTop = "-2400px";
  document.getElementById("printDiv").style.top = 0;
  document.getElementById("printDiv").style.left = 0;

  var ch=prompt("do you sure want to print?"); 
  if(ch=='y')
 	{
    window.print();
  }
  else
 	  window.location.href="dashboard.php";
}