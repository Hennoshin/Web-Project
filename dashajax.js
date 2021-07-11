

function ajaxShowProduct() {
    $.ajax({
        url: "product-control.php",
        type: "POST",
        success: function(response) {
            resps = response.split(".sep.");
            $("#prinfManagementFood2").html(resps[0]);
            $("#prinfManagementFood").html(resps[1]);
            $("#dem_food").html(resps[2]);
            console.log(resps[2]);
        }
    });
}

function ajaxShowOrder() {
    $.ajax({
        url: "order-handler.php",
        type: "POST",
        success: function(response) {
            $("#prinfPayment").html(response);
            alert(response);
        }
    })
}

$(document).ready(function() {
    ajaxShowProduct();
    ajaxShowOrder();
});