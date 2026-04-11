/**
 * Rythm Message Page JS
 */
document.addEventListener('DOMContentLoaded', function() {
    console.log('Messenger JS Loaded');
    
    const userSearch = document.getElementById('userSearch');
    const userList = document.getElementById('userList');
    const messageForm = document.getElementById('messageForm');
    const messageInput = document.getElementById('messageInput');
    const chatMessages = document.getElementById('chatMessages');

    // Basic Search Filter
    if (userSearch) {
        userSearch.addEventListener('input', function(e) {
            const term = e.target.value.toLowerCase();
            const items = userList.querySelectorAll('.user-item');
            
            items.forEach(item => {
                const name = item.querySelector('.username').textContent.toLowerCase();
                if (name.includes(term)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }

    // Scroll to bottom helper
    function scrollToBottom() {
        const chatMessages = document.getElementById('chatMessages');
        if (chatMessages) {
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
    }

    scrollToBottom();

    // Mock Message Submit (Final version would use AJAX)
    if (messageForm) {
        messageForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const text = messageInput.value.trim();
            if (!text) return;

            appendMessage(text, "sent");

            messageInput.value = "";
            scrollToBottom();

            // future: AJAX send here
        });
    }
});

// Function used in original code
function loadChat(userId, userName, userImg, el) {
    document.getElementById('chatHeaderName').textContent = userName;
    document.getElementById('chatHeaderImg').src = userImg;

    const chatBox = document.getElementById("chatMessages");
    chatBox.innerHTML = "";

    // active state fix
    document.querySelectorAll('.user-item').forEach(item => {
        item.classList.remove('active');
    });

    el.classList.add('active');

    // demo messages
    appendMessage("Hi " + userName + " 👋", "received");
    appendMessage("Hello 😎", "sent");

    scrollToBottom();
}

function appendMessage(message, type) {
    const div = document.createElement("div");
    div.className = `msg ${type}`;
    div.innerText = message;
    document.getElementById("chatMessages").appendChild(div);
}

function scrollToBottom() {
    const chat = document.getElementById("chatMessages");
    chat.scrollTop = chat.scrollHeight;
}


function appendMessage(message, type) {
    let div = document.createElement("div");
    div.classList.add("message", type);
    div.innerText = message;

    document.getElementById("chatMessages").appendChild(div);
}