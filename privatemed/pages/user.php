<?Php 

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }
$userid = $_GET['userid'];

//echo $_SERVER['REQUEST_URI'];
if (isset($_GET['userid']) && isset($_GET['user_name'])) {
	if ($_GET['userid']==0) { //Adding
		mysqli_query($db_connection,'INSERT INTO tbluser SET user_name=\''.
        urldecode($_GET['user_name']).'\',password=\''.
		urldecode($_GET['password']).'\',doctorid='.$_GET['doctorid']);
	} else { //Updating
		mysqli_query($db_connection,'UPDATE tbluser SET user_name=\''.
        urldecode($_GET['user_name']).'\',password=\''.
		urldecode($_GET['password']).'\',doctorid='.$_GET['doctorid'].'
        WHERE userid='.$userid);
	
	}	
}

$user_name = GetValue('select user_name from tbluser where userid='.$userid);
$password = GetValue('select password from tbluser where userid='.$userid);
$doctorid = GetValue('select doctorid from tbluser where userid='.$userid);


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
				<th>Doctor Name: </th>
				<th>';
				echo '<select id="doctorid">';
				$rs1 = mysqli_query($db_connection,'SELECT doctorid,
                                concat(medstaff,\' \',dfirstname,\' \',dlastname) as doctorname 
								from tbldoctor order by medstaff,dfirstname,dlastname');
                                while ($rw1 = mysqli_fetch_array($rs1)) { $sel = '';
                                    if ($doctorid==$rw1['doctorid']) { $sel = 'selected="selected"'; }
                                    echo '<option value="'.$rw1['doctorid'].'" '.$sel.'>'.$rw1['doctorname'].'</option>';
                                }

            echo '<thead>
				<th>Username: </th>
				<th><input type="text" style="width:250px" id="user_name" value="'.$user_name.'"/></th>
			</thead>';

			echo '<thead>
				<th>Password : </th>
				<th><input type="text" style="width:250px" id="password" value="'.$password.'"/> 
				<button onclick="addEditUser('.$userid.');">';
			if ($userid) { echo 'Update'; } else { echo 'Add'; }
			echo '</button></th>
			</thead>';
			
		?>

		</table>
		&nbsp;
		<table class="content-table" >
			<thead>
                <th>Doctor Name</th>
				<th>User Name</th>
                <th>Password</th>
				<th>EDIT</th>
			</thead>
			<?Php 
			$rs = mysqli_query($db_connection,'select a.userid,a.user_name,a.password,
            concat(medstaff,\' \',dfirstname,\' \',dlastname) as doctorname 
             from tbluser a, tbldoctor b
             where a.doctorid=b.doctorid');
			while ($rw = mysqli_fetch_array($rs)) {
				echo '<tr>
                    <th>'.$rw['doctorname'].'</th>
					<th>'.$rw['user_name'].'</th>
					<th>'.$rw['password'].'</th>
					<th><a href="javascript:void()" onclick="loadPage(\'pages/user.php?userid='.$rw['userid'].'\',\'content\');">EDIT</a></th>
				</tr>';
				
			}
			?>
			
		</table>
		
		
	</div>

</div>