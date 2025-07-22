<?php
include('connect.php');?>
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
	// Function to enforce minimum and maximum values for input fields
	function enforceMinMax(el) {
	  if (el.value != "") {
		// If the value is less than the minimum, set it to the minimum
		if (parseInt(el.value) < parseInt(el.min)) {
		  el.value = el.min;
		}
		// If the value is greater than the maximum, set it to the maximum
		if (parseInt(el.value) > parseInt(el.max)) {
		  el.value = el.max;
		}
	  }
	}
	
	// Function to calculate the total marks and percentage
	function calculateTotal(el, total_marks = 500) {
		// Add the current input value to the total
		total = total + Number(el.value);
		
		// Update the total marks field
		marks_sum = document.getElementById("marks_sum");
		marks_sum.value = total;
		
		// Calculate the percentage based on total marks
		percentage = document.getElementById("percentage");
		percent = total / total_marks * 100;
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
		<tr><td>Percentage<span class="star">*</span></td><td><input type="number" name="percent" min="0" max="500" id="percentage" required></td></tr>
		<tr><td>Total Marks</td><td><input type="number" name="total_marks" value = "500"></td></tr>
		<tr><td  colspan="2"><input type="submit" name="submit" value="submit"></td></tr>
	</table>
</form>
</body>
</htmL>

<?php 
if(isset($_POST['submit'])){
	// Initialize an error variable
	$error = '';
	
	// Retrieve and trim input values from the form
	$name = trim($_POST['name']);
	$sub1 = trim($_POST['sub1']);
	$sub2 = trim($_POST['sub2']);
	$sub3 = trim($_POST['sub3']);
	$sub4 = trim($_POST['sub4']);
	$sub5 = trim($_POST['sub5']);
	$total_marks = trim($_POST['total_marks']);
	
	// Calculate total obtained marks and percentage
	$total_obtained = $sub1 + $sub2 + $sub3 + $sub4 + $sub5;
	$percentage = $total_obtained / $total_marks * 100;
	
	// Check for any errors (currently unused)
	if($error != null){
		// Redirect to the same page with an error message
		// header('Location: ' . $_SESSION['PHP_SELF'].'?error='.$error);
		die('error');
	}else{		
		try{
			// Prepare an SQL statement to insert the data into the database
			$statement = $connect->prepare("INSERT INTO class1(name,percent,sub1,sub2,sub3,sub4,sub5,total_obtained,total_marks) values(?,?,?,?,?,?,?,?,?)");
			
			// Execute the prepared statement with the form data
			$statement->execute([$name, $percentage, $sub1, $sub2, $sub3, $sub4, $sub5, $total_obtained, $total_marks]);
		
			// Redirect to the index page with a success message
			header('Location:index.php?msg=add_success');
			die();
		}catch(Exception $e){
			// Handle any exceptions and display an error message
			die('Something went wrong:'.$e->getMessage());
		}
	}
}
?>
