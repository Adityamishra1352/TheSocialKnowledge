//full screen feature
function openFullscreen() {
  const elem = document.documentElement;
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.mozRequestFullScreen) {
    elem.mozRequestFullScreen();
  } else if (elem.webkitRequestFullscreen) {
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) {
    elem.msRequestFullscreen();
  }
}
function exitFullscreen() {
  if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.mozCancelFullScreen) {
    document.mozCancelFullScreen();
  } else if (document.webkitExitFullscreen) {
    document.webkitExitFullscreen();
  } else if (document.msExitFullscreen) {
    document.msExitFullscreen();
  }
}
var fullScreenModal = new bootstrap.Modal(
  document.querySelector(".fullScreenModal")
);
window.onload = function () {
  fullScreenModal.show();
  document.querySelector("#fullScreen_btn").onclick = () => {
    openFullscreen();
    fullScreenModal.hide();
  };
};
document.getElementById("submitTest").addEventListener("click", () => {
  showSummary();
});

function showSummary() {
  const answeredQuestions = questions.filter(
    (question) => question.selectedOption !== undefined
  );
  const unansweredQuestions = questions.filter(
    (question) => question.selectedOption === undefined
  );

  const resultModalBody = document.getElementById("resultModalBody");
  resultModalBody.innerHTML = `
                <p>Total Questions: ${questions.length}</p>
                <p>Answered Questions: ${answeredQuestions.length}</p>
                <p>Unanswered Questions: ${unansweredQuestions.length}</p>
                `;
  console.log("Answers Object:", answersObject);
}
function updateTimer() {
  const minutes = Math.floor(totalSecondsLeft / 60);
  const seconds = totalSecondsLeft % 60;
  totalTimeElement.textContent = `${minutes}m ${seconds}s`;

  if (totalSecondsLeft > 0) {
    totalSecondsLeft--;
  } else {
    totalTimeElement.textContent = "Time's up!";
    clearInterval(timerInterval);
  }
}
let answersObject = {};
function displayQuestion(index) {
  const questionContainer = document.getElementById("question-container");
  const currentQuestion = questions[index];

  if (currentQuestion) {
    questionContainer.innerHTML = "";
    const questionText = document.createElement("p");
    questionText.innerHTML = currentQuestion.question_text;
    questionContainer.appendChild(questionText);
    if (currentQuestion.image != null) {
      const questionImage = document.createElement("img");
      questionImage.setAttribute(
        "src",
        "../../images/questions/" + currentQuestion.image
      );
      questionContainer.appendChild(questionImage);
    }
    displayOptions();
  } else {
    console.log("All questions have been answered");
  }
}

function displayOptions() {
  const optionsContainer = document.getElementById("options-container");
  const currentQuestion = questions[currentQuestionIndex];
  if (currentQuestion) {
    optionsContainer.innerHTML = "";
    currentQuestion.options.forEach((option, optionIndex) => {
      if (currentQuestion.ismultiplechoice == 0) {
        const optionDiv = document.createElement("div");
        optionDiv.setAttribute("class", "option");
        const optionRadio = document.createElement("input");
        optionRadio.setAttribute("type", "radio");
        optionRadio.setAttribute("class", "form-check-input");
        optionRadio.setAttribute("style", "margin-right:10px");
        optionRadio.setAttribute("name", "options");
        const optionText = document.createElement("span");
        optionText.textContent = option;
        optionDiv.appendChild(optionRadio);
        optionDiv.appendChild(optionText);
        optionDiv.addEventListener("click", () => {
            const selectOptions = [];
            const checkboxes = optionsContainer.querySelectorAll(
              'input[type="checkbox"]'
            );
            checkboxes.forEach((checkbox) => {
              if (checkbox.checked) {
                selectOptions.push(checkbox.value);
              }
            });
            const selectedAnswersSet=new Set(selectOptions);
            console.log("select answer set",selectedAnswersSet);
            console.log("select OPtions",selectOptions);
            const correctAnswerIndices = JSON.parse(questions[index].correct_answer);
            console.log("selectOptions:", selectOptions);
            const correctAnswerSet=new Set(correctAnswerIndices);
            console.log(correctAnswerSet);
            console.log("correctAnswerIndices:", correctAnswerIndices);
            if (setsAreEqual(selectedAnswersSet,correctAnswerSet)) {
              console.log("Yuhooo");
            }
        });
        optionsContainer.appendChild(optionDiv);
      } else {
        const optionDiv = document.createElement("div");
        optionDiv.setAttribute("class", "option");
        const optionRadio = document.createElement("input");
        optionRadio.setAttribute("type", "checkbox");
        optionRadio.setAttribute("class", "form-check-input");
        optionRadio.setAttribute("name", "options");
        optionRadio.setAttribute("style", "margin-right:10px");
        const optionText = document.createElement("span");
        optionText.textContent = option;
        optionDiv.appendChild(optionRadio);
        optionDiv.appendChild(optionText);
        optionDiv.addEventListener("click", () => {
          answersObject[currentQuestionIndex] = optionIndex + 1;
        });
        optionsContainer.appendChild(optionDiv);
      }
    });
  }
}
function displayNavigationButtons() {
  const navigationContainer = document.getElementById("navigation-container");
  navigationContainer.innerHTML = "";

  questions.forEach((question, index) => {
    const button = document.createElement("button");
    button.setAttribute("class", "btn btn-outline-secondary m-1");
    button.textContent = `${index + 1}`;
    button.addEventListener("click", () => {
      currentQuestionIndex = index;
      displayQuestion(currentQuestionIndex);
      highlightSelectedButton();
    });
    navigationContainer.appendChild(button);
  });
  highlightSelectedButton();
  navigationContainer.classList.add("center-buttons");
}
function highlightSelectedButton() {
  const buttons = document.querySelectorAll("#navigation-container button");
  buttons.forEach((button) => {
    button.classList.remove("active");
  });
  buttons[currentQuestionIndex].classList.add("active");
}
document.getElementById("previousQuestion").addEventListener("click", () => {
  if (currentQuestionIndex > 0) {
    currentQuestionIndex--;
    displayQuestion(currentQuestionIndex);
    highlightSelectedButton();
  }
});

document.getElementById("nextQuestion").addEventListener("click", () => {
  if (currentQuestionIndex < questions.length - 1) {
    currentQuestionIndex++;
    displayQuestion(currentQuestionIndex);
    highlightSelectedButton();
  }
});
document
  .getElementById("previousQuestionArrow")
  .addEventListener("click", () => {
    if (currentQuestionIndex > 0) {
      currentQuestionIndex--;
      displayQuestion(currentQuestionIndex);
      highlightSelectedButton();
    }
  });

document.getElementById("nextQuestionArrow").addEventListener("click", () => {
  if (currentQuestionIndex < questions.length - 1) {
    currentQuestionIndex++;
    displayQuestion(currentQuestionIndex);
    highlightSelectedButton();
  }
});
