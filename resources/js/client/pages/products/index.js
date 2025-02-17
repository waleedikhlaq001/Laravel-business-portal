/**
 * External Dependencies
 */
import React, { Fragment, useState, useEffect, StrictMode } from "react";
import { render } from "react-dom";

/**
 * Internal Dependencies
 */
import styles from "./index.module.css";
import { ProductsProvider } from "./provider";
import List from "./list";
// const SideBar = () => {
//     return (
//         <div>
//             <h2>Side Bar</h2>
//         </div>
//     );
// };

const Index = () => {
    const [products, setProducts] = useState([]);
    useEffect(() => {}, []);
    return (
        <Fragment>
            {/* <h3 className={styles.mainHeading}>Products</h3> */}
            <div>
                {/* <SideBar /> */}
                <List />
            </div>
        </Fragment>
    );
};

if (document.querySelector("#products-app") != undefined) {
    render(
        <StrictMode>
            <ProductsProvider>
                <Index />
            </ProductsProvider>
        </StrictMode>,
        document.querySelector("#products-app")
    );
}

console.log("Product script loaded!!!!");
