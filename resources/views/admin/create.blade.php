@extends('layouts.app')

@section('title', 'Tambah Data')

@section('content')
    <div class="pc-content">
        <div class="page-header m-0">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('location.index') }}">Data Lokasi</a></li>
                            <li class="breadcrumb-item"><span>Tambah Data</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3 align-items-center pt-2">
            <div class="col-md-4">
                <h4 class="mb-3 mb-md-0">Tambah Data</h4>
            </div>
            <div class="col-md-8">
                <div class="float-start float-md-end">
                    <a href="" class="btn btn-outline-secondary me-2">Kembali</a>
                    <button type="submit" form="form-tambah" class="btn btn-primary">Tambah</button>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="" method="post" id="form-tambah">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="search" class="form-control @error('name') is-invalid @enderror"
                            placeholder="Ex: Stasiun Rejosari" aria-label="Nama" aria-describedby="button-addon2"
                            name="name" value="">
                        @error('name')
                            <small class="text-danger mt-1" role="alert">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('name') is-invalid @enderror"
                            placeholder="Ex: abc@gmail.com" aria-label="Email" aria-describedby="button-addon2"
                            name="name" value="">
                        @error('name')
                            <small class="text-danger mt-1" role="alert">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div >
                        <label class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control @error('name') is-invalid @enderror"
                            placeholder="Ex: 123Stasiun" aria-label="Nama" aria-describedby="button-addon2"
                            name="name" value="">
                        @error('name')
                            <small class="text-danger mt-1" role="alert">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
