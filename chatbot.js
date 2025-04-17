document.getElementById("open-chatbot").addEventListener("click", function() {
    document.getElementById("chat-box").style.display = "block";
});

document.getElementById("send-button").addEventListener("click", function() {
    const userInput = document.getElementById("user-input").value;
    if (userInput) {
        addMessage("Vous", userInput);
        document.getElementById("user-input").value = "";
        getBotResponse(userInput);
    }
});

function addMessage(sender, message) {
    const messageElement = document.createElement("div");
    messageElement.classList.add(sender === "Vous" ? "user-message" : "bot-message");
    messageElement.textContent = `${sender}: ${message}`;
    document.getElementById("chat-log").appendChild(messageElement);
}

function getBotResponse(userInput) {
    const botResponse = generateBotResponse(userInput);
    addMessage("Bot", botResponse);
}

function generateBotResponse(userInput) {
    // Exemple de réponses de base
    const responses = {
        "Bonjour": "Bonjour! Comment puis-je vous aider ?",
        "Réservation": "Vous pouvez réserver une destination sur notre page de réservation.",
        "Tunisie": "La Tunisie est un pays magnifique avec une histoire riche et de belles plages.",
        "Aide": "Je suis ici pour vous aider! Dites-moi ce dont vous avez besoin.",
        "default": "Désolé, je n'ai pas compris. Pouvez-vous reformuler ?"
    };

    return responses[userInput] || responses["default"];
}
