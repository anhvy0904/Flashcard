@extends('flashcard.data')
@section('css')
<style>
    /* Custom CSS */
    .perspective-1000 {
        perspective: 1000px;
    }

    .backface-hidden {
        backface-visibility: hidden;
    }

    .transform-style-preserve-3d {
        transform-style: preserve-3d;
    }

    .rotate-y-180 {
        transform: rotateY(180deg);
    }

    .flip .transform-style-preserve-3d {
        transform: rotateY(180deg);
    }

    .card-height {
        height: 20rem;
    }
</style>
@stop()
@section('homebody')
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="https://images.unsplash.com/photo-1526379095098-d400fd0bf935?w=50&h=50" alt="Logo" class="rounded-circle me-2" style="height: 40px; width: 40px;">
                <span class="text-primary fw-bold">SmartCards</span>
            </a>
            <div class="d-flex">
                <a href="#" class="btn btn-primary me-2">Create Card</a>
                <a href="#" class="btn btn-outline-secondary">Sign In</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container py-5">
        <div class="row g-4">
            <!-- Main Content Section -->
            <div class="col-lg-8">
                <!-- Flashcard Section -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title">Current Deck: Mathematics</h5>
                            <div>
                                <button class="btn btn-outline-secondary btn-sm me-2">
                                    <i class="bi bi-arrow-left"></i>
                                </button>
                                <button class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                        <div class="perspective-1000 card-height" onclick="this.classList.toggle('flip')">
                            <div class="position-relative w-100 h-100 transform-style-preserve-3d">
                                <div class="position-absolute w-100 h-100 bg-white rounded shadow border backface-hidden p-4">
                                    <h5 class="text-center">What is the derivative of x²?</h5>
                                    <p class="text-muted text-center">Click to flip</p>
                                </div>
                                <div class="position-absolute w-100 h-100 bg-light rounded shadow border backface-hidden rotate-y-180 p-4">
                                    <h5 class="text-center">2x</h5>
                                    <p class="text-muted text-center">Click to flip back</p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center gap-3 mt-4">
                            <button class="btn btn-danger">Need Review</button>
                            <button class="btn btn-success">Got It!</button>
                        </div>
                    </div>
                </div>
                <!-- Progress Section -->
                <div class="card shadow-sm">
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
                </div>
            </div>

            <!-- Sidebar Section -->
            <div class="col-lg-4">
                <!-- Study Modes -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Study Modes</h5>
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                                <span class="badge bg-primary rounded-circle me-3">F</span> Flip Cards
                            </a>
                            <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                                <span class="badge bg-secondary rounded-circle me-3">Q</span> Quiz Mode
                            </a>
                            <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                                <span class="badge bg-info rounded-circle me-3">S</span> Shuffle
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
                                <div class="bg-warning rounded-circle mx-auto mb-2" style="width: 50px; height: 50px;"></div>
                                <p class="text-muted">Expert</p>
                            </div>
                            <div class="col-4">
                                <div class="bg-success rounded-circle mx-auto mb-2" style="width: 50px; height: 50px;"></div>
                                <p class="text-muted">Streak</p>
                            </div>
                            <div class="col-4">
                                <div class="bg-info rounded-circle mx-auto mb-2" style="width: 50px; height: 50px;"></div>
                                <p class="text-muted">Speed</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
@stop()