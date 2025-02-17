import React, { useState } from "react";
import { render } from "react-dom";
import PropTypes from "prop-types";
import Tabs from "@mui/material/Tabs";
import Tab from "@mui/material/Tab";
import Typography from "@mui/material/Typography";
import Box from "@mui/material/Box";
import Grid from "@mui/material/Grid";

/** Internal dependencies */
import InfluencerPlans from "./influencer";
import VendorPlans from "./vendor";

function TabPanel(props) {
    const { children, value, index, ...other } = props;

    return (
        <div
            role="tabpanel"
            hidden={value !== index}
            id={`simple-tabpanel-${index}`}
            aria-labelledby={`simple-tab-${index}`}
            {...other}
        >
            {value === index && (
                <Box sx={{ p: 3 }}>
                    <Typography>{children}</Typography>
                </Box>
            )}
        </div>
    );
}

TabPanel.propTypes = {
    children: PropTypes.node,
    index: PropTypes.number.isRequired,
    value: PropTypes.number.isRequired,
};

function a11yProps(index) {
    return {
        id: `simple-tab-${index}`,
        "aria-controls": `simple-tabpanel-${index}`,
    };
}

export default function BasicTabs() {
    const [activeTab, setActiveTab] = useState(0);

    const handleChange = (event, newValue) => {
        setActiveTab(newValue);
    };

    const hideTabs = false;

    return (
        <Grid style={{}}>
            {!hideTabs && (
                <div style={{ paddingTop: "2em" }}>
                    <Tabs
                        value={activeTab}
                        onChange={handleChange}
                        indicatorColor="primary"
                        textColor="primary"
                        centered
                    >
                        <Tab label="Vendors" />
                        <Tab label="Creatives" />
                    </Tabs>
                    <TabPanel value={activeTab} index={0}>
                        <VendorPlans />
                    </TabPanel>
                    <TabPanel value={activeTab} index={1}>
                        <InfluencerPlans />
                    </TabPanel>
                </div>
            )}
        </Grid>
    );
}

if (document.querySelector("#user-plans") != undefined) {
    render(<BasicTabs />, document.getElementById("user-plans"));
}
