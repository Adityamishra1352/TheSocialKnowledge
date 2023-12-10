//Active classes feature
const editQuestions_container = document.querySelector(
  ".editQuestions_container"
);
const editQuestions_btn = document.querySelector("#editQuestions_btn");
const setTime_container = document.querySelector(".setTime_container");
const setTime_btn = document.querySelector("#setTime_btn");
const user_btn = document.querySelector("#users_btn");
const users_container = document.querySelector(".users_container");
const startString_btn = document.querySelector("#setString");
const startString_container = document.querySelector(".startString_container");
const setUsers_container = document.querySelector(".setUsers_container");
const setUsers_btn = document.querySelector("#setUsers_btn");
const tableFilter_btn = document.querySelector("#filter_btn");
const firstContainer = document.querySelector(".first_container");
editQuestions_btn.onclick = () => {
  editQuestions_container.style.display = "block";
  setTime_container.style.display = "none";
  // firstContainer.style.display = "none";
  users_container.style.display = "none";
  startString_container.style.display = "none";
  setUsers_container.style.display = "none";
};
setTime_btn.onclick = () => {
  // firstContainer.style.display = "none";
  editQuestions_container.style.display = "none";
  setTime_container.style.display = "block";
  users_container.style.display = "none";
  startString_container.style.display = "none";
  setUsers_container.style.display = "none";
};
users_btn.onclick = () => {
  // firstContainer.style.display = "none";
  editQuestions_container.style.display = "none";
  setTime_container.style.display = "none";
  users_container.style.display = "block";
  startString_container.style.display = "none";
  setUsers_container.style.display = "none";
};
startString_btn.onclick = () => {
  // firstContainer.style.display = "none";
  editQuestions_container.style.display = "none";
  setTime_container.style.display = "none";
  users_container.style.display = "none";
  startString_container.style.display = "block";
  setUsers_container.style.display = "none";
};
setUsers_btn.onclick = () => {
  // firstContainer.style.display = "none";
  editQuestions_container.style.display = "none";
  setTime_container.style.display = "none";
  users_container.style.display = "none";
  startString_container.style.display = "none";
  setUsers_container.style.display = "block";
};
tableFilter_btn.onclick = () => {
  document.querySelector(".tableFilterUser").style.display = "block";
};
document.getElementById("selectAll").addEventListener("change", function () {
  const checkboxes = document.querySelectorAll("input[name='delete[]']");
  checkboxes.forEach((checkbox) => {
    checkbox.checked = this.checked;
  });
});
document.getElementById("allowAll").addEventListener("change", function () {
  const checkboxes = document.querySelectorAll("input[name='selectedUser[]']");
  checkboxes.forEach((checkbox) => {
    checkbox.checked = this.checked;
  });
});
document.getElementById("attemptedAll").addEventListener("change", function () {
  const checkboxes = document.querySelectorAll("input[name='allowRestart[]']");
  checkboxes.forEach((checkbox) => {
    checkbox.checked = this.checked;
  });
});
//Year and batch selection functionality
function populateDropdowns(data) {
  const yearDropdown = document.getElementById("year");
  data.forEach((item) => {
    const option = document.createElement("option");
    option.value = item.year;
    option.text = item.year;
    yearDropdown.appendChild(option);
  });
  const batchDropdown = document.getElementById("batch");
  data.forEach((item) => {
    const option = document.createElement("option");
    option.value = item.batch;
    option.text = item.batch;
    batchDropdown.appendChild(option);
  });
}
fetch("dataForYearBatch.php")
  .then((response) => response.json())
  .then((data) => {
    populateDropdowns(data);
  })
  .catch((error) => {
    console.error("Error fetching data:", error);
  });
  //Questions input field generation and CSV file options
  document.addEventListener("DOMContentLoaded", function () {
    const addQuestionButton = document.getElementById("add-question");
    const questionsContainer = document.getElementById("questions");
  let questionCount = -1;
  var questionTypeSelect = document.getElementById("questionType");
  var answerTypeInput = document.getElementById("answerType");
  questionType.addEventListener("change", function () {
    answerTypeInput.value = questionTypeSelect.value;
    console.log(answerTypeInput.value);
  });
  addQuestionButton.addEventListener("click", function () {
    var selectedType = questionType.value;
    if (selectedType == "singleAnswer") {
      questionCount++;
      const questionDiv = document.createElement("div");
      questionDiv.classList.add("question");
      questionDiv.innerHTML = `
    <div class="row">
    <div class="col">
            <label for="question-${questionCount}"><b>Question ${
        questionCount + 1
      }:</b></label>
            <textarea id="question-${questionCount}" name="questions[]" class="form-control"></textarea>
            <label for="questionImage" class="form-label"><b>Add Question Image:</b></label>
            <input type="file" class="form-control" accept="image/*" id="questionImage" name="question-images[]">
        </div>
    </div>
    <button type="button" class="btn m-2 btn-outline-danger remove-question">Remove Question</button>
    <div class="options row row-cols-2"></div>
    <button type="button" class="btn btn-outline-success add-option m-2">Add Option</button>`;
      questionsContainer.appendChild(questionDiv);

      const removeQuestionButton =
        questionDiv.querySelector(".remove-question");
      removeQuestionButton.addEventListener("click", function () {
        questionsContainer.removeChild(questionDiv);
      });

      const optionsContainer = questionDiv.querySelector(".options");
      let optionCount = 0;

      questionDiv
        .querySelector(".add-option")
        .addEventListener("click", function () {
          const optionDiv = document.createElement("div");
          optionDiv.setAttribute("class", "row align-items-center");
          const radioDiv = document.createElement("div");
          radioDiv.setAttribute("class", "col-1");
          const optionRadio = document.createElement("input");
          optionRadio.setAttribute("type", "radio");
          optionRadio.setAttribute("class", "form-check-input");
          optionRadio.setAttribute("name", `correct-answer-${questionCount}`);
          optionRadio.setAttribute(
            "value",
            `options_${questionCount}[${optionCount}]`
          );
          radioDiv.appendChild(optionRadio);
          const optionInput = document.createElement("textarea");
          optionInput.setAttribute("class", "form-control m-2 col-11");
          optionInput.setAttribute("style", "width:60%;");
          optionInput.setAttribute(
            "name",
            `options_${questionCount}[${optionCount}]`
          );
          optionInput.setAttribute("placeholder", `Option ${optionCount + 1}`);
          optionDiv.appendChild(radioDiv);
          optionDiv.appendChild(optionInput);

          optionsContainer.appendChild(optionDiv);
          optionCount++;
        });
    } else if (selectedType == "multipleAnswer") {
      questionCount++;
      const questionDiv = document.createElement("div");
      questionDiv.classList.add("question");
      questionDiv.innerHTML = `
    <div class="row">
    <div class="col">
            <label for="question-${questionCount}"><b>Question ${
        questionCount + 1
      }:</b></label>
            <textarea id="question-${questionCount}" name="questions[]" class="form-control"></textarea>
            <label for="questionImage" class="form-label"><b>Add Question Image:</b></label>
            <input type="file" class="form-control" accept="image/*" id="questionImage" name="question-images[]">
        </div>
    </div>
    <button type="button" class="btn m-2 btn-outline-danger remove-question">Remove Question</button>
    <div class="options row row-cols-2"></div>
    <button type="button" class="btn btn-outline-success add-option m-2">Add Option</button>`;
      questionsContainer.appendChild(questionDiv);

      const removeQuestionButton =
        questionDiv.querySelector(".remove-question");
      removeQuestionButton.addEventListener("click", function () {
        questionsContainer.removeChild(questionDiv);
      });

      const optionsContainer = questionDiv.querySelector(".options");
      let optionCount = 0;

      questionDiv
        .querySelector(".add-option")
        .addEventListener("click", function () {
          const optionDiv = document.createElement("div");
          optionDiv.setAttribute("class", "row align-items-center");
          const radioDiv = document.createElement("div");
          radioDiv.setAttribute("class", "col-1");

          const optionRadio = document.createElement("input");
          optionRadio.setAttribute("type", "checkbox");
          optionRadio.setAttribute("class", "form-check-input");
          optionRadio.setAttribute("name", `correct-answer-${questionCount}[]`);
          optionRadio.setAttribute(
            "value",
            `options_${questionCount}[${optionCount}]`
          );

          radioDiv.appendChild(optionRadio);
          const optionInput = document.createElement("textarea");
          optionInput.setAttribute("class", "form-control m-2 col-11");
          optionInput.setAttribute("style", "width:60%;");
          optionInput.setAttribute(
            "name",
            `options_${questionCount}[${optionCount}]`
          );
          optionInput.setAttribute("placeholder", `Option ${optionCount + 1}`);
          optionDiv.appendChild(radioDiv);
          optionDiv.appendChild(optionInput);

          optionsContainer.appendChild(optionDiv);
          optionCount++;
        });
    // } else if (selectedType == "codingQuestion") {
    //   questionCount++;
    //     const questionDiv = document.createElement("div");
    //     questionDiv.classList.add("question");
    //     questionDiv.innerHTML = `
    //   <div class="row">
    //   <div class="col">
    //           <label for="question-${questionCount}"><b>Question ${
    //       questionCount + 1
    //     }:</b></label>
    //           <textarea id="question-${questionCount}" name="questions[]" class="form-control"></textarea>
    //       </div>
    //   </div>
    //   <button type="button" class="btn m-2 btn-outline-danger remove-question">Remove Question</button>
    //   <div class="extras row row-cols-2"></div>
    //   <div class="options row row-cols-2"></div>
    //   <button type="button" class="btn btn-outline-success add-inputFormat m-2">Add Input Format</button>
    //   <button type="button" class="btn btn-outline-success add-outputFormat m-2">Add Output Format</button>
    //   <button type="button" class="btn btn-outline-success add-constraints m-2">Add Constraints</button>
    //   <button type="button" class="btn btn-outline-success add-option m-2">Add TestCases</button>`;
    //     questionsContainer.appendChild(questionDiv);

    //     const removeQuestionButton =
    //       questionDiv.querySelector(".remove-question");
    //     removeQuestionButton.addEventListener("click", function () {
    //       questionsContainer.removeChild(questionDiv);
    //     });

    //     const optionsContainer = questionDiv.querySelector(".options");
    //     let optionCount = 0;

    //     questionDiv
    //       .querySelector(".add-option")
    //       .addEventListener("click", function () {
    //         const optionDiv = document.createElement("div");
    //         optionDiv.setAttribute("class", "row align-items-center m-1");
    //         const expectedOutput = document.createElement("input");
    //         expectedOutput.setAttribute("class", "form-control");
    //         expectedOutput.setAttribute("style", "width:50%");
    //         expectedOutput.setAttribute(
    //           "name",
    //           `expected_output_${questionCount}[${optionCount}]`
    //         );
    //         expectedOutput.setAttribute(
    //           "placeholder",
    //           `ExpectedOutput ${optionCount + 1}`
    //         );
    //         const optionInput = document.createElement("input");
    //         optionInput.setAttribute("class", "form-control");
    //         optionInput.setAttribute("style", "width:50%;");
    //         optionInput.setAttribute(
    //           "name",
    //           `input_${questionCount}[${optionCount}]`
    //         );
    //         optionInput.setAttribute("placeholder", `Input ${optionCount + 1}`);
    //         optionDiv.appendChild(optionInput);
    //         optionDiv.appendChild(expectedOutput);

    //         optionsContainer.appendChild(optionDiv);
    //         optionCount++;
    //       });
    //     const extra = document.querySelector(".extras");
    //     questionDiv
    //       .querySelector(".add-inputFormat")
    //       .addEventListener("click", function () {
    //         const inputFormatDiv = document.createElement("div");
    //         inputFormatDiv.setAttribute("class", "container");
    //         const inputFormatInput = document.createElement("textarea");
    //         inputFormatInput.setAttribute("class", "form-control");
    //         inputFormatInput.setAttribute(
    //           "name",
    //           `inputFormat_${questionCount}`
    //         );
    //         inputFormatInput.setAttribute(
    //           "placeholder",
    //           `Input Format ${questionCount + 1}`
    //         );
    //         inputFormatDiv.appendChild(inputFormatInput);
    //         extra.appendChild(inputFormatDiv);
    //         questionDiv.querySelector(".add-inputFormat").disabled = true;
    //       });
    //     questionDiv
    //       .querySelector(".add-outputFormat")
    //       .addEventListener("click", function () {
    //         const outputFormatDiv = document.createElement("div");
    //         outputFormatDiv.setAttribute("class", "container");
    //         const outputFormatInput = document.createElement("textarea");
    //         outputFormatInput.setAttribute("class", "form-control");
    //         outputFormatInput.setAttribute(
    //           "name",
    //           `OutputFormat_${questionCount}`
    //         );
    //         outputFormatInput.setAttribute(
    //           "placeholder",
    //           `Output Format ${questionCount + 1}`
    //         );
    //         outputFormatDiv.appendChild(outputFormatInput);
    //         extra.appendChild(outputFormatDiv);
    //         questionDiv.querySelector(".add-outputFormat").disabled = true;
    //       });
    //     questionDiv
    //       .querySelector(".add-constraints")
    //       .addEventListener("click", function () {
    //         const constraintsDiv = document.createElement("div");
    //         constraintsDiv.setAttribute("class", "container");
    //         const constraintsInput = document.createElement("textarea");
    //         constraintsInput.setAttribute("class", "form-control");
    //         constraintsInput.setAttribute(
    //           "name",
    //           `Constraints_${questionCount}`
    //         );
    //         constraintsInput.setAttribute(
    //           "placeholder",
    //           `Constraints ${questionCount + 1}`
    //         );
    //         constraintsDiv.appendChild(constraintsInput);
    //         extra.appendChild(constraintsDiv);
    //         questionDiv.querySelector(".add-constraints").disabled = true;
    //       });
      
    }
  });
  const csvFileInput = document.querySelector("input[type='file']");
  csvFileInput.addEventListener("change", function () {
    questionsContainer.innerHTML = "";
    addQuestionButton.style.display = "none";
  });
});
addQuestionButton.style.display = "none";
questionsContainer.innerHTML = "";
const clearFormButton = document.createElement("button");
clearFormButton.innerText = "Clear Form and Add More Questions";
clearFormButton.className = "btn btn-primary m-2";
clearFormButton.addEventListener("click", function () {
  questionsContainer.innerHTML = "";
  addQuestionButton.style.display = "block";
});
questionsContainer.appendChild(clearFormButton);
