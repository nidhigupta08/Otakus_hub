<?php
session_start();
include("connection.php");
extract($_REQUEST);
if (isset($_SESSION['id'])) {
  header("location:good.php");
}
if (isset($register)) {
  $sql = mysqli_query($con, "select * from tblvendor where fld_email='$email'");
  if (mysqli_num_rows($sql)) {
    $email_error = "This Email Id is already registered with us";
  } else {
    $logo = $_FILES['logo']['name'];
    $sql = mysqli_query($con, "insert into tblvendor 
	(fld_name	,fld_email,fld_password,fld_mob,fld_phone,fld_address,fld_logo)
       	values('$r_name','$email','$pswd','$mob','$phone','$address','$logo')");

    if ($sql) {
      mkdir("image/merchant");
      mkdir("image/merchant/$email");

      move_uploaded_file($_FILES['logo']['tmp_name'], "image/merchant/$email/" . $_FILES['logo']['name']);
    }
    $_SESSION['id'] = $email;

    header("location:good.php");

  }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Shop Registration Form</title>
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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
    integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">


  <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Aboreto&family=Anton&family=DynaPuff&family=Kanit:wght@500&family=Source+Sans+Pro&display=swap"
    rel="stylesheet">
  <style>
    /* ul li{list-style:none;}
    ul li a {color:black;text-decoration:none; }
    ul li a:hover {color:black; text-decoration:none;} */
    .middle {
      margin: 0px auto;
      border: 1px solid #00ffff;
      width: 480px;
      height: 590px;
      background: linear-gradient(to bottom, #ff9933 0%, #9966ff 100%);
      border-radius: 30px;
      /* padding: 26px 47px; */
      padding: 19px 32px;
    }

    /* .middle{
                background: linear-gradient(to bottom, #ff9933 0%, #9966ff 100%);
                position:fixed; padding:20px; border:1px  solid #00ffff; left:38%; top:30%; width:450px;
                border-radius: 40px;
            } */
    .regis {

      /* text-align: center;
      justify-content: center; */
      font-size: 1.4rem;
      color: black;
      font-family: 'Anton', sans-serif;

      padding: 0px 100px;
    }

    .navbar-brand {
      font-family: 'Fredoka One', cursive;
      color: black;
    }

    body {
      background-image: url("img/regist.PNG");
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
      background-blend-mode: normal;

    }

    .form-control {
      /* width: 30%; height: 50%; padding:4px;margin: 0px 1px; text-align: center; */
      width: 100%;
      height: 50%;
      margin: 1px 1px;
      margin: 0px 1px;
      margin: 0px -2px;

    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light  fixed-top" style="background-color:#ff9933">

    <a class="navbar-brand" href="index.php"><span>Otakus Hub</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
      aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">

      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home

          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about us.php">About Us</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="services.php">Services</a>
        </li> -->
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>
      </ul>

    </div>

  </nav>
  <br><br><br>
  <div class="middle">
    <ul class="nav nav-tabs nabbar_inverse" id="myTab" role="tablist">
      <!-- <li class="nav-item">
        <a class="nav-link active" style="color:#BDDEFD;" id="register-tab" data-toggle="tab" href="#register"
          role="tab" aria-controls="register" aria-selected="true">Register</a>
      </li> -->
      <div class="regis">Registration Form</div>

      <!-- <li class="nav-item">
             <a class="nav-link " id="login-tab" style="color:#00ffff;" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">Log In</a>
          </li> -->
    </ul>
    <br>
    <!--tab 1 starsts-->
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="register" role="tabpanel" aria-labelledby="home-tab">
        <div class="footer" style="color:red;">
          <?php if (isset($loginmsg)) {
            echo $loginmsg;
          } ?>
        </div>

        <form action="" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" value="<?php if (isset($r_name)) {
              echo $r_name;
            } ?>" placeholder="Enter Merchant Name" name="r_name" required />
          </div>
          <div class="form-group">
            <label for="name">Email Id:</label>
            <input type="email" class="form-control" id="email" value="<?php if (isset($email)) {
              echo $email;
            } ?>" placeholder="Enter Email" name="email" required />
            <span style="color:red;">
              <?php if (isset($email_error)) {
                echo $email_error;
              } ?>
            </span>
          </div>
          <div class="form-group">
            <label for="pswd">Password:</label>
            <input type="password" class="form-control" id="pswd" placeholder="Enter Password" name="pswd" required />
          </div>

          <!-- <div class="form-group">
                      <label for="gen">Gender: </label>
                      <input type="radio" name="gen" value="male" id="male">
                      <label for="male">Male</label>
                      <input type="radio" name="gen" value="female" id="female">
                      <label for="female">Female</label>
                  </div> -->

          <div class="form-group">
            <label for="mob">Mobile:</label>
            <input type="tel" class="form-control" pattern="[7-9]{1}[0-9]{9}" value="<?php if (isset($mob)) {
              echo $mob;
            } ?>" id="mob" placeholder="Enter number" name="mob" required />
          </div>
          <!-- <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="tel" class="form-control" pattern="[011]{3}[0-7]{7}" id="phone" value="<?php if (isset($phone)) {
              echo $phone;
            } ?>" placeholder="011-1234567" name="phone" required>
          </div> -->
          <div class="form-group">
            <label for="add">Address:</label>
            <input type="text" class="form-control" id="add" placeholder="Enter Address" value="<?php if (isset($address)) {
              echo $address;
            } ?>" name="address" required>
          </div>
          <div class="form-group">
            <input type="file" name="logo" required>
          </div>
          <!-- <button type="submit" id="register" name="register" class="btn btn-outline-primary">Register</button> -->
          <button type="submit" id="register" name="register" class="btn btn-outline-primary"
            style="background:#000000; border:1px solid #00ffff;">Register</button>
        </form>
      </div>
      <!-- <div class="tab-pane fade show" id="login" role="tabpanel" aria-labelledby="home-tab">
         <a href="vendor_login.html"><button type="button" style="padding:10px;  width:200px; margin-top:30%; margin-left:40%; margin:0px auto;" class="btn btn-outline-primary" name="login" value="Log In">Log In</button></a>
         <br>
     </div> -->
    </div>
    <br>
    <!-- <?php
    //  include("footer.php");
    ?> -->


</body>

</html>