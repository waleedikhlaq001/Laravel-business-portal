const subaccountForm = document.getElementById("add-payment-dets");
const addAcctBtn = document.querySelector(".add-account");
//get list of payment details
const fetchedData = fetch(pd, {
    method: "GET",
}).then((response) => response.json());

const deleteData = (id) => {
    let resp = fetch(deleteSubaccountUrl, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            id,
        }),
    });

    return resp;
};

//get list of banks
const banklist = fetch(gb, {
    method: "GET",
}).then((response) => response.json());

let paymentGateways = undefined;
switch (paymentGatewaysCountry) {
    case "India":
        paymentGateways = [
            {
                name: "RazorPay",
                isConnected: false,
            },
        ];
        break;
    case "United States":
        paymentGateways = [
            {
                name: "Stripe",
                isConnected: false,
            },
            {
                name: "Flutterwave",
                isConnected: false,
            },
        ];
        break;

    default:
        paymentGateways = [
            {
                name: "Flutterwave",
                isConnected: false,
            },
            {
                name: "Paystack",
                isCOnnected: false,
            },
        ];
        break;
}
