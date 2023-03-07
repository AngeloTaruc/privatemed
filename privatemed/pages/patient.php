<?Php 

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }
$pid = $_GET['pid'];

//echo $_SERVER['REQUEST_URI']; studentnumber, lastname, firstname, middlename, sex, dateofbirth, emailaddress

if (isset($_GET['pid']) && isset($_GET['lastname'])) {
	if ($_GET['pid']==0) { //Adding
	
		mysqli_query($db_connection,'INSERT INTO tblpatient SET lastname=\''.
									 urldecode($_GET['lastname']).'\',firstname=\''.
									 urldecode($_GET['firstname']).'\',middlename=\''.
									 urldecode($_GET['middlename']).'\',sex=\''.
									 urldecode($_GET['sex']).'\',age=\''.
                                     urldecode($_GET['age']).'\',dateofbirth=\''.
									 urldecode($_GET['dateofbirth']).'\',emailaddress=\''.
									 urldecode($_GET['emailaddress']).'\',illness=\''.
									 urldecode($_GET['illness']).'\',doctorid='.$_GET['doctorid']);
	} else { //Updating
		mysqli_query($db_connection,'UPDATE tblpatient SET lastname=\''.
									 urldecode($_GET['lastname']).'\',firstname=\''.
									 urldecode($_GET['firstname']).'\',middlename=\''.
									 urldecode($_GET['middlename']).'\',sex=\''.
									 urldecode($_GET['sex']).'\',age=\''.
                                     urldecode($_GET['age']).'\',dateofbirth=\''.
									 urldecode($_GET['dateofbirth']).'\',emailaddress=\''.
									 urldecode($_GET['emailaddress']).'\',illness=\''.
									 urldecode($_GET['illness']).'\',doctorid='.$_GET['doctorid'].'
									 WHERE pid='.$_GET['pid']);
	
	}	
}


$lastname = GetValue('select lastname from tblpatient where pid='.$pid);
$firstname = GetValue('select firstname from tblpatient where pid='.$pid);
$middlename = GetValue('select middlename from tblpatient where pid='.$pid);
$sex = GetValue('select sex from tblpatient where pid='.$pid);
$age = GetValue('select age from tblpatient where pid='.$pid);
$dateofbirth = GetValue('select dateofbirth from tblpatient where pid='.$pid);
$emailaddress = GetValue('select emailaddress from tblpatient where pid='.$pid);
$illness = GetValue('select illness from tblpatient where pid='.$pid);
$doctorid = GetValue('select doctorid from tblpatient where pid='.$pid);


?>
<style>
	.content-table thead tr {
    background-color: #72d4cb;
    color: #ffffff;
    text-align: left;
    font-weight: bold;
	font-size: 15px;
}

.content-table th,
.content-table td {
    padding: 12px 15px;
}

.content-table tbody tr {
    border-bottom: 1px solid #dddddd;
	font-size: 10px;
}

.content-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.content-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}

.content-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
}
</style>
<div align="center">
	
	<div>
	<table class="content-table" >
		<?Php 
			
			echo '<thead>
				<th>Last Name: </th>
				<th><input type="text" style="width:250px" id="lastname" value="'.$lastname.'"/></th>
			</thead>';
			
			echo '<thead>
				<th>First Name: </th>
				<th><input type="text" style="width:250px" id="firstname" value="'.$firstname.'"/></th>
			</thead>';

			echo '<thead>
				<th>Middle Name: </th>
				<th><input type="text" style="width:250px" id="middlename" value="'.$middlename.'"/></th>
			</thead>';
			
			echo '<thead>
				<th>Sex: </th>
				<th>';
				echo '<select id="sex">';
					if ($sex=='M') { 
						echo '<option value="M" selected="selected">Male</option>';	
						echo '<option value="F">Female</option>';							
					} else {
						echo '<option value="M">Male</option>';	
						echo '<option value="F"  selected="selected">Female</option>';	
					}
				echo '</select>';


                echo '<thead>
				<th>Age : </th>
				<th><input type="text" style="width:250px" id="age" value="'.$age.'"/></th>
			</thead>';


			echo '<thead>
				<th>Date Of Birth: </th>
				<th><input type="date" style="width:250px" id="dateofbirth" value="'.$dateofbirth.'"/> 
			 </thead>';

			echo '<thead>
				<th>Contact: </th>
				<th><input type="text" style="width:250px" id="emailaddress" value="'.$emailaddress.'"/></th>
			</thead>';

			echo '<thead>
				<th>Illness : </th>
				<th><input type="text" style="width:250px" id="illness" value="'.$illness.'"/></th>
			</thead>';
			
		
             echo '<thead>
				<th>Assign Practitioners: </th>
				<th>';
                
				echo '<select id="doctorid">';
				$rs1 = mysqli_query($db_connection,'SELECT doctorid,concat(medstaff,\' \',dfirstname,\' \',
													dlastname) as doctorname 
													from tbldoctor order by medstaff,dfirstname,dlastname
													');
				while ($rw1 = mysqli_fetch_array($rs1)) { $sel = '';
					if ($doctorid==$rw1['doctorid']) { $sel = 'selected="selected"'; }
					echo '<option value="'.$rw1['doctorid'].'" '.$sel.'>'.$rw1['doctorname'].'</option>';
				}
                
				echo '</select>';
			echo '

            <button onclick="addEditPatient('.$pid.');">';
			if ($pid) { echo 'Update'; } else { echo 'Add'; }
			echo '</th></button>
			</thead>';
			
		?>
		</table>
		&nbsp;
		<table width="80%" class="content-table" >
			<thead>
				<th>Last Name</th>
				<th>First Name</th>
				<th>Middle Name</th>
				<th>Sex</th>
                <th>Age</th>
				<th>Date of Birth</th>
				<th>Contact</th>
				<th>Illness</th>
                <th>Assigned Practitioners </th>
				<th>EDIT</th>
			</thead>
			<?Php  
			$rs = mysqli_query($db_connection,'select a.pid,a.lastname,a.firstname,a.illness,
											   a.middlename,a.sex,a.age,a.dateofbirth,
											   a.emailaddress, concat(medstaff,\' \',dfirstname,\' \',dlastname) as doctorname
												from tblpatient a, tbldoctor b
                                                where a.doctorid=b.doctorid');
			while ($rw = mysqli_fetch_array($rs)) {
				echo '<tr>
					<th>'.$rw['lastname'].'</th>
					<th>'.$rw['firstname'].'</th>
					<th>'.$rw['middlename'].'</th>
					<th>'.$rw['sex'].'</th>
                    <th>'.$rw['age'].'</th>
					<th>'.date('M d, Y',strtotime($rw['dateofbirth'])).'</th>
					<th>'.$rw['emailaddress'].'</th>
					<th>'.$rw['illness'].'</th>
                    <th>'.$rw['doctorname'].'</th>
					<th><a href="javascript:void()" onclick="loadPage(\'pages/patient.php?pid='.$rw['pid'].'\',\'content\');">EDIT</a></th>
				</tr>';
			} 
			?>
			
		</table>
		
		
	</div>

</div>