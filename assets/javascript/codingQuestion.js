document.addEventListener("DOMContentLoaded", function () {
    const addQuestionButton = document.getElementById("add-question");
    const questionsContainer = document.getElementById("questions");
    let questionCount = -1;
    addQuestionButton.addEventListener("click", function () {
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
          </div>
      </div>
      <button type="button" class="btn m-2 btn-outline-danger remove-question">Remove Question</button>
      <div class="options row row-cols-2"></div>
      <button type="button" class="btn btn-outline-success add-option m-2">Add TestCases</button>`;
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
              optionDiv.setAttribute("class", "row align-items-center m-1");
              const expectedOutput=document.createElement("input");
              expectedOutput.setAttribute("class","form-control");
              expectedOutput.setAttribute("style","width:50%");
              expectedOutput.setAttribute("name",`expected_output_${questionCount}[${optionCount}]`);
              expectedOutput.setAttribute("placeholder",`ExpectedOutput ${optionCount+1}`);
            const optionInput = document.createElement("input");
            optionInput.setAttribute("class", "form-control");
            optionInput.setAttribute("style", "width:50%;");
            optionInput.setAttribute(
              "name",
              `input_${questionCount}[${optionCount}]`
            );
            optionInput.setAttribute("placeholder", `Input ${optionCount + 1}`);
            optionDiv.appendChild(optionInput);
            optionDiv.appendChild(expectedOutput);
  
            optionsContainer.appendChild(optionDiv);
            optionCount++;
          });
    });
  });