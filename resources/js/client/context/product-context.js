import React, { useState, createContext } from "react";

export const ProductContext = createContext({
    product: [],
    toggleCart: () => {}
});
