<?Php 

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }
$phid = $_GET['phid'];

//echo $_SERVER['REQUEST_URI'];
if (isset($_GET['phid']) && isset($_GET['result_of_diagnosis'])) {
	if ($_GET['phid']==0) { //Adding
		mysqli_query($db_connection,'INSERT INTO tblpatient_history SET result_of_diagnosis=\''.
		urldecode($_GET['result_of_diagnosis']).'\',appointment_id=\''.
		urldecode($_GET['appointment_id']).'\',pid='.$_GET['pid']);
	} else { //Updating
		mysqli_query($db_connection,'UPDATE tblpatient_history SET result_of_diagnosis=\''.
		urldecode($_GET['result_of_diagnosis']).'\',appointment_id=\''.
		urldecode($_GET['appointment_id']).'\',pid='.$_GET['pid'].'
        WHERE phid='.$phid);
	
	}	
}

$result_of_diagnosis = GetValue('select result_of_diagnosis from tblpatient_history where phid='.$phid);
$pid = GetValue('select pid from tblpatient_history where phid='.$phid);
$appointment_id = GetValue('select appointment_id from tblpatient_history where phid='.$phid);


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
            <th>patient Name: </th>
            <th>';
			echo '<select id="pid">';
            $rs1 = mysqli_query($db_connection,'SELECT pid,concat(firstname,\' \',
													lastname) as patientname 
													from tblpatient order by firstname,lastname
													');
            while ($rw1 = mysqli_fetch_array($rs1)) { $sel = '';
                if ($pid==$rw1['pid']) { $sel = 'selected="selected"'; }
                echo '<option value="'.$rw1['pid'].'" '.$sel.'>'.$rw1['patientname'].'</option>';
            }
            echo '</select>';
        echo '</thead>
        <thead>';
        echo '<thead>
        <th>Illness: </th>
        <th>';
				echo '<select id="pid">';
				$rs1 = mysqli_query($db_connection,'SELECT pid,illness from tblpatient order by illness');
				while ($rw1 = mysqli_fetch_array($rs1)) { $sel = '';
					if ($pid==$rw1['pid']) { $sel = 'selected="selected"'; }
					echo '<option value="'.$rw1['pid'].'" '.$sel.'>'.$rw1['illness'].'</option>';
				}
                
				echo '</select>';

				echo '<thead>
				<th>Appointment History: </th>
				<th>';
				echo '<select id="appointment_id">';
				$rs1 = mysqli_query($db_connection,'SELECT appointment_id,time_and_date
													from tblappointment');
				while ($rw1 = mysqli_fetch_array($rs1)) { $sel = '';
					if ($appointment_id==$rw1['appointment_id']) { $sel = 'selected="selected"'; }
					echo '<option value="'.$rw1['appointment_id'].'" '.$sel.'>'.$rw1['time_and_date'].'</option>';
					
				}
                
			echo '<thead>
            <th>Result of diagnosis: </th>
            <th><input type="text" style="width:250px" id="result_of_diagnosis" value="'.$result_of_diagnosis.'"/> 
            <button onclick="addEditPatient_history('.$phid.');">';

			
        if ($phid) { echo 'Update'; } else { echo 'Add'; }
        echo '</button></th>
        </thead>';
			
		?>
		</table>
		&nbsp;
		<table class="content-table" >
			<thead>
				<th>Patient Name</th>
                <th>Illness</th>
				<th>Appointment History</th>
				<th>Result Of Medical Test</th>
                <th>EDIT</th>
			</thead>

			<?Php 
			$rs = mysqli_query($db_connection,'select a.phid,a.result_of_diagnosis,b.illness,c.time_and_date,
            concat(firstname,\' \',lastname) as patientname
             from tblpatient_history a, tblpatient b, tblappointment c
			 where a.pid=b.pid and c.appointment_id=a.appointment_id');
			while ($rw = mysqli_fetch_array($rs)) {

				echo '<tr>
					<th>'.$rw['patientname'].'</th>
					<th>'.$rw['illness'].'</th>
					<th>'.$rw['time_and_date'].'</th>
                    <th>'.$rw['result_of_diagnosis'].'</th>
					<th><a href="javascript:void()" onclick="loadPage(\'pages/patienthistory.php?phid='.$rw['phid'].'\',\'content\');">EDIT</a></th>
				</tr>';
				
			}
			?>
			
		</table>
		
		
	</div>

</div>