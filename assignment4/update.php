<?php
// Start of the PHP script
// This script handles the update functionality for the class1 table in the database
include('connect.php'); // Include the database connection file

$id = $_GET['id']; // Get the ID of the record to be updated from the URL

// Prepare and execute a query to fetch the record with the given ID
$statement = $connect->prepare("SELECT * from class1 where id = ?");
$statement->execute([$id]);
$res = $statement->fetch(PDO::FETCH_ASSOC); // Fetch the record as an associative array

?>

<html>
<head>
	<title>Assignment 4</title>
	<style>
	table, th, td {
	  border: 1px solid black;
	  border-collapse: collapse;
	  width:50%;
	}
	</style>
</head>
<body>

<form method="POST" style="margin-left:250px;">
	<table>
		<tr><th colspan="5" style="text-align:center">Update Result</th></tr>
		<input type="hidden" name="id" value ="<?php echo $res['id']?>">
		<tr><td>Name<span class="star">*</span></td><td><input type="text" name="name" value="<?php echo $res['name']?>" required></td></tr>
		<tr><td>Sub1<span class="star">*</span></td><td><input type="number" name="sub1" value="<?php echo $res['sub1']?>" min="0" max="100" onkeyup="enforceMinMax(this)" onfocusout="calculateTotal(this)" required></td></tr>
		<tr><td>Sub2<span class="star">*</span></td><td><input type="number" name="sub2" value="<?php echo $res['sub2']?>" min="0" max="100" onkeyup="enforceMinMax(this)" onfocusout="calculateTotal(this)" required></td></tr>
		<tr><td>Sub3<span class="star">*</span></td><td><input type="number" name="sub3" value="<?php echo $res['sub3']?>" min="0" max="100" onkeyup="enforceMinMax(this)" onfocusout="calculateTotal(this)" required></td></tr>
		<tr><td>Sub4<span class="star">*</span></td><td><input type="number" name="sub4" value="<?php echo $res['sub4']?>" min="0" max="100" onkeyup="enforceMinMax(this)" onfocusout="calculateTotal(this)" required></td></tr>
		<tr><td>Sub5<span class="star">*</span></td><td><input type="number" name="sub5" value="<?php echo $res['sub5']?>" min="0" max="100" onkeyup="enforceMinMax(this)" onfocusout="calculateTotal(this)" required></td></tr>
		<tr><td>Total Obtained<span class="star">*</span></td><td><input type="number" name="total" value="<?php echo $res['total_obtained']?>" min="0" max="500" id="marks_sum" onkeyup="enforceMinMax(this)" required></td></tr>
		<tr><td>Percentage<span class="star">*</span></td><td><input type="number" name="percent" value="<?php echo $res['percent']?>" min="0" max="500" id="percentage" required></td></tr>
		<tr><td>Total Marks</td><td><input type="number" name="total_marks" value = "500"></td></tr>
		<tr><td colspan="2">
				<div style="float:left"><input type="submit" name="submit" value="submit"></div>
				<div style="float:left"><a href="index.php">Cancel</a></div>
			</td>
		</tr>
	</table>
</form>
</body>
</htmL>

<?php 
// Check if the form has been submitted
if (isset($_POST['submit'])) {
	$error = ''; // Initialize an error variable
	$id = $_POST['id']; // Get the ID of the record to be updated
	$name = trim($_POST['name']); // Get and trim the name input
	$sub1 = trim($_POST['sub1']); // Get and trim the marks for subject 1
	$sub2 = trim($_POST['sub2']); // Get and trim the marks for subject 2
	$sub3 = trim($_POST['sub3']); // Get and trim the marks for subject 3
	$sub4 = trim($_POST['sub4']); // Get and trim the marks for subject 4
	$sub5 = trim($_POST['sub5']); // Get and trim the marks for subject 5
	$total_marks = trim($_POST['total_marks']); // Get and trim the total marks input

	// Calculate the total marks obtained and percentage
	$total_obtained = $sub1 + $sub2 + $sub3 + $sub4 + $sub5;
	$percentage = $total_obtained / $total_marks * 100;

	try {
		// Prepare an SQL statement to update the record in the database
		$statement = $connect->prepare("UPDATE class1 SET name = ?, sub1 = ?, sub2 = ?, sub3 = ?, sub4 = ?, sub5 = ?, total_obtained = ?, total_marks = ?, percent = ? WHERE id = ?");
		
		// Execute the statement with the provided values
		$statement->execute([$name, $sub1, $sub2, $sub3, $sub4, $sub5, $total_obtained, $total_marks, $percentage, $id]);
		
		// Redirect to the index page with a success message
		header('Location:index.php?msg=upd_success');
		die();
	} catch (Exception $e) {
		// Handle any exceptions and display an error message
		die('Something went wrong:' . $e->getMessage());
	}
}
?>
