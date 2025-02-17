import React from "react";

const Action = ({ text, action }) => {
    return (
        <div className="chat-actions">
            <div className="chat-action-buttons">
                <span>{text}</span>
                {action}
            </div>
        </div>
    );
};

export default Action;
