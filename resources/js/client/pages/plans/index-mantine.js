/**
 * External Dependencies
 */
import React, { useState } from "react";
import { render } from "react-dom";
import { Tabs, Grid } from "@mantine/core";
/**
 * Internal Dependencies
 */
import InfluencerPlans from "./influencer";
import VendorPlans from "./vendor";
const BasicTabs = () => {
    const [activeTab, setActiveTab] = useState(1);
    return (
        <Grid justify="center">
            <Tabs active={activeTab} onTabChange={setActiveTab}>
                <Tabs.Tab label="Vendors">
                    <VendorPlans />
                </Tabs.Tab>
                <Tabs.Tab label="Creatives">
                    <InfluencerPlans />
                </Tabs.Tab>
            </Tabs>
        </Grid>
    );
};

render(<BasicTabs />, document.getElementById("user-plans"));
