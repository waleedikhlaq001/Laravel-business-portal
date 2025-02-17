export const handleSearch = (query) => {
    //query database for categories
    //return array of categories
    return new Promise((resolve, reject) => {
        axios
            .get(`/api/categories/search/${query}`)
            .then((res) => {
                resolve(res.data);
            })
            .catch((err) => {
                reject(err);
            });
    });
};
