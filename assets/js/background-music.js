// Set the path to the background music file
const BasePath = "/uob/Jungle-Jumble/assets/sounds/";
const musicFile = "background.mp3";

// Check if background music exists globally (so it doesn't restart on page change)
if (!window.backgroundMusic) {
    window.backgroundMusic = new Audio(BasePath + musicFile);
    window.backgroundMusic.loop = true;
    window.backgroundMusic.volume = localStorage.getItem("volume") || 0.5;
    window.backgroundMusic.muted = localStorage.getItem("musicMuted") === "true";
}

// Function to toggle music on/off
function toggleMusic() {
    const isMuted = window.backgroundMusic.muted;
    window.backgroundMusic.muted = !isMuted;
    localStorage.setItem("musicMuted", !isMuted);
    document.getElementById("toggle-music").classList.toggle("active", !isMuted);
}

// Function to set volume
function updateVolume(value) {
    window.backgroundMusic.volume = value;
    localStorage.setItem("volume", value);
}

// Ensure settings persist when page loads
document.addEventListener("DOMContentLoaded", () => {
    // Auto-play music if it was previously on
    if (!window.backgroundMusic.muted) {
        window.backgroundMusic.play();
    }

    // Apply stored settings to UI
    const toggleMusicButton = document.getElementById("toggle-music");
    if (toggleMusicButton) {
        toggleMusicButton.classList.toggle("active", window.backgroundMusic.muted);
        toggleMusicButton.addEventListener("click", toggleMusic);
    }

    const volumeSlider = document.getElementById("volume-slider");
    if (volumeSlider) {
        volumeSlider.value = localStorage.getItem("volume") || 0.5;
        volumeSlider.addEventListener("input", (event) => {
            updateVolume(event.target.value);
        });
    }
});
