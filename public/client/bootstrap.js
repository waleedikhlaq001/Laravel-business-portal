/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************************!*\
  !*** ./resources/js/client/bootstrap.js ***!
  \******************************************/
var subaccountForm = document.getElementById("add-payment-dets");
var addAcctBtn = document.querySelector(".add-account"); //get list of payment details

var fetchedData = fetch(pd, {
  method: "GET"
}).then(function (response) {
  return response.json();
});

var deleteData = function deleteData(id) {
  var resp = fetch(deleteSubaccountUrl, {
    method: "POST",
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      "Content-Type": "application/json"
    },
    body: JSON.stringify({
      id: id
    })
  });
  return resp;
}; //get list of banks


var banklist = fetch(gb, {
  method: "GET"
}).then(function (response) {
  return response.json();
});
var paymentGateways = undefined;

switch (paymentGatewaysCountry) {
  case "India":
    paymentGateways = [{
      name: "RazorPay",
      isConnected: false
    }];
    break;

  case "United States":
    paymentGateways = [{
      name: "Stripe",
      isConnected: false
    }, {
      name: "Flutterwave",
      isConnected: false
    }];
    break;

  default:
    paymentGateways = [{
      name: "Flutterwave",
      isConnected: false
    }, {
      name: "Paystack",
      isCOnnected: false
    }];
    break;
}
/******/ })()
;