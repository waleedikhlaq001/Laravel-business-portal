import { isUndefined } from "lodash";
import React, { useState, useEffect } from "react";

import CategorySearch from "./browse";
import CategoryDetails from "./category-details";

const Main = ({ categories }) => {
    const [queryParams, setQueryParams] = useState([]);
    const [currentParams, setCurrentParams] = useState([]);
    const [result, setResult] = useState([]);
    const [resLength, setResLength] = useState(0);
    const [empty, setEmpty] = useState(false);
    useEffect(() => {
        async function fetchData(currentParams) {
            currentParams.forEach(async (queryParam) => {
                const response = await fetch(`/api/categoryJobs/${queryParam}`);
                const res = await response.json();
                setResult([...result, ...res]);
                setEmpty(false);
                setQueryParams(queryParam);
            });

            setResLength(queryParams.length);
        }
        if (currentParams.length > 0) {
            // console.log(currentParams);
            fetchData(currentParams);
        } else {
            setEmpty(true);
        }
    }, [currentParams]);

    return (
        <>
            <CategorySearch
                cat={categories}
                setCateriesQuery={setCurrentParams}
            />
            <CategoryDetails query={queryParams} data={result} />
        </>
    );
};

export default Main;
