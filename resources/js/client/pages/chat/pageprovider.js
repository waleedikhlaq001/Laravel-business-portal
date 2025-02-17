import React, { useEffect, useState } from "react";

import { PageContext } from "./context";

const PageProvider = ({ children }) => {
    const [currentPage, setCurrentPage] = useState("/");
    useEffect(() => {
        setCurrentPage(window.location?.pathname);
    }, [window.location?.pathname]);
    const values = {
        currentPage,
    };
    return (
        <PageContext.Provider value={values}>{children}</PageContext.Provider>
    );
};

export default PageProvider;
