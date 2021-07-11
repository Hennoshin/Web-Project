<?php
    if (isset($_SESSION["user"]) && ($_SESSION["logedin"] === true)) { ?>
        <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
      </label>
      <label class="logo">GO-PHARMA</label>
      <ul>
        <li><a onclick="home_page()" class="active text-white">Home</a></li>
        <li><a id="cart_menu" data-toggle="modal" data-target=".orderCart">Cart<div
              style="width: 20px;height: 20px;background: #fb9200;position: absolute;top: 15px;margin-left: 40px;border-radius: 50%">
              <p id="order_number"
                style="position: absolute;margin-top: -30px;margin-left: 7px;color: #fff;font-size: 80%">0</p>
            </div> </a></li>
        <li><a id="menu_login_button" data-toggle="modal" data-target=".login" style="display: none;">Login</a></li>
        <li><a id="menu_account_login" class="menu_account_hide" style="display: block;"><?php echo $_SESSION["user"]->getName(); ?></a>
        </li>
      </ul>

      <!-- untuk menu logout n login -->
      <div id="menu_logout" style="display: block;">
        <div id="menu_header22" class="khung p-3"
          style="margin: 0 auto;width: 200px; background: orange; border-radius: 8px; font-family: Helvetica, Arial, sans-serif;padding: 0.5rem;position: absolute;z-index: 999;margin-left: calc(100vw - 250px);margin-top: -25px;display: none;">
          <p id="hello_user" class="text-white" style="opacity: 0.9"><?php echo "Welcome " . $_SESSION["user"]->getName() . " !"; ?></p>
          <div id="quanlydon" class="box p-1" style="height: 35px;display: none;">
            <a href="dashboard.html">
              <p><i class="fa fa-list-alt text-white mr-3" aria-hidden="true"></i>Dashboard</p>
            </a>
          </div>
          <div class="box p-1" data-toggle="modal" data-target=".bd-example-modal-lg22" style="height: 35px">
            <p onclick="ajaxOrderShow()"><i class="fa fa-list-alt text-white mr-3" aria-hidden="true"></i>Order History</p>
          </div>
          <div class="box p-1" data-toggle="modal" data-target=".bd-example-modal-sm33" style="height: 35px">
            <p><i class="fa fa-key text-white mr-3" aria-hidden="true"></i>Password</p>
          </div>
          <div class="box p-1" style="height: 35px">
            <p onclick="logout()"><i class="fa fa-sign-out text-white mr-3" aria-hidden="true"></i>Logout</p>
          </div>
        </div>
      </div>

    <?php
    } else { ?>
        <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
      </label>
      <label class="logo">GO-PHARMA</label>
      <ul>
        <li><a onclick="home_page()" class="active text-white">Home</a></li>
        <li><a id="cart_menu" data-toggle="modal" data-target=".orderCart">Cart<div
              style="width: 20px;height: 20px;background: #fb9200;position: absolute;top: 15px;margin-left: 40px;border-radius: 50%">
              <p id="order_number"
                style="position: absolute;margin-top: -30px;margin-left: 7px;color: #fff;font-size: 80%">0</p>
            </div> </a></li>
        <li><a id="menu_login_button" data-toggle="modal" data-target=".login">Login</a></li>
        <li><a id="menu_account_login" class="menu_account_hide" style="display: none;"></a>
        </li>
      </ul>

      <!-- untuk menu logout n login -->
      <div id="menu_logout">
        <div id="menu_header22" class="khung p-3"
          style="margin: 0 auto;width: 200px; background: orange; border-radius: 8px; font-family: Helvetica, Arial, sans-serif;padding: 0.5rem;position: absolute;z-index: 999;margin-left: calc(100vw - 250px);margin-top: -25px;display: none;">
          <p id="hello_user" class="text-white" style="opacity: 0.9"></p>
          <div id="quanlydon" class="box p-1" style="height: 35px;display: none;">
            <a href="dashboard.html">
              <p><i class="fa fa-list-alt text-white mr-3" aria-hidden="true"></i>Dashboard</p>
            </a>
          </div>
          <div class="box p-1" data-toggle="modal" data-target=".bd-example-modal-lg22" style="height: 35px">
            <p><i class="fa fa-list-alt text-white mr-3" aria-hidden="true"></i>Order History</p>
          </div>
          <div class="box p-1" data-toggle="modal" data-target=".bd-example-modal-sm33" style="height: 35px">
            <p><i class="fa fa-key text-white mr-3" aria-hidden="true"></i>Password</p>
          </div>
          <div class="box p-1" style="height: 35px">
            <p onclick="logout()"><i class="fa fa-sign-out text-white mr-3" aria-hidden="true"></i>Logout</p>
          </div>
        </div>
      </div>

<?php
    }
?>