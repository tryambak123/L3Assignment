<?php
include('connect.php');

$id = $_GET['id'];

$statement = $connect->prepare("SELECT * from class1 where id = ?");
$statement->execute([$id]);
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
		<tr><td  colspan="2"><input type="submit" name="submit" value="submit"></td></tr>
	</table>
</form>
</body>
</htmL>

<?php 
if(isset($_POST['submit'])){
	$error = '';
	$id = $_POST['id'];
	$name = trim($_POST['name']);
	$sub1 = trim($_POST['sub1']);
	$sub2 = trim($_POST['sub2']);
	$sub3 = trim($_POST['sub3']);
	$sub4 = trim($_POST['sub4']);
	$sub5 = trim($_POST['sub5']);
	$total_marks = trim($_POST['total_marks']);
	$total_obtained = $sub1 + $sub2 + $sub3 + $sub4 + $sub5;
	$percentage = $total_obtained/$total_marks *100;
	
	if($error != null){
		header('Location: ' . $_SESSION['PHP_SELF'].'?error='.$error);
       	die();
	}else{	
		try{
			$statement = $connect->prepare("UPDATE class1 SET name = ?, sub1 = ?, sub2 = ?, sub3 = ?, sub4 = ?, sub5 = ?, total_obtained = ?, total_marks = ?, percent = ? WHERE id = ?");
			$statement->execute([$name, $sub1, $sub2, $sub3, $sub4, $sub5,$total_obtained,$total_marks,$percentage,$id]);
		
			header('Location:index.php?msg=upd_success');
			die();
		}catch(Exception $e){
			die('Something went wrong:'.$e->getMessage());
		}
	}
}
?>
