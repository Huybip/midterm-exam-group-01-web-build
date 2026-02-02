<x-app-layout>
    <div class="container py-5">
        <h1 class="mb-4">Quản Trị Hệ Thống</h1>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5>Tổng đơn hàng</h5>
                        <h2>{{ $totalOrders }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5>Đơn chờ xử lý</h5>
                        <h2>{{ $pendingOrders }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5>Tổng sản phẩm</h5>
                        <h2>{{ $totalBreads }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <h5>Tổng người dùng</h5>
                        <h2>{{ $totalUsers }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Đơn hàng gần đây</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Mã</th>
                                        <th>Khách hàng</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentOrders as $order)
                                    <tr>
                                        <td>#{{ $order->id }}</td>
                                        <td>{{ $order->customer_name }}</td>
                                        <td>{{ number_format($order->total_amount) }}đ</td>
                                        <td>
                                            <span class="badge bg-warning">{{ $order->status }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Quản lý nhanh</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.breads.index') }}" class="btn btn-outline-primary">
                                📦 Quản lý bánh mì
                            </a>
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-success">
                                📋 Quản lý đơn hàng
                            </a>
                            <a href="{{ route('admin.breads.create') }}" class="btn btn-outline-info">
                                ➕ Thêm bánh mì mới
                            </a>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-warning">
                                👥 Quản lý người dùng
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>