<!DOCTYPE html>
<html>
	<header>
		<title>Bidding Page</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/biddingpage.css">
	</header>
	<body>
		<?php 
			include_once 'includes/dbconnect.php';
			$dbconn = pg_connect($connection) or die('Could not connect: ' . pg_last_error());


	        $queryappliances = "SELECT i.itemname, i.availabledate, i.description FROM item i WHERE i.type = 'appliances'"; 
	        $querytools = "SELECT i.itemname, i.availabledate, i.description FROM item i WHERE i.type = 'tools'";
	        $queryfurnitures = "SELECT i.itemname, i.availabledate, i.description FROM item i WHERE i.type = 'furnitures'";
	        $querybooks = "SELECT i.itemname, i.availabledate, i.description FROM item i WHERE i.type = 'books'";

	        $result_appliances = pg_query($queryappliances); 
	        $result_tools = pg_query($querytools); 
	        $result_furnitures = pg_query($queryfurnitures); 
	        $result_books = pg_query($querybooks); 
			$i = 0;

			echo ' <div class="container">
				   <div class="row">

			       <section class="content">
			       <h1>Items up for bidding</h1>
			       <div class="col-md-8 col-md-offset-2">
				   <div class="panel panel-default">
					  <div class="panel-body">
						<div class="pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-success btn-filter" data-target="tools">Tools</button>
								<button type="button" class="btn btn-warning btn-filter" data-target="appliances">Appliances</button>
								<button type="button" class="btn btn-danger btn-filter" data-target="furnitures">Furniture</button>
								<button type="button" class="btn btn-primary btn-filter" data-target="books">Books</button>
								<button type="button" class="btn btn-default btn-filter" data-target="all">All</button>
							</div>
						</div>
						<div class="table-container">
						<table class="table table-filter">
						<tbody>';

			//fetch all tools
			$count = 0;
			while ($row = pg_fetch_assoc($result_tools)) {
				echo '<tr data-status="tools">
										<td>
											<div class="ckbox">
												<input type="checkbox" id="checkbox">
											</div>
										</td>
										<td>
											<a href="javascript:;" class="star">
												<i class="glyphicon glyphicon-star"></i>
											</a>
										</td>
										<td>
											<div class="media">
												<a href="#" class="pull-left">
													<img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
												</a>';	
				echo '<div class="media-body"><span class="media-meta pull-right">'.$row["availabledate"].'</span>';
				echo '<h4 class="title">'.$row["itemname"].'<span class="pull-right tools">(Tools)</span></h4>';
				echo '<p class="summary">'.$row["description"].'</p></div></div></td></tr>';
				$count++;
			}
			//fetch all appliances 
			while ($row = pg_fetch_assoc($result_appliances)) {
				echo '<tr data-status="appliances">
										<td>
											<div class="ckbox">
												<input type="checkbox" id="checkbox">
												
											</div>
										</td>
										<td>
											<a href="javascript:;" class="star">
												<i class="glyphicon glyphicon-star"></i>
											</a>
										</td>
										<td>
											<div class="media">
												<a href="#" class="pull-left">
													<img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
												</a>';	
				echo '<div class="media-body"><span class="media-meta pull-right">'.$row["availabledate"].'</span>';
				echo '<h4 class="title">'.$row["itemname"].'<span class="pull-right appliances">(Appliances)</span></h4>';
				echo '<p class="summary">'.$row["description"].'</p></div></div></td></tr>';
				$count++;
			}
			
			//fetch all furnitures
			while ($row = pg_fetch_assoc($result_furnitures)) {
				echo '<tr data-status="furnitures">
										<td>
											<div class="ckbox">
												<input type="checkbox" id="checkbox">
												
											</div>
										</td>
										<td>
											<a href="javascript:;" class="star">
												<i class="glyphicon glyphicon-star"></i>
											</a>
										</td>
										<td>
											<div class="media">
												<a href="#" class="pull-left">
													<img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
												</a>';	
				echo '<div class="media-body"><span class="media-meta pull-right">'.$row["availabledate"].'</span>';
				echo '<h4 class="title">'.$row["itemname"].'<span class="pull-right furnitures">(furnitures)</span></h4>';
				echo '<p class="summary">'.$row["description"].'</p></div></div></td></tr>';
				$count++;
			}

			//fetch all book
			while ($row = pg_fetch_assoc($result_books)) {
				echo '<tr data-status="books">
										<td>
											<div class="ckbox">
												<input type="checkbox" id="checkbox">
											</div>
										</td>
										<td>
											<a href="javascript:;" class="star">
												<i class="glyphicon glyphicon-star"></i>
											</a>
										</td>
										<td>
											<div class="media">
												<a href="#" class="pull-left">
													<img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
												</a>';	
				echo '<div class="media-body"><span class="media-meta pull-right">'.$row["availabledate"].'</span>';
				echo '<h4 class="title">'.$row["itemname"].'<span class="pull-right books">(books)</span></h4>';
				echo '<p class="summary">'.$row["description"].'</p></div></div></td></tr>';
				$count++;
			}
			pg_free_result($result);
				echo '</tbody></table>';
		?>
				</div>
				</div>
				</div>
				<div class="text-left">
					<p>	
						<a href="retrieveinfo.php" class="btn btn-primary" role="button">Your Shared Items</a>
						<a href="borrowed.php" class="btn btn-primary" role="button">Your Borrowed Items</a>
						<a href="logout.php" class="btn btn-danger" role="button">Logout</a>
					</p>
				</div>
			</div>
		</section>
	</div>
</div>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
	<script type="text/javascript" src="js/biddingpage.js"></script>
	</body>	
</html>

