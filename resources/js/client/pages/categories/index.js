/**
 * External Dependencies
 */
import React, { StrictMode, useState, lazy } from "react";
import { render } from "react-dom";
import { Pagination } from "@mantine/core";
/**
 * Internal Dependencies
 */

import Main from "./main";

if (!categories) {
    categories = lazy("./data.json");
}
render(
    <StrictMode>
        <Main categories={categories} />
    </StrictMode>,
    document.querySelector("#jobSearchByCategory-module")
);
