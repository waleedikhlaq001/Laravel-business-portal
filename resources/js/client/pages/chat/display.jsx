import React, { useEffect, useState, useRef } from "react";
import ChatAction from "./chataction";
import Message from "./message";
const MessageDisplay = ({ messages }) => {
    let len = messages.length;
    const data = {
        messages: messages,
        text: "This is where messages would be displayed!",
    };
    const user = {
        avatar: "https://avatars0.githubusercontent.com/u/17098477?s=460&v=4",
    };

    return (
        <div className="chat-messages">
            {" "}
            <div className="messages-container">
                {len == 0 && (
                    <div className="no-messages">No messages available</div>
                )}

                <div
                    className="messages"
                    dangerouslySetInnerHTML={{ __html: messages }}
                />

                {/* {messages.map((message, index) => {
                    return (
                        <Message key={index} message={message} user={user} />
                    );
                })} */}

                {/* <Message message={data} user={user} inverse={false} />
                <Message message={data} user={user} inverse={true} /> */}
            </div>
            <ChatAction />
        </div>
    );
};

export default MessageDisplay;
