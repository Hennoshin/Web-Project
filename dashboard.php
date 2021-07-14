<?php

  session_start();

  if ($_SESSION["assupplier"] != true) {
    header("location: index.php");
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Responsive Navbar</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
 
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
    integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  
  <script src="dashajax.js"></script>
</head>
<style type="text/css">
  ::-webkit-scrollbar:horizontal {
    display: none;
  }

  ::-webkit-scrollbar {
    width: 6px;
    height: 6px;
    background-color: #fff;
  }

  ::-webkit-scrollbar-thumb {
    background-color: #fff;
  }

  ::-webkit-scrollbar-track {

    background-color: #f8fafd;
  }
</style>

<body onload="onloadAll1()">
  <div class="container-fluid p-0">
    <div class="row m-0 p-0">
      <div class="col-2 pl-0 p-0" style="height: 100vh;">
        <div style="position: fixed;width: 220px;">
          <p class="text-center font-weight-bold mt-3 mb-4" style="font-size: 120%">GO-PHARMA</p>
          <div onclick="showAdd_food()" id="add_food3" class="add_produre mt-3"
            style="width: 80%;background: #ff6f47;margin: auto;border-radius: 10px;padding: 12px;">
            <p class="mb-0 text-white">Add Product <i class="fa fa-plus" aria-hidden="true"></i></p>
          </div>

          <!-- untuk bagian dashboard -->
          <div class="add_produre mt-4" style="width: 85%;margin: auto;border-radius: 10px;display: flex;">
            <div class="icon_bar" style="width: 16%;padding: 7px;">
              <img src="image/Group 261.svg">
            </div>
            <div class="text_bar p-2 pr-0">
              <p id="dashboard_text" class="mb-0" style="font-weight: bold;">dashboard</p>
            </div>
          </div>

          <!-- edit profile -->
          <div class="add_produre mt-2" style="width: 85%;margin: auto;border-radius: 10px;display: flex;">
            <div class="icon_bar" style="width: 16%;padding: 7px;">
              <img src="image/ic_settings_24px.svg">
            </div>
            <div class="text_bar p-2 pr-0" style="width: 80%;">
              <p id="management_food" class="mb-0">Edit Product</p>
            </div>
          </div>

          <!-- tambah cart -->
          <div class="add_produre mt-2" style="width: 85%;margin: auto;border-radius: 10px;display: flex;">
            <div class="icon_bar" style="width: 16%;padding: 7px;">
              <img src="image/ic_shopping_cart_24px.svg">
            </div>
            <div class="text_bar p-2 pr-0" style="width: 80%;">
              <p id="management_order" class="mb-0">Cart</p>
            </div>
          </div>

          <div class="add_produre mt-2" style="width: 85%;margin: auto;border-radius: 10px;display: flex;">
            <div class="icon_bar" style="width: 16%;padding: 7px;">
              <img src="">
            </div>
            <div class="text_bar p-2 pr-0" style="width: 80%;">
              <p id="management_order" class="mb-0" onclick="logout()">Logout</p>
            </div>
          </div>
        </div>
      </div>

      <!-- tampilan dari dashboard -->
      <div class="col-10  p-0">
        <div class="row m-0 p-0 ">
          <div class="col-12 bg-white" style="height: 70px;">
          </div>
          <div id="dashboard_box" class="col-12 bg-white mt-1" style="height: 570px;">
            <p class="font-weight-bold" style="font-size: 130%">dashboard</p>
            <div id="input_food" style="display: none;">
            </div>
            <div class="row m-0">
              <div class="col-xs-12 col-sm-6 col-md-3 p-3">
                <div class="ana_food pt-2 pb-0 pl-4 pr-3 shadow-sm" style="background: #fff;">
                  <p style="font-size: 110%" class="float-left mt-1">Product</p>
                  <p id="dem_food" style="font-size: 200%;font-weight: bold;" class="float-right mt-4 mb-2"></p>
                  <div style="clear: both;"></div>
                </div>
              </div>
            </div>

              <!-- bagian produk di dashboard -->
              <div class="col-6 p-3">
                <div class="payment_food_dash pt-2 pb-0 pl-4 pr-3 shadow-sm" style="height: 300px;background: #fff">
                  <p style="font-size: 110%" class=" mt-1">Product List</p>
                  <div id="scroll_height2" data-spy="scroll" data-target="#myScrollspy" data-offset="10"
                    style="height:220px;overflow-y: scroll;padding-top: 5px;padding-right: 10px;">
                    <table class="table table-borderless" style="margin-top: -25px;">
                      <thead>
                        <tr>
                          <th scope="col" style="width: 60%;font-size: 115%;"></th>
                          <th scope="col" style="width: 40%;font-size: 115%;" class="text-center"></th>
                        </tr>
                      </thead>

                      <!-- data yg di panggil di js untuk menu produk -->
                      <tbody id="prinfManagementFood2">


                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- untuk bagian menu  -->
          <div id="management_food_order" class="col-12" style="display: none;">
            <p class="font-weight-bold" style="font-size: 130%">Cart</p>
            <div class="shadow-sm pt-2" style="width: 100%;height: 530px;background: #fff;">
              <div id="scroll_height" data-spy="scroll" data-target="#myScrollspy" data-offset="10"
                style="height:480px;overflow-y: scroll;padding-top: 5px;padding-right: 10px;">
                <div class="cart_box pl-5 pt-0 pb-4 pr-4" style="width: 100%;margin: auto;">
                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col" style="width: 20%;font-size: 115%;">Order History</th>
                        <th scope="col" style="width: 44%;font-size: 115%;" class="text-center">Product</th>
                        <th scope="col" style="width: 18%;font-size: 115%;" class="text-center">Price</th>
                        <th scope="col" style="width: 18%;font-size: 115%;" class="text-center">Status</th>
                      </tr>
                    </thead>

                    <!-- bagian memunculkan pembayaran -->
                    <tbody id="prinfPayment">

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <!-- untuk bagian tambah produk -->
          <div id="management_food_box" class="col-12 bg-white mt-1" style="height: 570px;display: none;">
            <p class="font-weight-bold" style="font-size: 130%"></p>
            <div id="input_food2" style="display: none;">
              <div class="row m-0 shadow-sm pt-3">
                <div class="col-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Product</label>
                    <input type="text" class="form-control" id="foodAddNameInput" placeholder="Enter Product">
                    <input class="float-right" type="text" id="txtId" name="txtPrice"
                      style="border:0; border-radius: 10px;height: 40px;background:#f8fafd;width:100%;outline: none;display: none;">
                  </div>
                </div>
                <div class="col-3" style="height: 100px;">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Details</label>
                    <input type="email" class="form-control" id="foodAddNoteInput" placeholder="Enter Details">
                  </div>
                </div>
                <div class="col-3" style="height: 100px;">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Price</label>
                    <input type="number" class="form-control" id="foodAddPriceInput" placeholder="Price">
                  </div>
                </div>
                <div id="picupload" class="col-3 p-0 pt-3 pl-3" style="height: 100px;">
                  <div class="btn btn-rounded waves-effect btn-sm"
                    style="border-radius: 10px;width: 90%;background: #ff6f47">
                    <span class="text-white">Upload Picture</span>
                    <form method="POST" id="uploadFile" enctype="multipart/form-data">
                      <input class="text-white" type="file" type="file" name="file" id="foodAddImageInput">
                      <input type="submit" id="addfood2" class="btn btn-primary float-left"
                      style="background: #ff6f47;border: 1px solid #ff6f47;" value="Send">
                    </form>
                  </div>
                </div>
                <div class="col-8 p-0  pl-3 pb-4">
                  <!-- <button id="addfood2" onclick="addProduct()" class="btn btn-primary float-left"
                    style="background: #ff6f47;border: 1px solid #ff6f47;">Kirim</button> -->
                  <button id="updatefood2" onclick="saveUpdate()" class="btn btn-warning text-white float-left"
                    style="display: none;">Update</button>
                  <button onclick="CloseFood()" class="btn btn-danger text-white ml-1">Cancel</button>
                </div>

              </div>
            </div>

            <div class="cart_box pl-5 pt-4 shadow-sm mt-3 pb-4" style="width: 100%;margin: auto;">
              <div id="scroll_height2" data-spy="scroll" data-target="#myScrollspy" data-offset="10"
                style="height:450px;overflow-y: scroll;padding-top: 5px;padding-right: 10px;">
                <table class="table table-borderless">
                  <thead>
                    <tr>
                      <th scope="col" style="width: 40%;font-size: 115%;">Product</th>
                      <th scope="col" style="width: 20%;font-size: 115%;" class="text-center">Price</th>
                      <th scope="col" style="width: 20%;font-size: 115%;" class="text-center">Action</th>
                    </tr>
                  </thead>

                  <!-- untuk memunculkan data produk yg ada -->
                  <tbody id="prinfManagementFood">

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
    <script src="dashboard.js"></script>

</body>





</html>