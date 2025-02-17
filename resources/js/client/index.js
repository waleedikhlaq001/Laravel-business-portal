const { useState, useEffect, Suspense } = React;
const { render } = ReactDOM;
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

const AccountComponent = ({ data }) => {
    const [active, setActive] = useState(false);

    const handleDelete = (id) => {
        deleteData(id).then((data) => console.log(data));
        window.location.reload();
    };

    useEffect(() => {}, [data]);
    return (
        <React.Fragment>
            {data[1].length < 1 && (
                <p className="text-center">No data Available.</p>
            )}
            {data[1].map((d, index) => {
                if (index == 4) {
                    document
                        .querySelector("#bankList")
                        .setAttribute("disabled", "disabled");
                    document
                        .querySelector("#addAcctCta")
                        .setAttribute("disabled", "disabled");
                    document
                        .querySelector("#bankaccount")
                        .setAttribute("disabled", "disabled");
                    document
                        .querySelector("#email")
                        .setAttribute("disabled", "disabled");
                    document
                        .querySelector("#phone")
                        .setAttribute("disabled", "disabled");
                }
                return (
                    <li
                        className={"list-group-item"}
                        style={{
                            display: "flex",
                            flexDirection: "row",
                            justifyContent: "space-between",
                        }}
                        onMouseEnter={() => setActive(true)}
                        onMouseLeave={() => setActive(false)}
                    >
                        <span>{d.bank_name}</span>
                        <span>{d.type}</span>
                        <span>{d.name}</span>
                        <span>{d.account}</span>
                        <span>{d.status}</span>
                        {active && (
                            <span
                                style={{ zIndex: "999" }}
                                onClick={() => handleDelete(d.id)}
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="red"
                                    class="bi bi-x-square-fill"
                                    viewBox="0 0 16 16"
                                >
                                    <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z" />
                                </svg>
                            </span>
                        )}
                    </li>
                );
            })}
        </React.Fragment>
    );
};

const App = () => {
    const [details, setDetails] = useState([]);
    const [loading, setLoading] = useState(false);
    const fetchedData = fetch(pd, {
        method: "GET",
    }).then((response) => response.json());
    useEffect(() => {
        let id = setInterval(() => {
            fetchedData.then((data) => {
                let arr = [];
                Object.keys(data).forEach(function (key) {
                    arr.push(data[key]);
                });
                // setDetails([]);
                setLoading(true);
                setDetails(arr);
            });
        }, 5000);
        return () => clearInterval(id);
    }, [document.querySelector(".add-account").value]);

    return (
        <React.Fragment>
            <li
                className={"list-group-item"}
                style={{
                    display: "flex",
                    flexDirection: "row",
                    justifyContent: "space-between",
                }}
            >
                <span>BANK NAME</span>
                <span>TYPE</span>
                <span>NAME</span>
                <span>ACCOUNT</span>
                <span>STATUS</span>
            </li>
            {details.length < 1 && loading == false && (
                <p className="text-center">
                    <div class="spinner-border text-secondary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </p>
            )}

            {/* <p className="text-center">No data Available</p> */}

            {details.length > 0 && loading && (
                <Suspense fallback={<div>Loading...</div>}>
                    <AccountComponent data={details} />
                </Suspense>
            )}
        </React.Fragment>
    );
};

render(<App />, document.querySelector("#account-details"));

const PaymentGateways = () => {
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
    return (
        <React.Fragment>
            {paymentGateways.length < 0 && (
                <li className={"list-group-item"}>
                    No payment gateways connected
                </li>
            )}

            {paymentGateways.map((d, index) => {
                if (d.name == "Stripe") {
                    return (
                        <form action={stripeConnect} method="POST">
                            <button
                                type="submit"
                                class="btn btn-primary btn-stripe btn-sm"
                                name="submit"
                            >
                                Connect with <span class="fw-bold">Stripe</span>{" "}
                            </button>
                        </form>
                    );
                } else {
                    return (
                        <li key={index} className={"list-group-item"}>
                            {d.name}
                        </li>
                    );
                }
            })}
        </React.Fragment>
    );
};

render(<PaymentGateways />, document.querySelector("#payment-gateways"));

document.querySelector(".add-account").addEventListener("click", () => {
    //submit form
    document.querySelector(".add-account").value = "1";
    let bank_code = document.querySelector("#bankList").value;
    let bank_account = document.querySelector("#bankaccount").value;
    let email = document.querySelector("#email").value;
    let phone = document.querySelector("#phone").value;

    let resp = fetch(addflwsubaccount, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            account_number: bank_account,
            account_bank: bank_code,
            email: email,
            phone_number: phone,
        }),
    });

    resp.then((res) => res).then((data) => {
        console.log(data);
        let dfinall = data.json();
        console.log(dfinall)
        if (data.status == 400) {
            dfinall.then((data) => {
                swal({
                    title: "Update Failed!",
                    text: data.messages,
                    icon: "error",
                });
            });
        } else {
            // $(".close").trigger("click");
            dfinall.then(dt => {
                console.log(dt)
                if(dt.length == 2 && dt[1]){
                    return tooltip_tour(dt[1])
                }else {
                    window.location.reload();
                }
            })
            
        }
    });
});
