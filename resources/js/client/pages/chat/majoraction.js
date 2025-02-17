import React from "react";
import { JobContext } from "./context";
const MajorAction = () => {
    const redirectToDispute = async (job_id) => {
        window.location.href = `/dispute?job_id=${job_id}`;
    };

    const redirectToMilestone = async () => {
        window.location.href = $("#deposit-initial").attr("href");
    };

    const awardJobtoCreative = async () => {
        $("#awardForm").submit();
    };
    return (
        <JobContext.Consumer>
            {({ currentJob }) => {
                return (
                    <div>
                        {/* <h1>MajorAction</h1> */}
                        {/* <p>currentPage: {currentPage}</p> */}
                        {currentJob.isAwarded ? (
                            <div>
                                <button
                                    className="major-button"
                                    onClick={() =>
                                        redirectToDispute(currentJob.id)
                                    }
                                >
                                    Dispute
                                </button>
                                <button
                                    className="major-button"
                                    onClick={() => redirectToMilestone()}
                                >
                                    Pay Now
                                </button>
                            </div>
                        ) : (
                            <button
                                className="major-button"
                                onClick={() => awardJobtoCreative()}
                            >
                                Award
                            </button>
                        )}
                    </div>
                );
            }}
        </JobContext.Consumer>
    );
};

export default MajorAction;

/**
 * TO DO:
 *  - handle the case when user is not logged in
 *  - redirect to login page
 *  - when job has been awarded
 *  - when job has been closed
 *  - when there is a dispute
 */
