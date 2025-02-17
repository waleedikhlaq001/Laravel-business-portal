const { useState, useEffect } = React;
const { render } = ReactDOM;
import Select from 'react-select'
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

const BankList = () => {
    const [banks, setBanks] = useState([]);

    useEffect(() => {
        banklist.then((res) => {
            const { data } = res[0];
            setBanks(data);
        });
    }, []);
    return (
        <>
            <option>Select a Bank</option>
            {banks.map((bank) => {
                return (
                    <option key={bank.id} value={bank.code}>
                        {bank.name}
                    </option>
                );
            })}
        </>
    );
};

render(<BankList />, document.querySelector("#bankList"));

const AccountResolve = () => {
    const [accounts, setAccounts] = useState("");

    const resolve_acct_number = () => {
        let bank_account = document.querySelector("#bankaccount");
        let bank_name = document.querySelector("#bankList");

        console.log([bank_account.value, bank_name.value]);

        return fetch(raccount, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                account_number: bank_account.value,
                account_bank: bank_name.value,
            }),
        });
    };

    document.querySelector("#bankaccount").addEventListener("change", () => {
        resolve_acct_number()
            .then((response) => response.json())
            .then((res) => {
                console.log(res.data);
                setAccounts(res.data.account_name);
            });
    });

    useEffect(() => {}, [accounts]);
    return <>{accounts && <>{accounts}</>}</>;
};
render(<AccountResolve />, document.querySelector("#acctResolve"));
