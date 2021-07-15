$(document).ready(function() {
    ajaxShowProduct();
    $("#myInput").on("keyup", function() {
        ajaxShowProduct($("#myInput").val());
    });
    $("#cart_menu").on("click", function() {
        $("#payment_form").css("display", "none");
        $("#checkout_form").css("display", "block");
    });
})

function ajaxShowProduct(keyword = "") {
    $.ajax({
        url: "product-control.php",
        type: "POST",
        data: { keyword: keyword },
        success: function(response) {
            $("#prinf_food").html(response);
        }
    });
}

function addToCart(pid) {
    $.ajax({
        url: "cart-control.php",
        type: "POST",
        data: { op: "add", pid: pid },
        success: function(response) {
            if (response == -1) {
                alert("You have to login first");
            }
            else {
                let resps = response.split(".sep.");
                $("#prinf_order_cart").html(resps[0]);
                $("#total_money").html("RM " + resps[1]);
                $("#order_number").html(resps[2])
                console.log(response);
            }
            
        }
    });
}

function deleteFromCart(pid) {
    $.ajax({
        url: "cart-control.php",
        type: "POST",
        data: { op: "delete", pid: pid },
        success: function(response) {
            if (response == -1) {
                alert("You have to login first");
            }
            else {
                let resps = response.split(".sep.");
                $("#prinf_order_cart").html(resps[0]);
                $("#total_money").html("RM " + resps[1]);
                $("#order_number").html(resps[2])
                console.log(response);
            }
            
        }
    });
}

function editCart(pid, qty) {
    $.ajax({
        url: "cart-control.php",
        type: "POST",
        data: { op: "edit", pid: pid, qty: qty },
        success: function(response) {
            if (response == -1) {
                alert(response);
            }
            else {
                let resps = response.split(".sep.");
                $("#prinf_order_cart").html(resps[0]);
                $("#total_money").html("RM " + resps[1]);
                $("#order_number").html(resps[2])
                console.log(response);
            }
        }
    });
}

function login(email, password) {
    $.ajax({
        url: "login.php",
        type: "POST",
        data: { email: email, password: password },
        success: function(response) {
            if (response == 0) {
                $("#statusLogin").html("Wrong Password or Account");
            }
            else if (response == 1) {
                window.location = "dashboard.php";
            }
            else {
                $("#menu").html(response);
                window.location = "index.php";
            }
        }
    });
}

function ajaxLogin() {
    let email = $("#usernameLogin").val();
    let password = $("#passwordLogin").val();

    login(email, password);
}

function logout() {
    window.location = "logout.php";
}

function ajaxRegister() {
    let regemail = $("#usernameSignup").val();
    let regpasssword = $("#passwordSignup").val();
    let regrepassword = $("RepasswordSignup").val();
    let regname = $("#nameSignup").val();
    let regaddress = $("#addressSignup").val();

    $.ajax({
        url: "register.php",
        type: "POST",
        data: { emailreg: regemail, namereg: regname, addressreg: regaddress, passwordreg: regpasssword, repasswordreg: regrepassword },
        success: function(response) {
            if (response == 1) {
                login(regemail, regpasssword);
            }
            else {
                $("#statusSignup").html(response);
            }
        }
    });
}

function ajaxCheckout() {
    $("#payment_form").css("display", "block");
    $("#checkout_form").css("display", "none");
    
    $.ajax({
        url: "order-handler.php",
        type: "POST",
        data: { op: "add" },
        success: function(response) {
            console.log(response);
        }
    });
    
}

function ajaxOrderShow() {
    $.ajax({
        url: "order-handler.php",
        type: "POST",
        data: { op: "show" },
        success: function(response) {
            $("#prinfPaymentUser").html(response);
            console.log(response);
        }
    });
}

function setNewPass() {
    let pc = $("#passcurrent").val();
    let np = $("#passnew").val();
    let npr = $("#passnewrepeat").val();

    $.ajax({
        url: "passchange.php",
        type: "POST",
        data: { pass: pc, newpass: np, cnewpass: npr },
        success: function(response) {
            if (response != 1) {
                $("#notification_change_pass").html(response);
            }
            else {
                $("#notification_change_pass").html("Success");
            }
        }
    })
}