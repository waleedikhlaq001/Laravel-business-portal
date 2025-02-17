/**
 * External dependencies
 */
import React from "react";
import { Paper, Divider, Button } from "@mantine/core";
/**
 *
 * Internal dependencies`
 */
import List from "../../components/list";

const VendorPlans = () => {
    return (
        <>
            <div
                style={{
                    paddingTop: "0",
                    paddingBottom: "4em",
                    width: "100%"
                }}
            >
                <h1 className="main-heading text-center">Vendors</h1>

                <div
                    style={{
                        display: "flex",
                        flexDirection: "row",
                        justifyContent: "space-evenly",
                        marginTop: "2em",
                        gap: "2em"
                    }}
                >
                    <Paper
                        shadow={"lg"}
                        padding={"xl"}
                        radius={"md"}
                        withBorder={true}
                    >
                        <Pivotal />
                    </Paper>
                    <Paper
                        shadow={"lg"}
                        padding={"xl"}
                        radius={"md"}
                        withBorder={true}
                    >
                        <MovingUp />
                    </Paper>
                    <Paper
                        shadow={"lg"}
                        padding={"xl"}
                        radius={"md"}
                        withBorder={true}
                    >
                        <Premium />
                    </Paper>
                </div>
            </div>
        </>
    );
};

const Pivotal = () => {
    const pivotal_data = [
        {
            title: "Create a Vendor Account"
        },
        {
            title: "Add/Sell up to 3 products"
        },
        {
            title: "Post(Hire up to 2 creatives/month)"
        }
    ];
    return (
        <>
            <div
                style={{
                    display: "flex",
                    flexDirection: "column",
                    padding: "2em",
                    alignItems: "center"
                }}
            >
                <div className="top-section"> Pivotal </div>

                <div className="plan-content" style={{ marginTop: "2em" }}>
                    <List data={pivotal_data} />
                </div>

                <Divider size="sm" />

                <div style={{ marginTop: "2em", fontSize: "1.5rem" }}>
                    $5.99
                    <span style={{ fontSize: "0.8rem", color: "#6F408E" }}>
                        /month
                    </span>
                </div>

                <Button
                    style={{ marginTop: "2em", backgroundColor: "#6F408E" }}
                    size="md"
                >
                    Start Now
                </Button>
            </div>
        </>
    );
};
const MovingUp = () => {
    const moveup_data = [
        {
            title: "Create a Vendor Account"
        },
        {
            title: "Add/Sell up to 6 products"
        },
        {
            title: "Post(Hire up to 4 creatives/month)"
        }
    ];
    return (
        <>
            <div
                style={{
                    display: "flex",
                    flexDirection: "column",
                    padding: "2em",
                    alignItems: "center"
                }}
            >
                <div className="top-section"> MovingUp</div>
                <div className="plan-content" style={{ marginTop: "2em" }}>
                    <List data={moveup_data} />
                </div>

                <Divider size="sm" />

                <div style={{ marginTop: "2em", fontSize: "1.5rem" }}>
                    $8.99
                    <span style={{ fontSize: "0.8rem", color: "#6F408E" }}>
                        /month
                    </span>
                </div>

                <Button
                    style={{ marginTop: "2em", backgroundColor: "#6F408E" }}
                    size="md"
                >
                    Start Now
                </Button>
            </div>
        </>
    );
};
const Premium = () => {
    const premium_data = [
        {
            title: "Create a Vendor Account"
        },
        {
            title: "Add/Sell up to 10 products"
        },
        {
            title: "Post(Hire up to ꝏ creatives/month)"
        }
    ];
    return (
        <>
            <div
                style={{
                    display: "flex",
                    flexDirection: "column",
                    padding: "2em",
                    alignItems: "center"
                }}
            >
                <div className="top-section"> Premium</div>

                <div className="plan-content" style={{ marginTop: "2em" }}>
                    <List data={premium_data} />
                </div>

                <Divider size="sm" />

                <div style={{ marginTop: "2em", fontSize: "1.5rem" }}>
                    $12.99
                    <span style={{ fontSize: "0.8rem", color: "#6F408E" }}>
                        /month
                    </span>
                </div>

                <Button
                    style={{ marginTop: "2em", backgroundColor: "#6F408E" }}
                    size="md"
                >
                    Start Now
                </Button>
            </div>
        </>
    );
};

// ReactDOM.render(<VendorPlans />, document.getElementById("vendor-plans"));
export default VendorPlans;
