<x-app-layout>
    <div class="container py-5">
        <h1 class="mb-4">Đặt Hàng</h1>
        
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h5>Thông tin giao hàng</h5>
                        <small class="text-muted">
                            💰 Thanh toán khi nhận hàng (COD) - Phù hợp phạm vi đồ án
                        </small>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('order.store') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label class="form-label">Họ tên *</label>
                                <input type="text" name="customer_name" class="form-control" 
                                       value="{{ auth()->user()->name ?? old('customer_name') }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Số điện thoại *</label>
                                <input type="text" name="customer_phone" class="form-control" 
                                       value="{{ auth()->user()->phone ?? old('customer_phone') }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Địa chỉ giao hàng *</label>
                                <textarea name="customer_address" class="form-control" rows="3" required>{{ auth()->user()->address ?? old('customer_address') }}</textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Ghi chú (tùy chọn)</label>
                                <textarea name="note" class="form-control" rows="2">{{ old('note') }}</textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-success btn-lg w-100">
                                Đặt hàng (COD)
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h5>Đơn hàng của bạn</h5>
                    </div>
                    <div class="card-body">
                        @foreach($cart as $item)
                            <div class="d-flex justify-content-between mb-2">
                                <span>{{ $item['name'] }} x {{ $item['quantity'] }}</span>
                                <span>{{ number_format($item['price'] * $item['quantity']) }} đ</span>
                            </div>
                        @endforeach
                        
                        <hr>
                        
                        <div class="d-flex justify-content-between">
                            <strong>Tổng cộng:</strong>
                            <strong class="text-danger fs-5">{{ number_format($total) }} đ</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>