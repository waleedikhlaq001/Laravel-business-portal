import { Fragment, useState, Suspense, useEffect } from "react";
import { Button } from "@mantine/core";
import { useForm } from "@mantine/hooks";
import Interweave from "interweave";
import Skeleton from "react-loading-skeleton";
import "react-loading-skeleton/dist/skeleton.css";
import { loadStripe } from "@stripe/stripe-js/pure";

/**
 * Internal Dependencies
 */
import { PUBLIC_KEY } from "../../constant";

loadStripe.setLoadParameters({ advancedFraudSignals: false });

const handleStripePayments = async (values) => {
    const stripe = await loadStripe("pk_test_TYooMQauvdEDq54NiTphI7jx");

    stripe.redirectToCheckout({
        // items: [{ sku: "sku_Hkx9gjqXx8XxX", quantity: 1 }],
        successUrl: "https://example.com/success",
        cancelUrl: "https://example.com/cancel",
    });
};

const SpecialSelect = ({ form, getStates }) => {
    const [states, setStates] = useState([]);
    useEffect(() => {
        const fetchStates = async (country) => {
            var headers = new Headers();
            headers.append(
                "X-CSCAPI-KEY",
                "MFNOd0VlczgyRVVPQUlHUmRuN1lPc3lFWXNCNGhLYXdFRThveDVZVw=="
            );

            var requestOptions = {
                method: "GET",
                headers: headers,
                redirect: "follow",
            };

            // Pass Country Code -- Eg: Country Code : IN
            const result = await fetch(
                `https://api.countrystatecity.in/v1/countries/${country}/states`,
                requestOptions
            );

            const res = await result.json();
            console.log(res);
            setStates(res);
        };

        fetchStates(getStates);
    }, [getStates]);

    return (
        <select
            className="custom-select d-block w-100"
            id="state"
            {...form.getInputProps("state")}
            required
        >
            <option value="">Choose...</option>
            {states &&
                states.map((state) => (
                    <option key={state.id} value={state.iso2}>
                        {state.name}
                    </option>
                ))}
        </select>
    );
};

const CheckoutForm = ({ countries, nextStep }) => {
    const [data, setData] = useState(
        JSON.parse(sessionStorage.getItem("cartReact"))
    );

    const [states, setStates] = useState([]);
    const [getStates, setGetStates] = useState("NGN");

    const [userLocation, setUserLocation] = useState({});
    const [disabled, setDisabled] = useState(true);

    const [paymentMethod, setPaymentMethod] = useState("flutterwave");
    const form = useForm({
        initialValues: {
            email: "",
            firstname: "",
            lastname: "",
            address: "",
            country: userLocation.countryCode,
            zip: userLocation.zip,
            state: userLocation.state,
            companyname: "",
            paymentMethod: paymentMethod,
            termsOfService: false,
        },

        validationRules: {
            email: (value) => /^\S+@\S+$/.test(value),
        },
    });

    useEffect(() => {

        const fetchUserLocation = async () => {
            let result = await fetch(`http://ip-api.com/json`);

            let res = await result.json();

            setUserLocation(res);
        };

        fetchUserLocation();

        const fetchUserDetails = async () => {
            if(window.isLoggedIn){
            let result = await fetch(`/api/user-details/${window.isLoggedIn}`);

            let res = await result.json();

            console.log(res);
            if(res.data){
                var user = res.data;
                form.setFieldValue('firstname', user.first_name);
                form.setFieldValue('lastname', user.last_name);
                form.setFieldValue('email', user.email);
                // form.setFieldValue('country', res.country? res.country.name : "");
                form.setFieldValue('address', user.street_address? user.street_address : "");
                setDisabled(false);
            }
            }
        };

        fetchUserDetails();
    }, []);

    return (
        <Fragment>
            <section className="pt-5 pb-5">
                <div className="container-fluid">
                    <div className="row">
                        <h3 className="display-5 mb-2 text-center">Checkout</h3>
                        {/* CART SUMMARY START */}
                        <div className="col-md-4 order-md-2 mb-4">
                            <h4 className="d-flex justify-content-between align-items-center mb-3">
                                <span className="text-muted">Your cart</span>
                                <span className="badge badge-secondary badge-pill">
                                    {data.count}
                                </span>
                            </h4>

                            <Suspense fallback={<Skeleton />}>
                                <ul className="list-group mb-3">
                                    {data.cart.map((product) => (
                                        <li
                                            key={product.id}
                                            className="list-group-item d-flex justify-content-between lh-condensed"
                                        >
                                            <div>
                                                <h6 className="my-0">
                                                    {product.name}
                                                </h6>
                                                <small className="text-muted">
                                                    <Interweave
                                                        content={
                                                            product.description
                                                        }
                                                    />
                                                </small>
                                            </div>
                                            <span className="text-muted">
                                                ${product.price}
                                            </span>
                                        </li>
                                    ))}

                                    {/* <li className="list-group-item d-flex justify-content-between bg-light">
                                    <div className="text-success">
                                        <h6 className="my-0">Promo code</h6>
                                        <small>EXAMPLECODE</small>
                                    </div>
                                    <span className="text-success">-$5</span>
                                </li> */}
                                    <li className="list-group-item d-flex justify-content-between">
                                        <span>Total (USD)</span>
                                        <strong>${data.total}</strong>
                                    </li>
                                </ul>
                            </Suspense>

                            <form className="card p-2">
                                <div className="input-group">
                                    <input
                                        type="text"
                                        className="form-control"
                                        placeholder="Promo code"
                                    />
                                    <div className="input-group-append">
                                        <button
                                            type="submit"
                                            className="btn btn-secondary"
                                        >
                                            Redeem
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        {/* CART SUMMARY END */}
                        <div className="col-md-8 order-md-1">
                            <h4 className="mb-3">Billing address</h4>
                            <form
                                className="needs-validation"
                                noValidate
                                onSubmit={form.onSubmit((values) => {
                                    values.paymentMethod = paymentMethod;
                                    console.log(values);
                                    //initialize flutterwave payment modal
                                    if (paymentMethod === "flutterwave") {
                                        //flutterwave payment modal
                                        const { firstname, lastname } = values;
                                        let paySettings = {
                                            public_key: PUBLIC_KEY,
                                            tx_ref: "VC-12345" + Date.now(),
                                            amount: data.total,
                                            currency: "USD",
                                            country: "US",
                                            payment_options:
                                                "card,ussd,account,banktransfer,qr,mobilemoneyghana,paypal",
                                            customer: {
                                                email: values.email,
                                                phonenumber: "07064586146",
                                                name:
                                                    firstname + " " + lastname,
                                            },
                                            callback: function (data) {
                                                console.log(data);

                                                if (
                                                    data.status === "successful"
                                                ) {
                                                    //placeOrder
                                                    let formData =
                                                        new FormData();
                                                    formData.append(
                                                        "_token",
                                                        $(
                                                            'meta[name="csrf-token"]'
                                                        ).attr("content")
                                                    );
                                                    formData.append(
                                                        "name",
                                                        firstname +
                                                            " " +
                                                            lastname
                                                    );
                                                    formData.append(
                                                        "email",
                                                        values.email
                                                    );
                                                    formData.append(
                                                        "amount",
                                                        data.amount
                                                    );
                                                    formData.append(
                                                        "payment_method",
                                                        paymentMethod
                                                    );
                                                    formData.append(
                                                        "phone",
                                                        "07064586146"
                                                    );
                                                    formData.append(
                                                        "address",
                                                        values.address
                                                    );
                                                    formData.append(
                                                        "state",
                                                        values.state
                                                    );
                                                    formData.append(
                                                        "country",
                                                        values.country
                                                    );
                                                    formData.append(
                                                        "postal_code",
                                                        values.zip
                                                    );
                                                    // formData.append(
                                                    //     "country",
                                                    //     values.country
                                                    // );
                                                    
                                                    formData.append(
                                                        "products",
                                                        JSON.stringify(
                                                            JSON.parse(
                                                                sessionStorage.getItem(
                                                                    "cartReact"
                                                                )
                                                            )["cart"]
                                                        )
                                                    );
                                                    fetch(
                                                        `/placeorder`,
                                                        {
                                                            method: "POST",
                                                            body: formData,
                                                        }
                                                    );
                                                    fmp.close();
                                                    nextStep();
                                                }
                                            },
                                            onclose: function () {
                                                //do nothing if payment has not been made

                                                console.log("close");
                                            },
                                            customizations: {
                                                title: "Payment for vicomma order #3663",
                                                description:
                                                    "Payment for items in cart",
                                                logo: "https://vicomma-stagingrevamp.herokuapp.com/img/sidebarlogo.png",
                                            },
                                        };

                                        let fmp =
                                            FlutterwaveCheckout(paySettings);
                                    } else {
                                        handleStripePayments(values);
                                    }
                                })}
                            >
                                <div className="row">
                                    <div className="col-md-6 mb-3">
                                        <label htmlFor="firstName">
                                            First name
                                        </label>
                                        <input
                                            type="text"
                                            className="form-control"
                                            id="firstName"
                                            placeholder=""
                                            readOnly
                                            {...form.getInputProps("firstname")}
                                            required
                                        />
                                        <div className="invalid-feedback">
                                            Valid first name is required.
                                        </div>
                                    </div>
                                    <div className="col-md-6 mb-3">
                                        <label htmlFor="lastName">
                                            Last name
                                        </label>
                                        <input
                                            type="text"
                                            className="form-control"
                                            id="lastName"
                                            placeholder=""
                                            readOnly
                                            {...form.getInputProps("lastname")}
                                            required
                                        />
                                        <div className="invalid-feedback">
                                            Valid last name is required.
                                        </div>
                                    </div>
                                </div>

                                <div className="mb-3">
                                    <label htmlFor="email">
                                        Email{" "}
                                        {/* <span className="text-muted">
                                            (Optional)
                                        </span> */}
                                    </label>
                                    <input
                                        type="email"
                                        className="form-control"
                                        id="email"
                                        readOnly
                                        placeholder="you@example.com"
                                        {...form.getInputProps("email")}
                                    />
                                    <div className="invalid-feedback">
                                        Please enter a valid email address for
                                        shipping updates.
                                    </div>
                                </div>

                                <div className="mb-3">
                                    <label htmlFor="address">Address</label>
                                    <input
                                        type="text"
                                        className="form-control"
                                        id="address"
                                        placeholder="1234 Main St"
                                        {...form.getInputProps("address")}
                                        required
                                    />
                                    <div className="invalid-feedback">
                                        Please enter your shipping address.
                                    </div>
                                </div>

                                <div className="mb-3">
                                    <label htmlFor="address2">
                                        Address 2{" "}
                                        <span className="text-muted">
                                            (Optional)
                                        </span>
                                    </label>
                                    <input
                                        type="text"
                                        className="form-control"
                                        id="address2"
                                        placeholder="Apartment or suite"
                                    />
                                </div>

                                <div className="row">
                                    <div className="col-md-5 mb-3">
                                        <label htmlFor="country">Country</label>
                                        <select
                                            className="custom-select d-block w-100"
                                            id="country"
                                            {...form.getInputProps("country")}
                                            onChange={(e) => {
                                                setGetStates(e.target.value);
                                                // fetchStates(e.target.value)
                                            }}
                                            required
                                        >
                                            <option value="">Choose...</option>
                                            {countries.map((country) => (
                                                <option
                                                    key={country.sort}
                                                    value={country.sort}
                                                >
                                                    {country.name}
                                                </option>
                                            ))}
                                        </select>

                                        <div className="invalid-feedback">
                                            Please select a valid country.
                                        </div>
                                    </div>
                                    <div className="col-md-4 mb-3">
                                        <label htmlFor="state">State</label>
                                        <SpecialSelect
                                            form={form}
                                            getStates={getStates}
                                        />
                                        <div className="invalid-feedback">
                                            Please provide a valid state.
                                        </div>
                                    </div>
                                    <div className="col-md-3 mb-3">
                                        <label htmlFor="zip">Zip</label>
                                        <input
                                            type="text"
                                            className="form-control"
                                            id="zip"
                                            placeholder=""
                                            {...form.getInputProps("zip")}
                                            required
                                        />
                                        <div className="invalid-feedback">
                                            Zip code required/.
                                        </div>
                                    </div>
                                </div>
                                {/* <hr className="mb-4" />
                                <div className="custom-control custom-checkbox">
                                    <input
                                        type="checkbox"
                                        className="custom-control-input"
                                        id="save-info"
                                    />
                                    <label
                                        className="custom-control-label"
                                        htmlFor="save-info"
                                    >
                                        Save this information for next time
                                    </label>
                                </div> */}
                                <hr className="mb-4" />

                                <h4 className="mb-3">Payment</h4>

                                {/* <div className="d-block my-3">
                                    <div className="custom-control custom-radio">
                                        <input
                                            id="flutterwave"
                                            name="paymentMethod"
                                            type="radio"
                                            className="custom-control-input"
                                            onClick={() =>
                                                setPaymentMethod("flutterwave")
                                            }
                                            required
                                        />
                                        <label
                                            className="custom-control-label"
                                            htmlFor="flutterwave"
                                        >
                                            Flutterwave
                                        </label>
                                    </div>
                                    <div className="custom-control custom-radio">
                                        <input
                                            id="stripe"
                                            name="paymentMethod"
                                            type="radio"
                                            className="custom-control-input"
                                            onClick={() =>
                                                setPaymentMethod("stripe")
                                            }
                                            required
                                        />
                                        <label
                                            className="custom-control-label"
                                            htmlFor="stripe"
                                        >
                                            Stripe
                                        </label>
                                    </div>
                                </div> */}
                                {/* <hr className="mb-4" /> */}
                                <button
                                    className="btn btn-primary btn-lg btn-block"
                                    type="submit"
                                disabled={disabled}>
                                    Pay With Flutterwave
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </Fragment>
    );
};

export default CheckoutForm;
