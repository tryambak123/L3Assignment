<?php
include('connect.php');

$movieid = $_GET['movieid'];

$statement = $connect->prepare("SELECT * from movies where movieid = ?");
$statement->execute([$movieid]);
$res = $statement->fetch(PDO::FETCH_ASSOC);
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
<h3><?php 
if(isset($_GET['error'])){
	$error = $_GET['error'];
	if($error == 'name_error'){
		echo 'Enter name';
	}elseif($error == 'dir_error') {
		echo 'Enter director';
	}elseif($error == 'lead_error') {
		echo 'Enter Lead Actor';
	}elseif($error == 'coll_error') {
		echo 'Enter Box office collection';
	}
}
?></h3>
<form method="POST" style="margin-left:250px;">
	<table>
		<tr><td colspan="2" style="text-align:center">Add Movie</td></tr>
		<input type="hidden" name="movieid" value ="<?php echo $res['movieid']?>">
		<tr><td>Name</td><td><input type="text" name="moviename" value ="<?php echo $res['moviename']?>"></td></tr>
		<tr><td>Director</td><td><input type="text" name="movieDirector" value ="<?php echo $res['movieDirector']?>"></td></tr>
		<tr><td>Lead Actor</td><td><input type="text" name="LeadActor" value ="<?php echo $res['leadActor']?>"></td></tr>
		<tr><td>BO Collection</td><td><input type="text" name="BOCollection" value ="<?php echo $res['BOCollection']?>"></td></tr>
		<tr><td colspan="2" style="text-align:right"><input type="submit" name="submit" value="submit"></td></tr>
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
	$movieid = $_POST['movieid'];
	
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
		$statement = $connect->prepare("UPDATE movies SET moviename = ?, movieDirector = ?, leadActor = ?, BOCollection = ? WHERE movieid = ?");
		$statement->execute([$movie_name, $movie_dir, $lead, $collection, $movieid]);
	
		header('Location:index.php?msg=upd_success');
       	die();
	}
}
?>
