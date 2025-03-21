const wordText = document.querySelector(".sufflewords"); // The shuffled word display
const hintText = document.querySelector(".hint span"); // The hint text
const inputField = document.querySelector(".input"); // Input field for user answer
const refreshBtn = document.querySelector(".refesh_BTN"); // Refresh button (New Word)
const checkBtn = document.querySelector(".check_BTN"); // Check Answer button
const timerText = document.querySelector(".timer"); // Timer display
const messageBox = document.querySelector(".message-box"); // Message box for feedback
const messageText = document.querySelector(".message-text"); // Text inside message box
const scoreText = document.querySelector("#score"); // Score display
const livesText = document.querySelector("#lives"); // Lives count display
const gameOverBox = document.querySelector(".game-over"); // Game over screen
const bananaGameBox = document.querySelector(".banana-game");
const finalScoreText = document.querySelector("#final-score"); // Final score display

// Declaring game variables
let CorrectWord;
let score = 0; // Player's score
let lives = 3; // Player's total lives
let timer;
let isGameInitialized = false; // Prevents the game from restarting multiple times

// Function to Start Timer
const startTimer = (timeLimit) => {
    console.log("Starting new timer...");
    let timeLeft = timeLimit;
    timerText.innerHTML = `⏳ ${timeLeft}s`; // Display remaining time

    // Start countdown
    timer = setInterval(() => {
        timeLeft--;
        timerText.innerHTML = `⏳ ${timeLeft}s`; // Update timer display

        // If time runs out, stop timer, show message, and remove a life
        if (timeLeft <= 0) {
            clearInterval(timer);
            showMessage("⏳ Time's Up!", "red");
            loseLife();
            setTimeout(initGame, 2000); // Automatically load next word
        }
    }, 1000);
};

// Function to Initialize the Game (Set up a new word)
const initGame = () => {
    if (lives <= 0 || isGameInitialized) return; // Prevents restarting if game is over

    isGameInitialized = true; // Prevents multiple game starts at once
    console.log("Initializing game...");
    
    gameOverBox.style.display = "none"; // Hide game over screen when game starts
    bananaGameBox.style.display = "none"; // Hide game over screen when game starts
    clearInterval(timer); // Stop any previous timer
    inputField.value = ""; // Clear input field
    inputField.focus(); // Focus on input field for better UX

    // Select a random word from the word list
    let randomObj = words[Math.floor(Math.random() * words.length)];
    let wordArray = randomObj.word.split(""); // Convert word into an array of letters

    // Shuffle the letters randomly
    for (let i = wordArray.length - 1; i > 0; i--) {
        let j = Math.floor(Math.random() * (i + 1));
        [wordArray[i], wordArray[j]] = [wordArray[j], wordArray[i]];
    }

    // Display shuffled word and hint
    wordText.innerHTML = wordArray.join(" ").toUpperCase();
    hintText.innerHTML = randomObj.hint;
    CorrectWord = randomObj.word.toLowerCase();

    startTimer(20); // Start countdown timer

    // Reset game initialization flag after a short delay
    setTimeout(() => {
        isGameInitialized = false;
    }, 100);
};

// Function to Check the User's Answer
const checkWord = () => {
    let userWord = inputField.value.toLowerCase(); // Get input value
    clearInterval(timer); // Stop timer

    // If input is empty, show warning message
    if (!userWord) {
        showMessage("⚠️ Please enter a word!", "orange");
        return;
    }

    // If user answer is correct, increase score, otherwise remove a life
    if (userWord === CorrectWord) {
        score += 10;
        scoreText.innerHTML = score;
        showMessage(`🎉 Correct! +10 points`, "green");
    } else {
        loseLife();
        showMessage(`❌ Wrong! The word was: ${CorrectWord}`, "red");
    }

    // Load next word after 2 seconds
    setTimeout(initGame, 2000);
};

const askToPlayBananaGame = () => {
    console.log("Asked to Play Banana triggered"); // Debugging
    bananaGameBox.style.display = "flex"; // Show the modal

    modal.innerHTML = `
        <div class="modal-content">
            <img src="../../assets/images/monkey-thinking.png" style="width: 150px;">
            <h2>❓ Want Another Chance?</h2>
            <p>Play the Banana Game to earn an extra life!</p>
            <button onclick="playBananaGame()">🍌 Play</button>
            <button onclick="gameOver()">❌ No, End Game</button>
        </div>
    `;
    document.body.appendChild(modal);
};

window.onload = () => {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('bonusLife')) {
        lives = 1;
        livesText.innerHTML = lives;
        score = parseInt(urlParams.get('score'));
        scoreText.innerHTML = score;
        initGame();
    }
};

// Function to Reduce Lives When Answer is Wrong
const loseLife = () => {
    if (lives <= 0) return; // Prevents running multiple times
    lives--;
    livesText.innerHTML = lives;

    if (lives <= 0) {
        askToPlayBananaGame();
    } else {
        setTimeout(initGame, 2000); // Only load next word if lives remain
    }
};

// Function to Handle Game Over
const gameOver = () => {
    console.log("Game Over triggered"); // Debugging
    clearInterval(timer);
    gameOverBox.style.display = "flex"; // Ensure visibility
    finalScoreText.innerHTML = score;

    refreshBtn.disabled = true;
    checkBtn.disabled = true;

    gameOverBox.innerHTML = `
        <img src="../../assets/images/monkey-crying.png" style="width: 150px;">
        <h1>💀 Game Over!</h1>
        <p class="mt-1">Your Final Score: <span>${score}</span></p>
        <button onclick="restartGame()" class="btn btn-primary mt-3">Restart Game</button>
        <a href="../../views/game/home.php" class="btn btn-red mt-2">Exit</a>
    `;

    fetch("../../controllers/updateScore.php", {
        method: "POST",
        body: new URLSearchParams({ score }),
        headers: { "Content-Type": "application/x-www-form-urlencoded" }
    })
    .then(response => response.json())
    .then(data => console.log(data.message));
};


// Function to Restart the Game
const restartGame = () => {
    lives = 3; // Reset lives
    score = 0; // Reset score
    livesText.innerHTML = lives;
    scoreText.innerHTML = score;
    refreshBtn.disabled = false;
    checkBtn.disabled = false;
    gameOverBox.style.display = "none"; // Hide game over screen
    initGame(); // Restart game
};

// Function to Show Messages in the Game (Success/Fail)
const showMessage = (message, color) => {
    messageBox.style.display = "block";
    messageBox.style.backgroundColor = color;
    messageText.innerHTML = message;
    setTimeout(() => messageBox.style.display = "none", 2000);
};

// Deduct a Life When Player Refreshes Word
refreshBtn.addEventListener("click", () => {
    clearInterval(timer); // Stop timer
    loseLife(); // Reduce a life
    initGame(); // Start a new word
});

// Event Listener for "Check Word" Button
checkBtn.addEventListener("click", checkWord);

// Start Game on Input Focus (If Game is Not Over)
inputField.addEventListener("focus", () => {
    if (lives > 0) {
        clearInterval(timer);
        initGame();
    }
});

// Allow Enter Key to Submit Answer
inputField.addEventListener("keydown", (event) => {
    if (event.key === "Enter") {
        clearInterval(timer);
        checkBtn.click(); // Simulate "Check Word" button click
    }
});

// Start Game Immediately
initGame();
