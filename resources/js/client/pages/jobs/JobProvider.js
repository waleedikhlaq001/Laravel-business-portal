/**
 * External dependencies
 */
import React from "react";

/**
 * Internal dependencies
 */
import JobContext from "./context";

const JobProvider = ({
    jobs,
    filter,
    setFilter,
    filterList,
    setFilterList,
    searchQuery,
    setSearchQuery,
    children,
}) => {
    const values = {
        jobs,
        filter,
        setFilter,
        filterList,
        setFilterList,
        searchQuery,
        setSearchQuery,
    };
    return <JobContext.Provider value={values}>{children}</JobContext.Provider>;
};

export default JobProvider;
