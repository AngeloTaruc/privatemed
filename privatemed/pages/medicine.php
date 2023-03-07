<?Php 

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }
$mid = $_GET['mid'];

//echo $_SERVER['REQUEST_URI'];
if (isset($_GET['mid']) && isset($_GET['medicinename'])) {
	if ($_GET['mid']==0) { //Adding
		mysqli_query($db_connection,'INSERT INTO tblmedicine SET medicinename=\''.
		urldecode($_GET['medicinename']).'\'');
	} else { //Updating
		mysqli_query($db_connection,'UPDATE tblmedicine SET medicinename=\''.
		urldecode($_GET['medicinename']).'\'
		WHERE mid='.$mid);
	
	}	
}

$medicinename = GetValue('select medicinename from tblmedicine where mid='.$mid);

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
				<th>Medicine Name: </th>
				<th><input type="text" style="width:250px" id="medicinename" value="'.$medicinename.'"/> 
				<button onclick="addEditMedicine('.$mid.');">';
			if ($mid) { echo 'Update'; } else { echo 'Add'; }
			echo '</button></th>
			</thead>';
			
		?>
		</table>
		&nbsp;
		<table class="content-table" >
			<thead>
				<th>Medicine Name</th>
				<th>EDIT</th>
			</thead>
			<?Php 
			$rs = mysqli_query($db_connection,'select * from tblmedicine');
			while ($rw = mysqli_fetch_array($rs)) {
				echo '<tr>
					<th>'.$rw['medicinename'].'</th>
					<th><a href="javascript:void()" onclick="loadPage(\'pages/medicine.php?mid='.$rw['mid'].'\',\'content\');">EDIT</a></td>
				</tr>';
				
			}
			?>
			
		</table>
		
		
	</div>

</div>