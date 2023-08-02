<?php
session_start();
include("connection.php");
extract($_REQUEST);
if (isset($login)) {
  $sql = mysqli_query($con, "select * from tbadmin where fld_username='$username' && fld_password='$pswd' ");
  if (mysqli_num_rows($sql)) {
    $_SESSION['admin'] = $username;

    header('location:dashboard.php');

  } else {
    $admin_login_error = "Invalid Username or Password";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Admin</title>

  <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Aboreto&family=Anton&family=DynaPuff&family=Kanit:wght@500&family=Source+Sans+Pro&display=swap"
    rel="stylesheet">
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
  <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">		 -->
  <style>
    /*  body{
               background-image: url("img/adminbg.jpg") ;  
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
                background-blend-mode: normal;
                
            } */
    header::before {
      background-image: url("img/adminbg.jpg");
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

    .middle {
      background: linear-gradient(to bottom, #ff9933 0%, #9966ff 100%);
      height: 360px;
      position: relative;
      padding: 32px;
      border: 1px solid #00ffff;
      margin: 0px auto;
      width: 400px;
      border-radius: 40px;
    }

    .welcome {
      font-size: 1.4rem;
      /* color:aliceblue; */
      padding: 10px 50px;
      font-family: 'Anton', sans-serif;

    }

    /* style="color:black;font-family: 'Permanent Marker', cursive;" */
    .navbar-brand {
      font-family: 'Fredoka One', cursive;

    }

    .tab-content {
      font-size: 1.1rem;
      color: #000000;
      padding: 0px 2px;
      margin: 10px 7px;
    }
  </style>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color:#ff9933">

      <a class="navbar-brand" href="index.php"><span>Otaku's Hub</span></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
        aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">

        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="aboutus.php">About</a>
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
  </header>
  <br><br><br><br><br><br><br><br>

  <div class="middle">

    <!-- class="nav nav-tabs nabbar_inverse" id="myTab" style="background:#000000;border-radius:10px 10px 10px 10px;" role="tablist">
          <li class="nav-item">
             <a class="nav-link active" id="home-tab" data-toggle="tab" href="#login" role="tab" aria-controls="home" aria-selected="true">Home</a>
          </li>
          -->
    <a class="welcome" id="profile-tab" aria-controls="profile" aria-selected="false">Log into Little Otaku's Hub</a>

    <br><br>
    <div class="tab-content" id="myTabContent">
      <!--login Section-- starts-->
      <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="home-tab">
        <div class="footer" style="color:red;">
          <?php if (isset($loginmsg)) {
            echo $loginmsg;
          } ?>
        </div>
        <form method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="email">Email address:</label>
            <input type="text" class="form-control" name="username" id="email" required />
          </div>
          <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" name="pswd" class="form-control" id="pwd" required />
          </div>

          <button type="submit" name="login" style="background:#000000; border:1px solid #00ffff;"
            class="btn btn-primary">Login </button>

          <div class="footer" style="color:red;">
            <?php if (isset($admin_login_error)) {
              echo $admin_login_error;
            } ?>
          </div>
          <div class="footer" style="color:green;">
            <?php if (isset($_SESSION['pas_update_success'])) {
              echo $_SESSION['pas_update_success'];
            } ?>
          </div>
        </form>
      </div>
      <!--login Section-- ends-->
    </div>
  </div>
  <br><br><br><br><br><br><br>
  <?php
  // include("footer.php");
  ?>
</body>

</html>