@extends('layouts.index')
@section('content')
<div class="mb-1"></div>
<table id="datasiswa" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>No Handphone</th>
            <th>Email</th>
            <th>Total Peminjaman</th>
            <th>Denda</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($siswa as $s)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$s->nama}}</td>
                <td>{{$s->no_hp}}</td>
                <td>{{$s->email}}</td>
                <td><span class="badge badge-success">{{$s->total_pinjam}}</span></td>
                <td><span class="badge badge-info">Rp. {{$s->denda}}</span></td>
                <td>
                    <div class="row">
                        <div class="col-6 d-flex">
                            <a href="{{route('siswa.edit', $s->id)}}" class="btn btn-warning mx-auto"><i class="fa-solid fa-pencil"></i></a>
                        </div>
                        <div class="col-6 d-flex">
                            <form action="{{route('siswa.destroy', $s->id)}}" id="delete-siswa-form" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mx-auto delete-user"><i class="fa-solid fa-trash"></i></button>
                            </form>

                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-5"></div>

    @push('js')
        <script>
            $(document).ready(function () {
                $('#datasiswa').DataTable();
            });
        </script>
        <script>
            $('.delete-user').on('click', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Hapus Siswa ?',
                    text: "Semua data peminjaman pada siswa in juga akan terhapus !",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let element = $(this).parent();
                        element[0].submit();
                    }
                })

            });
        </script>
    @endpush
@endsection
