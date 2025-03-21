document.addEventListener("DOMContentLoaded", function () {
    console.log("Banana Game script loaded!");

    // DOM Elements
    const inputField = document.getElementById("checknum");
    const enterButton = document.querySelector(".checknum_BTN");
    const statusMessage = document.createElement("p");
    statusMessage.style.textAlign = "center";
    statusMessage.style.marginTop = "10px";
    document.querySelector(".right-container").appendChild(statusMessage);

    const questionImageContainer = document.querySelector(".left-container");
    const questionImage = document.createElement("img");
    questionImage.style.maxWidth = "100%";
    questionImage.style.height = "auto";
    questionImageContainer.innerHTML = "";
    questionImageContainer.appendChild(questionImage);

    const timerDisplay = document.querySelector(".timer"); // Timer display element
    const gameOverBox = document.querySelector(".game-over"); // Game over notification
    const finalScoreText = document.querySelector("#final-score"); // Final score display

    let correctAnswer = null; // Correct answer for the current question
    let timer; // Variable to hold the timer interval
    let timeLeft = 20; // Initial time in seconds

    // Retrieve the score from the query parameters
    const urlParams = new URLSearchParams(window.location.search);
    let score = urlParams.has('score') ? parseInt(urlParams.get('score')) : 0;

    // Auto-focus the input field without selecting its content
    inputField.focus();
    inputField.setSelectionRange(inputField.value.length, inputField.value.length); // Move cursor to the end

    // Fetch question from API
    async function fetchQuestion() {
        gameOverBox.style.display = "none"; 
            try {
                const response = await fetch("https://marcconrad.com/uob/banana/api.php");
                const data = await response.json();
                console.log("API Response:", data);
                
                if (data.question && data.solution !== undefined) {
                    correctAnswer = parseInt(data.solution, 10); // Set the correct answer
                    questionImage.src = data.question; // Display the question image
                    console.log("Correct Answer:", correctAnswer);
                    startTimer(); // Start the timer after fetching the question
                }
            } catch (error) {
                console.error("Error fetching question:", error);
                statusMessage.textContent = "Failed to load question.";
                statusMessage.style.color = "red";
            }
    }

    // Check user's answer
    function checkAnswer() {
        let userAnswer = parseInt(inputField.value.trim(), 10); // Get user's input
        if (isNaN(userAnswer)) {
            statusMessage.textContent = "Please enter a valid number.";
            statusMessage.style.color = "orange";
            return;
        }

        if (userAnswer === correctAnswer) {
            statusMessage.textContent = "Correct! You gained an extra life.";
            statusMessage.style.color = "green";
            clearInterval(timer); // Stop the timer
            setTimeout(() => {
                // Pass the score back to the main game with a bonus life
                window.location.href = `game.php?bonusLife=true&score=${score}`;
            }, 1500);
        } else {
            gameOver(); // Show game over notification
        }
    }

    // Start the timer
    function startTimer() {
        timer = setInterval(() => {
            timeLeft--; // Decrease time left
            timerDisplay.textContent = `⏳ ${timeLeft}s`; // Update the timer display

            if (timeLeft <= 0) {
                clearInterval(timer); // Stop the timer
                gameOver(); // Show game over notification
            }
        }, 1000); // Update every second
    }

    // Function to Handle Game Over
    function gameOver() {
        console.log("Game Over triggered"); // Debugging
        clearInterval(timer);
        gameOverBox.style.display = "flex"; // Show game over notification
        finalScoreText.innerHTML = score; // Display final score

        // Send the final score to the server
        fetch("../../controllers/updateScore.php", {
            method: "POST",
            body: new URLSearchParams({ score }),
            headers: { "Content-Type": "application/x-www-form-urlencoded" }
        })
        .then(response => response.json())
        .then(data => console.log(data.message));
    }

    // Function to Restart the Game
    function restartGame() {
        window.location.href = "bananagame.php"; // Reload the Banana Game
    }

    // Event listener for the button
    enterButton.addEventListener("click", checkAnswer);

    // Allow Enter Key to Submit Answer
    inputField.addEventListener("keydown", (event) => {
        if (event.key === "Enter") {
            event.preventDefault(); // Prevent default form submission behavior
            enterButton.click(); // Simulate button click
        }
    });

    // Load question when the game starts
    fetchQuestion();
});