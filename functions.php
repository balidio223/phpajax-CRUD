
<?php
	
	if(isset($_POST['action']) && !empty($_POST['action']))
	{

		$action = $_POST['action'];
		switch ($action) {
			case 'addData':
				addData();
				break;
			case 'showData':
				showData();
				break;
			case 'deleteData':
				deleteData();
				break;
			case 'showUpdateData':
				showUpdateData();
				break;
			case 'updateData':
				updateData();
				break;
			default:
				# code...
				break;
		}
	}

	function showData()
	{
		include('conn.php');

		$stmt = $con->prepare("SELECT * FROM names ORDER BY id DESC");
		$stmt->execute();
		$result = $stmt->get_result();
		$rows = $result->num_rows;


		if($rows < 1)
		{
			echo '<tr>';
			echo '<td colspan = "4" style = "text-align:center;">No results found.</td>';
			echo '</tr>';
		}
		while($row = $result->fetch_object())
		{
			echo '<tr>';
			echo '<td>'.$row->firstname.'</td>';
			echo '<td>'.$row->middlename.'</td>';
			echo '<td>'.$row->lastname.'</td>';
			echo '<td><button type="button" title = "Edit" class = "btn btn-primary btn-test" onclick = "updateData('.$row->id.')"><span class = "glyphicon glyphicon-edit"></span></button> <button class = "btn btn-danger" title = "Delete" onclick = "deleteData('.$row->id.')"><span class = "glyphicon glyphicon-trash"></span></button></td>';
			echo '</tr>';
	
		}
		
	}

	function addData()
	{
		include('conn.php');

		$fname = $_POST['fname'];
		$mname = $_POST['mname'];
		$lname = $_POST['lname'];

		$stmt = $con->prepare("INSERT INTO names (firstname , middlename, lastname) values ( ? , ? , ?)");
		$stmt->bind_param('sss', $fname, $mname, $lname);
		$stmt->execute();

		showData();
	}

	
?>

<?php
	function deleteData()
	{
		include('conn.php');

		$id = $_POST['id'];

		$stmt = $con->prepare("DELETE FROM names WHERE id = ?");
		$stmt->bind_param('i', $id);
		$stmt->execute();

		showData();
	}	

	function showUpdateData()
	{
		include('conn.php');

		$id = $_POST['id'];

		$stmt = $con->prepare("SELECT * FROM names WHERE id = ?");
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_object();
		echo json_encode(array("fname" => $row->firstname, "mname" => $row->middlename, "lname" => $row->lastname ));

	}
	function updateData()
    {
        include('conn.php');

        $fname = $_POST['u_fname'];
        $mname = $_POST['u_mname'];
        $lname = $_POST['u_lname'];
        $id = $_POST['u_id'];

        $stmt = $con->prepare("UPDATE names SET firstname = ?, middlename = ?, lastname = ? WHERE id = ?");
        $stmt->bind_param('sssi', $fname, $mname, $lname, $id);
        $stmt->execute();

        showData();
    }
?>
