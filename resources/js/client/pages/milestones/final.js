/**
 * External Dependencies
 */
 import React, { Suspense, useEffect, useState, lazy, StrictMode } from "react";
 import { render } from "react-dom";
 import {
     Paper,
     Divider,
     Box,
     Grid,
     Col,
     Button,
     TextInput,
     NumberInput,
 } from "@mantine/core";
 // import Box from "@mui/material/Box";
 /**
  * Internal Dependencies
  *
  */
 import ImageStore from "../../assets/image";
 import Icon from "../../icons";
 import { PUBLIC_KEY } from "../../constant/index";
 
 const Final = ({ jobId }) => {
     const appURL = window.location.origin;
     const [loadPaymentModal, setLoadPaymentModal] = useState(false);
     const [amount, setAmount] = useState(0);
     const [description, setDescription] = useState("Final Payment");
     const [subaccount, setSubaccount] = useState(0);
     const [uniqueId, setUniqueId] = useState("");
 
     const getMilestone = () => {
         const { mstone, jobid, subaccount } = JSON.parse(
             localStorage.getItem("final_m_data")
         );
         setAmount(parseInt(mstone));
         setSubaccount(subaccount);
     };
 
     const getJobUniqueId = () => {
         axios
             .get("/job/unique/" + jobId)
             .then((response) => setUniqueId(response.data.id));
     };
 
     useEffect(() => {
         getMilestone();
         getJobUniqueId();
     }, []);
 
     useEffect(() => {
         if (loadPaymentModal) {
             const updatePaymentMilestone25 = (setStuff) => {
                 const config = {
                     id: jobid,
                     paymentMilestone: 2,
                 };
 
                 axios
                     .post(updaccess, config, {
                         headers: {
                             "Content-Type": "application/json",
                             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                 "content"
                             ),
                         },
                     })
                     .then((response) => {
                         console.log(response.data);
                         if (response.data.message == "saved") {
                             setStuff(response.data.job.unique_id);
                         }
                     })
                     .catch((error) => console.log(error));
             };
 
             let px = FlutterwaveCheckout({
                 public_key: PUBLIC_KEY,
                 tx_ref: "VC-" + Date.now() + "-" + Math.random(),
                 amount: 100, //remove  5 on test mode removal
                 currency: "NGN",
                 country: "US",
                 payment_options:
                     "card,ussd,qr,barter,mobilemoneyghana,mobilemoneyrwanda,banktransfer,paypal",
                 // specified redirect URL
                 subaccounts: [{ id: subaccount }],
                 meta: {
                     consumer_id: 23,
                     consumer_mac: "92a3-912ba-1192a",
                 },
                 customer: {
                     email: "cornelius@gmail.com",
                     phone_number: "08102909304",
                     name: "Test Subject",
                 },
                 callback: function (data) {
                     if (data.status === "successful") {
                         // make a post request
                         // update jobs table to show that initial payment has been made
                         updatePaymentMilestone25(setUniqueId);
                         window.location.protocol = "https:";
                         window.location.href = `/jobs/details/${uniqueId}/?tx-ref=${data.tx_ref}`;
                         // window.location.href =
                         //     `/jobs/details/${uniqueId}/?actor=vendor&jobid=` +
                         //     jobid +
                         //     "&payment-status=successful";
                         px.close();
                     } else {
                         location.reload();
                     }
                 },
                 onclose: function () {
                     setLoadPaymentModal(false);
                 },
                 customizations: {
                     title: `Payment for job #${jobId}`,
                     description: description,
                     logo: "https://vicomma-stagingrevamp.herokuapp.com/img/sidebarlogo.png",
                 },
             });
 
             // finalPaymentCompleted();
             // window.location.protocol = "http:";
             // window.location.href = `/jobs/details/${uniqueId}/?tx-ref=${data.tx_ref}`;
             // setLoadPaymentModal(false);
         }
     }, [loadPaymentModal]);
     return (
         <div>
             <h1 className="pirple-font">Milestone & Payments</h1>
             <p style={{ fontSize: "1.3rem", paddingTop: "1em" }}>
                 You're protected By{" "}
                 <span className="pirple-font">Vicomma Payment Protection</span>.
                 Only pay for the work you authorize.
             </p>
 
             <Paper shadow="md" radius="md">
                 <img src={ImageStore.banner} alt={"banner"} loading="lazy" />
             </Paper>
 
             <h3 className="pirple-font" style={{ paddingTop: "1em" }}>
                 Payment Option{" "}
                 <span>
                     <img src={Icon.question} alt="help" />
                 </span>
             </h3>
 
             <Divider color="green" size="xl" />
 
             <Paper
                 style={{
                     borderTop: "2em",
                     paddingTop: "1em",
                     padding: "1em",
                     backgroundColor: "#F7FBF2",
                 }}
                 withBorder
             >
                 <Grid>
                     <Col className="text-right" span={12}>
                         <span style={{ color: "#95C952", fontSize: "1.5rem" }}>
                             {amount}.00
                         </span>
                     </Col>
                     <Col span={12}>
                         <h4>Fixed - Price</h4>
                         <p style={{ color: "#95C952", fontSize: "1rem" }}>
                             Pay as project milestones are completed.
                         </p>
                     </Col>
                     <Col span={12}>
                         <h4>Pay a fixed price for your project</h4>
                         <p style={{ color: "#95C952", fontSize: "1rem" }}>
                             This is the price you and Elmer have agreed upon
                         </p>
                     </Col>
                 </Grid>
             </Paper>
 
             <h3 className="pirple-font mt-4">Project Milestones</h3>
 
             <p>
                 Add project milestones and paying installments as each
                 milestones is completed to your satisfaction.
             </p>
 
             <Grid style={{ marginBottom: "2em" }}>
                 <Col span={5}>
                     <TextInput
                         placeholder="Initial/Final payment for release of my project"
                         label="Payment Description"
                         size="md"
                         value={description}
                         readOnly
                         required
                     />
                 </Col>
 
                 <Col span={3}>
                     <NumberInput
                         placeholder="Amount"
                         label="Payment Amount"
                         size="md"
                         value={amount}
                         readOnly
                         required
                     />
                 </Col>
 
                 <Col span={4} style={{ paddingTop: "2em" }}>
                     <Button
                         color="green"
                         size="md"
                         onClick={() => setLoadPaymentModal(true)}
                     >
                         Pay Now
                     </Button>
                 </Col>
             </Grid>
         </div>
     );
 };
 
 if (document.querySelector("#final-payment") != undefined) {
     const jobId = document.querySelector("#final-payment").getAttribute("job");
 
     render(
         <StrictMode>
             <Final jobId={jobId} />
         </StrictMode>,
         document.querySelector("#final-payment")
     );
 }