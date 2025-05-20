@extends('layouts.app')

@section('title', 'Data Inventory')

@section('content')
    <div class="pc-content">
        <div class="page-header m-0">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><span>Data Inventory</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-2">
            <div class="col-md-12">
                <h4 class="mb-3">Data Inventory</h4>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        {!! session('success') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header ">
                        <form action="" method="get">
                            <div class="row align-items-center">
                                <div class="col-md-3 mb-3 mb-md-0">
                                    <div class="input-group">
                                        <input type="search" class="form-control" placeholder="Cari" name="search" value="{{ $search }}">
                                    </div>
                                </div>
                                <div class="col-md-2 mb-3 mb-md-0">
                                    <div class="input-group">
                                        <select name="location_id" class="form-control">
                                            <option value="">Semua Lokasi</option>
                                            @foreach ($locations as $location)
                                                <option value="{{ $location->id }}" {{ $location_id == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <div class="input-group">
                                        <input type="text" placeholder="Dari" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control" name="start_date" value="{{ $start }}">
                                        <input type="text" placeholder="Sampai" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control" name="end_date" value="{{ $end }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="btn-group float-start float-md-end" role="group" aria-label="Basic example">
                                        <button class="btn btn-outline-primary" type="submit">Filter</button>
                                        <a href="{{ route('inventories.print', ['start_date' => $start, 'end_date' => $end]) }}" class="btn btn-outline-primary">Print</a>
                                        <a href="{{ route('inventories.create') }}" class="btn btn-primary">Tambah</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
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
                                        <th>Keluar</th>
                                        <th>Status</th>
                                        <th class="text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inventories as $inventory)
                                        <tr>
                                            <td class="text-center">{{ ($inventories->currentPage() - 1) * $inventories->perPage() + $loop->iteration }}</td>
                                            <td>{{ $inventory->code }}</td>
                                            <td>{{ $inventory->name }}</td>
                                            <td>{{ $inventory->location->name }}</td>
                                            <td>{{ $inventory->date_in->format('d-m-Y') }}</td>
                                            <td>{{ $inventory->date_out ? $inventory->date_out->format('d-m-Y') : '-' }}</td>
                                            <td>
                                                @php
                                                    $status = [
                                                        'received' => ['text' => 'Received', 'color' => 'secondary'],
                                                        'on_progress' => ['text' => 'On Progress', 'color' => 'warning'],
                                                        'done' => ['text' => 'Done', 'color' => 'success'],
                                                        'returned' => ['text' => 'Returned', 'color' => 'info'],
                                                        'broken' => ['text' => 'Broken', 'color' => 'danger']
                                                    ][$inventory->status];
                                                @endphp
                                                <span class="badge bg-{{ $status['color'] }}">{{ $status['text'] }}</span>
                                            </td>
                                            <td class="text-end">
                                                <a href="{{ route('inventories.edit', $inventory->id) }}" class="btn btn-sm btn-warning">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                <form action="{{ route('inventories.destroy', $inventory->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">{{ $inventories->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
