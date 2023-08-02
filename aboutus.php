<?php
session_start();
include("connection.php");
extract($_REQUEST);
$arr = array();

if (isset($_SESSION['cust_id'])) {
	$cust_id = $_SESSION['cust_id'];
	$qq = mysqli_query($con, "select * from tblcustomer where fld_email='$cust_id'");
	$qqr = mysqli_fetch_array($qq);
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
		$_SESSION['cust_id'] = $cust_id;
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
?>
<html>

<head>
	<title>Home</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
		crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
		integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
		crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
		integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
		crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
		integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Great+Vibes|Permanent+Marker" rel="stylesheet">

	<style>
		.carousel-item {
			height: 100vh;
			min-height: 350px;
			background: no-repeat center center scroll;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
		}

		body {
			background-image: url("img/DMS.jpg");
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-position: center;

		}

		/* header::before{
  background-image: url("img/aboutus1.jpg") ;
  content:"";  z-index: -1; opacity: 0.9;
  position:absolute;  width:100%;  height:100%;

                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
                background-blend-mode: normal;
} */
	</style>


	<script>
		//search product function
		$(document).ready(function () {

			$("#search_text").keypress(function () {
				load_data();
				function load_data(query) {
					$.ajax({
						url: "fetch.php",
						method: "post",
						data: { query: query },
						success: function (data) {
							$('#result').html(data);
						}
					});
				}

				$('#search_text').keyup(function () {
					var search = $(this).val();
					if (search != '') {
						load_data(search);
					}
					else {
						load_data();
					}
				});
			});
		});
	</script>
	<style>
		ul li {
			list-style: none;
		}

		ul li a {
			color: black;
			text-decoration: none;
		}

		ul li a:hover {
			color: black;
			text-decoration: none;
		}
	</style>
</head>


<body>
	<!--navbar start-->

	<div id="result" style="position:fixed;top:100; right:50;z-index: 3000;width:350px;background:white;"></div>
	<!--navbar ends-->
	<nav class="navbar navbar-expand-lg navbar-light fixed-top" style="height:60px; background-color:#ff9933">
		<a class="navbar-brand" href="index.php"><span
				style="color:black;font-family: 'Permanent Marker', cursive;">Otakus hub</span></a>
		<?php
        if (!empty($cust_id)) {
        ?>
		<a class="navbar-brand" style="color:black; text-decoratio:none;"><i class="far fa-user">
				<?php if (isset($cust_id)) {
		        echo $qqr['fld_name'];
	        } ?>
			</i></a>
		<?php
        }
        ?>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
			aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">

			<ul class="navbar-nav ml-auto" style="margin-top:revert">
				<li class="nav-item">
					<a class="nav-link" href="index.php">Home

					</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="aboutus.php">About Us</a>
				</li>
				<!-- <li class="nav-item">
          <a class="nav-link" href="services.php">Services</a>
        </li> -->
				<li class="nav-item">
					<a class="nav-link" href="contact.php">Contact</a>
				</li>
				<li class="nav-item">
					<form method="post">
						<?php
                        if (empty($cust_id)) {
                        ?>
						<!-- <a href="form/index.php?msg=you must be login first"><span style="color:black; font-size:30px;"><i class="fa fa-shopping-cart" aria-hidden="true"><span style="color:black;" id="cart"  class="badge badge-light">0</span></i></span></a> -->

						&nbsp;&nbsp;&nbsp;
						<button class="btn btn-outline-danger my-2 my-sm-0" name="login" type="submit">Log
							In</button>&nbsp;&nbsp;&nbsp;
						<?php
                        } else {
                        ?>
						<a href="form/cart.php"><span style=" color:black; font-size:30px;"><i
									class="fa fa-shopping-cart" aria-hidden="true"><span style="color:black;" id="cart"
										class="badge badge-light">
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
				<li class="nav-item">


				</li>
			</ul>

		</div>

	</nav>
	<!--navbar ends-->
	<br>
	<div class="container-fluid">
		<img src="" width='0%' />
	</div>
	<br><br>
	<div class="container-fluid" style="background:black; opacity:0.60;width:1000px">
		<h4 style="margin-top:60px;color:white; text-align:center;">Anime merchandise is merchandise, or ‘goods’, that
			have been produced for a popular anime or manga series. There are many types of anime merchandise including
			stationary items, anime figures, soft toys and many more. </h4>
		<p style="color:white; text-align:center; font-size:25px;">
			Otaku's Hub is an amazing website that sells multiple items Japanese items, including tons of anime
			merchandise! In terms of anime merchandise, the website’s main focus is on anime figures. All the figures
			are reasonably priced and the website is often conducting sales on many of their items, meaning that you can
			get amazing bargains on a lot of the anime merchandise! The best thing about this website is that all of the
			anime merchandise and anime figures are official, authentic and licensed merchandise. The anime merchandise
			available on the website has all come from japan and is of great quality. If you’re looking for a website to
			buy affordable, great quality anime merchandise then Otaku's Hub is definitely a website that you should
			check out!

		</p>
	</div>
	<!-- <div class="container-fluid" style="background:white; text-transform:uppercase;padding:20px; border-left:10px solid black;"><h3>locate us</h3></div> -->
	<div class="container-fluid">
		<!-- <div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="304" id="gmap_canvas" src="https://goo.gl/maps/FjBvsbZ1nymYXvKj8" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.emojilib.com">emojilib.com</a></div><style>.mapouter{position:relative;text-align:right;height:304px;width:100%;}.gmap_canvas {overflow:hidden;background:none!important;height:304px;width:100%;}</style></div> -->
	</div>

	<?php
    include("footerforabout.php");
    ?>

</body>

</html>