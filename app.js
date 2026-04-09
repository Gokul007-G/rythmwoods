document.getElementById("sendMessage").addEventListener("click", function() {
    let message = document.getElementById("messageInput").value;
    let receiver_id = 2; // This should be dynamically set based on the current conversation
    if (message.trim() !== "") {
        sendMessage(receiver_id, message);
    }
});

function sendMessage(receiver_id, message) {
    fetch('send_message.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ receiver_id: receiver_id, message: message })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById("messageInput").value = ''; // Clear the input box
            loadMessages(); // Reload the chat box
        } else {
            alert('Failed to send message');
        }
    });
}

function loadMessages() {
    fetch('load_messages.php')
    .then(response => response.json())
    .then(messages => {
        let chatBox = document.getElementById('chatBox');
        chatBox.innerHTML = ''; // Clear existing messages
        messages.forEach(msg => {
            let msgDiv = document.createElement('div');
            msgDiv.className = 'message';
            msgDiv.innerText = msg.message;
            chatBox.appendChild(msgDiv);
        });
    });
}

loadMessages(); // Load messages when the page loads
