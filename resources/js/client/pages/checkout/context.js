import React, { createContext } from "react";
export const themes = {
    light: {
        foreground: "#000000",
        background: "#eeeeee",
    },
    dark: {
        foreground: "#ffffff",
        background: "#222222",
    },
};

//
//make a call to the database to get the cart items

export const CartContext = createContext({
    state: "empty",
    theme: themes.light,
    data: [],
    updateCart: () => {},
});

// Signed-in user context
export const UserContext = createContext({
    name: "Guest User",
    dispute: {},
    email: "",
    user_id: "",
    isLoggedIn: false,
});

UserContext.displayName = "VicommaAuth";

CartContext.displayName = "VicommaCart";
