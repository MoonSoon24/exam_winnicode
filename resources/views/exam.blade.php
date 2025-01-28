<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <title>Exam Page</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
    
        #question-numbers {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: start;
        }

        .question-number {
            cursor: pointer;
            margin: 0;
            border: 1px solid #ddd;
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            width: 40px;
            height: 40px;
        }

        .question-number.active {
            border: 2px solid #007bff;
        }

        .question-number.saved {
            background-color: #28a745;
            color: white;
        }

        .question-number.flagged {
            background-color: #ff0000;
            color: white;
        }

        .question-container {
            height: 80vh;
        }

        .progress-container {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
        }
    </style>
</head>
<body>
    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">TOEFL EXAM</a>
            <a class="navbar-brand" id="exam-title"></a>
            <div class="ml-auto">
                <span id="time-remaining">Time Remaining: 00:00</span>
            </div>
        </div>
    </nav>

    <!-- Question -->
    <div class="container-fluid mt-5 pt-5">
        <div class="row">
            <div class="col-md-9 d-flex align-items-center justify-content-center question-container">
                <div class="text-center">
                    <h4 id="question-title"></h4>
                    <p id="question-text"></p>
                    <div id="question-options" class="mt-4"></div>
                    <div class="mt-5">
                        <button id="save-question" class="btn btn-success">Next</button>
                    </div>
                </div>
            </div>

            <!-- Question Sidebar -->
            <div class="col-md-3 bg-light">
                <div class="p-3">
                    <h5>Questions</h5>
                    <div id="question-numbers"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Bar -->
    <div class="progress-container">
        <div class="progress">
            <div id="progress-bar" class="progress-bar bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>

    <!-- Completion Confirmation Modal -->
    <div class="modal fade" id="completionModal" tabindex="-1" role="dialog" aria-labelledby="completionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="completionModalLabel">Confirm Completion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to complete the exam? You won’t be able to change your answers after this.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirm-completion">Yes, Complete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const examId = 1;
        let currentQuestionIndex = 0;
        let examData = null;
        const savedQuestions = new Set();
        const flaggedQuestions = new Set();

        async function fetchExamData() {
            try {
                const response = await fetch(`/exams/${examId}/start`);
                examData = await response.json();
                initializeExam();
            } catch (error) {
                console.error('Failed to fetch exam data:', error);
            }
        }

        function initializeExam() {
            document.getElementById('exam-title').textContent = examData.title;
            initializeTimer(examData.duration * 60);
            renderQuestions();
            showQuestion(currentQuestionIndex);
        }

        function initializeTimer(seconds) {
            const timerElement = document.getElementById('time-remaining');
            function updateTimer() {
                const minutes = Math.floor(seconds / 60);
                const remainingSeconds = seconds % 60;
                timerElement.textContent = `Time Remaining: ${minutes}:${remainingSeconds < 10 ? '0' : ''}${remainingSeconds}`;
                if (seconds > 0) {
                    seconds--;
                    setTimeout(updateTimer, 1000);
                } else {
                    alert("Time's up!");
                }
            }
            updateTimer();
        }

        function renderQuestions() {
            const questionNumbersContainer = document.getElementById('question-numbers');
            questionNumbersContainer.innerHTML = '';

            examData.questions.forEach((_, index) => {
                const questionNumber = document.createElement('div');
                questionNumber.className = 'question-number';
                questionNumber.textContent = index + 1;
                questionNumber.dataset.index = index;
                questionNumber.addEventListener('click', () => showQuestion(index));
                questionNumbersContainer.appendChild(questionNumber);
            });
        }

        function showQuestion(index) {
            currentQuestionIndex = index;
            const question = examData.questions[index];
            document.getElementById('question-title').innerHTML = `
                Question ${index + 1}
                <i id="flag-icon" class="bi bi-flag-fill ml-2" style="cursor: pointer; color: ${flaggedQuestions.has(index) ? 'red' : 'grey'};" title="Flag this question"></i>
            `;
            document.getElementById('question-text').textContent = question.question_text;

            const optionsContainer = document.getElementById('question-options');
            optionsContainer.innerHTML = '';

            question.options.forEach((option, index) => {
                const optionId = `option-${index}`;
                optionsContainer.innerHTML += `
                    <div align="left">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="option" id="${optionId}" value="${option}">
                            <label class="form-check-label" for="${optionId}">
                                ${String.fromCharCode(65 + index)}. ${option}
                            </label>
                        </div>
                    </div>
                `;
            });

            const flagIcon = document.getElementById('flag-icon');
            flagIcon.addEventListener('click', () => {
                const questionNumber = document.querySelector(`.question-number[data-index="${index}"]`);

                if (flaggedQuestions.has(index)) {
                    flaggedQuestions.delete(index);
                    flagIcon.style.color = 'grey';
                    questionNumber.classList.remove('flagged');
                } else {
                    flaggedQuestions.add(index);
                    flagIcon.style.color = 'red';
                    if (savedQuestions.has(index)) {
                        savedQuestions.delete(index);
                        questionNumber.classList.remove('saved');
                        updateProgressBar();
                    }
                    questionNumber.classList.add('flagged');
                }
            });

            document.querySelectorAll('.question-number').forEach((el) => el.classList.remove('active'));
            document.querySelector(`.question-number[data-index="${index}"]`).classList.add('active');

            const saveButton = document.getElementById('save-question');
            if (index === examData.questions.length - 1) {
                saveButton.textContent = 'Complete Exam';
                saveButton.onclick = () => {
                    const modal = new bootstrap.Modal(document.getElementById('completionModal'));
                    modal.show();

                };
            } else {
                saveButton.textContent = 'Next';
                saveButton.onclick = () => {
                    saveQuestion(index);
                    showQuestion(index + 1);
                };
            }
        }

        function saveQuestion(index) {
            savedQuestions.add(index);
            updateQuestionState(index, 'saved');
            updateProgressBar();
        }

        function updateQuestionState(index, state) {
            const questionNumber = document.querySelector(`.question-number[data-index="${index}"]`);
            if (questionNumber) {
                questionNumber.classList.add(state);
            }
        }

        function updateProgressBar() {
            const totalQuestions = examData.questions.length;
            const progressPercentage = (savedQuestions.size / totalQuestions) * 100;
            const progressBar = document.getElementById('progress-bar');
            progressBar.style.width = `${progressPercentage}%`;
            progressBar.setAttribute('aria-valuenow', progressPercentage);
        }

        document.getElementById('confirm-completion').addEventListener('click', () => {
            window.location.href = '/home';
        });

        fetchExamData();
    </script>
</body>
</html>
