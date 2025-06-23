@extends('layouts.app')

@section('title', 'Notifikasi')

@section('content')
    <div class="pc-content">
        <div class="page-header m-0">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><span>Notifikasi</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-2">
            <div class="col-md-12">
                <h4 class="mb-3">Notifikasi</h4>
                <div class="card">
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table table-hover text-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Kode Unik</th>
                                        <th>Nama Barang</th>
                                        <th>Barang dari</th>
                                        <th>Masuk</th>
                                        <th>Status barang</th>
                                        <th>Dibaca</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($notifications as $notification)
                                        <tr>
                                            <td class="text-center">{{ ($notifications->currentPage() - 1) * $notifications->perPage() + $loop->iteration }}</td>
                                            <td>{{ $notification->inventory->code }}</td>
                                            <td>{{ $notification->inventory->name }}</td>
                                            <td>{{ $notification->inventory->location->name }}</td>
                                            <td>{{ $notification->inventory->date_in->format('d-m-Y') }}</td>
                                            <td>
                                                @php
                                                    $status = [
                                                        'received' => ['text' => 'Masuk', 'color' => 'secondary'],
                                                        'on_progress' => ['text' => 'Dalam Progres', 'color' => 'warning'],
                                                        'done' => ['text' => 'Selesai', 'color' => 'success'],
                                                        'returned' => ['text' => 'Dikembalikan', 'color' => 'info'],
                                                        'broken' => ['text' => 'Rusak', 'color' => 'danger']
                                                    ][$notification->inventory->status];
                                                @endphp
                                                <span class="badge bg-{{ $status['color'] }}">{{ $status['text'] }}</span>
                                            </td>
                                            <td>{{ $notification->is_read ? 'Sudah' : 'Belum' }}</td>
                                            <td class="text-center">
                                                <form action="{{ route('notifications.update', $notification->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-sm btn-primary">
                                                        <i class="ti ti-eye"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">{{ $notifications->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
