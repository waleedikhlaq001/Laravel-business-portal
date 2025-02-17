/**
 * External Dependencies
 */
import React, { Fragment, useEffect, useState } from "react";
import { Col, Grid, TextInput, Popover, MultiSelect } from "@mantine/core";
import { MagnifyingGlassIcon } from "@radix-ui/react-icons";
import { useForm } from "@mantine/hooks";

/**
 * Internal Dependencies
 */
import { handleSearch } from "./helpers";
import categorySuggestedQuery from "./data.json";
const CategorySearch = ({ cat, setCateriesQuery }) => {
    const [categories, setCategories] = useState(cat);
    const [openSuggestion, setOpenSuggestion] = useState(false);
    const form = useForm({
        initialValues: {
            query: "",
        },

        // validationRules: {
        //     query: (value) => /^\S+@\S+$/.test(value),
        // },
    });
    useEffect(() => {
        fetch(availableCategoriesEndpoint)
            .then((response) => {
                response.json().then((data) => {
                    setCategories(data.data);
                    // console.log(data.data);
                });
            })
            .catch((error) => {
                console.log(error);
            });
    }, []);

    return (
        <div
            className="container-fluid"
            style={{
                backgroundColor: "#6f3c96",
                borderRadius: "12px",
                padding: "42px",
            }}
        >
            <h3 className="text-white  mb-4">Browse by Category</h3>
            {/* search bar start  */}
            {/* <TextInput
                className="mx-auto mb-4"
                icon={<MagnifyingGlassIcon />}
                placeholder="Search by category"
                radius="md"
                size="md"
                onChange={(e) => console.log(e.target.value)}
            /> */}

            <MultiSelect
                dropdownposition="bottom"
                data={categorySuggestedQuery}
                maxSelectedValues={3}
                placeholder="Select by Category"
                searchable
                size="md"
                dropdownComponent="div"
                icon={<MagnifyingGlassIcon />}
                onChange={(e) => setCateriesQuery(e)}
            />
            {/* search bar end  */}

            {/* category list */}

            <Grid
                grow
                gutter={"md"}
                className="text-white mb-4"
                style={{ fontSize: "12px", marginTop: "1em" }}
            >
                {categories.map((category, index) => (
                    <Col key={index} span={4}>
                        {category.name}{" "}
                        <span style={{ color: "#94ca52" }}>
                            {`(${category.count})` || "0"}
                        </span>
                    </Col>
                ))}
            </Grid>

            <a className="mt-4 text-success" href="#">
                see all categories
            </a>
        </div>
    );
};

export default CategorySearch;
