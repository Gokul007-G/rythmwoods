<script>
  const receiverId = 2; // example receiver, dynamically set this

  function loadMessages() {
    fetch("get_message.php?user_id=" + receiverId)
      .then(res => res.json())
      .then(data => {
        let messages = '';
        data.forEach(msg => {
          const isMe = msg.sender_id == <?= $_SESSION['user_id'] ?>;
          messages += `<div class="message ${isMe ? 'me' : 'you'}">${msg.message}</div>`;
        });
        document.querySelector(".messages").innerHTML = messages;
      });
  }

  document.querySelector(".message-form").addEventListener("submit", function(e) {
    e.preventDefault();
    const input = document.querySelector("input[name='message']");
    fetch("send_message.php", {
      method: "POST",
      body: new URLSearchParams({
        message: input.value,
        receiver_id: receiverId
      })
    }).then(() => {
      input.value = '';
      loadMessages();
    });
  });

  setInterval(loadMessages, 2000);
</script>