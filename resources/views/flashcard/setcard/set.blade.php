@extends('flashcard.data')
@section('css')
<style>
    /* Thiết kế Set Flashcard */
    .set-card {
        border: 1px solid #ccc;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .set-card:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .set-card img {
        height: 150px;
        object-fit: cover;
    }

    .set-card .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    .no-set {
        color: #888;
        text-align: center;
        font-size: 1.2rem;
        margin-top: 2rem;
    }
</style>
@stop()
@section('homebody')
<body>
    <div class="container py-5">
        <h1 class="text-center mb-4">Thư viện Flashcard</h1>
    
        <!-- Nút tạo mới -->
        <div class="text-center mb-4">
            <a href="#" class="btn btn-primary">+ Tạo mới Set Flashcard</a>
        </div>
    
        <!-- Danh sách Set -->
        <div id="setList" class="row g-4">
            <!-- Nếu không có Set, sẽ hiển thị thông báo -->
            <!-- Thay nội dung trong JavaScript -->
        </div>
    </div>
    
    <script>
        // Dữ liệu mẫu: Danh sách các set flashcard
        const sets = [
            {
                title: "Lập trình Java cơ bản",
                description: "Khóa học giúp bạn nắm vững các kiến thức cơ bản về Java.",
                image: "https://via.placeholder.com/300x150"
            },
            {
                title: "Lập trình Web",
                description: "Tìm hiểu cách xây dựng website bằng HTML, CSS và JavaScript.",
                image: "https://via.placeholder.com/300x150"
            }
            // Thêm dữ liệu mới nếu cần
        ];
    
        // Lấy phần tử setList
        const setList = document.getElementById('setList');
    
        if (sets.length > 0) {
            // Hiển thị các set flashcard
            sets.forEach(set => {
                const setCard = `
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="set-card card h-100">
                            <img src="${set.image}" alt="${set.title}" class="card-img-top">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-truncate">${set.title}</h5>
                                <p class="card-text text-truncate">${set.description}</p>
                                <a href="#" class="btn btn-primary mt-auto">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                `;
                setList.insertAdjacentHTML('beforeend', setCard);
            });
        } else {
            // Hiển thị thông báo khi không có set flashcard
            setList.innerHTML = `
                <div class="no-set">
                    Bạn chưa có set flashcard nào cả. Hãy thử tạo ngay!
                    <br>
                    <a href="#" class="btn btn-secondary mt-3">+ Tạo mới Set Flashcard</a>
                </div>
            `;
        }
    </script>


</body>
@stop()