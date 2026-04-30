<?php
/**
 * VastraVaani Chatbot Widget - Embedded Version
 * Connects to FastAPI backend on port 8081
 */
?>
<style>
/* ── Embedded Chat Container ── */
.embedded-chat-container {
    display: flex;
    flex-direction: column;
    flex: 1;
    min-height: 0;
    height: 650px;
    max-height: 650px;
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    font-family: 'Inter', 'Poppins', sans-serif;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #f0f0f0;
}

/* ── Chat Header ── */
.chat-header {
    background: #fff;
    padding: 12px 15px;
    border-bottom: 1px solid #eee;
    display: flex;
    align-items: center;
    gap: 12px;
    height: 65px;
    box-sizing: border-box;
}

.chat-header img {
    width: auto !important;
    height: 40px !important;
    max-width: 120px !important;
    object-fit: contain !important;
    border-radius: 4px !important;
    background: transparent !important;
    margin: 0 !important;
}

.chat-header .header-info {
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.chat-header h3 {
    margin: 0 !important;
    font-size: 16px !important;
    color: #4a3728 !important;
    font-weight: 600 !important;
    line-height: 1.2 !important;
}

.chat-header span {
    font-size: 11px !important;
    color: #27ae60 !important;
    display: flex !important;
    align-items: center !important;
    gap: 4px !important;
    margin-top: 2px !important;
}

.chat-header span::before {
    content: '';
    width: 6px;
    height: 6px;
    background: #27ae60;
    border-radius: 50%;
}

/* ── Messages Area ── */
#chat-messages {
    flex: 1;
    padding: 15px;
    overflow-y: auto;
    background: #fdfcfb;
    display: flex;
    flex-direction: column;
    gap: 15px;
}

/* ── Message Wrapper for Avatars ── */
.message-wrapper {
    display: flex;
    gap: 10px;
    max-width: 90%;
    align-items: flex-start;
}

.message-wrapper.bot {
    align-self: flex-start;
}

.message-wrapper.user {
    align-self: flex-end;
    flex-direction: row-reverse;
}

.bot-avatar {
    width: 35px !important;
    height: 35px !important;
    border-radius: 50% !important;
    flex-shrink: 0 !important;
    border: 1px solid #f0e6d6 !important;
    background: #fff !important;
    object-fit: contain !important;
    padding: 2px !important;
    margin: 0 !important;
    display: block !important;
}

.message {
    padding: 10px 14px;
    border-radius: 12px;
    font-size: 13.5px;
    line-height: 1.4;
    position: relative;
}

.message.bot {
    background: #fff;
    color: #333;
    border: 1px solid #f0e6d6;
    border-top-left-radius: 2px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.02);
}

.message.user {
    background: #b38b59;
    color: white;
    border-top-right-radius: 2px;
    box-shadow: 0 2px 10px rgba(179, 139, 89, 0.2);
}

.message img {
    max-width: 100% !important;
    height: auto !important;
    border-radius: 6px !important;
    margin-top: 8px !important;
    display: block !important;
}


/* ── Input Area ── */
.chat-input-area {
    padding: 15px;
    background: #fff;
    display: flex;
    gap: 8px;
    border-top: 1px solid #eee;
}

#chat-input {
    flex: 1;
    border: 1px solid #e0e0e0;
    border-radius: 24px;
    padding: 10px 18px;
    font-size: 13px;
    outline: none;
    transition: all 0.3s;
    background: #f9f9f9;
}

#chat-input:focus {
    border-color: #b38b59;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(179, 139, 89, 0.1);
}

#chat-send {
    background: #b38b59;
    color: white;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
}

#chat-send:hover {
    background: #9a7548;
    transform: scale(1.05);
}

/* ── Horizontal Image Row ── */
.image-row {
    display: flex;
    gap: 10px;
    overflow-x: auto;
    padding: 5px 0;
}

/* ── Typing Indicator ── */
.typing {
    padding: 0 15px 10px;
    font-size: 11px;
    color: #999;
    font-style: italic;
    display: none;
}

/* Scrollbar styling */
#chat-messages::-webkit-scrollbar {
    width: 4px;
}
#chat-messages::-webkit-scrollbar-thumb {
    background: #e0e0e0;
    border-radius: 2px;
}

.image-row::-webkit-scrollbar {
    height: 4px;
}
.image-row::-webkit-scrollbar-thumb {
    background: #e0e0e0;
    border-radius: 2px;
}

/* each image */
.image-item {
    flex: 0 0 auto;
    width: 140px;
}

.image-item img {
    width: 100%;
    border-radius: 6px;
    border: 1px solid #eee;
}

/* description */
.img-desc {
    font-size: 10px;
    color: #666;
    margin-top: 4px;
    line-height: 1.2;
}
</style>

<div class="embedded-chat-container">
    <div class="chat-header">
        <img src="assets/images/vastraVani.jpg" alt="VastraVaani Logo">
        <div class="header-info">
            <h3>VastraVaani</h3>
            <span>Online | AI Expert</span>
        </div>
    </div>

    <div id="chat-messages">
        <!-- Initial Message -->
        <div class="message-wrapper bot">
            <img src="assets/images/vastraVani.jpg" class="bot-avatar" alt="VV">
            <div class="message bot">
                Namaste! I am <strong>VastraVaani</strong>, your AI assistant. How can I help you explore our textile heritage today?
            </div>
        </div>
    </div>

    <div class="typing" id="typing-indicator">VastraVaani is thinking...</div>

    <form class="chat-input-area" onsubmit="sendMessage(event)">
        <input type="text" id="chat-input" placeholder="Ask about Indian textiles..." autocomplete="off">
        <button type="submit" id="chat-send">
            <i class="fas fa-paper-plane"></i>
        </button>
    </form>
</div>

<script>
const CHAT_API = 'http://localhost:8081/chat';

async function sendMessage(e) {
    e.preventDefault();
    const input = document.getElementById('chat-input');
    const text = input.value.trim();
    if (!text) return;

    addMessage(text, 'user');
    input.value = '';

    const typing = document.getElementById('typing-indicator');
    typing.style.display = 'block';
    scrollToBottom();

    try {
        const response = await fetch(CHAT_API, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ query: text, language: "English" })
        });

        const data = await response.json();
        typing.style.display = 'none';

        if (data.answer) {
            addMessage(data.answer, 'bot');
        }

        if (data.images && data.images.length > 0) {
            addImages(data.images);
        }

        if (!data.answer && (!data.images || data.images.length === 0)) {
            addMessage("I'm sorry, I couldn't process that.", 'bot');
        }
    } catch (error) {
        typing.style.display = 'none';
        addMessage("VastraVaani is currently offline. Please check backend connection (Port 8081).", 'bot');
    }
}

function addMessage(text, sender) {
    const container = document.getElementById('chat-messages');
    const lastMsg = container.lastElementChild;
    const isContinuation = sender === 'bot' && lastMsg && lastMsg.classList.contains('bot');
    
    const wrapper = document.createElement('div');
    wrapper.className = `message-wrapper ${sender}`;
    
    if (sender === 'bot') {
        if (!isContinuation) {
            const avatar = document.createElement('img');
            avatar.className = 'bot-avatar';
            avatar.src = 'assets/images/vastraVani.jpg';
            avatar.alt = 'VV';
            wrapper.appendChild(avatar);
        } else {
            const spacer = document.createElement('div');
            spacer.style.width = '35px';
            spacer.style.flexShrink = '0';
            wrapper.appendChild(spacer);
        }
    }
    
    const msgDiv = document.createElement('div');
    msgDiv.className = `message ${sender}`;
    
    let formattedText = text.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
    formattedText = formattedText.replace(/\n/g, '<br>');
    
    msgDiv.innerHTML = formattedText;
    wrapper.appendChild(msgDiv);
    
    container.appendChild(wrapper);
    scrollToBottom();
}

function addImages(images) {
    const container = document.getElementById('chat-messages');
    const lastMsg = container.lastElementChild;
    const isContinuation = lastMsg && lastMsg.classList.contains('bot');

    const wrapper = document.createElement('div');
    wrapper.className = 'message-wrapper bot';
    
    if (!isContinuation) {
        const avatar = document.createElement('img');
        avatar.className = 'bot-avatar';
        avatar.src = 'assets/images/vastraVani.jpg';
        avatar.alt = 'VV';
        wrapper.appendChild(avatar);
    } else {
        // Add a placeholder space to keep alignment with the avatar above
        const spacer = document.createElement('div');
        spacer.style.width = '35px';
        spacer.style.flexShrink = '0';
        wrapper.appendChild(spacer);
    }

    const msgDiv = document.createElement('div');
    msgDiv.className = 'message bot';
    msgDiv.style.maxWidth = '100%';

    const row = document.createElement('div');
    row.className = 'image-row';

    images.forEach(img => {
        const imgWrapper = document.createElement('div');
        imgWrapper.className = 'image-item';

        imgWrapper.innerHTML = `
            <a href="http://localhost:8081${img.url}" target="_blank">
                <img src="http://localhost:8081${img.url}">
            </a>
            ${(img.desc || img.caption || img.description || '') 
                ? `<div class="img-desc">${img.desc || img.caption || img.description}</div>` 
                : ''}
        `;

        row.appendChild(imgWrapper);
    });

    msgDiv.appendChild(row);
    wrapper.appendChild(msgDiv);
    container.appendChild(wrapper);

    scrollToBottom();
}

function scrollToBottom() {
    const container = document.getElementById('chat-messages');
    container.scrollTop = container.scrollHeight;
}
</script>

