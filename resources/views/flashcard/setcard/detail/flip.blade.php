@extends('flashcard.data')
@section('css')
    <style>
        /* Custom CSS */
        .perspective-1000 {
            perspective: 1000px;
            /* Tạo hiệu ứng 3D */
        }

        .transform-style-preserve-3d {
            transform-style: preserve-3d;
            /* Giữ không gian 3D */
            transition: transform 0.6s;
            /* Tạo hiệu ứng chuyển động mượt */
        }

        .backface-hidden {
            backface-visibility: hidden;
            /* Ẩn mặt sau khi không hiển thị */
        }

        .rotate-y-180 {
            transform: rotateY(180deg);
            /* Xoay mặt sau */
        }

        .flip .transform-style-preserve-3d {
            transform: rotateY(180deg);
            /* Lật thẻ khi thêm class flip */
        }

        .card-height {
            height: 20rem;
            /* Chiều cao cố định của thẻ */
        }
    </style>

@stop()
@section('homebody')

    <body class="bg-light">
        <!-- Main Content -->
        <main class="container py-5">
            <div class="row g-4">
                <!-- Main Content Section -->
                <div class="col-lg-8">
                    <!-- Flashcard Section -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="card-title">{{ $setcard->title }}</h5>
                                <div>
                                    <button id="prev-btn" class="btn btn-outline-secondary btn-sm me-2">
                                        <i class="fas fa-arrow-left"></i>
                                    </button>
                                    <span id="progress"></span>
                                    <button id="next-btn" class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                            <div id='flashcard-container' class="perspective-1000 card-height" onclick="toggleFlip()">
                                <div class="position-relative w-100 h-100 transform-style-preserve-3d">
                                    <!-- Mặt trước -->
                                    <div id="front"
                                        class="position-absolute w-100 h-100 bg-white rounded shadow border backface-hidden p-4 d-flex flex-column justify-content-center align-items-center">
                                        <h5 class="text-center"></h5>
                                        <p class="text-muted text-center">Click to flip</p>
                                    </div>
                                    <!-- Mặt sau -->
                                    <div id="back"
                                        class="position-absolute w-100 h-100 bg-light rounded shadow border backface-hidden rotate-y-180 p-4 d-flex flex-column justify-content-center align-items-center">
                                        <h5 class="text-center"></h5>
                                        <p class="text-muted text-center">Click to flip back</p>
                                    </div>
                                </div>
                            </div>


                            <div class="d-flex justify-content-center gap-3 mt-4">
                                <button class="btn btn-danger">Need Review</button>
                                <button class="btn btn-success">Got It!</button>
                            </div>

                            <div class="progress-container">
                                <h5>Study Progress</h5>
                                <div class="progress">
                                    <div id="progress-bar" class="progress-bar bg-primary" style="width: 0%;"></div>
                                </div>
                                <div class="d-flex justify-content-between text-muted">
                                    <span id="progress-percentage">0% Complete</span>
                                    <span id="progress-count">0/0 Cards</span>
                                </div>
                            </div>

                        </div>
                        <!-- Comment Section -->
                        
                    </div>
                    <div class="comment-section mt-4">
                        <h5>Comments</h5>
                    
                        <!-- Loop through existing comments -->
                        @foreach($setcard->comments as $comment)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-title">{{ $comment->user->username }}</h6>
                                    <p class="card-text">{{ $comment->comment }}</p>
                                    <p class="text-muted"><small>{{ $comment->created_at->diffForHumans() }}</small></p>
                                </div>
                            </div>
                        @endforeach
                    
                        <!-- Add New Comment -->
                        <form id="comment-form">
                            @csrf
                            <div class="mb-3">
                                <textarea name="comment" class="form-control" rows="3" placeholder="Leave a comment..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Post Comment</button>
                        </form>
                    </div>
                    <!-- Progress Section -->
                    {{-- <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Study Progress</h5>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-primary" style="width: 75%"></div>
                        </div>
                        <div class="d-flex justify-content-between text-muted">
                            <span>75% Complete</span>
                            <span>15/20 Cards</span>
                        </div>
                    </div>
                </div> --}}
                </div>

                <!-- Sidebar Section -->
                <div class="col-lg-4">
                    <!-- Study Modes -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Chế độ học</h5>
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                                    <span class="badge bg-primary rounded-circle me-3">F</span> Chế độ lật thẻ
                                </a>
                                <a href="{{ route('setcard.show', $setCard->id) }}?checkmode=quiz" class="list-group-item list-group-item-action d-flex align-items-center">
                                    <span class="badge bg-secondary rounded-circle me-3">Q</span> Chế độ trắc nghiệm
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Categories -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Categories</h5>
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action active">Mathematics</a>
                                <a href="#" class="list-group-item list-group-item-action">Science</a>
                                <a href="#" class="list-group-item list-group-item-action">History</a>
                                <a href="#" class="list-group-item list-group-item-action">Languages</a>
                            </div>
                        </div>
                    </div>
                    <!-- Achievements -->
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Achievements</h5>
                            <div class="row text-center">
                                <div class="col-4">
                                    <div class="bg-warning rounded-circle mx-auto mb-2" style="width: 50px; height: 50px;">
                                    </div>
                                    <p class="text-muted">Expert</p>
                                </div>
                                <div class="col-4">
                                    <div class="bg-success rounded-circle mx-auto mb-2" style="width: 50px; height: 50px;">
                                    </div>
                                    <p class="text-muted">Streak</p>
                                </div>
                                <div class="col-4">
                                    <div class="bg-info rounded-circle mx-auto mb-2" style="width: 50px; height: 50px;">
                                    </div>
                                    <p class="text-muted">Speed</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <script>
            const cards = @json($setcard->cards);
            

            let currentIndex = 0;

            const frontdata = document.getElementById('front').querySelector('h5');
            const backdata = document.getElementById('back').querySelector('h5');
            const prebtn = document.getElementById('prev-btn');
            const nextbtn = document.getElementById('next-btn');
            const progress = document.getElementById('progress');
            const progressBar = document.getElementById("progress-bar");
            const progressPercentage = document.getElementById("progress-percentage");
            const progressCount = document.getElementById("progress-count");

            function updateProgress() {
                const progress = ((currentIndex + 1) / cards.length) * 100;
                progressBar.style.width = progress + "%";
                progressPercentage.innerText = `${Math.round(progress)}% Complete`;
                progressCount.innerText = `${currentIndex + 1}/${cards.length} Cards`;
            }

            function loadCard(index) {
                frontdata.innerText = cards[index].question;
                backdata.innerText = cards[index].answer;

                prebtn.disabled = index === 0;
                nextbtn.disabled = index === cards.length - 1;

                updateProgress();
            }

            function toggleFlip() {
                document.getElementById('flashcard-container').classList.toggle('flip');
            }

            prebtn.addEventListener("click", () => {
                if (currentIndex > 0) {
                    currentIndex--;
                    loadCard(currentIndex);
                }
            });

            nextbtn.addEventListener("click", () => {
                if (currentIndex < cards.length - 1) {
                    currentIndex++;
                    loadCard(currentIndex);
                }
            });

            loadCard(currentIndex);
        </script>
    </body>
@stop()
