import React, { Fragment } from "react";
import { Grid, Col, Divider } from "@mantine/core";
import { forEach } from "lodash";
export default function List({ jobs }) {
    const AddStyle = {
        borderTopLeftRadius: "5px",
        borderTopRightRadius: "5px",
    };
    return (
        <Fragment>
            <div
                className="text-left"
                style={{
                    backgroundColor: "#6f3c96",
                    padding: "0.7rem",
                    color: "white",
                    ...AddStyle,
                }}
            >
                <Grid grow>
                    <Col span={4}>PROJECT/CONTEST</Col>
                    <Col span={2}>BIDS/ENTRIES</Col>
                    <Col span={4}>STARTED</Col>
                    <Col span={2}>PRICE (USD)</Col>
                </Grid>
            </div>

            <Divider size="sm" />

            {jobs.forEach((job) => {
                return (
                    <Grid
                        key={job.id}
                        grow
                        style={{
                            backgroundColor: "#f5f5f5",
                            padding: "0.7rem",
                            borderBottom: "1px solid #ececec",
                        }}
                    >
                        <Col span={4}>{job.projectName}</Col>
                        <Col span={2}>{job.bids}</Col>
                        <Col span={4}>{job.createdDate}</Col>
                        <Col span={2}>{job.price}</Col>
                    </Grid>
                );
            })}
        </Fragment>
    );
}
