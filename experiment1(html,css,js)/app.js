var msg1 = document.getElementById("msg1");
var msg2 = document.getElementById("msg2");
var answer = Math.floor(Math.random() * 100) + 1;
var nog = 0;

function game() {
    var user = document.getElementById("guess").value;
    if (user < 1 || user > 100) {
        alert("Please Enter a number Between 1 to 100");
    } else {
        nog += 1;
        if (user < answer) {
            msg2.textContent = "Your Guess is Too low"
            msg1.textContent = "No. Of Guesses : " + nog;
        } else if (user> answer) {
            msg2.textContent = "Your Guess is Too High"
            msg1.textContent = "No. Of Guesses : " + nog;
        } else if (user == answer) {
            msg2.textContent = " You won"
            msg1.textContent = "the Number was " + answer ;
        }
    }
}