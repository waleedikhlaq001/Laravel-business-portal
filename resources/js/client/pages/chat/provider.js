import React from "react";

import ChatContext from "./context";

const ChatProvider = ({ messages, setMessages, close, setClose, children }) => {
    const values = {
        messages,
        setMessages,
        close,
        setClose,
    };
    return (
        <ChatContext.Provider value={values}>{children}</ChatContext.Provider>
    );
};

export default ChatProvider;
