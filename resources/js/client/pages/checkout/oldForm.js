import React from "react";
import { useForm } from "@mantine/hooks";
const CheckoutForm = () => {
    const form = useForm({
        initialValues: {
            email: "",
            firstname: "",
            lastname: "",
            companyname: "",
            termsOfService: false
        },

        validationRules: {
            email: value => /^\S+@\S+$/.test(value)
        }
    });
    return (
        <>
            {/* <InputWrapper
                id="input-demo"
                required
                label="Credit card information"
                description="Please enter your credit card information, we need some money"
                error="Your credit card expired"
            >
                <Input id="input-demo" placeholder="Your email" />
            </InputWrapper> */}
            <div style={{ display: "flex", flexDirection: "row" }}>
                <form
                    onSubmit={form.onSubmit(values => console.log(values))}
                    style={{ width: "60%" }}
                >
                    <h3>Billing Details</h3>
                    <div className="row">
                        <TextInput
                            className="col-md-6"
                            label="First Name"
                            value={form.values.firstname}
                            onChange={event =>
                                form.setFieldValue(
                                    "firstname",
                                    event.currentTarget.value
                                )
                            }
                            required
                        />

                        <TextInput
                            className="col-md-6"
                            label="Last Name"
                            value={form.values.lastname}
                            onChange={event =>
                                form.setFieldValue(
                                    "lastname",
                                    event.currentTarget.value
                                )
                            }
                            required
                        />
                    </div>

                    <TextInput
                        label="Company Name"
                        value={form.values.companyname}
                        onChange={event =>
                            form.setFieldValue(
                                "companyname",
                                event.currentTarget.value
                            )
                        }
                    />

                    <div className="row">
                        <TextInput
                            className="col-md-6"
                            required
                            label="Email"
                            error={
                                form.errors.email &&
                                "Please specify valid email"
                            }
                            value={form.values.email}
                            onChange={event =>
                                form.setFieldValue(
                                    "email",
                                    event.currentTarget.value
                                )
                            }
                        />

                        <NumberInput
                            className="col-md-6"
                            defaultValue={8067985861}
                            placeholder="Your Phone Number"
                            label="Phone Number"
                            required
                        />
                    </div>

                    <MultiSelect
                        data={[
                            { value: "NG", label: "Nigeria" },
                            { value: "US", label: "United States" },
                            { value: "UG", label: "Uganda" },
                            { value: "KE", label: "Kenya" }
                        ]}
                        label="Select Country"
                        placeholder="Scroll to see all options"
                        maxDropdownHeight={160}
                    />

                    <Textarea
                        placeholder="Address"
                        label="Address"
                        size="md"
                        required
                    />

                    <h3>Shipping Details</h3>
                    <Accordion initialItem={-1}>
                        <Accordion.Item
                            icon={<img src={Icons.circlePlus} alt="plus" />}
                            label="Use a different Address"
                        >
                            Not at home? We can deliver to your current address
                        </Accordion.Item>
                    </Accordion>

                    <Textarea
                        placeholder="Order Notes"
                        label="Order Note"
                        size="md"
                    />

                    {/* <Button type="submit">Submit</Button> */}
                </form>

                <div
                    className="row"
                    style={{ width: "40%", marginLeft: ".5em" }}
                >
                    <Paper shadow="md">
                        <h6
                            className="text-center"
                            style={{ marginTop: "1.5rem" }}
                        >
                            Your Order
                        </h6>

                        <div className="order-details-body">
                            <Grid
                                columns={12}
                                gutter="lg"
                                justify="space-between"
                                grow
                                style={{
                                    textAlign: "center",
                                    margin: "1em",
                                    fontWeight: "bold"
                                }}
                            >
                                <Col span={6}>Product</Col>
                                <Col span={6}>Total</Col>
                            </Grid>

                            <Grid
                                columns={12}
                                justify="space-between"
                                style={{
                                    textAlign: "center"
                                }}
                            >
                                <Col span={6}>A Toast of life x1</Col>
                                <Col span={6}>N10</Col>
                                <Col span={6}>A Toast of life x1</Col>
                                <Col span={6}>N10</Col>
                            </Grid>

                            <Divider />

                            <Grid
                                columns={12}
                                justify="space-between"
                                style={{
                                    textAlign: "center",
                                    marginTop: ".5em",
                                    marginBottom: ".5em"
                                }}
                            >
                                <Col span={6} style={{ fontWeight: "bold" }}>
                                    CART SUBTOTAL
                                </Col>
                                <Col span={6}>N20</Col>
                            </Grid>

                            <Divider />

                            <Grid
                                columns={12}
                                justify="space-between"
                                style={{
                                    textAlign: "center",
                                    marginTop: ".5em",
                                    marginBottom: ".5em"
                                }}
                            >
                                <Col span={6} style={{ fontWeight: "bold" }}>
                                    SHIPPING
                                </Col>
                                <Col span={6}>free shipping</Col>
                            </Grid>
                            <Divider />
                            <Grid
                                columns={12}
                                justify="space-between"
                                style={{
                                    textAlign: "center",
                                    marginTop: ".5em",
                                    marginBottom: ".5em"
                                }}
                            >
                                <Col span={6} style={{ fontWeight: "bold" }}>
                                    ORDER TOTAL
                                </Col>
                                <Col span={6}>N120</Col>
                            </Grid>

                            <RadioGroup
                                label="Select your preferred payment method"
                                color="violet"
                                variant="vertical"
                                required
                            >
                                <Radio value="paypal">PayPal</Radio>
                                <Radio value="paystack">Paystack</Radio>
                                <Radio value="flutterwave">Flutterwave</Radio>
                            </RadioGroup>

                            <Checkbox
                                label="I have read and accept the terms and conditions"
                                color="violet"
                            />
                            <div className="text-center align-self-center">
                                <Button color={"green"}>
                                    Proceed to Payment
                                </Button>
                            </div>
                        </div>
                    </Paper>
                </div>
            </div>
        </>
    );
};

export default CheckoutForm;
