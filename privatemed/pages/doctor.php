<?Php 

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }
$doctorid = $_GET['doctorid'];

//echo $_SERVER['REQUEST_URI']; studentnumber, lastname, firstname, middlename, sex, emailaddress

if (isset($_GET['doctorid']) && isset($_GET['dlastname'])) {
	if ($_GET['doctorid']==0) { //Adding
		mysqli_query($db_connection,'INSERT INTO tbldoctor SET dlastname=\''.
									 urldecode($_GET['dlastname']).'\',dfirstname=\''.
									 urldecode($_GET['dfirstname']).'\',middlename=\''.
									 urldecode($_GET['middlename']).'\',sex=\''.
									 urldecode($_GET['sex']).'\',emailaddress=\''.
									 urldecode($_GET['emailaddress']).'\',medstaff=\''.
									 urldecode($_GET['medstaff']).'\'');
	} else { //Updating
		mysqli_query($db_connection,'UPDATE tbldoctor SET dlastname=\''.
									 urldecode($_GET['dlastname']).'\',dfirstname=\''.
									 urldecode($_GET['dfirstname']).'\',middlename=\''.
									 urldecode($_GET['middlename']).'\',sex=\''.
									 urldecode($_GET['sex']).'\',emailaddress=\''.
									 urldecode($_GET['emailaddress']).'\',medstaff=\''.
									 urldecode($_GET['medstaff']).'\' 
									 WHERE doctorid='.$_GET['doctorid']);
	
	}	
}

$dlastname = GetValue('select dlastname from tbldoctor where doctorid='.$doctorid);
$dfirstname = GetValue('select dfirstname from tbldoctor where doctorid='.$doctorid);
$middlename = GetValue('select middlename from tbldoctor where doctorid='.$doctorid);
$sex = GetValue('select sex from tbldoctor where doctorid='.$doctorid);
$emailaddress = GetValue('select emailaddress from tbldoctor where doctorid='.$doctorid);
$medstaff = GetValue('select medstaff from tbldoctor where doctorid='.$doctorid);


?>

<style>
	.content-table thead tr {
    background-color: #72d4cb;
    color: #ffffff;
    text-align: left;
    font-weight: bold;
}

.content-table th,
.content-table td {
    padding: 12px 15px;
}

.content-table tbody tr {
    border-bottom: 1px solid #dddddd;
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
				<th><input type="text" style="width:250px" id="dlastname" value="'.$dlastname.'"/></th>
			<thead>';
			echo '<thead>
				<th>First Name: </th>
				<th><input type="text" style="width:250px" id="dfirstname" value="'.$dfirstname.'"/></th>
			<thead>';
			echo '<thead>
				<th>Middle Initial: </th>
				<th><input type="text" style="width:250px" id="middlename" value="'.$middlename.'"/></th>
			<thead>';
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
				<th>Email Address: </th>
				<th><input style="width:250px" id="emailaddress" value="'.$emailaddress.'"/> 

				<thead>';
				echo '<tr>
				<th>Profession: </th>
				<th><input style="width:250px" id="medstaff" value="'.$medstaff.'"/>
				<button onclick="addEditDoctor('.$doctorid.');">';
			if ($doctorid) { echo 'Update'; } else { echo 'Add'; }
			echo '</button></th>
			<tr>';
			
			
		?>
</table>
		&nbsp;
		<table class="content-table" >
			<thead>
				<th>Last Name</th>
				<th>First Name</th>
				<th>Middle initial</th>
				<th>Sex</th>
				<th>Email Address</th>
				<th>Profession</th>
				<th>EDIT</th>
			</thead>
			<?Php  
			$rs = mysqli_query($db_connection,'select doctorid,dlastname,dfirstname,
			middlename,sex,emailaddress,medstaff
			from tbldoctor');                      
			while ($rw = mysqli_fetch_array($rs)) {
				echo '<tr>
					<th>'.$rw['dlastname'].'</th>
					<th>'.$rw['dfirstname'].'</th>
					<th>'.$rw['middlename'].'</th>
					<th>'.$rw['sex'].'</th>
					<th>'.$rw['emailaddress'].'</th>
					<th>'.$rw['medstaff'].'</th>
					<th><a href="javascript:void()" onclick="loadPage(\'pages/doctor.php?doctorid='.$rw['doctorid'].'\',\'content\');">EDIT</a></th>
				</tr>';
			} 
			?>
			
		</table>
		
		
	</div>

</div>