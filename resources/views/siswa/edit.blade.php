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
            <form action="{{route('siswa.update', $siswa->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-header">
                    <h4>Edit Siswa</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control {{isset($submited) ? $errors->has('nama') ? "is-invalid" : "is-valid" : ""}}" name="nama" value="{{isset($submited) ? old('nama') : $siswa->nama}}">
                        @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control {{isset($submited) ? $errors->has('email') ? "is-invalid" : "is-valid" : ""}}" name="email" value="{{isset($submited) ? old('email') : $siswa->email}}">
                        @error('email')
                            <div class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Nomor Handphone</label>
                        <input type="number" class="form-control {{isset($submited) ? $errors->has('no_hp') ? "is-invalid" : "is-valid" : ""}}" name="no_hp" value="{{isset($submited) ? old('no_hp') : $siswa->no_hp}}">
                        @error('no_hp')
                            <div class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-warning edit-siswa" type="submit">Edit</button>
                    <a href="{{route('siswa.index')}}" class="btn btn-primary">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
        <script>
            $('.edit-siswa').on('click', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Update Data?',
                    text: "Data yang anda rubah akan terubah !",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Update'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let element = $(this).parent().parent();
                        element[0].submit();
                    }
                })

            });
        </script>
    @endpush
@endsection
