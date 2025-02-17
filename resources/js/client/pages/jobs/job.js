/**
 * External Dependencies
 */
import React, { lazy, Suspense } from "react";
import { Container, Grid, Col, Paper } from "@mantine/core";
import Skeleton from "react-loading-skeleton";
import "react-loading-skeleton/dist/skeleton.css";
import moment from "moment";
/**
 * Internal Dependencies
 */
const List = lazy(() => import("./list") /* webpackChunkName: "list" */);
const Filter = lazy(
    () => import("./filter") /* webpackChunkName: "filterJob" */
);
const SearchBar = lazy(
    () => import("./search") /* webpackChunkName: "search" */
);
import FourFour from "./404.svg";
import Paginator from "./paginator";
import JobContext from "./context";

export default function Job() {
    return (
        <JobContext.Consumer>
            {(context) => (
                <div>
                    <Container fluid={true}>
                        <Grid>
                            <Col span={12}>
                                {/* SearchBar */}
                                <Suspense
                                    fallback={
                                        <Skeleton
                                            count={1}
                                            style={{
                                                borderRadius: "10%",
                                                height: "50",
                                            }}
                                        />
                                    }
                                >
                                    <SearchBar />
                                </Suspense>
                            </Col>
                            <Col span={12}>
                                {/* paginator */}
                                <Paginator />
                            </Col>
                            <Col span={12}>
                                {/* search filter */}
                                <Suspense
                                    fallback={
                                        <div>
                                            <Skeleton count={10} />
                                        </div>
                                    }
                                >
                                    <Filter />
                                </Suspense>
                            </Col>
                            <Col span={12}>
                                {/* JobList */}
                                <Suspense
                                    fallback={
                                        <div>
                                            <h1>{<Skeleton />}</h1>
                                            {<Skeleton count={10} />}
                                        </div>
                                    }
                                >
                                    <List jobs={context.jobs} />
                                </Suspense>
                            </Col>
                        </Grid>

                        {context.jobs.length === 0 && (
                            <div className="text-center pt-4">
                                <Suspense fallback={<Skeleton />}>
                                    <img
                                        src={FourFour}
                                        alt="404"
                                        width="70px"
                                        height="100px"
                                    />
                                </Suspense>
                                <h1>No jobs found</h1>
                            </div>
                        )}

                        {context.jobs != undefined &&
                            context.jobs.map((job) => (
                                <Paper
                                    key={job.id}
                                    padding="md"
                                    style={{ marginBottom: "6px" }}
                                    radius="md"
                                >
                                    <div key={job.id}>
                                        <Grid grow>
                                            <Col span={4}>
                                                <div
                                                    style={{
                                                        display: "flex",
                                                        flexDirection: "column",
                                                    }}
                                                >
                                                    <h4
                                                        style={{
                                                            color: "#94ca52",
                                                        }}
                                                    >
                                                        {job.name}
                                                    </h4>
                                                    <p>{job.description}</p>
                                                    <p
                                                        style={{
                                                            color: "#6f3c96",
                                                        }}
                                                    >
                                                        Vicomma
                                                    </p>
                                                </div>
                                            </Col>
                                            <Col span={2}>
                                                <div>{"2"}</div>
                                            </Col>
                                            <Col span={4}>
                                                {moment(
                                                    job.created_at
                                                ).calendar()}
                                            </Col>
                                            <Col span={2}>$14000 - $150000</Col>
                                        </Grid>
                                    </div>

                                    <div></div>
                                </Paper>
                            ))}
                    </Container>
                </div>
            )}
        </JobContext.Consumer>
    );
}
