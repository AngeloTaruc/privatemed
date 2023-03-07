<?php
	if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
	if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }
	
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Medical Management System</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Boxicons CDN Link -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<!DOCTYPE html>                    
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script type='text/javascript' src='js/sweetalert.min.js'></script>
								
								<script>
									function loadPage(url,elementId) {
										if (window.XMLHttpRequest) {
											  xmlhttp=new XMLHttpRequest();
										   } else {
											  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
										   }   
										   xmlhttp.onreadystatechange=function() {
											if (xmlhttp.readyState==4 && xmlhttp.status==200) {
											 document.getElementById(elementId).innerHTML="";
											 document.getElementById(elementId).innerHTML=xmlhttp.responseText;	
											}
										   }  
										   xmlhttp.open("GET",url,true);
										   xmlhttp.send();	   
									}
									function addEditMedicine(mid) {
									var action = "Add"; if (mid!=0) { action = "Update"; }
									var medicinename = document.getElementById('medicinename').value;
									if (medicinename!='') {
										swal({
											title: "Medicine",
											text: "Are you sure to "+ action +" this Medicine?",
											icon: "warning",
											buttons: true,
											dangerMode: true,
										})
										.then((willAdd) => {
											if (willAdd) {
												loadPage('pages/medicine.php?mid='+mid+'&medicinename='+
														 encodeURIComponent(medicinename),'content');
											} else {

											}
										});
								
									} else {
										swal('Error on Medicine Description','Please Input Medicine','error');
									}
								}
                function addEditMedicine_details(mdid) {
                    var action = "Add"; if (mdid!=0) { action = "Update"; }
                    var med_quantity = document.getElementById('med_quantity').value;
                    var mid = document.getElementById('mid').value;
                    if (med_quantity!='') {
                      swal({
                        title: "Medicine Details",
                        text: "Are you sure to "+ action +" this Medicine details?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                      })
                      .then((willAdd) => {
                        if (willAdd) {
                          loadPage('pages/medicinedetails.php?mdid='+mdid+'&mid='+mid
                          +'&med_quantity='+encodeURIComponent(med_quantity),'content');
						} else {

						}
					});
			
				} else {
					swal('Error on Medicine Details','Please Input Medicine details','error');
				}
			}

     
			function addEditDoctor(doctorid) {
				var action = "Add"; if (doctorid!=0) { action = "Update"; }
				var dlastname = document.getElementById('dlastname').value;
				var dfirstname = document.getElementById('dfirstname').value;
				var middlename = document.getElementById('middlename').value;
				var sex = document.getElementById('sex').value;
				var emailaddress = document.getElementById('emailaddress').value;
				var medstaff = document.getElementById('medstaff').value;
        
				
				var allow = 1;
				if (dlastname=='') { allow = 0;}
				if (dfirstname=='') { allow = 0;}
				if (emailaddress=='') { allow = 0;}
				if (medstaff=='') { allow = 0;}
				

				
				
				if (allow) {
					swal({
						title: "Staff",
						text: "Are you sure to "+ action +" this Staff?",
						icon: "warning",
						buttons: true,
						dangerMode: true,
					})
					.then((willAdd) => {
						if (willAdd) {
							loadPage('pages/doctor.php?doctorid='+doctorid
									+'&dlastname='+encodeURIComponent(dlastname)
									+'&dfirstname='+encodeURIComponent(dfirstname)
									+'&middlename='+encodeURIComponent(middlename)
									+'&sex='+encodeURIComponent(sex)
									+'&emailaddress='+encodeURIComponent(emailaddress)
									+'&medstaff='+encodeURIComponent(medstaff),'content');
						} else {

						}
					});
				} else {
					swal('Error on Staff Data','Please Input Complete Staff Data','error');
				}
				
			}


      function addEditPatient(pid) {
				var action = "Add"; if (pid!=0) { action = "Update"; }
				var lastname = document.getElementById('lastname').value;
				var firstname = document.getElementById('firstname').value;
				var middlename = document.getElementById('middlename').value;
				var sex = document.getElementById('sex').value;
       			var age = document.getElementById('age').value;
				var dateofbirth = document.getElementById('dateofbirth').value;
				var emailaddress = document.getElementById('emailaddress').value;
				var illness = document.getElementById('illness').value;
       			var doctorid = document.getElementById('doctorid').value;
        
				
				var allow = 1;
				if (lastname=='') { allow = 0;}
				if (firstname=='') { allow = 0;}
				if (dateofbirth=='') { allow = 0;}
				if (emailaddress=='') { allow = 0;}
        		if (age=='') { allow = 0;}
				if (illness=='') { allow = 0;}
				

				
				
				if (allow) {
					swal({
						title: "Patient",
						text: "Are you sure to "+ action +" this Patient?",
						icon: "warning",
						buttons: true,
						dangerMode: true,
					})
					.then((willAdd) => {
						if (willAdd) {
							loadPage('pages/patient.php?pid='+pid+'&doctorid='+doctorid
									+'&lastname='+encodeURIComponent(lastname)
									+'&firstname='+encodeURIComponent(firstname)
									+'&middlename='+encodeURIComponent(middlename)
									+'&sex='+encodeURIComponent(sex)
                  					+'&age='+encodeURIComponent(age)
									+'&dateofbirth='+encodeURIComponent(dateofbirth)
									+'&emailaddress='+encodeURIComponent(emailaddress)
									+'&illness='+encodeURIComponent(illness),'content');
						} else {

						}
					});
				} else {
					swal('Error on Staff Data','Please Input Complete Patient Data','error');
				}
				
			}

			function addEditPatient_history(phid) {
                    var action = "Add"; if (phid!=0) { action = "Update"; }
                    var result_of_diagnosis = document.getElementById('result_of_diagnosis').value;
                    var pid = document.getElementById('pid').value;
					var appointment_id = document.getElementById('appointment_id').value;
                    if (result_of_diagnosis!='') {
                      swal({
                        title: "Medicine Details",
                        text: "Are you sure to "+ action +" this Medicine details?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                      })
                      .then((willAdd) => {
                        if (willAdd) {
                          loadPage('pages/patienthistory.php?phid='+phid+'&pid='+pid+'&appointment_id='+appointment_id
                          +'&result_of_diagnosis='+encodeURIComponent(result_of_diagnosis),'content');
						} else {

						}
					});
			
				} else {
					swal('Error on Staff Details','Please Input Medicine Staff','error');
				}
			}

			function addEditAppointment(appointment_id) {
                    var action = "Add"; if (appointment_id!=0) { action = "Update"; }
                    var time_and_date = document.getElementById('time_and_date').value;
                    var pid = document.getElementById('pid').value;
                    if (time_and_date!='') {
                      swal({
                        title: "Appointment Details",
                        text: "Are you sure to "+ action +" this Appointment details?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                      })
                      .then((willAdd) => {
                        if (willAdd) {
                          loadPage('pages/appointment.php?appointment_id='+appointment_id+'&pid='+pid
                          +'&time_and_date='+encodeURIComponent(time_and_date),'content');
						} else {

						}
					});
			
				} else {
					swal('Error on Appointment Details','Please Input Appointment details','error');
				}
			}


			function addEditUser(userid) {
                    var action = "Add"; if (userid!=0) { action = "Update"; }
                    var user_name = document.getElementById('user_name').value;
					var password = document.getElementById('password').value;
                    var doctorid = document.getElementById('doctorid').value;
                    if (user_name!='') {
                      swal({
                        title: "User Details",
                        text: "Are you sure to "+ action +" this User details?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                      })
                      .then((willAdd) => {
                        if (willAdd) {
                          loadPage('pages/user.php?userid='+userid+'&doctorid='+doctorid
                          +'&user_name='+encodeURIComponent(user_name)
						  +'&password='+encodeURIComponent(password),'content');
						} else {

						}
					});
			
				} else {
					swal('Error on User Details','Please Input User details','error');
				}
			}
			

                

</script>
   </head>
<body >
  <div class="sidebar">
    <div class="logo-details">
    <i class="fa fa-hospital-o" aria-hidden="true"></i>
        <div class="logo_name">Medical</div>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
      <li>
        <a href="javascript:void();" 
								onclick="loadPage('pages/medicine.php?mid=0','content');">
			<i class="fa fa-tablets"></i>
          <span class="links_name">Medicine</span>
        </a>
         <span class="tooltip">Medicine</span>
      </li>
      <li>
       <a href="javascript:void()" 
								onclick="loadPage('pages/medicinedetails.php?mdid=0','content');">
								<i class="fa fa-pills"></i>
         <span class="links_name">Medicine Details</span>
       </a>
       <span class="tooltip">Medicine Details</span>
     </li>
     <li>
       <a href="javascript:void();" 
								onclick="loadPage('pages/doctor.php?doctorid=0','content');">
								<i class="fa fa-user-md"></i>
         <span class="links_name">Doctor</span>
       </a>
       <span class="tooltip">Doctor</span>
     </li>
     <li>
       <a href="javascript:void();" 
								onclick="loadPage('pages/user.php?userid=0','content');">
								<i class="fa fa-user"></i>
         <span class="links_name">User</span>
       </a>
       <span class="tooltip">User</span>
     </li>
     <li>
       <a href="javascript:void();" 
								onclick="loadPage('pages/patient.php?pid=0','content');">
								<i class="fa fa-users"></i>
         <span class="links_name">Patient</span>
       </a>
       <span class="tooltip">Patient</span>
     </li>
     <li>
       <a href="javascript:void();" 
								onclick="loadPage('pages/patienthistory.php?phid=0','content');">
								<i class="fa fa-history"></i>
         <span class="links_name">Patients History</span>
       </a>
       <span class="tooltip">Patient History</span>
     </li>
     <li>
       <a href="javascript:void();" 
								onclick="loadPage('pages/appointment.php?appointment_id=0','content');">
								<i class="fa fa-calendar-times"></i>
         <span class="links_name">Appointment</span>
       </a>
       <span class="tooltip">Appointment</span>
     </li>
     
     <li class="profile">
         <div class="profile-details">
           <img src="profile1.png" alt="profileImg">
           <div class="name_job">
             <div class="name">User</div>
             <div class="job">Admin</div>
           </div>
         </div>
		 <a href="logout.php" class="btn btn-danger">
         <i class='bx bx-log-out' id="log_out">
			
		 </i>

     </li>
    </ul>
	</a>
  </div>
  <section class="home-section" style="background-image: url('medic.jpg'); background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover; ">
  <div class="box" id="content">

    </div>
  </section>

  <script src="script.js"></script>

</body>
</html>
