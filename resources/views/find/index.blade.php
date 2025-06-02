@extends('layouts.app')

@section('title', 'Pencarian Inventory')

@section('content')
    <div class="pc-content">
        <div class="page-header m-0">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><span>Find</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row pt-2">
            <div class="col-md-12">
                <h4 class="mb-3">Find</h4>
                <div class="card">
                    <div class="card-header">
                        <form action="{{ route('find.search') }}" method="GET">
                            <div class="input-group" style="max-width: 400px;">
                                <input type="text" name="q" class="form-control" value="{{ request('q') }}" placeholder="cari">
                                <button class="btn btn-outline-primary" type="submit">Search</button>
                            </div>
                        </form>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover text-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Kode Unik</th>
                                        <th>Nama Barang</th>
                                        <th>Barang dari</th>
                                        <th>Masuk</th>
                                        <th>Keluar</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($query) && $query !== '')
                                        @forelse ($results as $item)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $item->code }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->location->name ?? '-' }}</td>
                                                <td>{{ $item->date_in ? $item->date_in->format('d-m-Y') : '-' }}</td>
                                                <td>{{ $item->date_out ? $item->date_out->format('d-m-Y') : '-' }}</td>
                                                <td>
                                                    @php
                                                        $status = [
                                                            'received' => ['text' => 'Received', 'color' => 'secondary'],
                                                            'on_progress' => ['text' => 'On Progress', 'color' => 'warning'],
                                                            'done' => ['text' => 'Done', 'color' => 'success'],
                                                            'returned' => ['text' => 'Returned', 'color' => 'info'],
                                                            'broken' => ['text' => 'Broken', 'color' => 'danger']
                                                        ][$item->status] ?? ['text' => $item->status, 'color' => 'light'];
                                                    @endphp
                                                    <span class="badge bg-{{ $status['color'] }}">{{ $status['text'] }}</span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">Data tidak ditemukan</td>
                                            </tr>
                                        @endforelse
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
