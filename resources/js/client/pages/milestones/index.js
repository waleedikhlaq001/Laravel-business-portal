/**
 * External Dependencies
 */
 import React, { Suspense, useEffect, useState, lazy } from "react";
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
     Modal,
 } from "@mantine/core";
 import { useClipboard } from "@mantine/hooks";
 // import Box from "@mui/material/Box";
 /**
  * Internal Dependencies
  *
  */
 import ImageStore from "../../assets/image";
 import Icon from "../../icons";
 import CountDownTimer from "./CountDownTimer";
 import ModalDefault from "../../components/Modal";
 import { PUBLIC_KEY } from "../../constant/index";
 import axios from "axios";
 const Milestone = () => {
     const [loadPaymentModal, setLoadPaymentModal] = useState(false);
     const [jobId, setJobId] = useState("");
     const [subaccount, setSubaccount] = useState(0);
     const [influencerName, setInfluencerName] = useState("Elmer");
     const [amount, setAmount] = useState(0);
     const [description, setDescription] = useState("Initial Payment");
     const [opened, setOpened] = useState(false);
     const [tokenOpened, setTokenOpened] = useState(false);
     const [jobIdMain, setJobIdMain] = useState(jobid);
     const [uniqueId, setUniqueId] = useState("");
     // const [paymentParams, setPaymentParams] = useState(new URLSearchParams(window.location.search))
     const [videoToken, setVideoToken] = useState(undefined);
     const clipboard = useClipboard({ timeout: 500 });
     const getMilestone = () => {
         const { mstone, jobid, subaccount } = JSON.parse(
             localStorage.getItem("m_data")
         );
         setAmount(parseInt(mstone));
         setJobId(jobid);
         setSubaccount(subaccount);
     };
 
     // const setCodeModal = () => {
     //     fetch("/jobs/" + jobid + "/generateToken")
     //         .then((res) => res.json())
     //         .then((data) => {
     //             console.log(data);
     //             setVideoToken(data.data);
     //         });
     // };
 
     const getJobUniqueId = () => {
         axios
             .get("/job/unique/" + jobid)
             .then((response) => setUniqueId(response.data.id));
     };
 
     const hoursMinSecs = { hours: 0, minutes: 1, seconds: 2 };
 
     //update job payment milestone column on jobs table to show vendor has made final payment
     const updatePaymentMilestone = () => {
         const config = {
             id: jobid,
             paymentMilestone: 1, // initial payment made
         };
         axios
             .post("/job/update/payment-milestone", config, {
                 headers: {
                     "Content-Type": "application/json",
                     "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                         "content"
                     ),
                 },
             })
             .then((response) => {
                 console.log(response.data);
                 setUniqueId(response.data.unique_id);
             })
             .catch((error) => console.log(error));
     };
 
     useEffect(() => {
         getMilestone();
         getJobUniqueId();
     }, []);
 
     useEffect(() => {
         if (loadPaymentModal) {
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
                     console.log(data);
                     if (data.status === "successful") {
                         //confirm payment is successful via API
                         // setLoadPaymentModal(false);
                         // $("#exampleModalCenter").removeClass("show");
                         // setTokenOpened(true);
                         // $("#cvToken").modal("show");
 
                         // make a post request
                         // update jobs table to show that initial payment has been made
                         updatePaymentMilestone();
                         // setCodeModal();
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
 
             setLoadPaymentModal(false);
         }
     }, [loadPaymentModal, mstone]);
 
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
                             $ {amount}.00
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
                             {`
                             This is the price you and ${influencerName} have
                             agreed upon `}
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
                         placeholder="Initial payment for release of my project"
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
                         hideControls
                         required
                     />
                 </Col>
 
                 <Col span={4} style={{ paddingTop: "2em" }}>
                     <Button
                         color="green"
                         size="md"
                         // onClick={() => setLoadPaymentModal(true)}
                         // onClick={() => setOpened(true)}
                         data-toggle="modal"
                         data-target="#exampleModalCenter"
                     >
                         Deposit
                     </Button>
                 </Col>
             </Grid>
 
             <ModalDefault
                 id="exampleModalCenter"
                 title="Deposit Breakdown"
                 action={
                     <div>
                         <button
                             className="btn btn-secondary"
                             onClick={() => setLoadPaymentModal(true)}
                         >
                             {" "}
                             Deposit your Escrow{" "}
                         </button>
                     </div>
                 }
             >
                 <h6>Here is how your deposit breaks down...</h6>
                 <p style={{ fontSize: "14px" }}>
                     Platform posting fee ( vicomma ): $10.00
                 </p>
                 <p style={{ fontSize: "14px" }}>
                     Flutterwave transaction fee: $10.00
                 </p>
                 <p style={{ fontSize: "14px" }}>
                     Total Deposit (to escrow ) : $10.00
                 </p>
             </ModalDefault>
 
             <ModalDefault
                 id="cvToken"
                 title="Content View Token"
                 action={
                     <div
                         style={{
                             display: "flex",
                             flexDirection: "row",
                             gap: "2em",
                         }}
                     >
                         <button
                             className="btn btn-outline-primary"
                             color={clipboard.copied ? "teal" : "blue"}
                             onClick={() => clipboard.copy(videoToken)}
                         >
                             {clipboard.copied ? "Copied" : "Copy Token"}
                         </button>
                         <button
                             className="btn btn-secondary"
                             onClick={() => {
                                 window.location.protocol = "https:";
                                 window.location.href =
                                     window.location.origin +
                                     "/video/review/?actor=vendor&jobid=" +
                                     jobid;
                             }}
                         >
                             View Your Content
                         </button>
                     </div>
                 }
             >
                 <p style={{ fontSize: "14px" }}>
                     Below is the token for you to view your initial content.
                     Copy your token to view
                 </p>
                 <p style={{ fontSize: "14px" }}> your content.</p>
 
                 <p className="pt-4" style={{ fontSize: "10px" }}>
                     Token:{" "}
                     <span style={{ color: "#6F3C96" }}>{videoToken}</span>
                 </p>
 
                 {tokenOpened && (
                     <CountDownTimer hoursMinSecs={hoursMinSecs} jobId={jobId} />
                 )}
             </ModalDefault>
 
             {/* <Modal
                 opened={tokenOpened}
                 onClose={() => setTokenOpened(false)}
                 title="Video Token"
                 style={{ marginTop: "15em" }}
             >
                 <div>{videoToken}</div>
                 <CountDownTimer hoursMinSecs={hoursMinSecs} />
                 <Button
                     color={clipboard.copied ? "teal" : "blue"}
                     onClick={() => clipboard.copy(videoToken)}
                     loaderPosition="right"
                 >
                     {clipboard.copied ? "Copied" : "Copy"}
                 </Button>
                 <Button
                     color={"blue"}
                     onClick={() => {
                         window.location.protocol = "https:";
                         window.location.href =
                             window.location.origin +
                             "/video/review/?actor=vendor&jobid=" +
                             jobid;
                     }}
                     loaderPosition="right"
                 >
                     check video
                 </Button>
             </Modal> */}
         </div>
     );
 };
 
 if (document.querySelector("#milestone-module") != undefined) {
     render(<Milestone />, document.querySelector("#milestone-module"));
 }
 
 if (document.querySelector("#final-milestone") != undefined) {
     render(<Milestone />, document.querySelector("#milestone-module"));
 }