<?php
  require_once "./model/User.php";
  require_once "./model/Cart.php";

  session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>GO-PHARMA</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
    integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>

  <script src="ajax.js"></script>
</head>

<body onload="onloadAll()">
  <div class="container-fluid p-0" style="background: url(./image/bg_1.jpg) no-repeat;
  background-size: cover;
  height: calc(100vh);">
    <p style="font-size: 240%;font-weight: bold;margin-left: 140px;position: absolute;margin-top: 110px;">WELCOME TO
      <br>
      GO-PHARMA
    </p>
    <p style="margin-left: 140px;position: absolute;margin-top: 295px;">Buy A Medicine<br> Fast & Easy <br> With One
      Click! <br>
    </p>
    <br>
    <button style="margin-left: 140px;position: absolute;margin-top: 370px;background: #fb9200;padding: 10px;border: 0;border-radius: 30px;color: #fff;padding-left: 30px;padding-right: 30px;-webkit-box-shadow: 10px 13px 38px -19px rgba(251,146,0,1);
    -moz-box-shadow: 10px 13px 38px -19px rgba(251,146,0,1);
    box-shadow: 10px 13px 38px -19px rgba(251,146,0,1);">Shop Now</button>
    <nav id="menu" style="position: fixed;z-index: 999;">
      <?php require_once "./View/user-header.php" ?>
    </nav>
  </div>
  <div class="modal fade bd-example-modal-lg22" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content p-3" style="width: 150%;left: -200px;">
        <p class="font-weight-bold" style="font-size: 110%">Order History</p>
        <div data-spy="scroll" data-target="#myScrollspy" data-offset="10"
          style="height:520px;overflow-y: scroll;padding-top: 5px;padding-right: 10px;">
          <table class="table table-borderless">
            <thead>
              <tr>
                <th scope="col" style="width: 20%;font-size: 115%;">Order History</th>
                <th scope="col" style="width: 44%;font-size: 115%;" class="text-center">Product</th>
                <th scope="col" style="width: 18%;font-size: 115%;" class="text-center">Price</th>
                <th scope="col" style="width: 18%;font-size: 115%;" class="text-center">Status</th>
              </tr>
            </thead>
            <tbody id="prinfPaymentUser">

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


  <!-- modal untuk memunculkan pop-up -->
  <div class="modal fade bd-example-modal-sm33 mt-5" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel33"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="iconpopup " style="margin: 0 auto; width: 27%;height: 100%; margin-top: 20%;">
          <img id="notick" src="tick.png" width="100%">
          <img id="errortick" src="ticknot.png" width="100%" style="display: none;">
          <img id="changeimg" src="defender.png" width="100%" style="display: none;">
        </div>

        <div id="changepass" class=" iconpopup mt-4" style="margin: 0 auto; width: 80%;margin-bottom: 10%;">
          <p class="text-center mb-3" style="font-weight: bold;margin-bottom: 2%;font-size: 120%">Change Password</p>
          <p class="mt-3" style="margin-bottom: 2%;">Enter Old Password</p>
          <input type="password" name="pass" id="passcurrent" class="form-control ">
          <p class="mt-1" style="margin-bottom: 2%;">Enter New Password</p>
          <input type="password" name="pass" id="passnew" class="form-control ">
          <p class="mt-1" style="margin-bottom: 2%;">Enter Your New Password Again</p>
          <input type="password" name="pass" id="passnewrepeat" class="form-control ">
          <p id="notification_change_pass" class="mt-4 text-center mb-0 " style="font-size: 90%;color: red;"></p>
          <button class="btn btn-warning float-right mt-3" onclick="Changepassword()">Change</button>
        </div>
      </div>
    </div>
  </div>

  <!-- css internal -->
  <style type="text/css">
    .produre_box {
      width: 100%;
      border-top-right-radius: 40px;
      border-bottom-left-radius: 40px;
    }

    .image_box {
      width: 100%;
      height: 150px;
    }

    .image_box img {
      border-top-right-radius: 35px;
      border-bottom-left-radius: 35px;
    }

    .info_box {
      width: 100%;
      border-bottom-left-radius: 35px;
    }

    .star_box {
      width: 50%;
      height: 50px;
    }

    .order_box {
      width: 50%;
      height: 50px;
    }

    .order_button {
      width: 80%;
      height: 40px;
      background: #fb9200;
      border-top-left-radius: 15px;
      padding-left: 2rem;
    }

    .order_button i {
      color: #fff;
      font-size: 150%;
    }

    .scroll_event_Add_class {
      background: #fff;
    }

    .scroll_event_Add_class_text {
      color: black
    }
  </style>

  <!-- modal untuk pop-up -->
  <div class="modal fade login mt-5 " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content ">
        <div class="cart_box" style="width: 100%;margin: auto;">
          <div class="login_img_box float-left" style="width: 50%;height: 450px;background: orange;">
            <img src="image/profile.png" width="100%" height="100%">
          </div>

          <div id="login_box">
            <div class="login_info_box float-right p-5" style="width: 50%;height: 450px;">
              <p class="text-center font-weight-bold" style="font-size: 140%">Login</p>
              <label class="font-weight-bold mt-3">Username</label>
              <input id="usernameLogin" type="text" class="form-control" aria-describedby="emailHelp"
                placeholder="Insert Username" style="outline: none;">
              <label class="mt-3 font-weight-bold">Password</label>
              <input id="passwordLogin" type="password" class="form-control" aria-describedby="emailHelp"
                placeholder="Insert Password">
              <button onclick="ajaxLogin()" class="btn btn-primary mt-4"
                style="width: 100%;background: #fb9200;border: 0;outline: none;">Login</button>
              <p id="statusLogin" class="text-center mt-4" style="font-size: 90%;color: red;"></p>
              <p onclick="move_signup()" class="text-center mt-3" style="font-size: 90%">Dont Have an Account?
                <strong style="color:#fb9200 "> Register</strong>
              </p>
            </div>
          </div>
          <!-- akhir dari modal untuk pop-up -->

          <!-- untuk bagian signup -->
          <div id="signup_box" style="display: none;">
            <div class="signup_info_box float-right p-4 pl-5 pr-5" style="width: 50%;height: 600px;">
              <p class="text-center font-weight-bold" style="font-size: 140%">Register</p>
              <label class="font-weight-bold mt-1">Username</label>
              <input id="usernameSignup" type="email" class="form-control" aria-describedby="emailHelp"
                placeholder="Enter Username" style="outline: none;">
              <label class="font-weight-bold mt-1">Name</label>
              <input id="nameSignup" type="text" class="form-control" aria-describedby="emailHelp"
                placeholder="Enter Name" style="outline: none;">
              <label class="font-weight-bold mt-1">Address</label>
              <input id="addressSignup" type="text" class="form-control" aria-describedby="emailHelp"
                placeholder="Enter Address" style="outline: none;">
              <label class="mt-3 font-weight-bold">Password</label>
              <input id="passwordSignup" type="password" class="form-control" aria-describedby="emailHelp"
                placeholder="Enter Password">
              <label class="mt-3 font-weight-bold">Password Again</label>
              <input id="RepasswordSignup" type="password" class="form-control" aria-describedby="emailHelp"
                placeholder="Enter Your Password Again">
              <button onclick="ajaxRegister()" class="btn btn-primary mt-4"
                style="width: 100%;background: #fb9200;border: 0;outline: none;">
                Register</button>
              <p id="statusSignup" class="text-center mt-3 mb-1" style="font-size: 90%;color: red;"></p>
              <p onclick="move_login()" class="text-center mt-0" style="font-size: 90%">Have an Account?<strong
                  style="color:#fb9200 "> Login</strong> </p>
            </div>
          </div>
          <!-- akhir dari  untuk bagian signup -->
          <div style="clear: both;"></div>
        </div>
      </div>
    </div>
  </div>



  <!-- modal untuk mmebuat sebuah pop-up -->
  <div class="modal fade orderCart mt-3 " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content ">
        <div id="checkout_form" class="cart_box pl-5 pt-4 shadow-sm mt-3 pb-4" style="width: 100%;margin: auto;">
          <p class="ml-2" style="font-size: 130%;font-weight: bold;">Add Cart</p>
          <div data-spy="scroll" data-target="#myScrollspy" data-offset="10"
            style="height:340px;overflow-y: scroll;padding-top: 5px;padding-right: 10px;">
            <table class="table table-borderless">
              <thead>
                <tr>
                  <th scope="col" style="width: 40%;font-size: 115%;">Product</th>
                  <th scope="col" style="width: 20%;font-size: 115%;" class="text-center">Total</th>
                  <th scope="col" style="width: 20%;font-size: 115%;" class="text-center">Price</th>
                  <th scope="col" style="width: 20%;font-size: 115%;" class="text-center">Delete</th>
                </tr>
              </thead>
              <tbody id="prinf_order_cart">

              </tbody>
            </table>
          </div>
          <div class="float-left pl-2" style="width: 30%;">
            <p class="font-weight-bold mt-2" style="font-size: 115%">Total</p>
          </div>
          <div class="float-right pr-5" style="width: 30%;">
            <p id="total_money" class="font-weight-bold float-right mt-2" style="font-size: 115%"> </p>
          </div>
          <div style="clear: both;"></div>
          <div onclick="ajaxCheckout()" class="btn mr-5 text-white float-right" style="background: #fb9200;">Checkout
          </div>
          <div style="clear: both;"></div>
        </div>

        <div id="payment_form" class="p-5" style="width: 100%;height: 400px;display: none;">
          <div class="choose_box float-left" style="width: 60%;">
            <p class="font-weight-bold" style="font-size: 130%">Payment</p>
            <p class="mb-2 font-weight-bold">Choose Payment Method</p>
            <div class="payment_choose_box" style="width: 60%">
              <div class="float-left pr-1 pb-1" style="width: 50%;height: 80px;">
                <img onclick="viettinbank()" class="payment_vietinbank " src="image/Vietinbank201808092833.png"
                  width="100%" height="100%" style="border: 1px solid #d7d7d7;">
              </div>
              <div class="float-right pr-1 pb-1" style="width: 50%;height: 80px;">
                <img onclick="donga()" class="payment_donga" src="image/DongABank201808092734.png" width="100%"
                  height="100%" style="border: 1px solid #d7d7d7;">
              </div>
              <div class="float-left pr-1 pb-1" style="width: 50%;height: 80px;">
                <img onclick="nama()" class="payment_nama" src="image/NamABank201808092054.png" width="100%"
                  height="100%" style="border: 1px solid #d7d7d7;">
              </div>
              <div class="float-right pr-1 pb-1" style="width: 50%;height: 80px;">
                <img onclick="sacom()" class="payment_sacom pl-3 pr-3" src="image/images.png" width="100%" height="100%"
                  style="border: 1px solid #d7d7d7;">
              </div>
              <div style="clear: both;"></div>
            </div>
          </div>
          <div class="choose_box p-3 float-right" style="width: 40%;height: 100px; margin-top: -30px;">
            <!-- <label for="exampleInputEmail1">Username</label>
            <input id="name_customer" type="text" class="form-control " id="exampleInputEmail1"
              aria-describedby="emailHelp">
            <label for="exampleInputEmail1" class="mt-3">Phone Number</label>
            <input id="phone_customer" type="text" class="form-control " id="exampleInputEmail1"
              aria-describedby="emailHelp" placeholder="Masukan nomor hp">
            -->
            <label for="exampleInputEmail1" class="mt-3">Address</label>
            <input id="address_customer" type="text" class="form-control" id="exampleInputEmail1"
              aria-describedby="emailHelp" placeholder="Masukan alamat">
            <button onclick="payment()" class="btn btn-primary float-right mt-3">Send</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- akhir modal untuk mmebuat sebuah pop-up -->

  <!-- untuk searching -->
  <div class="form-group" style="width: 300px; margin-left: 100px; margin-top: 20px;">
    <input type="text" class="form-control" id="myInput" placeholder="Kata kunci.." required="">
  </div>
  <!-- akhir untuk searching -->

  <!-- untuk menampilkan menu obat -->
  <div id="list_food_home" class="container">
    <div class="row" id="prinf_food">

    </div>
  </div>

  <!--akhir untuk menampilkan menu obat -->

  <!-- javscript internal -->

  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
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
  <script>
    window.onscroll = function () { myFunction() };

    // untuk scroll header fix
    function myFunction() {
      if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 120) {
        document.getElementById("menu").className = "scroll_event_Add_class";
      } else {
        document.getElementById("menu").className = "";
      }
    }
  </script>
  <style type="text/css">
    .menu_account_show {
      display: block !important;
    }
  </style>
  <script src="jquery/jquery.min.js"></script>
  <script src="jquery.easing/jquery.easing.min.js"></script>
  <script src="main.js"></script>
  <script>
    // untuk searching
    /*
    $(document).ready(function () {

      $("#myInput").on("keyup", function () {

        var value = $(this).val().toLowerCase();

        $("#myTable, .ok").filter(function () {

          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)

        });

      });

    });
    */

  </script>
</body>

</html>