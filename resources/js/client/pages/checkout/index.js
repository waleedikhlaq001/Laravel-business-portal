/**
 * External Dependencies
 */
import React, { useState, useEffect, useMemo, memo } from "react";
import { render } from "react-dom";
import { Stepper, MantineProvider } from "@mantine/core";
import { ShoppingCart } from "tabler-icons-react";
/**
 * Internal Dependencies
 */
import Cart from "./cart";
import OrderComplete from "./orderComplete";
import { CartProvider } from "./provider";
import CheckoutForm from "./form";
import { UserContext } from "./context";
import { list } from "../../services/countries";

const Checkout = () => {
    const [active, setActive] = useState(0);
    const [activeUser, setActiveUser] = useState({
        name: "Olaobaju Abraham",
        type: "vendor",
    });

    const [cartdata, setCartData] = useState(
        JSON.parse(sessionStorage.getItem("cart"))
    );

    const MemoCart = memo(Cart);

    const [countries, setCountries] = useState([]);

    const effectiveCountries = useMemo(() => countries, [countries]); //optmization scheme
    const effectiveCartData = useMemo(() => cartdata, [cartdata]); //optmization scheme

    useEffect(() => {
        const fetchCartSessionsData = async () => {
            const result = await fetch(`${window.location.origin}/cartsession`);

            const res = await result.json();
            console.log("result from inital render >", res);
            setCartData(res.cart);
        };

        fetchCartSessionsData();

        list()
            .then((data) => data.json())
            .then((response) => {
                setCountries(response);
            });
    }, []);
    const nextStep = () =>
        setActive((current) => (current < 3 ? current + 1 : current));
    const prevStep = () =>
        setActive((current) => (current > 0 ? current - 1 : current));
    return (
        <UserContext.Provider value={activeUser}>
            <CartProvider>
                <MantineProvider>
                    <div className="container-fluid">
                    <Stepper
                        color="#94ca52"
                        active={active}
                        // onStepClick={setActive}
                        breakpoint="sm"
                        style={{
                            paddingLeft: "0em",
                            paddingRight: "0em",
                        }}
                    >
                        <Stepper.Step
                            icon={<ShoppingCart color={"#6f3c96"} size={16} />}
                            label="Shopping cart"
                            description="First Step"
                        >
                            <MemoCart
                                cartContent={{
                                    cart: effectiveCartData,
                                    count: effectiveCartData.length,
                                    total: 0,
                                    qty: Array(effectiveCartData.length).fill(
                                        "1"
                                    ),
                                }}
                                nextStep={nextStep}
                            />
                        </Stepper.Step>
                        <Stepper.Step
                            label="Checkout"
                            description="Second Step"
                        >
                            <CheckoutForm
                                countries={
                                    effectiveCountries || [
                                        "Nigeria",
                                        "Ghana",
                                        "Kenya",
                                    ]
                                }
                                prevStep={prevStep}
                                nextStep={nextStep}
                            />
                        </Stepper.Step>
                        <Stepper.Step
                            label="Complete Order"
                            description="Final Step"
                        >
                            <OrderComplete
                                prevStep={prevStep}
                                nextStep={nextStep}
                            />
                        </Stepper.Step>
                    </Stepper>
                    </div>
                </MantineProvider>
            </CartProvider>
        </UserContext.Provider>
    );
};

render(<Checkout />, document.querySelector("#checkout-module"));
