/**
 * External Dependencies
 */
import React, { useEffect, useState, useRef } from "react";
import { render } from "react-dom";
import { LoadingOverlay, Textarea } from "@mantine/core";
/**
 * Internal Dependencies
 */
import ModalDefault from "../../components/Modal";
import Banner from "./banner";
import Two from "./Two";
import Three from "./Three";
import Four from "./Four";
import useJob from "../../hook/useJob";

const DisputeIndex = () => {
    const { job, isloading, isError } = useJob(job_id);
    const ProjectName = "Job Name" || job.data.name;
    const [visible, setVisible] = useState(false);
    const ref = useRef(null);
    const handleDisputeBody = async () => {
        setVisible(true);
        console.log(ref.current.value);

        const fetcher = await fetch("/dispute/register", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            body: JSON.stringify({
                initial_message: ref.current.value,
                job_id: job_id,
                vendor_to_pay: "450",
                creative_ask_for: "550",
            }),
        });

        let result = await fetcher.json();

        if (result.status === "success") {
            setTimeout(() => {
                location.href =
                    "/dispute/stage-two?dispute_id=" +
                    result.data +
                    "&job_id=" +
                    job_id;
            }, 2000);
        }
    };

    useEffect(() => {
        $("#initiateDispute").modal("show");
    }, []);

    return (
        <div>
            <h4>
                <span style={{ color: "#6F3C96" }}>Stage 1:</span>
                {"  Initiate Dispute"}
            </h4>

            <p>
                Do you have an issue with an influencer. Job delivery. file a
                complaint now.
            </p>

            <h6> Dispute: {ProjectName}</h6>

            <Banner />

            <ModalDefault
                id="initiateDispute"
                title="Stage 1: What is the Issue?"
                action={
                    <div
                        style={{
                            display: "flex",
                            flexDirection: "row",
                            gap: ".5em",
                        }}
                    >
                        <button className="btn btn-outline-primary">
                            Agree and Pay
                        </button>
                        <button
                            className="btn btn-secondary"
                            onClick={() => handleDisputeBody()}
                        >
                            Continue Dispute
                        </button>
                        <LoadingOverlay
                            visible={visible}
                            loader={
                                <div
                                    className="spinner-border text-primary"
                                    role="status"
                                >
                                    <span className="sr-only">Loading...</span>
                                </div>
                            }
                        />
                    </div>
                }
            >
                <Textarea
                    ref={ref}
                    placeholder="Please describe , in detail, what is wrong with the deliverable… "
                    label="so, what is wrong?"
                />
            </ModalDefault>

            <button
                className="btn btn-primary"
                style={{ marginTop: "2em" }}
                onClick={() => {
                    $("#initiateDispute").modal("show");
                }}
            >
                {"Start Dispute Process"}
            </button>
        </div>
    );
};

if (document.getElementById("dispute-module")) {
    render(<DisputeIndex />, document.getElementById("dispute-module"));
}

if (document.getElementById("dispute-two-module")) {
    render(<Two />, document.getElementById("dispute-two-module"));
}

if (document.getElementById("dispute-three-module")) {
    render(<Three />, document.getElementById("dispute-three-module"));
}

if (document.getElementById("dispute-four-module")) {
    render(<Four />, document.getElementById("dispute-four-module"));
}
