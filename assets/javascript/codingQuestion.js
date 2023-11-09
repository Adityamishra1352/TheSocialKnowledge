document.getElementById("selectAll").addEventListener("change", function () {
  const checkboxes = document.querySelectorAll("input[name='delete[]']");
  checkboxes.forEach((checkbox) => {
    checkbox.checked = this.checked;
  });
});
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
          </div>
      </div>
      <button type="button" class="btn m-2 btn-outline-danger remove-question">Remove Question</button>
      <div class="extras row row-cols-2"></div>
      <div class="options row row-cols-2"></div>
      <button type="button" class="btn btn-outline-success add-inputFormat m-2">Add Input Format</button>
      <button type="button" class="btn btn-outline-success add-outputFormat m-2">Add Output Format</button>
      <button type="button" class="btn btn-outline-success add-constraints m-2">Add Constraints</button>
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
          const extra=document.querySelector(".extras");
          questionDiv.querySelector(".add-inputFormat").addEventListener("click",function(){
            const inputFormatDiv=document.createElement("div");
            inputFormatDiv.setAttribute("class","container");
            const inputFormatInput=document.createElement("textarea");
            inputFormatInput.setAttribute("class","form-control");
            inputFormatInput.setAttribute("name",`inputFormat_${questionCount}`);
            inputFormatInput.setAttribute("placeholder",`Input Format ${questionCount+1}`);
            inputFormatDiv.appendChild(inputFormatInput);
            extra.appendChild(inputFormatDiv);
            questionDiv.querySelector(".add-inputFormat").disabled=true;
          });
          questionDiv.querySelector(".add-outputFormat").addEventListener("click",function(){
            const outputFormatDiv=document.createElement("div");
            outputFormatDiv.setAttribute("class","container");
            const outputFormatInput=document.createElement("textarea");
            outputFormatInput.setAttribute("class","form-control");
            outputFormatInput.setAttribute("name",`OutputFormat_${questionCount}`);
            outputFormatInput.setAttribute("placeholder",`Output Format ${questionCount+1}`);
            outputFormatDiv.appendChild(outputFormatInput);
            extra.appendChild(outputFormatDiv);
            questionDiv.querySelector(".add-outputFormat").disabled=true;
          });
          questionDiv.querySelector(".add-constraints").addEventListener("click",function(){
            const constraintsDiv=document.createElement("div");
            constraintsDiv.setAttribute("class","container");
            const constraintsInput=document.createElement("textarea");
            constraintsInput.setAttribute("class","form-control");
            constraintsInput.setAttribute("name",`Constraints_${questionCount}`);
            constraintsInput.setAttribute("placeholder",`Constraints ${questionCount+1}`);
            constraintsDiv.appendChild(constraintsInput);
            extra.appendChild(constraintsDiv);
            questionDiv.querySelector(".add-constraints").disabled=true;
          });
    });
  });