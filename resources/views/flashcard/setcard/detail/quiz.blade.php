<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Interface</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .question_mul {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-size: 24px;
            font-weight: bold;
        }

        .part_mul {
            cursor: pointer;
            background-color: white;
        }

        .part_mul:hover {
            border: 1px solid black;

        }

        .custom-btn {
            border: none;
            background-color: transparent;
            transition: background-color 0.3s ease;
        }

        .custom-btn:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }

        #previousButton,
        #nextButton {
            width: 50px;
            height: 50px;
        }

        #previousIcon,
        #nextIcon {
            font-size: 24px;
        }

        .btn-outline-custom {

            border-color: #d9dde8;
        }

        .selected {
            background-color: #28a745 !important;
            color: white !important;
        }
    </style>
</head>
<script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
<script>
    WebFont.load({
        google: {
            families: ["Public Sans:300,400,500,600,700"]
        },
        custom: {
            families: [
                "Font Awesome 5 Solid",
                "Font Awesome 5 Regular",
                "Font Awesome 5 Brands",
                "simple-line-icons",
            ],
            urls: ["{{ asset('assets/css/fonts.min.css') }}"],
        },
        active: function() {
            sessionStorage.fonts = true;
        },
    });
</script>

<body class="bg-light">

    <div class="container mt-5 pt-5 w-50">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title">{{ $setcard->title }}</h5>
            <a class="btn btn-outline-custom btn-sm" href="{{ route('setcard.show', $setcard->id) }}">
                <i class='bx bx-x'></i>
            </a>
        </div>

        <div class="question_mul text-center p-5 rounded bg-white mb-4 shadow">
            <!-- Question will be loaded here -->
        </div>

        <div class="row row-cols-2 g-3">
            <!-- Options will be loaded here -->
        </div>

        <div class="d-flex justify-content-center mt-4 gap-3">
            <button id="prev-btn" class="btn btn-outline-secondary btn-sm me-2">
                <i class="fas fa-arrow-left"></i>
            </button>

            <button id="next-btn" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-arrow-right"></i>
            </button>
        </div>

        <div class="mt-3">
            <div class="progress" style="height: 10px;">
                <div class="progress-bar bg-primary" id="progress-bar" style="width: 0%;"></div>
            </div>
        </div>
        <form id="test-form" method="POST" action="{{route('submit.test', $setcard->id)}}">
            @csrf
            <div class="d-flex justify-content-center mt-4">
                <input type="hidden" name="userAnswers" id="userAnswers">
                <input type="hidden" name="correctAnswers" id="correctAnswers">
                <button class="btn btn-pink px-4 text-white" id="submitButton" style="background-color: #e91e63;">Nộp
                    bài</button>
            </div>

        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const cards = @json($setcard->cards);
        let currentIndex = 0;
        let userAnswers = [];
        const questionElement = document.querySelector('.question_mul');
        const optionsContainer = document.querySelector('.row-cols-2');

        // Collect all answers from all cards
        const allAnswers = cards.map(card => card.answer);

        function shuffle(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
        }

        let shuffledAnswers = cards.map(card => {
            let answers = [card.answer, ...allAnswers.filter(answer => answer !== card.answer).slice(0, 3)];
            return shuffle(answers);
        });


        function loadQuestion(index) {
            const card = cards[index];
            questionElement.innerText = card.question;

            // Get the correct answer and shuffle all answers
            // Combine correct answer with incorrect answers and shuffle them
            let options = shuffledAnswers[index];

            optionsContainer.innerHTML = '';
            options.forEach((option, i) => {
                const optionElement = document.createElement('div');
                optionElement.classList.add('col');
                optionElement.innerHTML = `
                    <div class="part_mul d-flex align-items-center p-3 rounded shadow" onclick="selectAnswer('${option}', this)">
                        <span class="badge text-black me-3" style="background-color: #edeff4">${String.fromCharCode(65 + i)}</span>
                        <span>${option}</span>
                    </div>
                `;
                optionsContainer.appendChild(optionElement);
            });

            if (userAnswers[index]) {
                const selectedOption = Array.from(optionsContainer.children).find(child => child.textContent.includes(
                    userAnswers[index]));
                if (selectedOption) {
                    selectedOption.querySelector('.part_mul').classList.add('selected');
                }
            }


            document.getElementById('prev-btn').disabled = index === 0;
            document.getElementById('next-btn').disabled = index === cards.length - 1;

            updateProgress();
        }

        function updateProgress() {
            const progress = ((currentIndex + 1) / cards.length) * 100;
            document.getElementById('progress-bar').style.width = progress + "%";
        }

        function selectAnswer(answer, element) {
            userAnswers[currentIndex] = answer;
            const options = document.querySelectorAll('.part_mul');
            options.forEach(option => option.classList.remove('selected'));
            element.classList.add('selected');
            setTimeout(() => {
                if (currentIndex < cards.length - 1) {
                    currentIndex++;
                    loadQuestion(currentIndex);
                }
            }, 500);
        }

        function updateProgress() {
            const progress = ((currentIndex + 1) / cards.length) * 100;
            document.getElementById('progress-bar').style.width = progress + "%";
        }

        document.getElementById('prev-btn').addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                loadQuestion(currentIndex);
            }
        });

        document.getElementById('next-btn').addEventListener('click', () => {
            if (currentIndex < cards.length - 1) {
                currentIndex++;
                loadQuestion(currentIndex);
            }

        });

        document.getElementById('test-form').addEventListener('submit', function(e) {
            const isConfirmed = confirm('Bạn có chắc chắn muốn nộp bài không?');
            if (!isConfirmed) {
                e.preventDefault(); // Hủy bỏ việc gửi form
            }
            let correctAnswers = 0;
            cards.forEach((card, index) => {
                if (card.answer === userAnswers[index]) {
                    correctAnswers++;
                }
            });
            document.getElementById('userAnswers').value = JSON.stringify(
            userAnswers); // Biến mảng thành chuỗi JSON
            document.getElementById('correctAnswers').value = correctAnswers;
            document.getElementById('test-form').submit();

        });
        loadQuestion(currentIndex);
    </script>
</body>

</html>
