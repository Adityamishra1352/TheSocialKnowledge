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

    window.onload = openFullscreen;
const info_box = document.querySelector(".info_box");
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
};
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
// restart_quiz.onclick = () => {
//   quiz_box.classList.add("activeQuiz");
//   result_box.classList.remove("activeResult");
//   timeValue = 15;
//   que_count = 0;
//   que_numb = 1;
//   userScore = 0;
//   widthValue = 0;
//   showQuetions(que_count);
//   queCounter(que_numb);
//   clearInterval(counter);
//   clearInterval(counterLine);
//   startTimer(timeValue);
//   startTimerLine(widthValue);
//   timeText.textContent = "Time Left";
//   next_btn.classList.remove("show");
// };
view_answers.onclick = () => {
  answers_box.classList.add("activeAnswers");
  result_box.classList.remove("activeResult");
  countQuestions = 0;
  viewAnswers();
};
quit_quiz.onclick = () => {
  window.location.href = "../../index.php";
};

const next_btn = document.querySelector("footer .next_btn");
const bottom_ques_counter = document.querySelector("footer .total_que");

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
function showQuetions(index) {
  const que_text = document.querySelector(".que_text");
  let que_tag =
    "<span>" + (index + 1) + ". " + questions[index].question + "</span>";
    let option_tag='';
    for(let i=0;i<questions[index].options.length;i++){
      if(questions[index].options[i]){
        option_tag+='<div class="option"><span>'+questions[index].options[i]+'</span></div>';
      }
    }
  // let option_tag =
  //   '<div class="option"><span>' +
  //   questions[index].options[0] +
  //   "</span></div>" +
  //   '<div class="option"><span>' +
  //   questions[index].options[1] +
  //   "</span></div>" +
  //   '<div class="option"><span>' +
  //   questions[index].options[2] +
  //   "</span></div>" +
  //   '<div class="option"><span>' +
  //   questions[index].options[3] +
  //   "</span></div>";
  que_text.innerHTML = que_tag;
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
  let correcAns = questions[que_count].answer;
  const allOptions = option_list.children.length;
  answer.classList.add("correct");
  if (userAns == correcAns) {
    userScore += 1;
  }
  const questionObject = {
    question: questions[que_count].question,
    answer: userAns,
    correctAnswer: questions[que_count].answer,
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
      let answered = "<span>You have answered correctly!!";
      answerMessage.innerHTML = answered;
    } else {
      let answered =
        "<span>You got the answer wrong. The correct option is: " +
        answers[countQuestions].correctAnswer +
        " ,while you chose " +
        answers[countQuestions].answer;
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
