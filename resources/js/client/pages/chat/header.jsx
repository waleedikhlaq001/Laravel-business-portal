import React from "react";
import phone from "./phone.svg";
import closeSvg from "./close.svg";
import settings from "./settings.svg";
import ChatContext from "./context";
const Header = () => {
    const vendor = "AppifYou";
    return (
        <ChatContext.Consumer>
            {({ close, setClose }) => (
                <div className="chat-header">
                    <div className="chat-header-title">{vendor}</div>
                    <div className="chat-header-actions">
                        <div className="header-actions">
                            <img src={phone} alt="call" />
                            <img src={settings} alt="settings" />
                            <img
                                src={closeSvg}
                                alt="close"
                                onClick={() => setClose(!close)}
                            />
                        </div>
                    </div>
                </div>
            )}
        </ChatContext.Consumer>
    );
};

export default Header;
