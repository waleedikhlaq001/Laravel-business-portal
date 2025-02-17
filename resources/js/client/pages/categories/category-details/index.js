import React, { useEffect, useLayoutEffect } from "react";
import { Paper } from "@mantine/core";
import { Link } from "tabler-icons-react";
const CategoryDetails = ({ query, data }) => {
    useEffect(() => {
        console.log(query);
    }, [query]);

    useLayoutEffect(() => {}, [data]);
    return (
        <Paper padding={"md"}>
            {data.length > 0 && (
                <>
                    <h4>Result : </h4>

                    <div className="row">
                        {data.map((item, index) => (
                            <div key={index} className="col-md-4">
                                <div className="card">
                                    <div className="card-body">
                                        <h5 className="card-title">
                                            {item.name}
                                        </h5>
                                        <p className="card-text">
                                            {item.description}
                                        </p>
                                        <Link
                                            to={`/job/category/${item.id}`}
                                            className="btn btn-primary"
                                        >
                                            View
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                </>
            )}

            {data.length === 0 && (
                <div className="text-center m-4">
                    <h4>Result would be displayed here</h4>
                </div>
            )}
        </Paper>
    );
};

export default CategoryDetails;
