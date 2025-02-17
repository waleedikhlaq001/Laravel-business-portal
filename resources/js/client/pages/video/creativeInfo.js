import React from "react";
import { Paper, Divider, Button, TextInput, Grid, Col } from "@mantine/core";
import Icon from "../../icons";

const CreativeInfo = ({ name, projectName, createdDate, email, phone }) => {
    return (
        <div>
            <h3 className="pirple-font mt-4">Creative Details</h3>
            <div
                style={{ display: "flex", flexDirection: "column", gap: "1em" }}
            >
                <div>
                    <Divider color="green" size="lg" />
                    <Paper shadow="lg" padding="xl" radius="md">
                        <Grid>
                            <Col
                                span={4}
                                style={{
                                    display: "flex",
                                    flexDirection: "row",
                                    gap: "1em",
                                }}
                            >
                                <img src={Icon.user} /> <span>{name}</span>
                            </Col>
                            <Col
                                span={4}
                                style={{
                                    display: "flex",
                                    flexDirection: "row",
                                    gap: "1em",
                                }}
                            >
                                <img src={Icon.user} />{" "}
                                <span>{projectName}</span>
                            </Col>
                            <Col
                                span={4}
                                style={{
                                    display: "flex",
                                    flexDirection: "row",
                                    gap: "1em",
                                }}
                            >
                                <img src={Icon.user} />{" "}
                                <span>Member Since {createdDate}</span>
                            </Col>
                        </Grid>
                    </Paper>
                </div>
            </div>

            <h3 className="pirple-font mt-4">Creative Verification</h3>
            <div
                style={{ display: "flex", flexDirection: "column", gap: "1em" }}
            >
                <div>
                    <Divider color="green" size="lg" />
                    <Paper shadow="lg" padding="xl" radius="md">
                        <Grid>
                            <Col
                                span={4}
                                style={{
                                    display: "flex",
                                    flexDirection: "row",
                                    gap: "1em",
                                }}
                            >
                                <img src={Icon.user} /> <span>{email}</span>
                            </Col>
                            <Col
                                span={4}
                                style={{
                                    display: "flex",
                                    flexDirection: "row",
                                    gap: "1em",
                                }}
                            >
                                <img src={Icon.user} /> <span>{phone}</span>
                            </Col>
                            {/* <Col
                                span={4}
                                style={{
                                    display: "flex",
                                    flexDirection: "row",
                                }}
                            >
                                <img src={Icon.user} />{" "}
                                <span>Member Since 1 week ago</span>
                            </Col> */}
                        </Grid>
                    </Paper>
                </div>
            </div>
        </div>
    );
};

export default CreativeInfo;
