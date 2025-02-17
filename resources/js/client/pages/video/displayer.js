import React, { useState, useEffect } from "react";
import ReactPlayer from "react-player";

const Displayer = ({ url }) => {
    // const [videoURL, setVideoURL] = useState(url);
    const [loop, setLoop] = useState(true);
    const [playing, setPlaying] = useState(true);
    const [add, setAdd] = useState(undefined);

    useEffect(() => {
        setLoop(false);
        setPlaying(false);
    }, [url]);
    return (
        <>
            <ReactPlayer
                url={
                    url ||
                    "https://staging.vicomma.com/videos/vicomma-intro.mp4"
                }
                playing={playing}
                loop={loop}
                controls
                config={{
                    file: {
                        attributes: {
                            controlsList: "nodownload",
                        },
                    },
                }}
                onReady={() => {
                    if (url != undefined) {
                        setAdd(url);
                    }
                }}
                width={"100%"}
            />
        </>
    );
};

export default Displayer;
