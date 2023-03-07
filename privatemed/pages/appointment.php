<?Php 

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }
$appointment_id = $_GET['appointment_id'];

//echo $_SERVER['REQUEST_URI'];
if (isset($_GET['appointment_id']) && isset($_GET['time_and_date'])) {
	if ($_GET['appointment_id']==0) { //Adding
		mysqli_query($db_connection,'INSERT INTO tblappointment SET time_and_date=\''.
		urldecode($_GET['time_and_date']).'\',pid='.$_GET['pid']);
	} else { //Updating
		mysqli_query($db_connection,'UPDATE tblappointment SET time_and_date=\''.
		urldecode($_GET['time_and_date']).'\',pid='.$_GET['pid'].'
        WHERE appointment_id='.$appointment_id);
	
	}	
}

$time_and_date = GetValue('select time_and_date from tblappointment where appointment_id='.$appointment_id);
$pid = GetValue('select pid from tblappointment where appointment_id='.$appointment_id);


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
<div align="center" >
	<div>
		<table class="content-table" >
		<?Php 

           
			
			echo '<thead>
				<th >Patient Name: </th>
				<th>';
				
				echo '<select id="pid">';
                $rs1 = mysqli_query($db_connection,
                        'SELECT pid,concat(firstname,\' \',lastname) as patientname 
                        from tblpatient order by firstname,lastname
                ');     while ($rw1 = mysqli_fetch_array($rs1)) { $sel = '';
                        if ($pid==$rw1['pid']) { $sel = 'selected="selected"'; }
                        echo '<option value="'.$rw1['pid'].'" '.$sel.'>'.$rw1['patientname'].'</option>';
				}
				echo '</select>';
			echo '</thead>
			<thead>';

			echo '<thead>
            <th >Appointment: </th>
            <th ><input type="date" style="width:250px" id="time_and_date" value="'.$time_and_date.'"/> 
				<button class="btn btn-primary"onclick="addEditAppointment('.$appointment_id.');">';
			if ($appointment_id) { echo 'Update'; } else { echo 'Add'; }
			echo '</button></th>
			</thead>';
			
		?>
</table>
		&nbsp;

<table class="content-table" >
			<thead>
				<th >Patient Name</th>
                <th >Appointment Time</th>
				<th >EDIT</th>
			</thead>
			<?Php 
			$rs = mysqli_query($db_connection,'select a.appointment_id, a.time_and_date,
                                               concat(firstname,\' \',lastname) as patientname
			                                   from tblappointment a, tblpatient b 
			                                   where a.pid=b.pid');
                                               
			while ($rw = mysqli_fetch_array($rs)) {
				
				echo '<tr>
					<th>'.$rw['patientname'].'</th>
					<th>'.$rw['time_and_date'].'</th>
					<th><a  href="javascript:void()" onclick="loadPage(\'pages/appointment.php?appointment_id='.$rw['appointment_id'].'\',\'content\');">EDIT</a></th>
				</tr>';
				
			}
			?>
			
		</table>
		
		
	</div>

</div>