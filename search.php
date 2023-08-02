<?php
include("connection.php");
extract($_REQUEST);
session_start();
if(isset($_SESSION['cust_id']))
{
	 $cust_id=$_SESSION['cust_id'];
	 $qq=mysqli_query($con,"select * from tblcustomer where fld_email='$cust_id'");
	 $qqr= mysqli_fetch_array($qq);
}
else
{
	$cust_id="";
}
if(Isset($vendor_id))
{
$vid= $vendor_id;
}
else
{
	header("location:index.php");
}
if(isset($login))
 {
	 header("location:form/index.php");
 }
 if(isset($logout))
 {
	 session_destroy();
	 header("location:index.php");
 }

$query=mysqli_query($con,"select * from tblvendor where fldvendor_id='$vid'");
$row=mysqli_fetch_array($query);
echo $row['fld_name'];
$query=mysqli_query($con,"select tbgood.goodname,tbgood.fldvendor_id,tbgood.cost,tbgood.categories,tbgood.fldimage,tblcart.fld_cart_id,tblcart.fld_product_id,tblcart.fld_customer_id from tbgood inner  join tblcart on tbgood.good_id=tblcart.fld_product_id where tblcart.fld_customer_id='$cust_id'");
  $re=mysqli_num_rows($query);
?>
<html>
  <head>
     <title>Home</title>
	 <!--bootstrap files-->
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	  <!--bootstrap files-->
	 
	 <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	 
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	 <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Permanent+Marker" rel="stylesheet">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
	 
	 
	 
	 <script>
	 //search product function
            $(document).ready(function(){
	
	             $("#search_text").keypress(function()
	                      {
	                       load_data();
	                       function load_data(query)
	                           {
		                        $.ajax({
			                    url:"fetch2.php",
			                    method:"post",
			                    data:{query:query},
			                    success:function(data)
			                                 {
				                               $('#result').html(data);
			                                  }
		                                });
	                             }
	
	                           $('#search_text').keyup(function(){
		                       var search = $(this).val();
		                           if(search != '')
		                               {
			                             load_data(search);
		                                }
		                            else
		                             {
			                         $('#result').html(data);			
		                              }
	                                });
	                              });
	                            });
								
								//shop search
								$(document).ready(function(){
	
	                            $("#search_shop").keypress(function()
	                         {
	                         load_data();
	                       function load_data(query)
	                           {
		                        $.ajax({
			                    url:"fetch.php",
			                    method:"post",
			                    data:{query:query},
			                    success:function(data)
			                                 {
				                               $('#resultshop').html(data);
			                                  }
		                                });
	                             }
	
	                           $('#search_shop').keyup(function(){
		                       var search = $(this).val();
		                           if(search != '')
		                               {
			                             load_data(search);
		                                }
		                            else
		                             {
			                         load_data();			
		                              }
	                                });
	                              });
	                            });
</script>
<style>
#aboutus{
     background-image:url(""img/full.jpg"");
	 background-repeat: no-repeat;
	 background-attachment: fixed;
	  background-position: center;
  
}

ul li {list-style:none;}
ul li a{color:black; font-weight:bold;}
ul li a:hover{text-decoration:none;}


</style>
  </head>
  
    
	<body>
	

<div id="result" style="position:fixed;top:100; right:50;z-index: 3000;width:350px;background:white;"></div>

<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
  
    <a class="navbar-brand" href="index.php"><span style="color:black;font-family: 'Permanent Marker', cursive;">Otakus Hub</span></a>
    <?php
	if(!empty($cust_id))
	{
	?>
	<a class="navbar-brand" style="color:white; text-decoratio:none;"><i class="far fa-user"><?php if(isset($cust_id)) { echo $qqr['fld_name']; }?></i></a>
	<?php
	}
	?>
	
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
	
      <ul class="navbar-nav ml-auto" style="height:52px; margin-top:revert ;margin-block-end:auto">
	      
          
		  <li class="nav-item" >
		     <a href="index.php" style="color:white;" class="nav-link">Home</a>
		  </li>
		  <li class="nav-item">
		     <a href="aboutus.php" style="color:white;" class="nav-link">About Us</a>
		  </li>
		  <!-- <li class="nav-item">
		     <a href="services.php" style="color:white;" class="nav-link">Services</a>
		  </li> -->
		  <li class="nav-item">
		     <a href="contact.php" style="color:white;" class="nav-link">Contact</a>
		  </li>
		  <?php
			if(empty($cust_id))
			{
			?>
			<li class="nav-item">
			  <!-- <a href="form/index.php?msg= login first" class="nav-link"><span style="color:black;  font-size:30px;"><i class="fa fa-shopping-cart" aria-hidden="true"><span style="color:black;" id="cart"  class="badge badge-light">0</span></i></span></a> -->
		    </li>
			
			<li class="nav-item">
			<a  class="nav-link"><form method="post"><button class="btn btn-outline-danger" style="margin-top:-6px" name="login" type="submit">Log In</button></form></a>
            </li>
			<?php
			}
			else
			{
			?>
			<li class="nav-item">
			<a href="form/cart.php" class="nav-link"><form method="post"><span style=" color:black; font-size:30px;"><i class="fa fa-shopping-cart" aria-hidden="true"><span style="color:black;" id="cart"  class="badge badge-light"><?php if(isset($re)) { echo $re; }?></span></i></span></form></a>
			</li>
			<li class="nav-item">
			<a class="nav-link"><form method="post"><button class="btn btn-outline-success my-2 my-sm-0" name="logout" type="submit">Log Out</button></form></a>
			</li>
			<?php
			}
			?>
	  
		
        
      </ul>
	  
    </div>
	
</nav>
<br><br><br><br>
<!--menu ends-->
<div class="container" >
<?php 
if($vid=='22') {
	?><img src="img/rd.jpg" alt="no Pic Available" height="400px" width="100%"><?php
} if($vid=='23') {
	?><img src="img/comp logo.jpg" alt="no Pic Available" height="400px" width="100%"><?php
}
?>
</div>
<div class="container-fluid" >
<br><br>
<div class="row">
   <div class="col-sm-1"></div>
   <div class="col-sm-10" >
   <h3 style="color:#01C699;text-transform:uppercase;"><?php echo $row['fld_name']; ?></h3><br><br>
   <span style="color:#A5A5A5;font-size:25px;text-transform:uppercase;"><i class="fas fa-home"></i></span>&nbsp;&nbsp;<span style="font-family: 'Tangerine', serif; font-weight:bold;font-size:25px; color:#ED2553;"><?php echo $row['fld_address']?></span><br><br>
   <span style="color:#A5A5A5;font-size:25px;"><i class="fas fa-phone"></i></span>&nbsp;&nbsp;<span style=" font-size:25px; color:#ED2553;"><?php echo $row['fld_phone']?></span><br><br>
   <span style="color:#A5A5A5;font-size:25px;"><i class="fa fa-mobile" aria-hidden="true"></i></span>&nbsp;&nbsp;<span style=" font-size:25px; color:#ED2553;"><?php echo $row['fld_mob']?></span><br><br>
   <span style="color:#A5A5A5;font-size:25px;"><i class="fas fa-at"></i></span>&nbsp;&nbsp;<span style=" font-size:25px; color:#ED2553;"><?php echo $row['fld_email']?></span><br><br>


   
   </div>
   
   <div class="col-sm-1"></div>
</div>
</div>

<!--footer primary-->
	     <?php
		 include("footer.php");
		 ?>
</body>

</html>