<x-app-layout>
    <div class="container py-5">
        <h1 class="mb-4">Danh Sách Bánh Mì</h1>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Form tìm kiếm -->
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('home') }}" method="GET" class="row g-3">
                    <div class="col-md-10">
                        <input type="text" 
                               name="search" 
                               class="form-control form-control-lg" 
                               placeholder="Tìm kiếm bánh mì theo tên hoặc mô tả..." 
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            🔍 Tìm kiếm
                        </button>
                    </div>
                    @if(request('search'))
                    <div class="col-12">
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm">
                            Xóa bộ lọc
                        </a>
                        <span class="text-muted ms-2">Kết quả tìm kiếm cho: <strong>"{{ request('search') }}"</strong></span>
                    </div>
                    @endif
                </form>
            </div>
        </div>

        @if($breads->count() > 0)
        <div class="row">
            @foreach($breads as $bread)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($bread->image_url)
                    <img src="{{ $bread->image_url }}" class="card-img-top" alt="{{ $bread->name }}" style="height: 200px; object-fit: cover;">
                    @else
                    <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
                        <span class="text-white">Không có ảnh</span>
                    </div>
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $bread->name }}</h5>
                        <p class="card-text">{{ Str::limit($bread->description, 100) }}</p>
                        <p class="text-danger fw-bold">{{ number_format($bread->price) }}</p>
                        <p class="text-muted small">Còn lại: {{ $bread->stock }}</p>
                    </div>

                    <div class="card-footer bg-white">
                        <a href="{{ route('bread.show', $bread->id) }}" class="btn btn-outline-primary btn-sm">Chi tiết</a>

                        @if($bread->stock > 0)
                        <form action="{{ route('cart.add', $bread->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary btm-sm">Thêm vào giỏ</button>
                        </form>
                        @else
                        <button class="btn btn-secondary btn-sm" disabled>Hết hàng</button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $breads->links() }}
        </div>
        @else
        <div class="alert alert-info text-center">
            <h5>Không tìm thấy bánh mì nào</h5>
            <p class="mb-0">
                @if(request('search'))
                    Không có kết quả nào phù hợp với từ khóa "<strong>{{ request('search') }}</strong>"
                @else
                    Hiện tại chưa có bánh mì nào trong cửa hàng.
                @endif
            </p>
            @if(request('search'))
            <a href="{{ route('home') }}" class="btn btn-primary mt-3">Xem tất cả bánh mì</a>
            @endif
        </div>
        @endif
    </div>
</x-app-layout>