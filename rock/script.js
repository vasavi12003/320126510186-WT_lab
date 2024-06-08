let computermove;
let score = {
    win: 0,
    lose: 0,
    tie: 0,
};
let gameActive = true;

function resetscore() {
    score = {
        win: 0,
        lose: 0,
        tie: 0,
    };
    document.getElementById('win').textContent = score.win;
    document.getElementById('lose').textContent = score.lose;
    document.getElementById('tie').textContent = score.tie;
    document.getElementById('result').textContent = "Score was reset";
}

function playGame(playermove) {
    if (!gameActive) {
        document.getElementById('result').textContent = "Game is stopped. Restart to play.";
        return;
    }

    let res = "";
    computermove = pickcomputermove();
    if (playermove == 'rock') {
        if (computermove == 'rock') {
            res = "TIE";
        } else if (computermove == "paper") {
            res = "You Lose";
        } else if (computermove == "Scissor") {
            res = "You win";
        }
    }
    if (playermove == 'paper') {
        if (computermove == 'paper') {
            res = "TIE";
        } else if (computermove == "rock") {
            res = "You win";
        } else if (computermove == "Scissor") {
            res = "You Lose";
        }
    }
    if (playermove == 'Scissor') {
        if (computermove == 'Scissor') {
            res = "TIE";
        } else if (computermove == "paper") {
            res = "You win";
        } else if (computermove == "rock") {
            res = "You Lose";
        }
    }
    if (res == "You win") {
        score.win += 1;
    } else if (res == "You Lose") {
        score.lose += 1;
    } else if (res == "TIE") {
        score.tie += 1;
    }
    
    document.getElementById('win').textContent = score.win;
    document.getElementById('lose').textContent = score.lose;
    document.getElementById('tie').textContent = score.tie;
    document.getElementById('result').textContent = `${res}. Computer chose ${computermove}. You chose ${playermove}.`;
}

function pickcomputermove() {
    let result = "";
    let move = Math.random();
    if (move >= 0 && move < (1 / 3)) {
        result = "rock";
    } else if (move >= (1 / 3) && move < (2 / 3)) {
        result = "paper";
    } else if (move >= (2 / 3) && move < 1) {
        result = "Scissor";
    }
    return result;
}

function stopGame() {
    gameActive = false;
    document.getElementById('result').textContent = "Game stopped. Click Restart to play again.";
}

function restartGame() {
    gameActive = true;
    resetscore();
    document.getElementById('result').textContent = "Game restarted. Let's play!";
}
