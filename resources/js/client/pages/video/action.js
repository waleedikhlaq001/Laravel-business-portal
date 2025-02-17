/**
 * External dependencies
 */
import React, { StrictMode, useEffect, useState } from "react";
import { render } from "react-dom";

import CountDownTimer from "../milestones/CountDownTimer";
import {
    Button,
    Paper,
    Divider,
    TextInput,
    Group,
    Loader,
} from "@mantine/core";
import { useForm } from "@mantine/hooks";
import axios from "axios";

import UploadVideo from "../../../components/UploadVideo.vue";

const VideoAction = ({ getToken, job, expiresDate }) => {
    const [loading, setLoading] = useState(false);
    const [errorMessage, setErrorMessage] = useState("");
    // const [jobTimer, setJobTimer] = useState(null);
    const [tokenValue, setTokenValue] = useState("");

    const verifyToken = (e) => {
        e.preventDefault();
        const config = {
            jobId: job,
            token: tokenValue,
        };

        if (tokenValue !== "") {
            setLoading(true);
            axios
                .post("/job/video/token", config)
                .then((response) => {
                    setLoading(false);
                    setTokenValue("");
                    setErrorMessage("");
                    setTimeout(() => {
                        localStorage.setItem("openTab", "pills-content-tab");
                        location.reload();
                    }, 3000);
                    console.log(response);
                })
                .catch((error) => {
                    setLoading(false);
                    setErrorMessage(error.response.data);
                });
        }
    };

    useEffect(() => {}, [errorMessage, tokenValue]);

    // const countDownFromDB = JSON.parse(timer);
    // console.log(timer);
    // const hoursMinSecs = {
    //     hours: timer.hours,
    //     minutes: timer.minutes,
    //     seconds: timer.seconds,
    // };
    const hoursMinSecs = {
        hours: 48,
        minutes: 0,
        seconds: 0,
    };

    return (
        <>
            {/* {actor === "vendor" && ( */}
            <div>
                <Divider color="green" size="lg" />
                <Paper
                    shadow="lg"
                    style={{
                        alignItems: "center",
                    }}
                    className="p-3"
                >
                    {/* <CountDownTimer
                        hoursMinSecs={hoursMinSecs}
                        jobId={job}
                        countDownFromDB={countDownFromDB}
                    /> */}
                    {errorMessage && (
                        <div
                            className="text-danger"
                            style={{ fontSize: "12px" }}
                        >
                            {errorMessage}
                        </div>
                    )}
                    <form>
                        <TextInput
                            className="mt-2"
                            placeholder="Enter Token"
                            variant="filled"
                            value={tokenValue}
                            onChange={(e) => setTokenValue(e.target.value)}
                        />
                        <button
                            className="btn btn-success btn-block mt-2"
                            onClick={(e) => verifyToken(e)}
                            disabled={tokenValue === "" ? "true" : ""}
                        >
                            {loading ? (
                                <Loader
                                    color="green"
                                    size="xl"
                                    variant="dots"
                                />
                            ) : (
                                "Submit"
                            )}
                        </button>
                    </form>
                </Paper>
            </div>
            {/* // )} */}
        </>
    );
};

const params = new URLSearchParams(window.location.search);

if (document.querySelector("#video-action") != undefined) {
    // const tokenData = document
    //     .querySelector("#video-action")
    //     .getAttribute("token");
    const jobData = document.querySelector("#video-action").getAttribute("job");
    // const expiresDate = document
    //     .querySelector("#video-action")
    //     .getAttribute("expire");
    const jobId = JSON.parse(jobData);
    // const tokenCode = JSON.parse(tokenData);
    render(
        <StrictMode>
            <VideoAction
                // actor={params.get("actor")}
                // getToken={tokenCode.token}
                job={jobId.id}
                // expiresDate={expiresDate}
            />
        </StrictMode>,
        document.querySelector("#video-action")
    );
}

export default VideoAction;
