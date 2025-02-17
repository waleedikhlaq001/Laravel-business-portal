/**
 * External Dependencies
 */
import React, { lazy, Suspense, useEffect, useState } from "react";
import Skeleton from "react-loading-skeleton";
import "react-loading-skeleton/dist/skeleton.css";
/**
 * Internal Dependencies
 */
import useDispute from "../../hook/useDispute";
import useJob from "../../hook/useJob";
import Banner from "./banner";
import Message from "./message";
import styles from "./css/index.module.css";

const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const dispute_id = urlParams.get("dispute_id");
const job_id = urlParams.get("job_id");
const token_sec = $('meta[name="csrf-token"]').attr("content");
var job_unique_id = 0;

const JobName = () => {
    const [ProjectName, setProjectName] = useState("");
    const fetchJobDetails = async () => {
        const response = await fetch(
            `${window.location.origin}/api/jobs/${job_id}`
        );
        const json = await response.json();
        setProjectName(json.data?.name);
        job_unique_id = json.data?.unique_id;
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

const Two = () => {
    const [dispute, setDispute] = useState({});
    // const { dispute, isloading, isError } = useDispute(dispute_id);

    const fetchDisputeDetails = async () => {
        const response = await fetch(`/dispute/details/${dispute_id}`);
        const json = await response.json();
        setDispute(json.data);
    };

    const handleDrop = async () => {
        const response = await fetch(`/dispute/drop/${dispute_id}`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token_sec,
            },
            body: JSON.stringify({}),
        });
        const json = await response.json();
        console.log(json);
        swal({
            title: "Dispute Dropped",
            text: "Dispute Dropped Successfully",
            icon: "success",
        });

        //return vendor to the job
        window.location.href = `/jobs/details/${job_unique_id}`;
    };

    const handleMitigation = async () => {
        // redirect to the next stage and update status to mitigated
        const response = await fetch(`/dispute/mitigation/${dispute_id}`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token_sec,
            },
            body: JSON.stringify({}),
        });
        const json = await response.json();
        console.log(json);
        //update dispute stage
        window.location.href = `/dispute/stage-three?dispute_id=${dispute_id}&job_id=${job_id}`;
    };

    const handleCancel = async () => {
        const response = await fetch(`/dispute/cancel/${dispute_id}`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token_sec,
            },
            body: JSON.stringify({}),
        });
        const json = await response.json();
        console.log(json);
        swal({
            title: "Dispute Cancelled",
            text: "Dispute Cancelled Successfully",
            icon: "success",
        });
        //return vendor to the job
        window.location.href = `/jobs/details/${job_unique_id}`;
    };

    useEffect(() => {
        fetchDisputeDetails();
    }, []);

    useEffect(() => {
        if (
            dispute?.stage !== "two" &&
            dispute?.stage !== "one" &&
            dispute?.stage !== undefined
        ) {
            window.location.href = `/dispute/stage-${dispute.stage}?dispute_id=${dispute_id}&job_id=${job_id}`;
        }

        if (dispute?.stage === "one") {
            window.location.href = `/dispute?job_id=${job_id}`;
        }

        let vStatus = dispute?.status;

        if (vStatus === "resolved") {
            window.location.href = `/jobs/details/${job_unique_id}`;
        }
    }, [dispute]);
    return (
        <div>
            <h4>
                <span style={{ color: "#94CA52" }}>Stage 2:</span>
                {"  Discuss & Compromise"}
            </h4>

            <p>
                Do you have an issue with an influencer. Job delivery. file a
                complaint now.
            </p>

            <JobName />

            <Banner />

            <h4 style={{ marginTop: "47px", color: "#6F3C96" }}>
                Vendor's Dispute
            </h4>
            <Suspense fallback={<Skeleton count={5} />}>
                <p>{dispute?.initial_message}</p>
            </Suspense>
            <h4 style={{ marginTop: "47px", color: "#6F3C96" }}>
                Creatives's Dispute
            </h4>

            <p>
                Lorem Ipsum is simply dummy text of the printing and typesetting
                industry. Lorem Ipsum has been the industry's standard dummy
                text ever since the 1500s, Lorem Ipsum is simply dummy text of
                the printing and typesetting industry.{" "}
            </p>

            <h4 className={styles.heading}> Dispute Discussion</h4>

            <Suspense fallback={<Skeleton />}>
                <Message
                    actions={
                        <div className={styles.actionBtns}>
                            <button
                                className={styles.disputeBtn}
                                onClick={() => handleDrop(dispute_id)}
                            >
                                {" "}
                                Drop Dispute
                            </button>
                            <button
                                className={styles.disputeBtn}
                                onClick={() => handleMitigation(dispute_id)}
                            >
                                {" "}
                                Pay for Mitigation{" "}
                            </button>
                            <button
                                className={styles.disputeBtn}
                                onClick={() => handleCancel(dispute_id)}
                            >
                                {" "}
                                Cancel{" "}
                            </button>
                        </div>
                    }
                    text={dispute?.initial_message}
                />
            </Suspense>
        </div>
    );
};

export default Two;
