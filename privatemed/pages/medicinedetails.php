<?Php 

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }
$mdid = $_GET['mdid'];

//echo $_SERVER['REQUEST_URI'];
if (isset($_GET['mdid']) && isset($_GET['med_quantity'])) {
	if ($_GET['mdid']==0) { //Adding
		mysqli_query($db_connection,'INSERT INTO tblmedicine_details SET med_quantity=\''.
		urldecode($_GET['med_quantity']).'\',mid='.$_GET['mid']);
	} else { //Updating
		mysqli_query($db_connection,'UPDATE tblmedicine_details SET med_quantity=\''.
		urldecode($_GET['med_quantity']).'\',mid='.$_GET['mid'].'
        WHERE mdid='.$mdid);
	
	}	
}

$med_quantity = GetValue('select med_quantity from tblmedicine_details where mdid='.$mdid);
$mid = GetValue('select mid from tblmedicine_details where mdid='.$mdid);


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
				<th>';
				
				echo '<select id="mid">';
				$rs1 = mysqli_query($db_connection,'SELECT mid,medicinename from tblmedicine order by medicinename');
				while ($rw1 = mysqli_fetch_array($rs1)) { $sel = '';
					if ($mid==$rw1['mid']) { $sel = 'selected="selected"'; }
					echo '<option value="'.$rw1['mid'].'" '.$sel.'>'.$rw1['medicinename'].'</option>';
				}
				echo '</select>';
			echo '</th>
			<tr>';

			echo '<tr>
				<th>Medicine Quantity: </th>
				<th><input type="text" style="width:250px" id="med_quantity" value="'.$med_quantity.'"/> 
				<button onclick="addEditMedicine_details('.$mdid.');">';
			if ($mdid) { echo 'Update'; } else { echo 'Add'; }
			echo '</button></th>
			</thead>';
			
		?>
		</table>
		&nbsp;
		<table class="content-table" >
			<thead>
				<th>Medicine Name</th>
                <th>Medicine Quantity</th>
				<th>EDIT</th>
			</thead>
			<?Php 
			$rs = mysqli_query($db_connection,'select a.mdid,a.med_quantity,b.medicinename
			from tblmedicine_details a, tblmedicine b 
			where a.mid=b.mid');
			while ($rw = mysqli_fetch_array($rs)) {
				echo '<tr>
					<th>'.$rw['medicinename'].'</th>
					<th>'.$rw['med_quantity'].'</th>
					<th><a href="javascript:void()" onclick="loadPage(\'pages/medicinedetails.php?mdid='.$rw['mdid'].'\',\'content\');">EDIT</a></th>
				</tr>';
				
			}
			?>
			
		</table>
		
		
	</div>

</div>