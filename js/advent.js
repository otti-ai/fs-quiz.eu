function correctAnswer(){
    document.getElementById('adventCloseButton').click();
    confetti({
        particleCount: 250,
        spread: 180,
        colors: ["#d53235","#d53235","#d53235","#248f3d"],
      });
    document.getElementById("adventBody").innerHTML = '<h1 class="text-center text-success">Your answer was correct!</h1>';
}

function getTipp(){
    document.getElementById("adventTipp").style.display = 'block';
}

function wrongAnswer(button){
    getTipp();
    button.disabled=true;
    button.classList.add("btn-danger");
    button.classList.remove("btn-primary");
}

function checkAnswer(button){
    if (button.getAttribute('data-solution') == "true"){
        correctAnswer();
    }else{
        wrongAnswer(button);
    }
}

