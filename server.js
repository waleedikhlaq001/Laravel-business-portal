const http = require("http");
const path = require("path");
const express = require("express");
const app = express();
const server = http.createServer(app);

// Set static folder
app.use(express.static(path.join(__dirname, "public")));

const {
    userJoin,
    getCurrentUser,
    userLeave,
    getRoomUsers,
    users
} = require("./Utils/users");
const formatMessage = require("./Utils/messages");
const { getAllJobs } = require("./Utils/projects");

const io = require("socket.io")(server, {
    cors: { origin: "*" }
});

const botName = "Vicommma";

const PORT = process.env.PORT || 3000;

io.on("connection", socket => {
    console.log("new connection");
    socket.on("initiateChat", ({ username, projectName }) => {
        console.log(`${projectName} chat initiated`);
        const user = userJoin(socket.id, username, projectName);
        socket.join(user.projectName);
        // console.log(user);
        // Broadcast when a user connects and is online
        socket.broadcast
            .to(user.projectName)
            .emit(
                "message",
                formatMessage(botName, `${user.username} is online to chat`)
            );
    });

    //listening for typing
    socket.on("typing", data => {
        const user = getCurrentUser(socket.id);
        socket.broadcast
            .to(user.projectName)
            .emit("typing", { message: `${user.username} typing...` });
    });

    // // Send users and room info
    // io.to(user.projectName).emit('participants', {
    //     room: user.projectName,
    //     users: getRoomUsers(user.projectName),
    //     projects: getAllJobs(user.id)
    // });

    // Listen for chatMessage
    socket.on("chatMessage", msg => {
        const user = getCurrentUser(socket.id);
        io.to(user.projectName).emit(
            "message",
            formatMessage(user.username, msg)
        );
    });

    // Runs when client disconnects
    socket.on("disconnect", () => {
        console.log("disconnection");
        const user = userLeave(socket.id);
        socket.broadcast
            .to(user.projectName)
            .emit("message", formatMessage(botName, `${socket.id} is offline`));
        console.log(users);
    });
});

server.listen(PORT, () => {
    console.log(`Socket Server running on PORT: ${PORT}`);
});
