@extends('layouts.index')
@section('content')

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>Data Buku</h4>
                <button class="btn btn-primary float-end" data-toggle="modal" data-target="#modalAddBuku"
                data-backdrop="static" data-keyboard="false">Tambah Buku</button>
            </div>
            <div class="card-body">
                <table id="databuku" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>No ISBN</th>
                            <th>Ketersediaan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($buku as $b)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$b->judul}}</td>
                                <td>ISBN {{$b->no_isbn}}</td>
                                <td><span class="badge badge-info">{{$b->stok}}</span> Buku</td>
                                <td>
                                    <div class="row justify-content-center">
                                        <div class="col-4">
                                            <button class="btn btn-success btn-detail-buku" data-id="{{$b->id}}"><i class="fa-solid fa-eye"></i></button>
                                        </div>
                                        <div class="col-4">
                                            <button class="btn btn-warning btn-edit-buku" data-id="{{$b->id}}" data-toggle="modal" data-target="#modalEditBuku"
                                            data-backdrop="static" data-keyboard="false"><i class="fa-solid fa-pencil"></i></button>
                                        </div>
                                        <div class="col-4">
                                            <form action="{{route('buku.destroy', $b->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-delete-buku"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4 detail-buku" style="display: none">
        <div class="card">
            <div class="card-header">
                <h4>Detail Buku</h4>
            </div>
            <div class="card-body pt-0">
                <div class="form-group mb-1 ">
                    <div class="d-flex justify-content-center">
                        <div class="image-preview" style="width: 200px; height: 250px;">
                            <img class="cover-img-detail" style="width: 100%; height: 100%;">
                        </div>
                    </div>
                </div>
                <div class="form-group mb-1">
                    <label>Judul</label>
                    <input type="text" class="form-control" name="judul_detail" readonly>
                </div>
                <div class="form-group mb-1">
                    <label>No ISBN</label>
                    <input type="text" class="form-control" name="no_isbn_detail" readonly>
                </div>
                <div class="form-group mb-1">
                    <label>Pengarang</label>
                    <input type="text" class="form-control" name="pengarang_detail" readonly>
                </div>
                <div class="form-group mb-1">
                    <label>Penerbit</label>
                    <input type="text" class="form-control" name="penerbit_detail" readonly>
                </div>
                <div class="form-group mb-1">
                    <label>Halaman</label>
                    <input type="text" class="form-control" name="halaman_detail" readonly>
                </div>
                <div class="form-group mb-1">
                    <label>Ketersediaan</label>
                    <input type="text" class="form-control" name="stok_detail" readonly>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- Modal Tambah Buku --}}
<div class="modal fade" id="modalAddBuku" tabindex="-1" role="dialog" aria-labelledby="modalAddBukuTitle"
        aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="modalAddBukuTitle">Tambah Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('buku.store')}}" class="tambah-buku" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-1">
                            <label>Judul Buku</label>
                            <input type="text" class="form-control" name="judul">
                        </div>
                        <div class="form-group mb-1">
                            <label>No ISBN</label>
                            <input type="text" class="form-control" name="no_isbn">
                        </div>
                        <div class="form-group mb-1">
                            <label>Pengarang</label>
                            <input type="text" class="form-control" name="pengarang">
                        </div>
                        <div class="form-group mb-1">
                            <label>Halaman</label>
                            <input type="text" class="form-control" name="halaman">
                        </div>
                        <div class="form-group mb-1 ">
                            <label>Cover</label>
                            <div class="d-flex justify-content-center">
                                <div class="image-preview" style="width: 200px; height: 250px;">
                                    <input type="file" name="gambar" onchange="imgPreview(event)" />
                                    <img class="cover-img" style="width: 100%; height: 100%;">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-1">
                            <label>Penerbit</label>
                            <input type="text" class="form-control" name="penerbit">
                        </div>
                        <div class="form-group mb-1">
                            <label>Ketersediaan</label>
                            <input type="text" class="form-control" name="stok">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-tambah-buku">Tambah Buku</button>
                </div>
            </div>
    </div>
</div>

{{-- Modal Edit Buku --}}
<div class="modal fade" id="modalEditBuku" tabindex="-1" role="dialog" aria-labelledby="modalEditBukuTitle"
        aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="modalEditBukuTitle">Edit Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="edit-buku" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" id="type-method-update">
                        <div class="form-group mb-1">
                            <label>Judul Buku</label>
                            <input type="text" class="form-control" name="judul">
                        </div>
                        <div class="form-group mb-1">
                            <label>No ISBN</label>
                            <input type="text" class="form-control" name="no_isbn">
                        </div>
                        <div class="form-group mb-1">
                            <label>Pengarang</label>
                            <input type="text" class="form-control" name="pengarang">
                        </div>
                        <div class="form-group mb-1">
                            <label>Halaman</label>
                            <input type="text" class="form-control" name="halaman">
                        </div>
                        <div class="form-group mb-1 ">
                            <label>Cover</label>
                            <div class="d-flex justify-content-center">
                                <div class="image-preview" style="width: 200px; height: 250px;">
                                    <input type="file" name="gambar" onchange="imgPreview(event)" />
                                    <img class="cover-img-edit" style="width: 100%; height: 100%;">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-1">
                            <label>Penerbit</label>
                            <input type="text" class="form-control" name="penerbit">
                        </div>
                        <div class="form-group mb-1">
                            <label>Ketersediaan</label>
                            <input type="text" class="form-control" name="stok">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-update-buku">Update Buku</button>
                </div>
            </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function () {
            $('#databuku').DataTable();
            $("#modalAddBuku").appendTo("body");
            $("#modalEditBuku").appendTo("body");
        });

        let imgPreview = function (e) {
            let file = e.target.files[0];
            var output = document.querySelector(
                `.${e.target.nextElementSibling.className}`
            );
            if (file) {
                let reader = new FileReader();
                reader.onload = function () {
                    output.src = reader.result;
                };
                reader.readAsDataURL(e.target.files[0]);
                output.style.display = "block";
                return;
            }
            output.style.display = "none"; //hide img tag to none if no file choosen
        };
    </script>

    {{-- Validate form add buku --}}

    <script>
        $('.btn-tambah-buku').click(function (e) {
            e.preventDefault();
            let formdata = new FormData($('.tambah-buku')[0]);

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:'POST',
                url: "{{ route('buku.validate.add') }}",
                data: formdata,
                contentType: false,
                processData: false,
                success: (response) => {
                    if (response['is-valid'] === true) {
                        $('.tambah-buku').submit();
                    }
                },
                error: function(response){
                    let errors = response.responseJSON.errors;

                    $("input").removeClass("is-invalid");
                    $("input").addClass("is-valid");
                    $(".invalid-feedback").remove();
                    $("input[type=search]").removeClass("is-valid");

                    $.each(errors, function (fieldName, errorBag) {
                        let ele = `input[name=${fieldName}]`;
                        $(ele).addClass('is-invalid');

                        let msg = `
                            <span class="invalid-feedback" role="alert">
                                <strong>${errorBag}</strong>
                            </span>
                        `;
                        $( msg ).insertAfter( ele );
                    });
                }
            });
        })
    </script>


    <script>
        $('.btn-detail-buku').click(function() {
            $('.detail-buku').show();
            let id = $(this).data("id");

            $.ajax({
                url: `${window.location.href}/${id}`,
                type: "GET",
                success: (response) => {
                    // show cover img
                    let srcimg = "{{ asset('img_book') }}/" + response.gambar;
                    $('.cover-img-detail').attr('src', srcimg);

                    // show detail
                    $.each(response, function (key, value) {
                        let ele = `input[name=${key}_detail]`;
                        $(ele).val(value);
                    });
                },
                error: (error) => {
                    alert('Cannot get Detail Buku')
                }
            })
        })
    </script>

    {{-- Get data value modal edit --}}
    <script>
        $('.btn-edit-buku').click(function() {
            let id = $(this).data("id");
            $('.edit-buku').attr('action', `${window.location.href}/${id}`)
            $.ajax({
                url: `${window.location.href}/${id}/edit`,
                type: "GET",
                success: (response) => {
                    // show cover img
                    let srcimg = "{{ asset('img_book') }}/" + response.gambar;
                    $('.cover-img-edit').attr('src', srcimg);

                    // show old value
                    $.each(response, function (key, value) {
                        let ele = `input[name=${key}]`;
                        $(ele).val(value);
                    });
                },
                error: (error) => {
                    alert('Cannot get Detail Buku')
                }
            })
        })
    </script>

    {{-- Update buku button on click --}}
    <script>
        $('.btn-update-buku').click(function () {
            let formdata = new FormData($('.edit-buku')[0]);

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('buku.validate.edit') }}",
                type: 'POST',
                data: formdata,
                contentType: false,
                processData: false,
                success: (response) => {
                    $('#type-method-update').val('PUT');
                    $('.edit-buku').submit();
                },
                error: function(response){
                    let errors = response.responseJSON.errors;

                    $("input").removeClass("is-invalid");
                    $("input").addClass("is-valid");
                    $(".invalid-feedback").remove();
                    $("input[type=search]").removeClass("is-valid");

                    $.each(errors, function (fieldName, errorBag) {
                        let ele = `input[name=${fieldName}]`;
                        $(ele).addClass('is-invalid');

                        let msg = `
                            <span class="invalid-feedback" role="alert">
                                <strong>${errorBag}</strong>
                            </span>
                        `;
                        $( msg ).insertAfter( ele );
                    });
                }
            });
            console.log(formdata);
        })
    </script>

    <script>
        $('.btn-delete-buku').on('click', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Hapus Data ?',
                    text: "Data yang dihapus tidak bisa dikembalikan !",
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

    {{-- Reset all field when closing modal --}}
    <script>
        $('#modalEditBuku').on('hidden.bs.modal', function (e) {
            $('#modalAddBuku')
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
            $("input").removeClass("is-invalid");
            $("input").removeClass("is-valid");
            $(".invalid-feedback").remove();
            $("input[type=search]").removeClass("is-valid");
        })

        $('#modalAddBuku').on('hidden.bs.modal', function (e) {
            $('#modalAddBuku')
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
            $("input").removeClass("is-invalid");
            $("input").removeClass("is-valid");
            $(".invalid-feedback").remove();
            $("input[type=search]").removeClass("is-valid");
        })

    </script>
@endpush

@endsection
