import React from "react";

const Modal = ({ id, title, children, action }) => {
    //   const showHideClassName = show ? "modal display-block" : "modal display-none";
    return (
        <div
            className="modal fade"
            id={id}
            tabIndex="-1"
            role="dialog"
            aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true"
        >
            <div className="modal-dialog modal-dialog-centered" role="document">
                <div className="modal-content">
                    <div className="modal-header">
                        <h5
                            className="modal-title pirple-font"
                            id="exampleModalLongTitle"
                        >
                            {title}
                        </h5>
                        <button
                            type="button"
                            className="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div className="modal-body">{children}</div>
                    <div className="modal-footer">{action}</div>
                </div>
            </div>
        </div>
    );
};

export default Modal;
