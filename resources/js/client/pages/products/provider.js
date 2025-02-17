import React, { useEffect, useState } from "react";
import { ProductsContext } from "./context";

export const ProductsProvider = ({ children }) => {
    const [products, setProducts] = useState([]);
    const [current, setCurrent] = useState({});
    const [loading, setLoading] = useState(false);
    const fetchNext = async () => {
        let arr = [];
        setLoading(true)
        const result = await fetch(
            current.next
        );
       
        const resp = await result.json();
        const res = resp.data
        const page = {
            page: resp.current_page,
            total: resp.total,
            to: resp.to,
            next: resp.next_page_url
        }
        Object.keys(res).forEach(function (key) {
            arr.push(res[key]);
        });
        console.log("from index", arr);
        var cont = products.concat(arr)
        setProducts(cont);
        setCurrent(page);
        setLoading(false);
    };
    useEffect(() => {
        const fetchProducts = async () => {
            let arr = [];
            const result = await fetch(
                `/api/products`
            );
            const resp = await result.json();
            const res = resp.data
            const page = {
                page: resp.current_page,
                total: resp.total,
                to: resp.to,
                next: resp.next_page_url
            }
            Object.keys(res).forEach(function (key) {
                arr.push(res[key]);
            });
            console.log("from index", arr);
            setProducts(arr);
            setCurrent(page);
        };

        fetchProducts();
    }, []);
    const values = {
        products,
        setProducts,
        current,
        loading,
        setLoading,
        fetchNext
    };

    return (
        <ProductsContext.Provider value={values}>
            {children}
        </ProductsContext.Provider>
    );
};
