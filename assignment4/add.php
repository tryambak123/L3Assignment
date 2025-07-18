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
	<script>
	function enforceMinMax(el) {
	  if (el.value != "") {
		if (parseInt(el.value) < parseInt(el.min)) {
		  el.value = el.min;
		}
		if (parseInt(el.value) > parseInt(el.max)) {
		  el.value = el.max;
		}
	  }
	}
	
	function calculateTotal(el){
		total = total + Number(el.value);
		marks_sum = document.getElementById("marks_sum");
		marks_sum.value = total;
	}
	</script>
</head>
<body>
<h3><?php 
if(isset($_GET['msg'])){
	echo "Record added Successfully";
}
?></h3>
<form method="POST" style="margin-left:250px;">
	<table>
		<tr><th colspan="5" style="text-align:center">Enter Result</th></tr>
		<tr><td>Name</td><td><input type="text" name="name" required></td></tr>
		<tr><td>Sub1</td><td><input type="number" name="sub1" min="0" max="100" onkeyup="enforceMinMax(this)" onfocusout="calculateTotal(this)" required></td></tr>
		<tr><td>Sub2</td><td><input type="number" name="sub2"  min="0" max="100" onkeyup="enforceMinMax(this)" onfocusout="calculateTotal(this)" required></td></tr>
		<tr><td>Sub3</td><td><input type="number" name="sub3" min="0" max="100" onkeyup="enforceMinMax(this)" onfocusout="calculateTotal(this)" required></td></tr>
		<tr><td>Sub4</td><td><input type="number" name="sub4" min="0" max="100" onkeyup="enforceMinMax(this)" onfocusout="calculateTotal(this)" required></td></tr>
		<tr><td>Sub5</td><td><input type="number" name="sub5" min="0" max="100" onkeyup="enforceMinMax(this)" onfocusout="calculateTotal(this)" required></td></tr>
		<tr><td>Total</td><td><input type="number" name="total" min="0" max="500" id="marks_sum" onkeyup="enforceMinMax(this)" required></td></tr>
		<tr><td>Total Marks</td><td><input type="number" name="total_marks" value = "500" readonly></td></tr>
		<tr><td  colspan="5"><input type="submit" name="submit" value="submit"></td></tr>
	</table>
</form>
</body>
</htmL>

<?php 
if(isset($_POST['submit'])){
	$error = '';
	$name = trim($_POST['name']);
	$sub1 = trim($_POST['sub1']);
	$sub2 = trim($_POST['sub2']);
	$sub3 = trim($_POST['sub3']);
	$sub4 = trim($_POST['sub4']);
	$sub5 = trim($_POST['sub5']);
	$total = trim($_POST['total']);
	$total_marks = trim($_POST['total_marks']);
		
	if($error != null){
		header('Location: ' . $_SESSION['PHP_SELF'].'?error='.$error);
       	die();
	}else{		
		$statement = $connect->prepare("INSERT INTO class1(name,sub1,sub2,sub3,sub4,sub5,total,total_marks) values(?,?,?,?,?,?,?,?,?,?)");
		$statement->execute([$name, $sub1, $sub2, $sub3,$sub4, $sub5,$total,$total_marks]);
	
		header('Location:add.php?msg=success');
       	die();
	}
}
?>
