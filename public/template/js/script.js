document.addEventListener('DOMContentLoaded', function() {
  const chatContainer = document.getElementById('chat-container');
  const chatWidget = document.getElementById('chat-widget');
  const chatToggle = document.getElementById('chat-toggle');
  const chatInput = document.getElementById('chat-input');
  const chatSend = document.getElementById('chat-send');
  const chatMessages = document.getElementById('chat-messages');
  
  let isChatOpen = false;
  
  // Show chat toggle button after page loads
  setTimeout(() => {
    chatToggle.style.opacity = '1';
  }, 1000);
  
  // Toggle chat visibility
  function toggleChat(open) {
    if(open === undefined) {
      open = !isChatOpen;
    }
    
    if(open) {
      chatWidget.classList.add('active');
      isChatOpen = true;
    } else {
      chatWidget.classList.remove('active');
      isChatOpen = false;
    }
  }
  
  // Click on toggle button
  chatToggle.addEventListener('click', function(e) {
    e.stopPropagation();
    toggleChat();
  });
  
  // Click on chat widget - prevent closing
  chatWidget.addEventListener('click', function(e) {
    e.stopPropagation();
  });
  
  // Click anywhere else to close
  document.addEventListener('click', function() {
    if(isChatOpen) {
      toggleChat(false);
    }
  });
  
  // Send message
  function sendMessage() {
    const message = chatInput.value.trim();
    if(message) {
      // Add user message
      addMessage(message, 'user');
      chatInput.value = '';
      
      // Simulate bot response after delay
      setTimeout(() => {
        const responses = [
          "Thanks for your message! Our team will get back to you soon.",
          "That's a great question! Let me connect you with a specialist.",
          "We're happy to help with that. Can you provide more details?",
          "I've noted your inquiry. Is there anything else we can assist with?"
        ];
        const randomResponse = responses[Math.floor(Math.random() * responses.length)];
        addMessage(randomResponse, 'bot');
      }, 1000);
    }
  }
  
  // Add message to chat
  function addMessage(text, sender) {
    const messageDiv = document.createElement('div');
    messageDiv.classList.add('chat-message', sender + '-message');
    
    const contentDiv = document.createElement('div');
    contentDiv.classList.add('message-content');
    contentDiv.textContent = text;
    
    const timeDiv = document.createElement('div');
    timeDiv.classList.add('message-time');
    timeDiv.textContent = getCurrentTime();
    
    messageDiv.appendChild(contentDiv);
    messageDiv.appendChild(timeDiv);
    chatMessages.appendChild(messageDiv);
    
    // Scroll to bottom
    chatMessages.scrollTop = chatMessages.scrollHeight;
  }
  
  // Get current time in HH:MM format
  function getCurrentTime() {
    const now = new Date();
    return now.getHours().toString().padStart(2, '0') + ':' + 
           now.getMinutes().toString().padStart(2, '0');
  }
  
  // Send message on button click
  chatSend.addEventListener('click', sendMessage);
  
  // Send message on Enter key
  chatInput.addEventListener('keypress', function(e) {
    if(e.key === 'Enter') {
      sendMessage();
    }
  });
});