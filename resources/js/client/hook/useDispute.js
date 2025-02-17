/**
 * External Dependencies
 */
import useSWR from "swr";
import fetch from "unfetch";
const useDispute = (id) => {
    const fetcher = fetch(`/dispute/details/${id}`).then((r) => r.json());
    const { data, error } = useSWR(`/dispute/details/${id}`, fetcher);

    return {
        dispute: data,
        isloading: !error && !data,
        isError: error,
    };
};

export default useDispute;
