# 🌴 Jungle Jumble - Word Shuffle Game

**Jungle Jumble** is a fun and interactive word shuffle game designed as a university project. Players guess shuffled words with the help of hints, earn scores, and engage with a life-based system that includes a side game to regain lost lives. Built using **Vanilla JavaScript, PHP, and MySQL**, the game follows the **MVC architecture** for maintainability and scalability.

---

## 🎮 How to Play

1. **Sign Up / Log In**
   - Register or log in using a username and password.
   - Your progress and high scores are saved.

2. **Guess the Word**
   - A scrambled word and its hint are shown.
   - Enter the correct word to earn points.
   - Wrong guesses reduce your lives.

3. **Lives System**
   - You start with 3 lives.
   - Lose all → prompted to play a **Banana Game** for a chance to earn 1 life.
   - Win = +1 life, Lose = Game Over.

4. **Leaderboard**
   - See how your score compares with others.

---

## ▶️ How to Run the Project Locally

To run Jungle Jumble on your local machine, follow these steps:

### ✅ Requirements:
- [XAMPP](https://www.apachefriends.org/index.html) or any local PHP server
- A web browser (e.g. Chrome)
- MySQL enabled (via XAMPP)

### 🧪 Steps:

1. **Clone or Download the Project**
   - Place the folder inside `htdocs` (XAMPP)  
     Example path: `C:\xampp\htdocs\JungleJumble`

2. **Start Apache & MySQL**
   - Open **XAMPP Control Panel**
   - Start **Apache** and **MySQL**

3. **Import the Database**
   - Go to `http://localhost/phpmyadmin`
   - Create a new database named `jungle_jumble`
   - Import the `init.sql` file from the `database/` folder

4. **Configure Database Connection**
   - Open `models/Database.php` or relevant file
   - Update with your local DB credentials (usually `root` with no password):
     ```php
     $host = "localhost";
     $dbname = "jungle_jumble";
     $username = "root";
     $password = "";
     ```

5. **Run the Game**
   - Open your browser and go to:
     ```
     http://localhost/JungleJumble/index.php
     ```

---

### 🛠️ Tech Stack

- **Frontend**: HTML, CSS (Bootstrap), JavaScript
- **Backend**: PHP (MVC)
- **Database**: MySQL
- **Design**: Figma
- **Version Control**: Git

---

## 🌐 Custom API Implementation

### Purpose
Instead of using external APIs, a **custom PHP-based API** was created to fetch shuffled words and hints dynamically from the database.

### Implementation Steps:

1. **Database Table: `words`**
   - Columns: `id`, `word`, `hint`, `difficulty`

2. **API Endpoint: `/api/words.php`**
   - Returns a random word and hint in JSON:
     ```json
     {
       "word": "planet",
       "hint": "A celestial body that orbits a star"
     }
     ```

3. **JavaScript Integration**
   - Uses `fetch()` to get a new word on game start
   - Randomly shuffles letters before showing it to the player

---


