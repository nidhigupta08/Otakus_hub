<?php
session_start();
include("connection.php");
extract($_REQUEST);
if (isset($_SESSION['id'])) {
  header("location:good.php");
}
if (isset($login)) {
  $sql = mysqli_query($con, "select * from tblvendor where fld_email='$username' && fld_password='$pswd' ");
  if (mysqli_num_rows($sql)) {
    $_SESSION['id'] = $username;
    header('location:good.php');
  } else {
    $admin_login_error = "Invalid Username or Password";
  }
}
?>

<head>
  <meta charset="UTF-8">
  <title>Merchant Login</title>

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
  <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        -->

  <link
    href="https://fonts.googleapis.com/css2?family=Aboreto&family=Anton&family=DynaPuff&family=Kanit:wght@500&family=Source+Sans+Pro&display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
  <style>
    /* body{
                background-image: url("img/anime.jpg") ;
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
                background-blend-mode: normal;
                
            }  */

    .middle {
      background: linear-gradient(to bottom, #ff9933 0%, #9966ff 100%);
      position: fixed;
      padding: 20px;
      border: 1px #00ffff;
      left: 38%;
      top: 30%;
      width: 400px;
      border-radius: 40px;
    }

    .navbar-brand {
      font-family: 'Fredoka One', cursive;
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
      background-image: url("img/anime-wallpaper 5.jfif");
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

    ul li {
      font-family: 'Noto Sans', sans-serif;
      color: white;
    }

    a:hover {
      color: black;
    }
  </style>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light  fixed-top" style="background-color:#ff9933">

      <a class="navbar-brand" href="index.php"><span>Otaku's Hub</span></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
        aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">

        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
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


        </ul>

      </div>

    </nav>
  </header>
  <div class="middle">
    <!-- <ul class="nav nav-tabs nabbar_inverse" id="myTab" style="background:#000000;border-radius:10px 10px 10px 10px;" role="tablist">
     <li class="nav-item">
       <a class="nav-link active" id="home-tab" data-toggle="tab" href="#login" role="tab" aria-controls="home" aria-selected="true">Merchant Login</a>
    </li> 
   
        <a class="nav-link" id="profile-tab" style="color:white;"    aria-controls="profile" aria-selected="false">Welcome</a> 
   
 </ul> -->


    <div class="mer">Merchant Login Form</div>

    <br>
    <div class="tab-content" id="myTabContent">
      <!--login Section-- starts-->
      <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="home-tab">
        <div class="footer" style="color:red;">
          <?php if (isset($admin_login_error)) {
            echo $admin_login_error;
          } ?>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username"
              required />
          </div>
          <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" required />
          </div>

          <button type="submit" name="login" class="btn btn-primary">Login</button><br><br>

          <div class="signup-link">Doesn't have an account? <a href="vendor-new.php"><u>Sign Up</u></a></div>
          <!-- 
                          <a href="vendor-new.php"><button type="button" name="new" class="btn btn-warning">Sign Up</button></a> -->
        </form>
      </div>
      <!--login Section-- ends-->
    </div>
  </div>

</body>