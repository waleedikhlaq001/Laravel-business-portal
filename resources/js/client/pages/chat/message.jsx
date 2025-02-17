import React from "react";
import moment from "moment";
const Message = ({ message, user, inverse }) => {
    const datePosition = inverse ? "right" : "left";
    return (
        <div className={inverse ? "message-bubble-inverse" : "message-bubble"}>
            <img src={user.avatar} width="49px" height="49px" alt="avatar" />
            <div className="message-info">
                <div className={`message-text text-${datePosition}`}>
                    {message.text}
                </div>
                <span
                    className="message-date"
                    style={{
                        fontSize: "9px",
                        color: "#adadad",
                        float: datePosition,
                    }}
                >
                    {moment(Date.now()).format("LLLL")}
                </span>
            </div>
        </div>
    );
};

export default Message;
