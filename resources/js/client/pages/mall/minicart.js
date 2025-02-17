import { Button } from "@mantine/core";
import React, { useState, useEffect } from "react";

const Cart = () => {
    const [products, setProducts] = useState([]);

    useEffect(() => {
        if (JSON.parse(sessionStorage.getItem("cart").length > 0)) {
            setProducts(JSON.parse(sessionStorage.getItem("cart")));
        }
    }, []);

    return (
        <div style={{ padding: "20px" }}>
            <h3>Cart</h3>

            {/* show products added to the cart */}

            {products.map((product) => (
                <div
                    key={product.id}
                    style={{
                        padding: "20px",
                        display: "flex",
                        flexDirection: "row",
                        justifyContent: "space-between",
                        textAlign: "left",
                    }}
                >
                    <img
                        src={
                            "https://vicomma-stagingrevamp.herokuapp.com/img/product.png"
                        }
                        style={{ width: "50px", height: "50px" }}
                    />
                    <p style={{ textAlign: "left" }}>{product.name}</p>
                    <p style={{ textAlign: "left" }}>{product.price}</p>
                </div>
            ))}

            <div style={{ textAlign: "center" }}>
                <Button
                    size="md"
                    color="indigo"
                    loaderPosition="rights"
                    onClick={() =>
                        (window.location.href = "/mall/checkout/cart")
                    }
                >
                    Proceed to Checkout
                </Button>
            </div>
        </div>
    );
};

export default Cart;
