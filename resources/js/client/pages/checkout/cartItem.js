import React from "react";
const CartItem = ({ id, price, qty, name, attributes, imgSrc }) => {
    const main_id = id || "5";
    const main_name = name || "Iphone 11 Pro Max";
    const main_attributes = attributes || "black";
    return (
        <Fragment>
            <Paper padding="sm" shadow="md" style={{ marginBottom: ".5em" }}>
                <Grid columns={12} gutter="lg" grow>
                    <Col span={3}>
                        <img
                            src={`https://picsum.photos/id/${main_id}/200/200`}
                            // fit="scale-down"
                            style={{
                                alignSelf: "center",
                                padding: ".5em",
                                width: "60%"
                            }}
                        />
                    </Col>
                    <Col span={3}>
                        <div style={{ alignSelf: "center", padding: ".5em" }}>
                            <h6>{main_name}</h6>
                            <p>{`${main_attributes}`}</p>
                        </div>
                    </Col>
                    <Col span={3}>
                        <div style={{ alignSelf: "center", padding: ".5em" }}>
                            <p>3</p>
                            <p>N300</p>
                        </div>
                    </Col>
                    <Col span={3}>
                        <img
                            style={{ alignSelf: "center", padding: "2em" }}
                            src={Icons.Trash}
                        />
                    </Col>
                </Grid>
            </Paper>
        </Fragment>
    );
};

export default CartItem;
