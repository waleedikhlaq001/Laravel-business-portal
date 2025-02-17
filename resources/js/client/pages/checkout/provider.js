/**
 * External Dependencies
 */
import React, { useEffect, useState } from "react";
/**
 * Internal Dependencies
 */
import { CartContext, UserContext } from "./context";

// const getUserCart = async (userId) => {
//     const response = await fetch(
//         `${window.location.origin}/api/carts/user/${userId}`
//     );
//     const data = await response.json();
//     console.log("retrieve user cart", data);
//     sessionStorage.setItem("cart", JSON.stringify(data.cart));
// };

// const getSessionCart = async () => {
//     const response = await fetch(`/cartsession`);
//     const data = await response.json();
//     console.log("retrieve user cart from session", data);
//     setCart(data.cart);
//     sessionStorage.setItem("cart", JSON.stringify(data.cart));
// };

export const CartProvider = ({ children }) => {
    const [cart, setCart] = useState([]);
    const [userId, setUserId] = useState(window.CurrentUserId);

    useEffect(() => {
        console.log(window.isLoggedIn);
        console.log("from cartContext: userId-" + userId);
    }, []);
    const values = {
        cart,
        setCart,
        userId,
    };
    return (
        <CartContext.Provider value={values}>{children}</CartContext.Provider>
    );
};
export const UserProvider = ({ children }) => {
    useEffect(() => {}, []);
    const values = {};
    return (
        <UserContext.Provider value={values}>{children}</UserContext.Provider>
    );
};
