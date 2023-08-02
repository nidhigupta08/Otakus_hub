<?php

header("refresh:3;url=cart.php");


?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Material Login Form</title>
  <style>
    h1 {
      text-align: center;
      font-size: 60px;
      margin-top: 0px;
    }

    p {
      text-align: center;
      font-size: 60px;
      margin-top: 0px;
    }
  </style>

</head>

<body>
  <div class="container" style="margin:0px auto;text-align:center;">
    <p style="color:black;"> Wait removing Item from cart </p>
    <img src="../img/lg.walking-clock-preloader.gif" />
  </div>
  <h1><time>00</time></h1>
  <script>
    var h1 = document.getElementsByTagName('h1')[0],
      start = document.getElementById('start'),
      stop = document.getElementById('stop'),
      clear = document.getElementById('clear'),
      seconds = 0, minutes = 0, hours = 0,
      t;

    function add() {
      seconds++;
      if (seconds >= 60) {
        seconds = 0;
        minutes++;
        if (minutes >= 60) {
          minutes = 0;
          hours++;
        }
      }

      h1.textContent = (seconds > 9 ? seconds : "0" + seconds);

      timer();
    }
    function timer() {
      t = setTimeout(add, 1000);
    }
    timer();



  </script>

</body>

</html>