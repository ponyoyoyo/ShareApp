<!DOCTYPE html>

<?php
	session_start();
	
	if (!$session['email']) {
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
			<div class="form-group">
				<select name="itemType">
					<option value="appliances">Appliance</option>
					<option value="tools">Tool</option>
					<option value="furniture">Furniture</option>
					<option value="books">Books</option>
				</select>
			</div>
			<div class="form-group">
				<label for="desc">Description</label>
				<textarea name="desc" id="desc" form="createForm" maxlength="100" placeholder="No more than 100 characters"></textarea>
			</div>
			</form>'
			
		if (isset($_POST[Submit])) {
			$itemType = $_POST['itemType'];
		}
			
</body>