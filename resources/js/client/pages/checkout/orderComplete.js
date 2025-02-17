import React, { Fragment } from "react";
import { Paper, Grid, Col, Button } from "@mantine/core";
const OrderComplete = () => {
    return (
        <Fragment>
            <div className="container-fluid" style={{ paddingLeft: "0", paddingRight: "0" }}>
                <h6 className="text-center"> Order Complete</h6>

                <div className="order-details-body">
                    <Paper shadow="md" padding="md" className={`text-center`}>
                        <Grid columns={12} gutter="lg" justify="space-between">
                            <Col span={12} style={{ fontSize: "1.5em" }}>
                                Your Order Was Placed Succesfully. You will
                                recieve a confirmation email shortly.
                            </Col>
                            <Col span={12} style={{ fontSize: "1.5em" }}>
                                <center>
                               <img src="/images/200ww.gif" className="my-3" height={80} />
                               </center>
                            </Col>
                            <Col span={12} style={{ fontSize: "1.5em" }}>
                                Click The Button Below to See your order Progress.
                            </Col>
                            <Col span={12}>
                                <div className="text-center align-self-center">
                                    <Button color={"green"}> View Order</Button>
                                </div>
                            </Col>
                        </Grid>
                    </Paper>
                </div>
            </div>
        </Fragment>
    );
};

export default OrderComplete;
