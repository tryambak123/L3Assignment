<?php
include('connect.php');
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
		<tr><th colspan="5" style="text-align:center">Enter Result</th></tr>
		<tr><td>Name</td><td><input type="text" name="name" required></td></tr>
		<tr><td>Sub1</td><td><input type="number" name="sub1" min="0" max="100" required></td></tr>
		<tr><td>Sub2</td><td><input type="number" name="sub2" required></td></tr>
		<tr><td>Sub3</td><td><input type="number" name="sub3" required></td></tr>
		<tr><td>Sub4</td><td><input type="number" name="sub4" required></td></tr>
		<tr><td>Sub5</td><td><input type="number" name="sub5" required></td></tr>
		<tr><td>Total</td><td><input type="number" name="total" required></td></tr>
		<tr><td>Total Marks</td><td><input type="number" name="total_marks" required></td></tr>
		<tr><td  colspan="5"><input type="submit" name="submit" value="submit"></td></tr>
	</table>
</form>
</body>
</htmL>

<?php 
if(isset($_POST['submit'])){
	$error = '';
	$movie_name = trim($_POST['moviename']);
	$movie_dir = trim($_POST['movieDirector']);
	$lead = trim($_POST['LeadActor']);	
	$collection = $_POST['BOCollection'];
	
	if(trim($_POST['moviename']) == NULL){
		$error = "name_error";
	}elseif(trim($_POST['movieDirector']) == NULL){
		$error = "dir_error";
	}elseif(trim($_POST['LeadActor']) == NULL){
		$error = "lead_error";
	}elseif(is_nan($collection)){
		$error = "coll_error";
	}
	
	if($error != null){
		header('Location: ' . $_SESSION['PHP_SELF'].'?error='.$error);
       	die();
	}else{		
		$statement = $connect->prepare("INSERT INTO movies(moviename,movieDirector,leadActor,BOCollection) values(?,?,?,?)");
		$statement->execute([$movie_name, $movie_dir, $lead, $collection]);
	
		header('Location:index.php?msg=success');
       	die();
	}
}
?>
