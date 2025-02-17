import React, { Suspense, useState, useEffect, StrictMode } from "react";
import { render } from "react-dom";
import { Modal, Button } from "@mantine/core";
import ReactPlayer from "react-player";
import { FiCheck } from "react-icons/fi";
import { FaWallet } from "react-icons/fa";
import { FaCreditCard } from "react-icons/fa";
import { BsChatSquareTextFill } from "react-icons/bs";
import { AiOutlineCheckCircle } from "react-icons/ai";

const VideoPage = ({
    jobId,
    url,
    watched,
    role,
    milestone,
    videoId,
    approved,
    amountDue,
    walletBalance,
    uuid,
    jobCompleted,
}) => {
    const [loop, setLoop] = useState(false);
    const [playing, setPlaying] = useState(false);
    const [add, setAdd] = useState(undefined);
    const [jobIDD, setJobIDD] = useState(0);
    const [isWatched, setIsWatched] = useState(watched);
    const [opened, setOpened] = useState(false);
    const [awardedInfluencer, setAwardedInfluencer] = useState(0);
    const [finalPaymentModal, setfinalPaymentModal] = useState(false);
    const [walletTab, setWalletTab] = useState("");
    const [videoSrc, setVideoSrc] = useState('');

    const [isdisabled, setDisabled] = useState(true);

    const getData = () => {
        const { mstone, jobid, subaccount } = JSON.parse(
            localStorage.getItem("m_data")
        );
        setJobIDD(jobId);
    };

    const watchedVideo = () => {
        const config = {
            job_id: jobId,
        };
        axios
            .post("/video/viewat", config)
            .then((response) => {
                console.log(response);
            })
            .catch((error) => {
                console.log(error);
            });
    };

    const updateVidSrc = () => {
        const m = url.split('%');
        const encSrc = m[0].split("").reverse().join("");
        const decSrc = new Buffer.from(encSrc , 'base64').toString();
        let xhr = new XMLHttpRequest();
        xhr.open('GET', decSrc);
        xhr.responseType = 'arraybuffer';
        xhr.onload = (e) => {
            let blob = new Blob([xhr.response]);
            let url = URL.createObjectURL(blob);
            setVideoSrc(url)
        }

        xhr.send();
    }

    useEffect(() => {
        if (milestone === 1) {
            getData();
        }

        if (isWatched == 1) {
            setDisabled(false);
        }

        updateVidSrc();

        // axios
        //     .get(`/api/influencersfind/job/${jobId}/awarded`)
        //     .then((res) => {
        //         setAwardedInfluencer(res.data.influencer_id);
        //     })
        //     .catch((err) => {
        //         console.log(err);
        //     });
    }, []);

    const videoAction = () => {
        if (walletBalance === amountDue) {
            return (
                <button
                    className="btn btn-primary me-2"
                    disabled={isdisabled}
                    onClick={() => setOpened(true)}
                >
                    <FiCheck /> Accept Video
                </button>
            );
        } else {
            return (
                <button
                    className="btn btn-primary me-2 open-vwallet"
                    disabled={isdisabled}
                >
                    <FaCreditCard /> Credit Wallet
                </button>
            );
        }
    };

    const approveVideo = () => {
        const config = {
            uid: uuid,
        };
        window.location.replace(`/milestone/${uuid}/pay`);
        // axios
        //     .get(``)
        //     .then((res) => {
        //         console.log(res);
        //     })
        //     .catch((error) => {
        //         console.log(error);
        //     });
    };

    console.log("milestone", isWatched);

    return (
        <>
            <ReactPlayer
                url={videoSrc}
                playing={playing}
                loop={loop}
                controls
                config={{
                    file: {
                        attributes: {
                            onContextMenu: (e) => e.preventDefault(),
                            controlsList: "nodownload",
                        },
                    },
                }}
                onReady={() => {
                    if (url != undefined) {
                        setAdd(url);
                    }
                }}
                onEnded={() => {
                    setIsWatched(true);
                    watchedVideo();
                    // setfinalPaymentModal(true);
                    location.reload();
                }}
                width={"100%"}
            />
            {role === "vendor" && jobCompleted != "1" ? (
                <div className="d-flex justify-content-center mt-4 px-2">
                    {videoAction()}

                    <div
                        id="vicomma-chat-module-final"
                        style={{ display: "none" }}
                    ></div>

                    {$("#cta-final").length == 1 ? (
                        <button
                            className="btn btn-secondary ml-2"
                            disabled={false}
                            onClick={() => {
                                window.location = $("#cta-final").attr("href");
                            }}
                        >
                            Make Final Payment
                        </button>
                    ) : (
                        <div></div>
                    )}
                </div>
            ) : (
                ""
            )}

            <Modal
                opened={opened}
                onClose={() => setOpened(false)}
                centered
                title="Please Confirm your action!"
            >
                You have watched the video uploaded by the creative and you're
                ready to accept it.
                <div className="d-flex justify-content-end mt-2">
                    <Button
                        className="me-2"
                        variant="outline"
                        onClick={() => setOpened(false)}
                    >
                        Cancel
                    </Button>
                    <Button color="green" onClick={approveVideo}>
                        Procced
                    </Button>
                </div>
            </Modal>
        </>
    );
};

if (document.querySelector("#video-module") != undefined) {
    const video = document.querySelector("#video-module").getAttribute("video");
    const watched = document
        .querySelector("#video-module")
        .getAttribute("watched");
    const role = document.querySelector("#video-module").getAttribute("role");
    const approved = document
        .querySelector("#video-module")
        .getAttribute("approved");

    const videoId = document
        .querySelector("#video-module")
        .getAttribute("videoId");

    const milestone = document
        .querySelector("#video-module")
        .getAttribute("milestone");

    const amountDue = document
        .querySelector("#video-module")
        .getAttribute("amountDue");

    const walletBalance = document
        .querySelector("#video-module")
        .getAttribute("walletBal");

    const jobCompleted = document
        .querySelector("#video-module")
        .getAttribute("jobCompleted");

    const uuid = document.querySelector("#video-module").getAttribute("uuid");

    const jobData = document.querySelector("#video-module").getAttribute("job");
    const jobId = JSON.parse(jobData);
    render(
        <StrictMode>
            <VideoPage
                jobId={jobId}
                url={video}
                watched={watched}
                role={role}
                milestone={milestone}
                videoId={videoId}
                approved={approved}
                amountDue={amountDue}
                walletBalance={walletBalance}
                uuid={uuid}
                jobCompleted={jobCompleted}
            />
        </StrictMode>,
        document.querySelector("#video-module")
    );
}
