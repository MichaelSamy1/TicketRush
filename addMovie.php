<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$conn = new mysqli("localhost", "root", "", "ticket");
if ($conn->connect_error) {
    die("Failed to connect: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $event_title = $_POST['event_title'];
    $link = $_POST['link'];
    $age_rating = $_POST['age_rating'];
    $info = $_POST['info'];
    $movie_type = $_POST['movie_type'];
    $language = $_POST['language'];
    $subtilte = $_POST['subtilte'];
    $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $place_name = $_POST['place_name'];

    $sql = "INSERT INTO event (event_type, event_date, event_time, event_title, link, age_rating, info, movie_type, language, subtilte, image)
            VALUES ('Cinema', '$event_date', '$event_time', '$event_title', '$link', '$age_rating', '$info', '$movie_type', '$language', '$subtilte', '$image')";

    if ($conn->query($sql) === TRUE) {
        $event_id = $conn->insert_id;

        $q = "INSERT INTO place (place_name) VALUES ('$place_name')";
        if ($conn->query($q) === TRUE) {
            // Assuming 5 rows and 10 columns for seats, you can adjust these numbers
            $rows = 5;
            $cols = 10;
            $stmt = $conn->prepare("INSERT INTO seat (seat_number, is_booked, event_id) VALUES (?, 0, ?)");
            $stmt->bind_param("si", $seat_number, $event_id);

            for ($i = 1; $i <= $rows; $i++) {
                for ($j = 1; $j <= $cols; $j++) {
                    $seat_number = "R{$i}C{$j}";
                    $stmt->execute();
                }
            }
            $stmt->close();

            header('Location: Cinema.php');
        } else {
            echo "Error inserting place: " . $conn->error;
        }
    } else {
        echo "Error inserting event: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Ticket Rush | Add Movie</title>

	<!-- Bootstrap -->
	<link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- NProgress -->
	<link href="vendors/nprogress/nprogress.css" rel="stylesheet">
	<!-- iCheck -->
	<link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	<!-- bootstrap-wysiwyg -->
	<link href="vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
	<!-- Select2 -->
	<link href="vendors/select2/dist/css/select2.min.css" rel="stylesheet">
	<!-- Switchery -->
	<link href="vendors/switchery/dist/switchery.min.css" rel="stylesheet">
	<!-- starrr -->
	<link href="vendors/starrr/dist/starrr.css" rel="stylesheet">
	<!-- bootstrap-daterangepicker -->
	<link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

	<!-- Custom Theme Style -->
	<link href="build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view">
					<div class="navbar nav_title" style="border: 0;">
						<a href="../index.php" class="site_title"><span style="text-decoration: none;
																			color: white;
																			font-size: 20px;
																			font-weight: 700px;
																			border: #fff solid 1px;
																			border-radius: 10px;
																			padding: 7px;
																			;">Ticket Rush</span></a>
					</div>

					<div class="clearfix"></div>

					<!-- menu profile quick info -->
					<div class="profile clearfix">
						<div class="profile_pic">
							<img src="images/profile.png" alt="..." class="img-circle profile_img">
						</div>
						<div class="profile_info">
							<span>Welcome,</span>
							<h2>
								<?php
                  session_start();
                  echo $_SESSION["name"];
                  ?>
				  </h2>
						</div>
					</div>
					<!-- /menu profile quick info -->

					<br />

					<!-- sidebar menu -->
					<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
						<div class="menu_section">
							<h3>General</h3>
							<ul class="nav side-menu">
								<li><a><i class="fa fa-users"></i> Users <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="users.php">Users List</a></li>
										
									</ul>
								</li>

								<li><a><i class="fa fa-edit"></i>Add Events <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="addMovie.php">Add Movie</a></li>
										<li><a href="addTheater.php">Add Theater</a></li>
										<li><a href="addMatch.php">Add Match</a></li>
										<li><a href="addEvent.php">Add Event</a></li>
										<li><a href="addPark.php">Add Park</a></li>
									</ul>
								</li>

								<li><a><i class="fa fa-desktop"></i>Show Events<span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="Cinema.php">Cinemas List</a></li>
										<li><a href="Theater.php">Theaters List</a></li>
										<li><a href="Matches.php">Matches List</a></li>
										<li><a href="Events.php">Events List</a></li>
										<li><a href="Park.php">Parks List</a></li>
									</ul>
								</li>
							</ul>
						</div>

					</div>
					<!-- /sidebar menu -->

					<!-- /menu footer buttons -->
					<div class="sidebar-footer hidden-small">
						<a data-toggle="tooltip" data-placement="top" title="Settings">
							<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
						</a>
						<a data-toggle="tooltip" data-placement="top" title="FullScreen">
							<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
						</a>
						<a data-toggle="tooltip" data-placement="top" title="Lock">
							<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
						</a>
						<a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
							<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
						</a>
					</div>
					<!-- /menu footer buttons -->
				</div>
			</div>

			<!-- top navigation -->
			<div class="top_nav">
				<div class="nav_menu">
					<div class="nav toggle">
						<a id="menu_toggle"><i class="fa fa-bars"></i></a>
					</div>
					<nav class="nav navbar-nav">
						<ul class=" navbar-right">
							<li class="nav-item dropdown open" style="padding-left: 15px;">
								<a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
									<img src="images/profile.png" alt="">
									<?php
                                     echo $_SESSION["name"];
                                    ?>
								</a>
								<div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="javascript:;"> Profile</a>
									<a class="dropdown-item" href="javascript:;">
										<span class="badge bg-red pull-right">50%</span>
										<span>Settings</span>
									</a>
									<a class="dropdown-item" href="javascript:;">Help</a>
									<a class="dropdown-item" href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
								</div>
							</li>

							
						</ul>
					</nav>
				</div>
			</div>
			<!-- /top navigation -->

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Manage Events</h3>
						</div>

						
					</div>
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Add Movie</h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										</li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
											<ul class="dropdown-menu" role="menu">
												<li><a class="dropdown-item" href="#">Settings 1</a>
												</li>
												<li><a class="dropdown-item" href="#">Settings 2</a>
												</li>
											</ul>
										</li>
										<li><a class="close-link"><i class="fa fa-close"></i></a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form id="demo-form2" method="post" action="" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="News-date">Movie Date <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="date" id="News-date" name="event_date" required="required" class="form-control ">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="News-date">Movie Time <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="time" id="News-date" name="event_time" required="required" class="form-control ">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="title">Title <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="title" name="event_title" required="required" class="form-control ">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="title">Trailer Link <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="title" name="link" required="required" class="form-control ">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="title">Age Rating <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<select class="rating-select" name="age_rating" id="egyptianCinemaRating" class="form-control" style="
																																	font-size: 16px;
																																	padding: 10px;
																																	border-radius: 5px;
																																	border: 1px solid #ccc;
																																	width: 100%;">
													<option value="">Select Rating</option>
													<option value="E">E - Exempt</option>
													<option value="G">G - General Audiences</option>
													<option value="PG">PG - Parental Guidance</option>
													<option value="12+">12+ - Suitable for ages 12 and over</option>
													<option value="15+">15+ - Suitable for ages 15 and over</option>
													<option value="18+">18+ - Suitable for adults only</option>
												</select>
												
											</div>
										</div>


										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="content">Info <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<textarea id="content" name="info" required="required" class="form-control"></textarea>
											</div>

										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="content">Movie Type <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
													<select class="genre-select" id="movieGenre" name="movie_type" class="form-control" style="width: 100%;
																															font-size: 16px;
																															padding: 10px;
																															border-radius: 5px;
																															border: 1px solid #ccc;">
														<option value="">Select Genre</option>
														<option value="Action">Action</option>
														<option value="Adventure">Adventure</option>
														<option value="Animation">Animation</option>
														<option value="Biography">Biography</option>
														<option value="Comedy">Comedy</option>
														<option value="Crime">Crime</option>
														<option value="Documentary">Documentary</option>
														<option value="Drama">Drama</option>
														<option value="Family">Family</option>
														<option value="Fantasy">Fantasy</option>
														<option value="History">History</option>
														<option value="Horror">Horror</option>
														<option value="Musical">Musical</option>
														<option value="Mystery">Mystery</option>
														<option value="Romance">Romance</option>
														<option value="Sci-Fi">Sci-Fi</option>
														<option value="Sport">Sport</option>
														<option value="Thriller">Thriller</option>
														<option value="War">War</option>
														<option value="Western">Western</option>
													</select>
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="content">Language <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<select class="genre-select" name="language" id="movieGenre" class="form-control" style="width: 100%;
																														font-size: 16px;
																														padding: 10px;
																														border-radius: 5px;
																														border: 1px solid #ccc;">
													<option value="Arabic">Arabic</option>
													<option value="English">English</option>
												</select>
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="content">Subtitle <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<select class="genre-select" name="subtilte" id="movieGenre" class="form-control" style="width: 100%;
																														font-size: 16px;
																														padding: 10px;
																														border-radius: 5px;
																														border: 1px solid #ccc;">
													<option value="No Subtitle">No Subtitle</option>
													<option value="Arabic">Arabic</option>
													<option value="English">English</option>
												</select>
											</div>
										</div>
										
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="title">Place Location <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="title" name="place_name" required="required" class="form-control ">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="image">Image <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="file" id="image" name="image" required="required" class="form-control">
											</div>
										</div>
										
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button class="btn btn-primary" type="button">Cancel</button>
												<button type="submit" name="submit" class="btn btn-success">Add</button>
											</div>
										</div>

									</form>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
			<!-- /page content -->

			<!-- footer content -->
			
			<!-- /footer content -->
		</div>
	</div>

	<!-- jQuery -->
	<script src="vendors/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<!-- FastClick -->
	<script src="vendors/fastclick/lib/fastclick.js"></script>
	<!-- NProgress -->
	<script src="vendors/nprogress/nprogress.js"></script>
	<!-- bootstrap-progressbar -->
	<script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
	<!-- iCheck -->
	<script src="vendors/iCheck/icheck.min.js"></script>
	<!-- bootstrap-daterangepicker -->
	<script src="vendors/moment/min/moment.min.js"></script>
	<script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
	<!-- bootstrap-wysiwyg -->
	<script src="vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
	<script src="vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
	<script src="vendors/google-code-prettify/src/prettify.js"></script>
	<!-- jQuery Tags Input -->
	<script src="vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
	<!-- Switchery -->
	<script src="vendors/switchery/dist/switchery.min.js"></script>
	<!-- Select2 -->
	<script src="vendors/select2/dist/js/select2.full.min.js"></script>
	<!-- Parsley -->
	<script src="vendors/parsleyjs/dist/parsley.min.js"></script>
	<!-- Autosize -->
	<script src="vendors/autosize/dist/autosize.min.js"></script>
	<!-- jQuery autocomplete -->
	<script src="vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
	<!-- starrr -->
	<script src="vendors/starrr/dist/starrr.js"></script>
	<!-- Custom Theme Scripts -->
	<script src="build/js/custom.min.js"></script>

</body></html>
