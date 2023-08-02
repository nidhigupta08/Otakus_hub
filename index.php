<?php
session_start();


include("connection.php");
extract($_REQUEST);
$arr = array();
$countt = 0;
if (isset($_GET['msg'])) {
	$loginmsg = $_GET['msg'];
} else {
	$loginmsg = "";
}
if (isset($_SESSION['cust_id'])) {
	$cust_id = $_SESSION['cust_id'];
	$cquery = mysqli_query($con, "select * from tblcustomer where fld_email='$cust_id'");
	$cresult = mysqli_fetch_array($cquery);
} else {
	$cust_id = "";
}






$query = mysqli_query($con, "select  tblvendor.fld_name,tblvendor.fldvendor_id,tblvendor.fld_email,
tblvendor.fld_mob,tblvendor.fld_address,tblvendor.fld_logo,tbgood.good_id,tbgood.goodname,tbgood.cost,
tbgood.categories,tbgood.paymentmode 
from tblvendor inner join tbgood on tblvendor.fldvendor_id=tbgood.fldvendor_id;");
while ($row = mysqli_fetch_array($query)) {
	$arr[] = $row['good_id'];
	shuffle($arr);
}

//print_r($arr);

if (isset($addtocart)) {

	if (!empty($_SESSION['cust_id'])) {

		header("location:form/cart.php?product=$addtocart");
	} else {
		header("location:form/?product=$addtocart");
	}
}

if (isset($login)) {
	header("location:form/index.php");
}
if (isset($logout)) {
	session_destroy();
	header("location:index.php");
}
$query = mysqli_query($con, "select tbgood.goodname,tbgood.fldvendor_id,tbgood.cost,tbgood.categories,tbgood.fldimage,tblcart.fld_cart_id,tblcart.fld_product_id,tblcart.fld_customer_id from tbgood inner  join tblcart on tbgood.good_id=tblcart.fld_product_id where tblcart.fld_customer_id='$cust_id'");
$re = mysqli_num_rows($query);
if (isset($message)) {

	if (mysqli_query($con, "insert into tblmessage(fld_name,fld_email,fld_phone,fld_msg) values ('$nm','$em','$ph','$txt')")) {
		echo "<script> alert('We will be Connecting You shortly')</script>";
	} else {
		echo "failed";
	}
}

?>
<html>

<head>
	<title>Home</title>
	<!--bootstrap files-->
	<link rel="stylesheet" href="bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
		crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
		integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
		crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
		integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
		crossorigin="anonymous"></script>
	<!--bootstrap files-->

	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
		integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Great+Vibes|Permanent+Marker" rel="stylesheet">




	<script>
		//search product function
		$(document).ready(function () {

			$("#search_text").keypress(function () {
				load_data();

				function load_data(query) {
					$.ajax({
						url: "fetch2.php",
						method: "post",
						data: {
							query: query
						},
						success: function (data) {
							$('#result').html(data);
						}
					});
				}

				$('#search_text').keyup(function () {
					var search = $(this).val();
					if (search != '') {
						load_data(search);
					} else {
						$('#result').html(data);
					}
				});
			});
		});

		//merchant search
		$(document).ready(function () {

			$("#search_merchant").keypress(function () {
				load_data();

				function load_data(query) {
					$.ajax({
						url: "fetch.php",
						method: "post",
						data: {
							query: query
						},
						success: function (data) {
							$('#resultmerchant').html(data);
						}
					});
				}

				$('#search_merchant').keyup(function () {
					var search = $(this).val();
					if (search != '') {
						load_data(search);
					} else {
						load_data();
					}
				});
			});
		});
	</script>
	<style>
		//body{
		background-image:url("img/full.jpg");
		background-repeat: no-repeat;
		background-attachment: fixed;
		background-position: center;
		}

		ul li {
			list-style: none;
		}

		ul li a {
			color: black;
			font-weight: bold;
		}

		ul li a:hover {
			text-decoration: none;
		}
	</style>
</head>


<body style="background-color:#ccccff">
	<div id="result" style="position:fixed;top:300; right:500;z-index: 3000;width:350px;background:white;"></div>
	<div id="resultmerchant"
		style=" margin:0px auto; position:fixed; top:150px;right:750px; background:white;  z-index: 3000;"></div>

	<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">

		<a class="navbar-brand" href="index.php"><span
				style="color:black;font-family: 'Permanent Marker', cursive;">Otaku's Hub</span></a>
		<?php
		if (!empty($cust_id)) {
			?>
			<a class="navbar-brand" style="color:black; text-decoratio:none;"><i class="far fa-user">
					<?php echo $cresult['fld_name']; ?>
				</i></a>
			<?php
		}
		?>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
			aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">

			<ul class="navbar-nav ml-auto" style="
	align-items: center;
	flex-direction: row;
	justify-content: center;">

				<li class="nav-item">
					<!--merchant search-->
					<a href="#" class="nav-link">
						<form style="margin-block-end:auto" method="post"><input type="text" name="search_merchant"
								id="search_merchant" placeholder="Search " class="form-control " /></form>
					</a>
				</li>
				<!-- <li class="nav-item">
					<a href="#" class="nav-link">
						<form method="post"><input type="text" name="search_text" id="search_text" placeholder="Search by theme " class="form-control " /></form>
					</a>
				</li> -->
				<li class="nav-item active">
					<a class="nav-link" href="index.php">Home

					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="aboutus.php">About Us</a>
				</li>
				<!-- <li class="nav-item">
					<a class="nav-link" href="services.php">Services</a>
				</li> -->
				<li class="nav-item">
					<a class="nav-link" href="contact.php">Contact</a>
				</li>
				<li class="nav-item">
					<form style="margin-block-end: auto" method="post">
						<?php
						if (empty($cust_id)) {
							?>
							<a href="form/index.php?msg=you must be login first"><span style="color:red; font-size:30px;"><i
										class="fa fa-cart-arrow-down" style="margin-top: 5px" aria-hidden="true"><span
											style="color:red;" id="cart" class="badge badge-light">0</span></i></span></a>

							&nbsp;&nbsp;&nbsp;
							<button class="btn btn-outline-danger" style="margin-top:-14px" name="login" type="submit">Log
								In</button>&nbsp;&nbsp;&nbsp;
							<?php
						} else {
							?>
							<a href="form/cart.php"><span style=" color:green; font-size:30px;"><i
										class="fa fa-cart-arrow-down" aria-hidden="true"><span style="color:green;"
											id="cart" class="badge badge-light">
											<?php if (isset($re)) {
												echo $re;
											} ?>
										</span></i></span></a>
							<button class="btn btn-outline-success my-2 my-sm-0" name="logout" type="submit">Log
								Out</button>&nbsp;&nbsp;&nbsp;
							<?php
						}
						?>
					</form>
				</li>

			</ul>

		</div>

	</nav>
	<!--menu ends-->
	<div id="demo" class="carousel slide" data-ride="carousel" data-interval="4000" style="background-color: #ccccff;">
		<ul class="carousel-indicators">
			<li data-target="#demo" data-slide-to="0" class="active"></li>

		</ul>

		<br />
		<br />
		<div class="carousel-inner">

			<div class="carousel-item active" style="width: 400px;height: 400px;margin-left:550px">
				<img src="http://tshirtmaniac.gr/images/detailed/132/Luffy_and_Shanks1.jpg" alt="Los Angeles"
					class="d-block w-100">
				<div class="carousel-caption"></div>
			</div>

			<div class="carousel-item " style="width: 400px;height: 400px;margin-left:550px">
				<img src="https://i.etsystatic.com/26243346/r/il/702b6e/2800083183/il_794xN.2800083183_1qi0.jpg"
					alt="New York" class="d-block w-100">
				<div class="carousel-caption"></div>
			</div>
			<div class="carousel-item " style="width: 400px;height: 400px;margin-left:550px">
				<img src="img/OIP.jfif" alt="New York" class="d-block w-100">
				<div class="carousel-caption"></div>
			</div>
			<div class="carousel-item " style="width: 400px;height: 400px;margin-left:550px">
				<img src="img/kidluffy.jpg" alt="New York" class="d-block w-100">
				<div class="carousel-caption"></div>
			</div>
		</div>
		<a class="carousel-control-prev" href="#demo" data-slide="prev">
			<span class="carousel-control-prev-icon"></span>
		</a>
		<a class="carousel-control-next" href="#demo" data-slide="next">
			<span class="carousel-control-next-icon"></span>
		</a>
	</div>
	<!--slider ends-->

	<!--container 1 starts-->

	<br><br>
	<div class="container-fluid" style="background-color:#ccccff">
		<div class="row">


			<div class="col-sm-6" style="display: flex;flex:1;flex-direction:row;max-width:95%;margin-left:32px">
				<?php
				for ($countt = 0; $countt < 3; $countt++) { ?>
					<div class="container-fluid rounded"
						style="border:solid 2px #000000;padding:20px;background-color:lavender">
						<?php
						$good_id = $arr[$countt];
						$query = mysqli_query($con, "select tblvendor.fld_email,tblvendor.fld_name,tblvendor.fld_mob,
	  tblvendor.fld_phone,tblvendor.fld_address,tblvendor.fldvendor_id,tblvendor.fld_logo,tbgood.good_id,tbgood.goodname,tbgood.cost,
	  tbgood.categories,tbgood.paymentmode,tbgood.fldimage from tblvendor inner join
	  tbgood on tblvendor.fldvendor_id=tbgood.fldvendor_id where tbgood.good_id='$good_id'");
						while ($res = mysqli_fetch_assoc($query)) {
							$merchant_logo = "image/merchant/" . $res['fld_email'] . "/" . $res['fld_logo'];
							$good_pic = "image/merchant/" . $res['fld_email'] . "/goodimages/" . $res['fldimage'];
							?>
							<div class="container-fluid">
								<div class="container-fluid">
									<div class="row" style="padding:10px; ">
										<div class="col-sm-2"><img src="<?php echo $merchant_logo; ?>" class="rounded-circle"
												height="50px" width="50px" alt="Cinque Terre"></div>
										<div class="col-sm-5">
											<a href="search.php?vendor_id=<?php echo $res['fldvendor_id']; ?>"><span
													style="font-family: 'Miriam Libre', sans-serif; font-size:28px;color:#CB202D;">
													<?php echo $res['fld_name']; ?>
												</span></a>
										</div>
										<form method="post">
											<div class="col-sm-2"
												style="text-align:left;padding:10px; font-size:25px;margin-top:-88px;margin-left:300px">
												<br /><button type="submit" name="addtocart"
													value="<?php echo $res['good_id']; ?>" )"><span style="color:green;" <i
														class="fa fa-cart-arrow-down" aria-hidden="true"></i></span></button>
											</div>
											<form>
									</div>

								</div>
								<div class="container-fluid">
									<div class="row"
										style="padding:10px;padding-top:0px;padding-right:0px; padding-left:0px;margin-top:10px">
										<?php if ($countt == 0) {
											?>
											<div class="col-sm-12" style="margin-top:-16px"><img src="<?php echo $good_pic; ?>"
													class="rounded" height="250px" width="100%" alt="Cinque Terre"></div>
											<?php
										} else {
											?>
											<div class="col-sm-12"><img src="<?php echo $good_pic; ?>" class="rounded"
													height="250px" width="100%" alt="Cinque Terre"></div>
											<?php
										}
										?>


									</div>
								</div>
								<div class="container-fluid">
									<div class="row" style="padding:10px;display: flex;flex-direction: column;
											align-items: center; ">
										<h3>
											<?php echo $res['goodname'] ?>
										</h3>
										<h5 style="color:green">
											<?php echo "₹" . $res['cost']; ?>
										</h5>

										<div class="col-sm-6" style="max-width: none;">
											<li>
												<?php echo " Upto " . random_int(10, 40) . "% off" ?>&nbsp;
											</li>
											<li>
												<?php echo $res['categories']; ?>
											</li>
										</div>
										<div class="col-sm-6" style="padding:10px;">
										</div>
									</div>

								</div>


								<?php
						}
						?>
						</div>

					</div>
					<?php
				} ?>

			</div>

		</div>

	</div>

	</div>
	</div>

	<!--container 1 ends-->

	<!--container 2 starts-->


	<div class="container-fluid" style="background-color:#ccccff">
		<div class="row">


			<div class="col-sm-6" style="display: flex;flex:1;flex-direction:row;max-width:95%;margin-left:32px">
				<?php
				for ($countt = 3; $countt < 6; $countt++) { ?>
					<div class="container-fluid rounded"
						style="border:solid 2px #000000;padding:20px;background-color:lavender">
						<?php
						$good_id = $arr[$countt];
						$query = mysqli_query($con, "select tblvendor.fld_email,tblvendor.fld_name,tblvendor.fld_mob,
	  tblvendor.fld_phone,tblvendor.fld_address,tblvendor.fldvendor_id,tblvendor.fld_logo,tbgood.good_id,tbgood.goodname,tbgood.cost,
	  tbgood.categories,tbgood.paymentmode,tbgood.fldimage from tblvendor inner join
	  tbgood on tblvendor.fldvendor_id=tbgood.fldvendor_id where tbgood.good_id='$good_id'");
						while ($res = mysqli_fetch_assoc($query)) {
							$merchant_logo = "image/merchant/" . $res['fld_email'] . "/" . $res['fld_logo'];
							$good_pic = "image/merchant/" . $res['fld_email'] . "/goodimages/" . $res['fldimage'];
							?>
							<div class="container-fluid">
								<div class="container-fluid">
									<div class="row" style="padding:10px; ">
										<div class="col-sm-2"><img src="<?php echo $merchant_logo; ?>" class="rounded-circle"
												height="50px" width="50px" alt="Cinque Terre"></div>
										<div class="col-sm-5">
											<a href="search.php?vendor_id=<?php echo $res['fldvendor_id']; ?>"><span
													style="font-family: 'Miriam Libre', sans-serif; font-size:28px;color:#CB202D;">
													<?php echo $res['fld_name']; ?>
												</span></a>
										</div>
										<form method="post">
											<div class="col-sm-2"
												style="text-align:left;padding:10px; font-size:25px;margin-top:-88px;margin-left:300px">
												<br /><button type="submit" name="addtocart"
													value="<?php echo $res['good_id']; ?>" )"><span style="color:green;" <i
														class="fa fa-cart-arrow-down" aria-hidden="true"></i></span></button>
											</div>
											<form>
									</div>

								</div>
								<div class="container-fluid">
									<div class="row"
										style="padding:10px;padding-top:0px;padding-right:0px; padding-left:0px;margin-top:10px">

										<div class="col-sm-12"><img src="<?php echo $good_pic; ?>" class="rounded"
												height="250px" width="100%" alt="Cinque Terre"></div>
									</div>
								</div>
								<div class="container-fluid">
									<div class="row" style="padding:10px;display: flex;flex-direction: column;
											align-items: center; ">
										<h3>
											<?php echo $res['goodname'] ?>
										</h3>
										<h5 style="color:green">
											<?php echo "₹" . $res['cost']; ?>
										</h5>

										<div class="col-sm-6" style="max-width: none;">
											<li>
												<?php echo " Upto " . random_int(10, 40) . "% off" ?>&nbsp;
											</li>
											<li>
												<?php echo $res['categories']; ?>
											</li>
										</div>
										<div class="col-sm-6" style="padding:10px;">
										</div>
									</div>

								</div>


								<?php
						}
						?>
						</div>

					</div>
					<?php
				} ?>

			</div>

		</div>

	</div>

	</div>
	</div>


	<!--container 2 ends-->

	<!--container 3 starts-->


	<div class="container-fluid" style="background-color:#ccccff">
		<div class="row">


			<div class="col-sm-6" style="display: flex;flex:1;flex-direction:row;max-width:95%;margin-left:32px">
				<?php
				for ($countt = 6; $countt < 9; $countt++) { ?>
					<div class="container-fluid rounded"
						style="border:solid 2px #000000;padding:20px;background-color:lavender">
						<?php
						$good_id = $arr[$countt];
						$query = mysqli_query($con, "select tblvendor.fld_email,tblvendor.fld_name,tblvendor.fld_mob,
	  tblvendor.fld_phone,tblvendor.fld_address,tblvendor.fldvendor_id,tblvendor.fld_logo,tbgood.good_id,tbgood.goodname,tbgood.cost,
	  tbgood.categories,tbgood.paymentmode,tbgood.fldimage from tblvendor inner join
	  tbgood on tblvendor.fldvendor_id=tbgood.fldvendor_id where tbgood.good_id='$good_id'");
						while ($res = mysqli_fetch_assoc($query)) {
							$merchant_logo = "image/merchant/" . $res['fld_email'] . "/" . $res['fld_logo'];
							$good_pic = "image/merchant/" . $res['fld_email'] . "/goodimages/" . $res['fldimage'];
							?>
							<div class="container-fluid">
								<div class="container-fluid">
									<div class="row" style="padding:10px; ">
										<div class="col-sm-2"><img src="<?php echo $merchant_logo; ?>" class="rounded-circle"
												height="50px" width="50px" alt="Cinque Terre"></div>
										<div class="col-sm-5">
											<a href="search.php?vendor_id=<?php echo $res['fldvendor_id']; ?>"><span
													style="font-family: 'Miriam Libre', sans-serif; font-size:28px;color:#CB202D;">
													<?php echo $res['fld_name']; ?>
												</span></a>
										</div>
										<form method="post">
											<div class="col-sm-2"
												style="text-align:left;padding:10px; font-size:25px;margin-top:-88px;margin-left:300px">
												<br /><button type="submit" name="addtocart"
													value="<?php echo $res['good_id']; ?>" )"><span style="color:green;" <i
														class="fa fa-cart-arrow-down" aria-hidden="true"></i></span></button>
											</div>
											<form>
									</div>

								</div>
								<div class="container-fluid">
									<div class="row"
										style="padding:10px;padding-top:0px;padding-right:0px; padding-left:0px;margin-top:10px">

										<div class="col-sm-12"><img src="<?php echo $good_pic; ?>" class="rounded"
												height="250px" width="100%" alt="Cinque Terre"></div>
									</div>
								</div>
								<div class="container-fluid">
									<div class="row" style="padding:10px;display: flex;flex-direction: column;
											align-items: center; ">
										<h3>
											<?php echo $res['goodname'] ?>
										</h3>
										<h5 style="color:green">
											<?php echo "₹" . $res['cost']; ?>
										</h5>

										<div class="col-sm-6" style="max-width: none;">
											<li>
												<?php echo " Upto " . random_int(10, 40) . "% off" ?>&nbsp;
											</li>
											<li>
												<?php echo $res['categories']; ?>
											</li>
										</div>
										<div class="col-sm-6" style="padding:10px;">
										</div>
									</div>

								</div>


								<?php
						}
						?>
						</div>

					</div>
					<?php
				} ?>

			</div>

		</div>

	</div>

	</div>
	</div>

	<!--container 3 ends-->

	<!--footer primary-->

	<?php
	include("footer.php");
	?>




</body>

</html>