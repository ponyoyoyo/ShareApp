<!DOCTYPE html>
<html>
	<header>
		<title>Bidding Page</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/biddingpage.css">
	</header>
	<body>
		<div class="container">
			<div class="row">
				<section class="content">
					<h1>Items up for bidding</h1>
					<div class="col-md-8 col-md-offset-2">
						<form id="search-form" action="bidding.php" method="post" role="form" style="display: block;">
							<div class="btn-group">
								<button name="tools" type="button" class="btn btn-default btn-filter" data-target="tools">Tools</button>
								<button name="appliances" type="button" class="btn btn-default btn-filter" data-target="appliances">Appliances</button>
								<button name="furnitures" type="button" class="btn btn-default btn-filter" data-target="furnitures">Furniture</button>
								<button name="books" type="button" class="btn btn-default btn-filter" data-target="books">Books</button>
								<button name="all" type="button" class="btn btn-default btn-filter" data-target="all">All</button>
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Search" name="search">
									<div class="input-group-btn">
										<button name="search-submit" id="search-submit" class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
									</div>
								</div>
							</div>
						</form>
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="table-container">
									<table class="table table-filter">
										<tbody>
		<?php 
			include_once 'includes/dbconnect.php';
			$dbconn = pg_connect($connection) or die('Could not connect: ' . pg_last_error());
			
			$search = '';
			if(isset($_POST['search-submit'])) {
				$search = pg_escape_string($_POST['search']);
			}

	        $queryappliances = "SELECT i.itemname, i.availabledate, i.description FROM item i WHERE i.type = 'appliances' and i.name LIKE '%" . $search . "%'"; 
	        $querytools = "SELECT i.itemname, i.availabledate, i.description FROM item i WHERE i.type = 'tools' and i.name LIKE '%" . $search . "%'";
	        $queryfurnitures = "SELECT i.itemname, i.availabledate, i.description FROM item i WHERE i.type = 'furnitures' and i.name LIKE '%" . $search . "%'";
	        $querybooks = "SELECT i.itemname, i.availabledate, i.description FROM item i WHERE i.type = 'books' and i.name LIKE '%" . $search . "%'";

	        $result_appliances = pg_query($queryappliances); 
	        $result_tools = pg_query($querytools); 
	        $result_furnitures = pg_query($queryfurnitures); 
	        $result_books = pg_query($querybooks); 
			$i = 0;

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

