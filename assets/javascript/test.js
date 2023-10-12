//right-click disable
// document.addEventListener("contextmenu", function(e) {
//   e.preventDefault();
//   window.alert("Right-click is not allowed on this page!");
// }, false);
//full screen feature
function openFullscreen() {
  const elem = document.documentElement; // Get the document element

  if (elem.requestFullscreen) {
    elem.requestFullscreen(); // Standard API
  } else if (elem.mozRequestFullScreen) {
    elem.mozRequestFullScreen(); // Firefox
  } else if (elem.webkitRequestFullscreen) {
    elem.webkitRequestFullscreen(); // Chrome, Safari, and Opera
  } else if (elem.msRequestFullscreen) {
    elem.msRequestFullscreen(); // IE/Edge
  }
}
function exitFullscreen() {
  if (document.exitFullscreen) {
    document.exitFullscreen(); // Standard API
  } else if (document.mozCancelFullScreen) {
    document.mozCancelFullScreen(); // Firefox
  } else if (document.webkitExitFullscreen) {
    document.webkitExitFullscreen(); // Chrome, Safari, and Opera
  } else if (document.msExitFullscreen) {
    document.msExitFullscreen(); // IE/Edge
  }
}
const info_box = document.querySelector(".info_box");
//time box feature
const time_box = document.querySelector(".time_box");
const time_info = document.querySelector(".time_info");

function updateTimer() {
  const databaseDate = new Date(testStart);
  const currentDate = new Date();
  
  const timeDifference = databaseDate - currentDate;

  if (timeDifference > 0) {
    info_box.style.display="none";
    time_box.classList.add("activeTime");
    const remainingHours = Math.floor(timeDifference / (1000 * 60 * 60));
    const remainingMinutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
    const remainingSeconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

    const time_text =
      'Quiz yet to start. Remaining Time: <br>' +
      remainingHours +
      ' hours, ' +
      remainingMinutes +
      ' minutes, ' +
      remainingSeconds +
      ' seconds';

    time_info.innerHTML = time_text;
  } else {
    time_box.classList.remove("activeTime");
    info_box.style.display="block";
  }
}
setInterval(updateTimer, 1000);
updateTimer();



const exit_btn = info_box.querySelector(".buttons .quit");
const continue_btn = info_box.querySelector(".buttons .restart");
const quiz_box = document.querySelector(".quiz_box");
const result_box = document.querySelector(".result_box");
const option_list = document.querySelector(".option_list");
const time_line = document.querySelector("header .time_line");
const timeText = document.querySelector(".timer .time_left_txt");
const timeCount = document.querySelector(".timer .timer_sec");
const totalTimeForEach = timeforeach * questionsforeach;
continue_btn.onclick = () => {
  info_box.classList.add("deactivateInfo");
  openFullscreen();
  quiz_box.classList.add("activeQuiz");
  showQuetions(0);
  queCounter(1);
  startTimer(timeforeach);
  startTimerLine(totalTimeForEach);
  const updatedArray = JSON.stringify([...decodedArray, test_id]);
  fetch("update_test_array.php", {
    method: "POST",
    body: JSON.stringify({ updatedArray, user_id }),
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => response.json())
    .then((data) => {
      console.log("Test array updated:", data);
    })
    .catch((error) => {
      console.error("Error updating test array:", error);
    }); 
};

let timeValue = timeforeach;
let que_count = 0;
let que_numb = 1;
let userScore = 0;
let counter;
let counterLine;
let widthValue = 0;

const view_answers = result_box.querySelector(".buttons .viewAnswers");
const answers_box = document.querySelector(".answers_box");
const quit_quiz = result_box.querySelector(".buttons .quit");
view_answers.onclick = () => {
  answers_box.classList.add("activeAnswers");
  result_box.classList.remove("activeResult");
  countQuestions = 0;
  viewAnswers();
};
quit_quiz.onclick = () => {
  window.location.href = "test.php";
};

const next_btn = document.querySelector("footer .next_btn");
const bottom_ques_counter = document.querySelector("footer .total_que");
const warningBox = document.querySelector(".warning-box");
document.addEventListener("fullscreenchange", function () {
  if (
    quiz_box.classList.contains("activeQuiz") &&
    !document.fullscreenElement
  ) {
    console.log("hiisfjkasf");
    warningBox_control();
  }
});

function warningBox_control() {
  quiz_box.classList.remove("activeQuiz");
  warningBox.classList.add("activeWarning");
  document.querySelector("#warning_btn").onclick = () => {
    quiz_box.classList.add("activeQuiz");
    warningBox.classList.remove("activeWarning");
    openFullscreen();
  };
}

next_btn.onclick = () => {
  if (que_count < questions.length - 1) {
    que_count++;
    que_numb++;
    showQuetions(que_count);
    queCounter(que_numb);
    clearInterval(counter);
    // clearInterval(counterLine);
    startTimer(timeValue);
    // startTimerLine(widthValue);
    timeText.textContent = "Time Left";
    next_btn.classList.remove("show");
  } else {
    clearInterval(counter);
    // clearInterval(counterLine);
    showResult();
  }
};
var counterrors=0;
function showQuetions(index) {
  console.log(questions[index].question_text);
  const que_text = document.querySelector(".que_text");
  let que_tag =
    "<span>" + (index + 1) + ". " + questions[index].question_text + "</span>";
  let option_tag = "";

  que_text.innerHTML = que_tag;
  if (questions[index].options !== null) {
    for (let i = 0; i < questions[index].options.length; i++) {
      if (questions[index].options[i]) {
        option_tag +=
          '<div class="option"><span>' +
          questions[index].options[i] +
          "</span></div>";
      }
    }
  }
  else{
    option_tag='<div class="option"><span>Error occured! Dont worry this questions wont be counted</span>';
    counterrors+=1;
  }

  option_list.innerHTML = option_tag;

  const option = option_list.querySelectorAll(".option");
  for (i = 0; i < option.length; i++) {
    option[i].setAttribute("onclick", "optionSelected(this)");
  }
}

const answers = [];
function optionSelected(answer) {
  clearInterval(counter);
  // clearInterval(counterLine);
  let userAns = answer.textContent;
  let correcAns = questions[que_count].correct_answer;
  const allOptions = option_list.children.length;
  answer.classList.add("correct");
  if (userAns == correcAns) {
    userScore += 1;
  }
  const questionObject = {
    question: questions[que_count].question_text,
    answer: userAns,
    correctAnswer: questions[que_count].correct_answer,
  };
  answers.push(questionObject);
  for (i = 0; i < allOptions; i++) {
    option_list.children[i].classList.add("disabled");
  }
  next_btn.classList.add("show");
}
const certificate_box = document.querySelector(".certificate_box");
const certificate_btn = document.querySelector(".getCertificate");
function showResult() {
  sendToStorage();
  exitFullscreen();
  info_box.classList.add("deactivateInfo");
  quiz_box.classList.remove("activeQuiz");
  result_box.classList.add("activeResult");
  let passValue = Math.floor(questions.length * 0.7);
  let moderateValue = Math.floor(questions.length * 0.3);
  const scoreText = result_box.querySelector(".score_text");
  if (userScore > passValue) {
    certificate_btn.textContent = "Get Certificate";
    certificate_btn.onclick = () => {
      certificate_box.classList.add("activeCertificate");
      result_box.classList.remove("activeResult");
      getCertificate();
    };
    let scoreTag =
      "<span>and congrats! , You got <p>" +
      userScore +
      "</p> out of <p>" +
      questions.length +
      "</p></span>";
    scoreText.innerHTML = scoreTag;
  } else if (userScore > moderateValue) {
    certificate_btn.style.display = "none";
    let scoreTag =
      "<span>and nice , You got <p>" +
      userScore +
      "</p> out of <p>" +
      questions.length +
      "</p></span>";
    scoreText.innerHTML = scoreTag;
  } else {
    certificate_btn.style.display = "none";
    let scoreTag =
      "<span>and sorry , You got only <p>" +
      userScore +
      "</p> out of <p>" +
      questions.length +
      "</p></span>";
    scoreText.innerHTML = scoreTag;
  }
}
const certi = document.querySelector("#certificatepdf");
const getCertificate_btn = document.querySelector(".certification");
const goBackResult_btn = document.querySelector("#gobacktoresult");
function getCertificate() {
  //have to add formattedId to each specific certificate
  let formattedId = "SK" + testId + (certificate_id + 1);
  console.log(formattedId);
  getCertificate_btn.onclick = () => {
    certi.style.display = "block";
    let val = fname + " " + lname;
    generatePdf(val, formattedId);
    sendCertificateIdToPHP(formattedId);
    getCertificate_btn.disabled = true;
  };
  goBackResult_btn.onclick = () => {
    certificate_box.classList.remove("activeCertificate");
    result_box.classList.add("activeResult");
  };
}
function startTimer(time) {
  counter = setInterval(timer, 1000);
  function timer() {
    timeCount.textContent = time;
    time--;
    if (time < 9) {
      let addZero = timeCount.textContent;
      timeCount.textContent = "0" + addZero;
    }
    if (time < 0) {
      clearInterval(counter);
      timeText.textContent = "Time Off";
      const allOptions = option_list.children.length;
      for (i = 0; i < allOptions; i++) {
        option_list.children[i].classList.add("disabled");
      }
      next_btn.classList.add("show");
    }
  }
}

function startTimerLine(totalTime) {
  const intervalTime = (totalTime * 1000) / 549;
  let currentTime = 0;
  counterLine = setInterval(timer, intervalTime);
  function timer() {
    currentTime += intervalTime;
    const width = (currentTime / (totalTime * 1000)) * 549;
    time_line.style.width = width + "px";
    if (currentTime >= totalTime * 1000) {
      clearInterval(counterLine);
    }
  }
}

function queCounter(index) {
  let totalQueCounTag =
    "<span><p>" +
    index +
    "</p> of <p>" +
    questions.length +
    "</p> Questions</span>";
  bottom_ques_counter.innerHTML = totalQueCounTag;
}
function viewAnswers() {
  const currentQuestion = document.querySelector(".currentQuestion");
  const answerMessage = document.querySelector(".answerMessage");
  const nextAnswer = document.querySelector(".nextAnswer");

  if (answers[countQuestions]) {
    let ques_text = "<h3>" + answers[countQuestions].question + "</h3>";
    currentQuestion.innerHTML = ques_text;

    if (
      answers[countQuestions].answer == answers[countQuestions].correctAnswer
    ) {
      let answered =
        "<span>You have answered correctly!!<br><b>" +
        answers[countQuestions].answer +
        "</b></span>";
      answerMessage.innerHTML = answered;
    } else {
      let answered =
        "<span>You got the answer wrong. The correct option is:<br> <b>" +
        answers[countQuestions].correctAnswer +
        "</b><br> ,while you chose <b>" +
        answers[countQuestions].answer +
        " </b></span>";
      answerMessage.innerHTML = answered;
    }

    nextAnswer.onclick = () => {
      countQuestions++;
      viewAnswers();
    };
  } else {
    nextAnswer.value = "Results Page";
    nextAnswer.onclick = () => {
      answers_box.classList.remove("activeAnswers");
      result_box.classList.add("activeResult");
    };
  }
}


function sendToStorage(){
  console.log(userScore);
console.log(test_id);
console.log(user_id);
console.log(enrollment);
  const data = {
    errors:counterrors,
    enrollment:enrollment,
    test_id: test_id,
    user_id: user_id,
    userScore: userScore
  };
fetch("storeUserData.php", {
  method: "POST",
  body: JSON.stringify(data),
  headers: {
    "Content-Type": "application/json"
  }
})
  .then((response) => response.json())
  .then((data) => {
    console.log("Score sent to PHP:", data);
  })
  .catch((error) => {
    console.error("Error sending score to PHP:", error);
  });

}
// const answersString=JSON.stringify(answers);
function sendCertificateIdToPHP(formattedId) {
  const data = {
    certificate_formatted: formattedId,
    user_id: user_id,
    test_id: testId,
    userScore: userScore,
  };
  fetch("storeCertificateId.php", {
    method: "POST",
    body: JSON.stringify(data),
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => response.json())
    .then((data) => {
      console.log("Certificate ID sent to PHP:", data);
    })
    .catch((error) => {
      console.error("Error sending data to PHP:", error);
    });
}
function updateProfile() {}
