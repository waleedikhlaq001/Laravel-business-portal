import React from "react";

import { Avatar } from "@mantine/core";

import styles from "./css/index.module.css";

const Action = ({ actions }) => {
    return (
        <div className={styles.messageaction}>
            <div className={styles.actionProfile}>
                <Avatar src={null} radius="xl" alt="no image here" />
                <span className={styles.profileName}>Ola</span>
            </div>

            {actions}

            <div className={styles.dateTime}>{new Date().toLocaleString()}</div>
        </div>
    );
};

const MessageText = ({ text }) => {
    return (
        <div className={styles.messagetext}>
            <div>{text}</div>
        </div>
    );
};
const Message = ({ width, text, actions }) => {
    const wid = width || "100%";
    const txt = text || "This should be the message text";
    return (
        <div>
            <div style={{ display: "flex", flexDirection: "column" }}>
                <div>
                    <Action actions={actions} />
                    <MessageText text={txt} />
                </div>
            </div>
        </div>
    );
};

export default Message;
