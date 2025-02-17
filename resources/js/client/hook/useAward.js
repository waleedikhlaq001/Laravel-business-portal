import React from "react";

const useAward = (jobId, creavtiveId) => {
    if (jobId == undefined || creavtiveId == undefined) {
        return "one parameter are undefined";
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

export default useAward;
