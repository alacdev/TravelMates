<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/chat.css">
</head>
<body>
  <div class="chat-container">
    <!-- Lista de conversaciones -->
    <div class="sidebar">
      <div class="conversation">
        <img src="user1.jpg" alt="User 1" class="avatar">
        <div class="conversation-info">
          <h4>John Doe</h4>
          <p>Último mensaje mbappe...</p>
        </div>
      </div>
      <div class="conversation">
        <img src="user2.jpg" alt="User 2" class="avatar">
        <div class="conversation-info">
          <h4>Jane Smith</h4>
          <p>Hola, ¿cómo estás?</p>
        </div>
      </div>
      <!-- Más conversaciones -->
    </div>

    <!-- Pantalla de chat -->
    <div class="chat-screen">
      <div class="messages">
        <div class="message received">
          <p>¡Hola! ¿Cómo estás?</p>
          <span class="timestamp">10:00 AM</span>
        </div>
        <div class="message sent">
          <p>Bien, ¿y tú?</p>
          <span class="timestamp">10:01 AM</span>
        </div>
      </div>
      <!-- Campo para escribir mensajes -->
      <div class="message-input">
        <input type="text" placeholder="Escribe un mensaje..." />
        <button class="send-btn">Enviar</button>
      </div>
    </div>
  </div>
</body>
</html>
