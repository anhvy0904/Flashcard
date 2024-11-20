@extends('flashcard.data')
@section('homebody')
    <div class="container py-5">
        <h1 class="text-center mb-4">Thêm Set Flashcard</h1>
        <form action="{{ route('setcards.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Tiêu đề Set -->
            <div class="mb-3">
                <label for="setTitle" class="form-label">Tiêu đề của Set</label>
                <input type="text" class="form-control" id="setTitle" name="setTitle" placeholder="Nhập tiêu đề cho set" required>
            </div>
    
            <!-- Mô tả -->
            <div class="mb-3">
                <label for="setDescription" class="form-label">Mô tả</label>
                <textarea class="form-control" id="setDescription" name="setDescription" rows="3" placeholder="Nhập mô tả"></textarea>
            </div>
    
            <!-- Hình ảnh Set -->
            <div class="mb-3">
                <label for="setImage" class="form-label">Hình ảnh Set</label>
                <input type="file" class="form-control" id="setImage" name="setImage" accept="image/*">
                <div class="image-preview mt-3" id="imagePreview">
                    <span>Chưa chọn hình ảnh</span>
                </div>
            </div>
    
            <!-- Danh sách câu hỏi -->
            <h3 class="mt-4">Câu hỏi và câu trả lời</h3>
            <div id="questionList">
                <!-- Một câu hỏi mẫu -->
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="questions[0][question]" class="form-label">Câu hỏi</label>
                            <input type="text" class="form-control" id="questions[0][question]" name="questions[0][question]" placeholder="Nhập câu hỏi" required>
                        </div>
                        <div class="mb-3">
                            <label for="questions[0][answer]" class="form-label">Câu trả lời</label>
                            <textarea class="form-control" id="questions[0][answer]" name="questions[0][answer]" rows="2" placeholder="Nhập câu trả lời" required></textarea>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Nút thêm câu hỏi -->
            <button type="button" class="btn btn-secondary mb-4" id="addQuestion">+ Thêm câu hỏi</button>
    
            <!-- Nút lưu -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
    </div>
    
    <script>
        // Thêm tính năng xem trước hình ảnh
        document.getElementById('setImage').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview');
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.innerHTML = `<img src="${e.target.result}" alt="Hình ảnh set" class="img-fluid">`;
                };
                reader.readAsDataURL(file);
            } else {
                preview.innerHTML = '<span>Chưa chọn hình ảnh</span>';
            }
        });
    
        // Thêm câu hỏi mới
        document.getElementById('addQuestion').addEventListener('click', function () {
            const questionCount = document.querySelectorAll('#questionList .card').length;
            const questionHtml = `
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="questions[${questionCount}][question]" class="form-label">Câu hỏi</label>
                            <input type="text" class="form-control" id="questions[${questionCount}][question]" name="questions[${questionCount}][question]" placeholder="Nhập câu hỏi" required>
                        </div>
                        <div class="mb-3">
                            <label for="questions[${questionCount}][answer]" class="form-label">Câu trả lời</label>
                            <textarea class="form-control" id="questions[${questionCount}][answer]" name="questions[${questionCount}][answer]" rows="2" placeholder="Nhập câu trả lời" required></textarea>
                        </div>
                    </div>
                </div>`;
            document.getElementById('questionList').insertAdjacentHTML('beforeend', questionHtml);
        });
    </script>
@stop()