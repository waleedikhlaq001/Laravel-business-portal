import React from "react";

const useFetch = (url, options) => {
    if (url == undefined) {
        return "url is undefined";
    } else {
        return fetch(url, options)
            .then((response) => response.json())
            .then((json) => json)
            .catch((error) => {
                console.log(error);
                return error;
            });
    }
};

export default useFetch;
