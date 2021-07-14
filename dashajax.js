$(document).ready(function() {
    ajaxShowProduct();
    ajaxShowOrder();
});

$(document).on('submit', "#uploadFile", function(e) {
    e.preventDefault();
    let img = new FormData(this);
    let imgurl = "empty";

    $.ajax({
        url: "product-update.php",
        type: "POST",
        data: img,
        contentType: false,
        processData: false,
        async: false,
        success: function(response) {
            if (response != 0) {
                imgurl = response;
                console.log(response);
            }
        }
    });

    let name = $("#foodAddNameInput").val();
    let desc = $("#foodAddNoteInput").val();
    let price = $("#foodAddPriceInput").val();

    while (imgurl === "empty") {
        console.log("waiting");
    }

    $.ajax({
        url: "product-update.php",
        type: "POST",
        data: { op: "add", name: name, desc: desc, price: price, imgurl: imgurl },
        success: function(response) {
            console.log(response);
            console.log(imgurl);
        }
    })

});

function ajaxShowProduct() {
    $.ajax({
        url: "product-control.php",
        type: "POST",
        success: function(response) {
            resps = response.split(".sep.");
            $("#prinfManagementFood2").html(resps[0]);
            $("#prinfManagementFood").html(resps[1]);
            $("#dem_food").html(resps[2]);
        }
    });
}

function ajaxShowOrder() {
    $.ajax({
        url: "order-handler.php",
        type: "POST",
        success: function(response) {
            $("#prinfPayment").html(response);
        }
    })
}

function updateProduct(id) {
    $("#input_food2").css("display", "block");
    $("#addfood2").css("display", "none");
    $("#updatefood2").css("display", "block");
    $("#picupload").css("display", "none");
    $("#txtId").val(id);
    $.ajax({
        url: "product-update.php",
        type: "POST",
        data: { op: "show", id: id },
        success: function(response) {
            resps = response.split(".sep.");
            $("#foodAddNameInput").val(resps[0]);
            $("#foodAddNoteInput").val(resps[1]);
            $("#foodAddPriceInput").val(resps[2]);
        }
    });
}

function saveUpdate() {
    let id = $("#txtId").val();
    let name = $("#foodAddNameInput").val();
    let desc = $("#foodAddNoteInput").val();
    let price = $("#foodAddPriceInput").val();
    $.ajax({
        url: "product-update.php",
        type: "POST",
        data: { op: "update", id: id, name: name, desc: desc, price: price },
        success: function(response) {
            ajaxShowOrder();
            ajaxShowProduct();
        }
    });
}

function addProduct(form) {
    let img = new FormData(form);
    let name = $("#foodAddNameInput").val();
    let desc = $("#foodAddNoteInput").val();
    let price = $("#foodAddPriceInput").val();

    $.ajax({
        url: "product-update.php",
        type: "POST",
        data: img,
        contentType: false,
        processData: false,
        success: function(response) {
            console(response);
        }
    })
}

function logout() {
    window.location = "logout.php";
}