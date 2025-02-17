import { Col, Divider, Grid, Paper } from "@mantine/core";
import React, { useEffect, useState } from "react";
import Skeleton from "react-loading-skeleton";
import "react-loading-skeleton/dist/skeleton.css";
import Banner from "./banner";
import Message from "./message";
import styles from "./css/index.module.css";

const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const dispute_id = urlParams.get("dispute_id");
const job_id = urlParams.get("job_id");
const token_sec = $('meta[name="csrf-token"]').attr("content");
var job_unique_id = 0;

const Action = () => {
    const [dispute, setDispute] = useState({});
    // const { dispute, isloading, isError } = useDispute(dispute_id);

    const fetchDisputeDetails = async () => {
        const response = await fetch(`/dispute/details/${dispute_id}`);
        const json = await response.json();
        setDispute(json.data);
    };

    // milestones/pay?id=381384320&influ_id=15

    const redirectToMileStone = () => {
        window.location.href = `/milestones/pay?id=${job_unique_id}&influ_id=${dispute?.influencer_id}`;
    };

    const redirectToStageFour = () => {
        //make a call to advance to stage four
        window.location.href = `/dispute/stage-four?dispute_id=${dispute_id}&job_id=${job_id}`;
    };

    useEffect(() => {
        fetchDisputeDetails();
    }, []);

    const amount = 200;
    return (
        <div style={{ display: "flex", flexDirection: "column" }}>
            <Divider size={"md"} color="purple" />
            <Paper shadow="lg" padding="md">
                <h6 style={{ paddingTop: "23px" }} className="text-center">
                    Total amount being disputed:{" "}
                    <span style={{ color: "#6F3C96" }}>${amount}</span>
                </h6>

                <p style={{ color: "#D6A120" }} className="text-right">
                    show milestones
                </p>

                <div className={styles.breakdown}>
                    <div>
                        <p className={styles.breakdowntext}>
                            Vendor(you) want{" "}
                        </p>
                        <p className={styles.breakdowntext}>to pay:</p>
                        <span style={{ color: "#6F3C96" }}>
                            ${dispute?.vendor_to_pay}
                        </span>
                    </div>
                    <div>
                        <p className={styles.breakdowntext}>
                            Creative (chibuchi 0.) wants{" "}
                        </p>
                        <p className={styles.breakdowntext}> to receive: </p>

                        <span style={{ color: "#6F3C96" }}>
                            ${dispute?.creative_ask_for}
                        </span>
                    </div>
                </div>

                <h6>
                    Total Dispute Amount with Dispute Fee:{" "}
                    <span style={{ color: "#6F3C96" }}>
                        $
                        {parseInt(dispute?.vendor_to_pay) +
                            0.02 * parseInt(dispute?.vendor_to_pay)}
                        Paid
                    </span>
                </h6>

                <div
                    style={{
                        display: "flex",
                        flexDirection: "row",
                        gap: ".5em",
                        justifyContent: "space-around",
                    }}
                >
                    <button
                        className="btn rounded btn-outline-primary"
                        onClick={() => redirectToMileStone()}
                    >
                        Agree and Pay
                    </button>
                    <button
                        className="btn rounded btn-secondary"
                        onClick={() => redirectToStageFour()}
                    >
                        Continue Dispute
                    </button>
                </div>
            </Paper>
        </div>
    );
};

const JobName = () => {
    const [ProjectName, setProjectName] = useState("");
    const fetchJobDetails = async () => {
        const response = await fetch(
            `${window.location.origin}/api/jobs/${job_id}`
        );
        const json = await response.json();
        setProjectName(json.data.name);
        job_unique_id = json.data.unique_id;
    };

    useEffect(() => {
        fetchJobDetails();
    }, []);

    return (
        <div>
            {ProjectName ? (
                <h4> ProjectName: {ProjectName}</h4>
            ) : (
                <Skeleton count={1} />
            )}
        </div>
    );
};

const Three = () => {
    const [dispute, setDispute] = useState({});
    // const { dispute, isloading, isError } = useDispute(dispute_id);

    const fetchDisputeDetails = async () => {
        const response = await fetch(`/dispute/details/${dispute_id}`);
        const json = await response.json();
        setDispute(json.data);
    };

    useEffect(() => {
        fetchDisputeDetails();
    }, []);
    return (
        <div>
            <h4>
                <span style={{ color: "#D6A120" }}>Stage 3:</span>
                {"  Pay & Resolve"}
            </h4>

            <p>
                Do you have an issue with an influencer. Job delivery. file a
                complaint now.
            </p>

            <JobName />

            <Banner />
            <h4 style={{ marginTop: "2em" }}>Dispute Discussion</h4>
            <div
                style={{
                    display: "flex",
                    flexDirection: "row",
                    alignItem: "flex-start",
                    gap: "1em",
                    flexGrow: 1,

                    marginTop: "2em",
                }}
            >
                <div style={{ flexGrow: 1 }}>
                    <Message />
                    <Message />
                </div>
                <Action />
            </div>
        </div>
    );
};

export default Three;
