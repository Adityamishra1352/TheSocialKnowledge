<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Social Knowledge: Test</title>
    <link rel="stylesheet" href="../bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <script>
        const questions = [];
        // console.log(showTest);
        function fetchQuestions(testId) {
            fetch(`getQuestions.php?testid=19`)
                .then(response => response.json())
                .then(data => {
                    shuffleArray(data);
                    questions.push(...data);
                    shuffleArray(questions);
                })
                .catch(error => {
                    console.error('Error fetching questions:', error);
                });
        }
        fetchQuestions(19);
        console.log(questions);
        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="list-group" id="question-list">
                    <li>Question</li>
                    <li>Question</li>
                    <li>Question</li>
                    <li>Question</li>
                    <li>Question</li>
                </ul>
            </div>
            <div class="col-md-9">
                <div class="question">

                </div>
            </div>
            <div class="btn-group" role="group">
                <button id="previous" class="btn btn-outline-secondary">Previous</button>
                <button id="next" class="btn btn-outline-success">Next</button>
            </div>
        </div>
    </div>
    <script src="../bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
    <script>
        console.log(questions);
    </script>
</body>

</html>