/**
 * External dependencies
 */
import React, { useEffect, useState, lazy, Suspense } from "react";
import ReactDOM from "react-dom";
import Skeleton from "react-loading-skeleton";
import "react-loading-skeleton/dist/skeleton.css";
import ReactPlayer from "react-player";
import { Divider, Paper, Button } from "@mantine/core";

/**
 *  Internal Dependencies
 */
import styles from "./index.module.css";
import download from "./download.svg";
const CreativeInfo = lazy(() => import("./creativeInfo"));

const Action = () => {
    const amount = 200;
    return (
        <div
            style={{
                display: "flex",
                flexDirection: "column",
                height: "445px",
                textAlign: "center",
            }}
        >
            <Divider size={"md"} color="purple" />
            <Paper shadow="lg" style={{ padding: "20px" }}>
                <img
                    className={styles.downloadSvg}
                    src={download}
                    alt="download"
                />
                <h6>Download Video </h6>
                <p> Click on the button to download your content</p>
            </Paper>
        </div>
    );
};
const Accept = () => {
    const url = "https://www.youtube.com/watch?v=dQw4w9WgXcQ";
    const size = "default";
    const [actor, setActor] = useState("vendor");
    const [videoURL, setVideoURL] = useState(undefined);
    return (
        <div>
            <h3 className="pirple-font">Download Your Content</h3>

            <div style={{ display: "flex", flexDirection: "row", gap: ".3em" }}>
                <Suspense fallback={<Skeleton />}>
                    <ReactPlayer
                        url={url}
                        playing={false}
                        controls
                        config={{
                            file: {
                                attributes: {
                                    controlsList: "nodownload",
                                },
                            },
                        }}
                        width={"100%"}
                        height={445}
                    />
                </Suspense>

                <Action />
            </div>

            <div className={styles.options}>
                <Button variant="outline" radius="xl">
                    Rate My Creative
                </Button>
                <Button variant="outline" radius="xl">
                    Boost My Sales
                </Button>
                <Button variant="filled" radius="xl">
                    Make an NFT
                </Button>
            </div>

            <div>
                <Suspense fallback={<Skeleton count={1} />}>
                    <CreativeInfo
                        name="Abraham Olaobaju"
                        projectName="Nike Shoes"
                        createdDate="1 week ago"
                        email="olaobaju@gmail.com"
                        phone="09067985861"
                    />
                </Suspense>
            </div>
        </div>
    );
};

export default Accept;

if (document.getElementById("vicomma-complete-module")) {
    ReactDOM.render(
        <Accept />,
        document.getElementById("vicomma-complete-module")
    );
}
