import {
    Divider,
    Paper,
    Grid,
    Col,
    RadioGroup,
    Radio,
    Select,
    Slider,
    MultiSelect,
} from "@mantine/core";

import React from "react";
import moment from "moment";

import JobContext from "./context";
const Actions = ({}) => {
    const projTypes = [
        { value: "react", label: "React" },
        { value: "ng", label: "Angular" },
        { value: "svelte", label: "Svelte" },
        { value: "vue", label: "Vue" },
        { value: "riot", label: "Riot" },
        { value: "next", label: "Next.js" },
        { value: "blitz", label: "Blitz.js" },
    ];
    return (
        <JobContext.Consumer>
            {(context) => (
                <div>
                    <Grid>
                        <Col span={2}>
                            <div
                                style={{
                                    display: "flex",
                                    flexDirection: "column",
                                }}
                            >
                                <p>Project Type</p>
                                <p>Duration</p>
                                <p>Types</p>
                                <p>Location</p>
                            </div>
                        </Col>
                        <Col span={4}>
                            <div
                                style={{
                                    display: "flex",
                                    flexDirection: "column",
                                }}
                            >
                                <div>
                                    <RadioGroup
                                        size="xs"
                                        color="violet"
                                        spacing="xl"
                                        className="w-100"
                                        onChange={(e) => {
                                            // console.log({
                                            //     ...context.filterList,
                                            //     projType: e,
                                            // });

                                            context.setFilterList({
                                                ...context.filterList,
                                                projType: e,
                                            });
                                        }}
                                    >
                                        <Radio value="fixed">Fixed</Radio>
                                        <Radio value="residual">Residual</Radio>
                                        {/* <Radio value="contract">Contract</Radio> */}
                                    </RadioGroup>
                                </div>

                                <div style={{ paddingTop: "10px" }}>
                                    <Select
                                        placeholder="Pick a duration"
                                        clearable
                                        data={[
                                            "All Duration",
                                            "1-3 days",
                                            "3-7 days",
                                            "1-3 weeks",
                                            "3-7 weeks",
                                            "1-3 months",
                                            "3-7 months",
                                            "1-3 years",
                                            "3-7 years",
                                        ]}
                                        onChange={(e) => {
                                            // console.log({
                                            //     ...context.filterList,
                                            //     duration: e,
                                            // });
                                            context.setFilterList({
                                                ...context.filterList,
                                                duration: e,
                                            });
                                        }}
                                    />
                                </div>

                                <div style={{ paddingTop: "10px" }}>
                                    <Select
                                        color="violet"
                                        placeholder="Type of Project filter"
                                        clearable
                                        data={[
                                            "All Types",
                                            "Web Development",
                                            "Advertising",
                                            "Interior Design",
                                            "Mobile Development",
                                            "App Development",
                                            "Fencing",
                                            "Free Run",
                                            "Basic",
                                        ]}
                                        onChange={(e) => {
                                            // console.log({
                                            //     ...context.filterList,
                                            //     type: e,
                                            // });
                                            context.setFilterList({
                                                ...context.filterList,
                                                type: e,
                                            });
                                        }}
                                    />
                                </div>

                                <div style={{ paddingTop: "10px" }}>
                                    <Select
                                        color="violet"
                                        placeholder="Location filter"
                                        clearable
                                        data={[
                                            "England",
                                            "Nigeria",
                                            "France",
                                            "Canada",
                                            "USA",
                                            "Belgium",
                                            "China",
                                            "Sweden",
                                            "Japan",
                                        ]}
                                        onChange={(e) => {
                                            // console.log({
                                            //     ...context.filterList,
                                            //     location: e,
                                            // });
                                            context.setFilterList({
                                                ...context.filterList,
                                                location: e,
                                            });
                                        }}
                                    />
                                </div>
                            </div>
                        </Col>
                        <Col span={2}>
                            <div
                                style={{
                                    display: "flex",
                                    flexDirection: "column",
                                }}
                            >
                                <p>Avg Price</p>
                                <p>Avg hourly Rate</p>
                                <p>Types</p>
                            </div>
                        </Col>
                        <Col span={2}>
                            <div
                                style={{
                                    display: "flex",
                                    flexDirection: "column",
                                }}
                            >
                                <div style={{ paddingTop: "10px" }}>
                                    <Slider
                                        size="sm"
                                        color="violet"
                                        styles={(theme) => ({
                                            markLabel: {
                                                display: "none",
                                            },
                                        })}
                                        marks={[
                                            { value: 20, label: "20%" },
                                            { value: 50000, label: "50%" },
                                            { value: 120000, label: "80%" },
                                        ]}
                                        onChange={(e) => {
                                            // console.log({
                                            //     ...context.filterList,
                                            //     AvgPrice: e,
                                            // });
                                            context.setFilterList({
                                                ...context.filterList,
                                                AvgPrice: e,
                                            });
                                        }}
                                    />
                                </div>

                                <div style={{ paddingTop: "25px" }}>
                                    <Slider
                                        size="sm"
                                        color="violet"
                                        styles={(theme) => ({
                                            markLabel: {
                                                display: "none",
                                            },
                                        })}
                                        marks={[
                                            { value: 20, label: "20%" },
                                            { value: 50000, label: "50%" },
                                            { value: 120000, label: "80%" },
                                        ]}
                                    />
                                </div>

                                <div style={{ paddingTop: "30px" }}>
                                    <MultiSelect
                                        color="violet"
                                        data={projTypes}
                                        placeholder="Pick all that you like"
                                    />
                                </div>
                            </div>
                        </Col>
                    </Grid>
                </div>
            )}
        </JobContext.Consumer>
    );
};

export default function Filter() {
    return (
        <div>
            <Divider size={"lg"} color="violet" />
            <Paper shadow="sm" padding="md">
                <Actions />
            </Paper>
        </div>
    );
}
