@extends('layouts.index')
@section('content')
@if (count($errors) > 0)
   @php
       $submited = true;
   @endphp
@endif
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <form action="{{route('siswa.store')}}" method="POST">
                @csrf
                <div class="card-header">
                    <h4>Tambah Siswa</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control {{isset($submited) ? $errors->has('nama') ? "is-invalid" : "is-valid" : ""}}" name="nama" value="{{old('nama')}}">
                        @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control {{isset($submited) ? $errors->has('email') ? "is-invalid" : "is-valid" : ""}}" name="email" value="{{old('email')}}">
                        @error('email')
                            <div class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Nomor Handphone</label>
                        <input type="number" class="form-control {{isset($submited) ? $errors->has('no_hp') ? "is-invalid" : "is-valid" : ""}}" name="no_hp" value="{{old('no_hp')}}">
                        @error('no_hp')
                            <div class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary" type="submit">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
