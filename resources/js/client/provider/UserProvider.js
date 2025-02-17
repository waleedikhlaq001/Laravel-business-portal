import React, { useEffect, useState } from "react";

import UserContext from "../context/user-context";

const UserProvider = ({ children }) => {
    const [loggedIn, setLoggedIn] = useState(false);
    const [names, setNames] = useState("Guest User");
    const [email, setEmail] = useState("");
    const [dispute, setDispute] = useState({});
    const [user_id, setUserId] = useState("");

    const getUser = async () => {
        const response = await fetch("/api/user");
        const data = await response.json();
        if (data.user) {
            setLoggedIn(true);
            setNames(data.user.name);
            setEmail(data.user.email);
            setUserId(data.user.user_id);
        }
    };

    useEffect(() => {
        getUser();
        if (loggedIn) {
            setName(names);
            setDispute(dispute);
        } else {
            window.location.href = `${window.location.origin}/login`;
        }
    }, []);

    const values = {
        names,
        dispute,
        loggedIn,
    };
    return (
        <UserContext.Provider value={values}>{children}</UserContext.Provider>
    );
};

export default UserProvider;
