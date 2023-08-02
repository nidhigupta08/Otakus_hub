<?php
session_start();
include("../connection.php");
extract($_REQUEST);
if (isset($_GET['product'])) {
  $product_id = $_GET['product'];
} else {
  $product_id = "";
}

if (isset($login)) {
  $query = mysqli_query($con, "select * from tblcustomer where fld_email='$email' && password='$password'");
  if ($row = mysqli_fetch_array($query)) {
    $customer_email = $row['fld_email'];
    $_SESSION['cust_id'] = $customer_email;
    if (!empty($customer_email && $product_id)) {
      //$_SESSION['product']=$product_id;
      echo $_SESSION['cust_id'] = $customer_email;

      header("location:cart.php?product=$product_id");

    } else {
      header("location:../index.php");
      $_SESSION['product'] = $product_id;
      $_SESSION['cust_id'];
    }

  } else {
    $ermsg = "invalid Details";
  }
}

if (isset($register)) {
  $query = mysqli_query($con, "select * from tblcustomer where fld_email='$email'");
  $row = mysqli_num_rows($query);
  if ($row) {
    $ermsg2 = "Email already registered with us";

  } else {
    if (mysqli_query($con, "insert into tblcustomer (fld_name,fld_email,password,fld_mobile) values('$name','$email','$password','$mobile')")) {
      $_SESSION['cust_id'] = $email;
      if (!empty($customer_email && $product_id)) {
        $_SESSION['cust_id'] = $customer_email;
        header("location:cart.php?product='$product_id'");

      } else {
        $_SESSION['cust_id'] = $email;
        header("location:../index.php");
      }


    } else {
      echo "fail";
      echo $name;
      echo $email;
      echo $password;
      echo $mobile;
    }
  }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Material Login Form</title>
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

  <link
    href="https://fonts.googleapis.com/css2?family=Aboreto&family=Anton&family=DynaPuff&family=Kanit:wght@500&family=Source+Sans+Pro&display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
  <style>
    .navbar-brand {
      font-family: 'Fredoka One', cursive;
      color: black;
    }

    /* body{
                background-image: url("img/bg_login.jpg") ;
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
                background-blend-mode: normal;
                
            }   */
    /* style=" position:fixed; padding:40px; border:1px solid #00ffff; left:30%; top:30%; width:400px;" */
    .middle {
      background: linear-gradient(to bottom, #ff9933 0%, #9966ff 100%);
      position: fixed;
      padding: 20px;
      border: 1px solid #00ffff;
      left: 38%;
      top: 20%;
      width: 400px;
      border-radius: 20px;
    }

    .mer {
      font-size: 1.5rem;
      color: black;
      font-family: 'Anton', sans-serif;
      text-align: center;
    }

    a {
      color: white;
    }

    header::before {
      background-image: url("user_login.jpeg");
      content: "";
      z-index: -1;
      opacity: 0.9;
      position: absolute;
      width: 100%;
      height: 100%;

      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
      background-blend-mode: normal;

    }

    /* ul li a {color:white;padding:40px; }
		ul li a:hover {color:white;} */
  </style>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light  fixed-top" style="background-color:#ff9933">

      <a class="navbar-brand" href="./../index.php"><span>Otakus Hub</span></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
        aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">

        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="../index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../aboutus.php">About Us</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="../services.php">Services</a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" href="../contact.php">Contact</a>
          </li>

        </ul>
      </div>

    </nav>
  </header>
  <br><br>
  <div class="middle">
    <!-- <ul class="nav nav-tabs nabbar_inverse" id="myTab" style="background:#000000;border-radius:10px 10px 10px 10px;" role="tablist">
          <li class="nav-item">
             <a class="nav-link active" id="home-tab" data-toggle="tab" href="#login" role="tab" aria-controls="home" aria-selected="true">User Login</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#signup" role="tab" aria-controls="profile" aria-selected="false">Create New Account</a>
          </li>
       </ul>
	   <br><br> -->

    <div class="tab-content" id="myTabContent">
      <!--login Section-- starts-->
      <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="home-tab">
        <form method="post" enctype="multipart/form-data">
          <div class="mer">User Login</div>
          <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" class="form-control" name="email" id="email" required />
          </div>
          <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" name="password" class="form-control" id="pwd" required />
          </div>

          <button type="submit" name="login" style="background:#000000; border:1px solid #00ffff;"
            class="btn btn-primary">Login In</button>

          <div style="display: flex;" class="signup-link">Doesn't have an account?<a style="margin-left: 4px;"
              id="profile-tab" data-toggle="tab" href="#signup" role="tab" aria-controls="profile"
              aria-selected="false"><u>Sign Up</u></a></div>



          <div class="footer" style="color:red;">
            <?php if (isset($ermsg)) {
              echo $ermsg;
            } ?>
            <?php if (isset($ermsg2)) {
              echo $ermsg2;
            } ?>
          </div>
        </form>
      </div>
      <!--login Section-- ends-->

      <!--new account Section-- starts-->
      <div class="tab-pane fade" id="signup" role="tabpanel" aria-labelledby="profile-tab">
        <form method="post" enctype="multipart/form-data">
          <div class="mer">User Registration Form</div>
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" class="form-control" name="name" required="required" />
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" required />
          </div>

          <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" name="password" class="form-control" id="pwd" required />
          </div>

          <div class="form-group">
            <label for="mobile">Mobile</label>
            <input type="tel" id="mobile" class="form-control" name="mobile" pattern="[6-9]{1}[0-9]{2}[0-9]{3}[0-9]{4}"
              placeholder="" required>
          </div>

          <button type="submit" name="register" style="background:#000000; border:1px solid #00ffff;"
            class="btn btn-primary">Submit</button>
          <div class="footer" style="color:red;">
            <?php if (isset($ermsg)) {
              echo $ermsg;
            } ?>
            <?php if (isset($ermsg2)) {
              echo $ermsg2;
            } ?>
          </div>
        </form>
        <div style="display: flex;" class="signup-link">Already't have an account?<a style="margin-left: 4px;"
            id="profile-tab" data-toggle="tab" href="#login" role="tab" aria-controls="profile"
            aria-selected="false"><u>Sign In</u></a></div>
      </div>

    </div>
  </div>

</body>