/**
 * External Dependencies
 */
import React from "react";
import useSWR from "swr";
import fetch from "unfetch";
const useJob = async (id) => {
    const fetcher = await fetch(
        `${window.location.origin}/api/jobs/${id}`
    ).then((r) => r.json());
    const { data, error } = useSWR(
        `${window.location.origin}/api/jobs/${id}}`,
        fetcher
    );

    return {
        job: data,
        isloading: !error && !data,
        isError: error,
    };
};

export default useJob;
