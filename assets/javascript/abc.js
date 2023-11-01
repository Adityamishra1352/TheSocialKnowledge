document.addEventListener("DOMContentLoaded", function () {
            const addQuestionButton = document.getElementById("add-question");
            const questionsContainer = document.getElementById("questions");
            let questionCount = -1;

            addQuestionButton.addEventListener("click", function () {
                questionCount++;
                const questionDiv = document.createElement("div");
                questionDiv.classList.add("question");
                questionDiv.innerHTML = `
                    <div class="row row-cols-2">
                        <div class="col">
                            <label for="question-${questionCount}"><b>Question ${questionCount + 1}:</b></label>
                            <textarea id="question-${questionCount}" name="questions[]" class="form-control"></textarea>
                            <label for="questionImage" class="form-label"><b>Add Question Image:</b></label>
                            <input type="file" class="form-control" accept="image/*" id="questionImage" name="question-images[]">
                        </div>
                        <div class="col">
                            <fieldset>
                                <legend><b>Options:</b></legend>
                                <div class="options row row-cols-2"></div>
                                <button type="button" class="btn btn-success add-option m-2">Add Option</button>
                            </fieldset>
                        </div>
                    </div>
                    <button type="button" class="btn m-2 btn-outline-danger remove-question">Remove</button>
                `;
                questionsContainer.appendChild(questionDiv);

                const removeQuestionButton = questionDiv.querySelector(".remove-question");
                removeQuestionButton.addEventListener("click", function () {
                    questionsContainer.removeChild(questionDiv);
                });

                const optionsContainer = questionDiv.querySelector(".options");
                let optionCount = 0;

                questionDiv.querySelector("textarea").addEventListener("change", function () {
                    optionsContainer.innerHTML = ""; // Clear options when question text changes
                });

                questionDiv.querySelector("fieldset").addEventListener("click", function (e) {
                    if (e.target.classList.contains("remove-option")) {
                        optionsContainer.removeChild(e.target.parentElement);
                    }
                });

                questionDiv.querySelector(".add-option").addEventListener("click", function () {
                    const optionInput = document.createElement("div");
                    optionInput.classList.add("option");
                    optionInput.innerHTML = `
                        <input type="radio" name="correct-answer-${questionCount}" id="answer-${questionCount}-${optionCount}">
                        <input type="text" class="form-control m-2 col" name="options_${questionCount}[]" placeholder="Option ${optionCount + 1}">
                        <button type="button" class="btn btn-outline-danger remove-option">Remove</button>
                    `;
                    optionsContainer.appendChild(optionInput);
                    optionCount++;
                });
            });
        });