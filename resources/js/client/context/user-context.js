import React, { createContext } from "react";

const UserContext = createContext({
    name: "Guest User",
    dispute: {},
    email: "",
    user_id: "",
});

UserContext.displayName = "VicommaAuth";

export default UserContext;
