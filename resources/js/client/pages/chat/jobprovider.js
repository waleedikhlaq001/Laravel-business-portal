import React, { useEffect, useState } from "react";

import { JobContext } from "./context";

const JobProvider = ({ mx_id, children }) => {
    const [currentJob, setCurrentJob] = useState({
        id: parseInt(mx_id),
        jobName: $("#main-job-name").text(),
        isAwarded: false, // should be updated from the server
        isDisputed: false, //should be updated from the server
    });
    useEffect(() => {
        const checkJobAwarded = async () => {
            const response = await fetch(
                `${window.location.origin}/job/checkAwarded/${currentJob.id}`
            );
            const data = await response.json();
            setCurrentJob({
                ...currentJob,
                isAwarded: data.isAwarded,
                // isDisputed: data.isDisputed,
            });
        };
        checkJobAwarded();
    }, []);
    const values = {
        currentJob,
    };
    return <JobContext.Provider value={values}>{children}</JobContext.Provider>;
};

export default JobProvider;
