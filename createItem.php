<!DOCTYPE html>

<?php
	session_start();
	
	if (!$_SESSION['email']) {
		header("Location: index.php");
	}
?>
<html>
<head>
	<title>Create Item</title>
	<link rel="stylesheet" type="text.css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text.css" href="css/style.css">
</head>
<body>
	<?php
		include_once 'includes/dbconnect.php';
		$dbconn = pg_connect($connection) or die('Could not connect: ' . pg_last_error());
		
		/*echo '<h2>Create A New Item</h2>
			<form class="form-inline" role="form" method="post">
			<div class="dropdown">
				<button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">Item Type
				<span class="caret"></span></button>
				<ul class="item-type" id="item-type">
					<li><a href="#">Appliance</li>
					<li><a href="#">Tool</li>
					<li><a href="#">Furniture</li>
					<li><a href="#">Books</li>
				</ul>
			</div>
			</form>
				';*/
		echo '<h2>Create A New Item</h2>
			<form id="createForm" method="post" role="form" style"display: none;">
			<div class="form-group">
				<input type="text" name="itemName" id="itemName" class="form-control" placeholder="Item Name" value="">
			</div>
			<div class="form-group row">
				<label> Type of Item: </label>
				<select name="itemType" required>
					<option value="appliances">Appliance</option>
					<option value="tools">Tool</option>
					<option value="furniture">Furniture</option>
					<option value="books">Books</option>
					<option value="others">Others</option>
				</select>
				<label> Need to Pay: </label>
				<select name="fee" required>
					<option value=1>Yes</option>
					<option value=0>No</option>
				</select>
			</div>
			<div class="form-group">
				<label for="desc">Description</label>
				<textarea name="itemDesc" id="itemDesc" form="createForm" maxlength="100" placeholder="No more than 100 characters"></textarea>
			</div>
			<div class="form-group">
				<label>Pick-Up Point</label>
				<input type="text" name="pickUp" id="pickUp" class="form-control" placeholder="Pick-Up Point" value="">
			</div>
			<div class="form-group">
				<label>Return Location</label>
				<input type="text" name="retL" id="retL" class="form-control" placeholder="Return Point" value="">
			</div>
			<div class="form-group">
				<input type="file" name="imagefile" accept="image/*" id="imagefile">
			</div>
			<div class="form-group">
				<input type="submit" name="itemSubmit" id="itemSubmit" class="form-control btn btn-success" value="Submit">
			</div>
			</form>'
			
		if (isset($_POST[Submit])) {
			$itemName = $_POST['itemName'];
			$itemType = $_POST['itemType'];
			$feeFlag = $_POST['fee'];
			$itemDesc = $_POST['itemDesc'];
			$itemImg = $_POST['imagefile'];
			$itemID = mt_rand(0,0xffffff);
			$today = getdate();
			$pickUp = $_POST['pickUp'];
			$retL = $_POST['retL'];
		}
		
		$query = 'INSERT INTO item (email, type, itemID, feeFlag, itemName, pickupLocation, returnLocation, availableDate, description, availabilityFlag)
					VALUES ('{$_SESSION['email']}', '$itemType', '$itemID', '$feeFlag', '$itemName', '$pickUp', '$retL', '$today', '$itemDesc', 0)';
		if (pg_result_status($query) = PGSQL_FATAL_ERROR) {
			$qquery = "CREATE TABLE item (
						email VARCHAR(64) REFERENCES member(email),
						type CHAR(10) CHECK(type='tools' OR type='appliances' OR type='furnitures' OR type='books'),
						itemID INT PRIMARY KEY,
						feeFlag BIT NOT NULL,
						itemName VARCHAR(256) NOT NULL,
						pickupLocation VARCHAR(256) NOT NULL,
						returnLocation VARCHAR(256) NOT NULL,
						availableDate DATE NOT NULL,
						description VARCHAR(256),
						availablityFlag BIT NOT NULL
						)";
			pg_query($qquery);
		}
		else {
			
			while ()
			pg_query($query);
		}
		
	?>	
			
</body>