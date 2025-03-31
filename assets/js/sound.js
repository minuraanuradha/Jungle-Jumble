const basePath = window.location.origin + "/uob/Jungle-Jumble/assets/sounds/";
const clickSound = new Audio(basePath + "click.mp3");  // General button clicks
const navigateSound = new Audio(basePath + "navigate.mp3");  // Navigation buttons
const errorSound = new Audio(basePath + "error.mp3");  // Error sounds

// Function to play a sound
function playSound(sound) {
    if (localStorage.getItem("muteSounds") !== "true") {
        sound.currentTime = 0; // Restart sound from the beginning
        sound.play();
    }
}

// Function for navigation buttons (delays navigation slightly)
function handleNavigation(event) {
    event.preventDefault(); // Stop instant navigation
    playSound(navigateSound);

    // Get the URL and navigate after the sound finishes
    setTimeout(() => {
        window.location.href = event.target.href;
    }, 300); // Delay allows sound to play before navigating
}

// Function to toggle sound effects
function toggleSounds() {
    const isMuted = localStorage.getItem("muteSounds") === "true";
    localStorage.setItem("muteSounds", !isMuted);
    document.getElementById("toggle-sounds").classList.toggle("active", !isMuted);
}

// Ensure settings persist when page loads
document.addEventListener("DOMContentLoaded", () => {
    // Apply sound settings
    const soundToggleButton = document.getElementById("toggle-sounds");
    if (soundToggleButton) {
        soundToggleButton.classList.toggle("active", localStorage.getItem("muteSounds") === "true");
        soundToggleButton.addEventListener("click", toggleSounds);
    }

    // Apply sounds to buttons
    document.querySelectorAll(".btn-nav").forEach(button => {
        button.addEventListener("click", handleNavigation);
    });

    document.querySelectorAll(".btn-click").forEach(button => {
        button.addEventListener("click", () => playSound(clickSound));
    });

    document.querySelectorAll(".btn-error").forEach(button => {
        button.addEventListener("click", () => playSound(errorSound));
    });
});
