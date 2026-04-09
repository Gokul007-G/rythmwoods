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
            if (text) {
                console.log('Sending message:', text);
                messageInput.value = '';
                // Append logic would go here
            }
        });
    }
});

// Function used in original code
function loadChat(userId, userName, userImg) {
    document.getElementById('chatHeaderName').textContent = userName;
    document.getElementById('chatHeaderImg').src = userImg;
    // AJAX load messages would follow
}
