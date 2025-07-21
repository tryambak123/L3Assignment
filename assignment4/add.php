<?php
include('connect.php');
$statement = $connect->query("SELECT * FROM class1");
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
	.star{color:red;}
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
	
	function calculateTotal(el,total_marks=500){
		total = total + Number(el.value);
		marks_sum = document.getElementById("marks_sum");
		marks_sum.value = total;
		percentage = document.getElementById("percentage");
		percent = total/total_marks*100;
		percentage.value = percent;
	}
	</script>
</head>
<body>
<form method="POST" style="margin-left:250px;">
	<table>
		<tr><th colspan="5" style="text-align:center">Enter Result</th></tr>
		<tr><td>Name<span class="star">*</span></td><td><input type="text" name="name" required></td></tr>
		<tr><td>Sub1<span class="star">*</span></td><td><input type="number" name="sub1" min="0" max="100" onkeyup="enforceMinMax(this)" onfocusout="calculateTotal(this)" required></td></tr>
		<tr><td>Sub2<span class="star">*</span></td><td><input type="number" name="sub2"  min="0" max="100" onkeyup="enforceMinMax(this)" onfocusout="calculateTotal(this)" required></td></tr>
		<tr><td>Sub3<span class="star">*</span></td><td><input type="number" name="sub3" min="0" max="100" onkeyup="enforceMinMax(this)" onfocusout="calculateTotal(this)" required></td></tr>
		<tr><td>Sub4<span class="star">*</span></td><td><input type="number" name="sub4" min="0" max="100" onkeyup="enforceMinMax(this)" onfocusout="calculateTotal(this)" required></td></tr>
		<tr><td>Sub5<span class="star">*</span></td><td><input type="number" name="sub5" min="0" max="100" onkeyup="enforceMinMax(this)" onfocusout="calculateTotal(this)" required></td></tr>
		<tr><td>Total Obtained<span class="star">*</span></td><td><input type="number" name="total" min="0" max="500" id="marks_sum" onkeyup="enforceMinMax(this)" required></td></tr>
		<tr><td>Percentage<span class="star">*</span></td><td><input type="number" name="total" min="0" max="500" id="percentage" required></td></tr>
		<tr><td>Total Marks</td><td><input type="number" name="total_marks" value = "500"></td></tr>
		<tr><td  colspan="2"><input type="submit" name="submit" value="submit"></td></tr>
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
	$total_marks = trim($_POST['total_marks']);
	$total_obtained = $sub1 + $sub2 + $sub3 + $sub4 + $sub5;
	$percentage = $total_obtained/$total_marks *100;
	if($error != null){
		//header('Location: ' . $_SESSION['PHP_SELF'].'?error='.$error);
       	die('error');
	}else{		
		try{
			$statement = $connect->prepare("INSERT INTO class1(name,percent,sub1,sub2,sub3,sub4,sub5,total_obtained,total_marks) values(?,?,?,?,?,?,?,?,?)");
			$statement->execute([$name,$percentage,$sub1,$sub2,$sub3,$sub4,$sub5,$total_obtained,$total_marks]);
		
			header('Location:index.php?msg=add_success');
			die();
		}catch(Exception $e){
			die('Something went wrong:'.$e->getMessage());
		}
		
	}
}
?>
