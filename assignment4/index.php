<?php
include('connect.php');
if(isset($_GET['msg'])){
	if($_GET['msg'] == 'upd_success'){
		echo "<h3>Record updated successfully</h3>";
	}elseif($_GET['msg'] == 'add_success'){
		echo "<h3>Record added successfully</h3>";
	}
}
$statement = $connect->query("SELECT * FROM class1");
?>
<html>
<head>
	<title>Assignment 3</title>
	<style>
	table, th, td {
	  border: 1px solid black;
	  border-collapse: collapse;
	  width:90%;
	}
	</style>
</head>
<body>
	<table>
		<thead>
		<tr>
			<th colspan="8" style="text-align:center;">List of students</th>
			<th colspan="1" style="text-align:right;"><a href="add.php">Add new Record</a></th>
		</tr>
		<tr>
			<th style="width:5%;">Sl</th>
			<th style="width:25%;">Name</th>
			<th style="width:10%;">Sub1</th>
			<th style="width:10%;">Sub2</th>
			<th style="width:10%;">Sub3</th>
			<th style="width:10%;">Sub4</th>
			<th style="width:10%;">Sub5</th>
			<th style="width:10%;">Obtained</th>
			<th style="width:10%;">Percentage</th>
			<th style="width:10%;"></th>
			</tr>
		</thead>
		<tbody><?php
		$i = 1;
		while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {?>
			<tr>
				<td style="width:10%;"><?php echo $i++?></td>
				<td style="width:15%;"><?php echo $row['name']?></td>
				<td style="width:15%;"><?php echo $row['sub1']?></td>
				<td style="width:15%;"><?php echo $row['sub2']?></td>
				<td style="width:15%;"><?php echo $row['sub3']?></td>
				<td style="width:15%;"><?php echo $row['sub4']?></td>
				<td style="width:15%;"><?php echo $row['sub5']?></td>
				<td style="width:15%;"><?php echo $row['total_obtained']?></td>
				<td style="width:15%;"><?php echo $row['percent']?></td>
				<td style="width:10%;"><a href="update.php?id=<?php echo $row['id']?>">Edit</a></td>
			</tr><?php
		}?>
		</tbody>
	</table>
</body>