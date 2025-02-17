/**
 * External Dependencies
 */
import React, { StrictMode } from "react";
import ReactDOM from "react-dom";
/**
 * Internal Dependencies
 */
import FeaturedProducts from "./featured";
import NewProducts from "./new";
ReactDOM.render(
    <StrictMode>
        <FeaturedProducts />
    </StrictMode>,
    document.getElementById("featuredMallDisplay")
);
ReactDOM.render(
    <StrictMode>
        <NewProducts />
    </StrictMode>,
    document.getElementById("newMallDisplay")
);
