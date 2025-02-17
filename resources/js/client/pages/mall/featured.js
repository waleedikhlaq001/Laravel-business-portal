/**
 * External Dependencies
 */
import React, { useState, useEffect, StrictMode, Fragment } from "react";

/**
 * Internal Dependencies
 */
import Product from "./Product";
const FeaturedProducts = () => {
    const [products, setProducts] = useState([]);

    useEffect(() => {
        fetch("/api/featured")
            .then((res) => res.json())
            .then((data) => {
                // console.log(data);
                let sdata = data.data.slice(0, 5); //limit to 5;
                console.log(sdata);
                // sdata.forEach((d) => {
                //     let awsRes = `https://viccomma-videos.s3.us-east-2.amazonaws.com/product-images/${JSON.parse(
                //         d.image
                //     )}`;
                //     d.image = awsRes;
                // });
                setProducts(sdata);
            });
    }, []);

    return (
        <>
        <div className="row w-100">
            {products.map((product) => (
                <div className="col-md-4 mx-auto my-2">
                <Product key={product.id} product={product} />
                </div>
            ))}
            </div>
        </>
    );
};

export default FeaturedProducts;
