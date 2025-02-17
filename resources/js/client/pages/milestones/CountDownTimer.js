import React, { useEffect, useState } from "react";

import { Paper } from "@mantine/core";
import axios from "axios";

const styles = {
    cntDwnText: {
        fontSize: "38px",
        color: "#e11414",
    },
};
const CountDownTimer = ({ hoursMinSecs, jobId, countDownFromDB }) => {
    const { hour, minutes, seconds } = countDownFromDB;
    // const { hhrs, mm, ss } = countDownFromDB;
    // console.log(countDownFromDB);

    const [[hrs, mins, secs], setTime] = useState([hour, minutes, seconds]);
    const [initalTimer, setInitialTimer] = useState(300);
    const [makeVidReq, setMakeVidReq] = useState(false);

    const tick = () => {
        if (hrs === 0 && mins === 0 && secs === 0) {
            redirectToVideoPage();
        } else if (mins === 0 && secs === 0) {
            setTime([hrs - 1, 59, 59]);
        } else if (secs === 0) {
            setTime([hrs, mins - 1, 59]);
        } else {
            setTime([hrs, mins, secs - 1]);
        }
    };

    //save timer to database

    const timerConfig = {
        id: jobId,
        time: { hour: hrs, minutes: mins, seconds: secs },
    };
    const remainingTime = () => {
        axios
            .post("/video/time/update/", timerConfig)
            .then((response) => console.log(response.data))
            .catch((error) => console.log(error));
        console.log("updated");
    };

    const redirectToVideoPage = () => {
        window.location.protocol = "https:";
        window.location.href =
            window.location.origin +
            "/video/review/?actor=vendor&jobid=" +
            jobId;
    };
    const countToFive = () => {
        if (initalTimer === 0) {
            setMakeVidReq(true);
            setInitialTimer(300);
        } else {
            setMakeVidReq(false);
            setInitialTimer(initalTimer - 1);
            // console.log("initial Timer Change", initalTimer);
        }
    };
    useEffect(() => {
        const timerId = setInterval(() => {
            tick();
            countToFive();
        }, 1000);
        return () => clearInterval(timerId);
    });
    useEffect(() => {
        // if (makeVidReq) {
        //     remainingTime();
        // }
    }, [makeVidReq]);

    return (
        <Paper withBorder>
            <div style={styles.cntDwnText}>
                {`${hrs.toString().padStart(2, "0")}:${mins
                    .toString()
                    .padStart(2, "0")}:${secs.toString().padStart(2, "0")}`}
            </div>
        </Paper>
    );
};

export default CountDownTimer;