var  boxSize = 27;
var total_row = 19;
var total_col = 19; 
var board;
var con;
var score=0;
let scor=0;

const scoree = document.querySelector(".score");

var snakeX = boxSize * 5;
var snakeY = boxSize * 5;

var speedX = 0; 
var speedY = 0; 

var snakeBody = [];

var foodX;
var foodY;

var gameOver = false;

window.onload = function () {
	board = document.getElementById("board");
	board.height = total_row * boxSize;
	board.width = total_col * boxSize;
	context = board.getContext("2d");

	Food();
	document.addEventListener("keyup", changeDirection);
	setInterval(update, 1000 / 10);
}

function update() {
	if (gameOver) {
		return;
	}

	context.fillStyle = "rgb(255, 240, 221)";
	context.fillRect(0, 0, board.width, board.height);

	context.fillStyle = "red";
	context.fillRect(foodX, foodY, boxSize, boxSize);

	if (snakeX == foodX && snakeY == foodY) {
		snakeBody.push([foodX, foodY]);
		scor++;
		scoree.innerText=`Score: ${scor}`;
		Food();
	}

	for (let i = snakeBody.length - 1; i > 0; i--) {
		snakeBody[i] = snakeBody[i - 1];
	}
	if (snakeBody.length) {
		snakeBody[0] = [snakeX, snakeY];
	}

	context.fillStyle = "white";
	snakeX += speedX * boxSize; 
	snakeY += speedY * boxSize;
	context.fillRect(snakeX, snakeY, boxSize, boxSize);
	for (let i = 0; i < snakeBody.length; i++) {
		context.fillRect(snakeBody[i][0], snakeBody[i][1], boxSize, boxSize);
	}

	if (snakeX < 0
		|| snakeX > total_col * boxSize
		|| snakeY < 0
		|| snakeY > total_row * boxSize) {
		
		gameOver = true;
		alert("Game Over");
	}

	for (let i = 0; i < snakeBody.length; i++) {
		if (snakeX == snakeBody[i][0] && snakeY == snakeBody[i][1]) {
			

			gameOver = true;
			alert("Game Over");
		}
	}
}

function changeDirection(e) {
	if (e.code == "ArrowUp" && speedY != 1) {
		speedX = 0;
		speedY = -1;
	}
	else if (e.code == "ArrowDown" && speedY != -1) {
		speedX = 0;
		speedY = 1;
	}
	else if (e.code == "ArrowLeft" && speedX != 1) {
		speedX = -1;
		speedY = 0;
	}
	else if (e.code == "ArrowRight" && speedX != -1) {
		speedX = 1;
		speedY = 0;
	}
}

function Food() {

	foodX = (Math.floor(Math.random() * 10 ) * 27);
	
	foodY = (Math.floor(Math.random() * 10) * 27);
}

