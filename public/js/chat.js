const chatForm = document.getElementById("chat-box-form");
const chatMessages = document.querySelector(".chat-messages");
const roomName = document.getElementById("project-name");
const userList = document.getElementById("participants");
const inputField = document.getElementById("msg");

// Get username and room from URL or embedded via PHP
// const { username, projectName } = Qs.parse(location.search, {
//     ignoreQueryPrefix: true,
// });

const username = "Olaobaju Abraham";

const projectName = "Graphic Tee";

const socket = io("http://localhost:3000");

// Join chatroom
socket.emit("initiateChat", { username, projectName });

// // Get room and users
// socket.on('participants', ({ projectName, users }) => {
//     outputRoomName(projectName);
//     outputUsers(users);
// });

// Message from server
socket.on("message", message => {
    console.log(message);
    outputMessage(message);

    // Scroll down
    // chatMessages.scrollTop = chatMessages.scrollHeight;
});

// Message submit
chatForm.addEventListener("submit", e => {
    e.preventDefault();

    // Get message text
    let msg = e.target.elements.msg.value;

    msg = msg.trim();

    if (!msg) {
        return false;
    }

    // Emit message to server
    socket.emit("chatMessage", msg);

    // Clear input
    e.target.elements.msg.value = "";
    e.target.elements.msg.focus();
});

// const outputRoomName = (projectName) => {
//     roomName.innerText = projectName;
// }

// const outputUsers = (projectName) => {
//     userList.innerHTML = '';
//     users.forEach((user) => {
//       const li = document.createElement('li');
//       li.innerText = user.username;
//       userList.appendChild(li);
//     });
// }

inputField.addEventListener("keypress", () => {
    socket.emit("typing", username);
});

// Output message to DOM
function outputMessage(message) {
    const li = document.createElement("li");
    li.classList.add("message");
    const p = document.createElement("p");
    p.classList.add("meta");
    p.innerText = message.username;
    p.innerHTML += `<span>${message.time}</span>`;
    li.appendChild(p);
    const para = document.createElement("p");
    para.classList.add("text");
    para.innerText = message.text;
    li.appendChild(para);
    $("#no-messages").hide();
    document.querySelector(".chat-messages").appendChild(li);
}
