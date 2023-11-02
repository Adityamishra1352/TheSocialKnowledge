//right-click disable
// document.addEventListener("contextmenu", function(e) {
//   e.preventDefault();
//   window.alert("Right-click is not allowed on this page!");
// }, false);

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
const info_box = document.querySelector(".info_box");
//time box feature
const time_box = document.querySelector(".time_box");
const time_info = document.querySelector(".time_info");

function updateTimer() {
  const databaseDate = new Date(testStart);
  const currentDate = new Date();

  const timeDifference = databaseDate - currentDate;

  if (timeDifference > 0) {
    info_box.style.display = "none";
    time_box.classList.add("activeTime");
    const remainingHours = Math.floor(timeDifference / (1000 * 60 * 60));
    const remainingMinutes = Math.floor(
      (timeDifference % (1000 * 60 * 60)) / (1000 * 60)
    );
    const remainingSeconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

    const time_text =
      "<b>Quiz yet to start.</b><br>Remaining Time: " +
      remainingHours +
      " hours, " +
      remainingMinutes +
      " minutes, " +
      remainingSeconds +
      " seconds";

    time_info.innerHTML = time_text;
  } else {
    time_box.classList.remove("activeTime");
    info_box.style.display = "block";
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
const end_box=document.querySelector(".end_box");
const totalTimeForEach = timeforeach * questionsforeach;
//skip question implementation
function skipCurrentQuestion() {
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
}
// string box implementation
const string_box=document.querySelector(".string_box");
if(showTest==0){
  info_box.classList.add("deactivateInfo");
}
else{
  info_box.classList.remove("deactivateInfo");
  string_box.classList.add("deactivateString");
}

function checkTimeAndShowResult() {
  const endDateTime = new Date(endTime);
  const currentTime = new Date();
  if (currentTime > endDateTime && quiz_box.classList.contains("activeQuiz")) {
      showResult();
  }
  else if(currentTime> endDateTime && !info_box.classList.contains("deactivateInfo")){
    end_box.classList.add("activeEndBox");
    info_box.classList.add("deactivateInfo");
  }
}
checkTimeAndShowResult();
const checkInterval = setInterval(checkTimeAndShowResult, 1000);
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

const quit_quiz = result_box.querySelector(".buttons .quit");
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
const skipQuestion_btn=document.querySelector("#skipQuestion");
const skip_box=document.querySelector(".skip-box");
skipQuestion_btn.onclick=()=>{
  skip_box.classList.add("activateSkip");
  const allOptions = option_list.children.length;
  for (i = 0; i < allOptions; i++) {
    option_list.children[i].classList.add("disabled");
  }
  next_btn.classList.add("show");
}
const skipQuestionConfirm=document.querySelector("#confirmSkip");
skipQuestionConfirm.onclick=()=>{
  skip_box.classList.remove("activateSkip");
  skipCurrentQuestion();
}
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
var counterrors = 0;
function showQuetions(index) {
  const que_text = document.querySelector(".que_text");
  const que_image = document.querySelector(".que_image");

  if (questions[index].question_text !== null) {
    que_text.innerHTML = `<span>${index + 1}. ${questions[index].question_text}</span>`;
  } else {
    que_text.innerHTML = "";
  }

  if (questions[index].image !== null) {
    que_image.innerHTML = `<span>${index + 1}.</span><img src="../images/questions/${questions[index].image}" alt="Question Image">`;
    que_image.style.display = "block";
  } else {
    que_image.style.display = "none";
  }
  let option_tag = "";
  if (questions[index].options !== null) {
    for (let i = 0; i < questions[index].options.length; i++) {
      if (questions[index].options[i]) {
        option_tag +=
          '<div class="option"><span>' +
          questions[index].options[i] +
          "</span></div>";
      }
    }
  } else {
    option_tag =
      '<div class="option"><span>Error occured! Dont worry this questions wont be counted</span>';
    counterrors += 1;
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
    question_id:questions[que_count].question_id,
    question: questions[que_count].question_text,
    image:questions[que_count].image,
    answer: userAns,
    correctAnswer: questions[que_count].correct_answer,
  };
  answers.push(questionObject);
  for (i = 0; i < allOptions; i++) {
    option_list.children[i].classList.add("disabled");
  }
  next_btn.classList.add("show");
}
function showResult() {
  sendToStorage();
  exitFullscreen();
  console.log(answers);
  info_box.classList.add("deactivateInfo");
  quiz_box.classList.remove("activeQuiz");
  result_box.classList.add("activeResult");
      // userScore +
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
function sendToStorage() {
  console.log(userScore);
  console.log(test_id);
  console.log(user_id);
  console.log(enrollment);
  const data = {
    errors: counterrors,
    enrollment: enrollment,
    test_id: test_id,
    user_id: user_id,
    userScore: userScore,
    answers:answers
  };
  fetch("storeUserData.php", {
    method: "POST",
    body: JSON.stringify(data),
    headers: {
      "Content-Type": "application/json",
    },
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
