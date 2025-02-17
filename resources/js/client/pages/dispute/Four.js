import React, { useEffect, useRef, useState } from "react";
import { Textarea, LoadingOverlay } from "@mantine/core";
import ModalDefault from "../../components/Modal";
import Banner from "./banner";
import Message from "./message";

const Four = () => {
    const ProjectName = "Nike Superfly";
    const ref = useRef(null);
    const [visible, setVisible] = useState(false);
    const handleConclusionBody = () => {
        setVisible(true);
        console.log(ref.current.value);
    };

    useEffect(() => {
        $("#concludeDispute").modal("show");
    }, []);
    return (
        <div>
            <h4>
                <span style={{ color: "#53E5AA" }}>Stage 4:</span>
                {"  Conclusion"}
            </h4>

            <p>
                A video about Dogs is now available. You can now view the video
            </p>

            <h6> Dispute: {ProjectName}</h6>

            <Banner />

            <h4 style={{ marginTop: "47px", color: "#6F3C96" }}>
                Vendor's Dispute
            </h4>
            <p>
                Lorem Ipsum is simply dummy text of the printing and typesetting
                industry. Lorem Ipsum has been the industry's standard dummy
                text ever since the 1500s, Lorem Ipsum is simply dummy text of
                the printing and typesetting industry.{" "}
            </p>

            <h4 style={{ marginTop: "47px", color: "#6F3C96" }}>
                Creatives's Dispute
            </h4>

            <p>
                Lorem Ipsum is simply dummy text of the printing and typesetting
                industry. Lorem Ipsum has been the industry's standard dummy
                text ever since the 1500s, Lorem Ipsum is simply dummy text of
                the printing and typesetting industry.{" "}
            </p>

            <Message />

            <ModalDefault
                id="concludeDispute"
                title="Stage 4: Conclusion"
                action={
                    <div
                        style={{
                            display: "flex",
                            flexDirection: "row",
                            gap: ".5em",
                        }}
                    >
                        <button className="btn btn-outline-primary">
                            Cancel escrow
                        </button>
                        <button
                            className="btn btn-secondary"
                            onClick={() => handleConclusionBody()}
                        >
                            Release Escrow to Creative
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
                    label="The Decision"
                />
            </ModalDefault>
        </div>
    );
};

export default Four;
