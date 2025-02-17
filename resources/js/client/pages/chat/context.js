import React, { createContext } from "react";

const ChatContext = createContext();
export const PageContext = createContext();
export const JobContext = createContext();
ChatContext.displayName = "VicommaChatContext";

export default ChatContext;
