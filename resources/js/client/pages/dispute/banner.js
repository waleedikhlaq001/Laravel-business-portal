/**
 * External Dependencies
 */
import React from "react";
import { Paper } from "@mantine/core";
/**
 * Internal Dependencies
 */
import svg from "./disp.svg";

const Banner = () => {
    const stages = [
        {
            stage: 1,
            title: "What is the issue?",
        },
        {
            stage: 2,
            title: "Discuss & Compromise",
        },
        {
            stage: 3,
            title: "Pay & Resolve",
        },
        {
            stage: 4,
            title: "Conclusion",
        },
    ];
    return (
        <div>
            <Paper shadow="lg" padding="md">
                <div style={{ width: "96%", alignItems: "center" }}>
                    <img
                        src={svg}
                        alt=""
                        style={{
                            width: "inherit",
                        }}
                    />
                </div>
                <div
                    style={{
                        display: "flex",
                        flexDirection: "row",
                        textAlign: "center",
                    }}
                >
                    <div
                        style={{
                            marginTop: "10px",
                            marginLeft: "2em",
                            marginRight: "6.2em",
                        }}
                    >
                        <h5>STAGE 1</h5>
                        <h6>"What is the issue?"</h6>
                    </div>

                    <div
                        style={{
                            marginTop: "10px",
                            marginLeft: "1em",
                            marginRight: "6.2em",
                        }}
                    >
                        <h5>STAGE 2</h5>
                        <h6>"Discuss & Compromise"</h6>
                    </div>

                    <div
                        style={{
                            marginTop: "10px",
                            marginLeft: "2em",
                            marginRight: "6.2em",
                        }}
                    >
                        <h5>STAGE 3</h5>
                        <h6>"Pay & Resolve"</h6>
                    </div>

                    <div
                        style={{
                            marginTop: "10px",
                            marginLeft: "3em",
                            marginRight: "6.2em",
                        }}
                    >
                        <h5>STAGE 4</h5>
                        <h6>"Conclusion"</h6>
                    </div>
                </div>
            </Paper>
        </div>
    );
};

export default Banner;
