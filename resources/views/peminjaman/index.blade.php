@extends('layouts.index')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="tabPeminjaman" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="peminjaman-tab5" data-toggle="tab" href="#peminjaman" role="tab"
                                aria-controls="peminjaman" aria-selected="true">
                                <i class="fas fa-file-lines"></i> Peminjaman Baru </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="data-peminjaman-tab5" data-toggle="tab" href="#data-peminjaman" role="tab" aria-controls="data-peminjaman"
                                aria-selected="false">
                                <i class="fas fa-clock-rotate-left"></i> Data Peminjaman</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="tabPeminjamanContent">
                        @include('peminjaman.tabs.tabpeminjaman')
                        @include('peminjaman.tabs.tabdatapeminjaman')
                    </div>
                </div>
            </div>
        </div>
    </div>

@push('js')
    <script>
        $(document).ready(function () {
            $(".choose-siswa").select2({
                placeholder: "Pilih Siswa",
                allowClear: true,
            });
            $(".choose-book").select2({
                placeholder: "Pilih Buku",
                allowClear: true,
            });

            $("#datepicker-pinjam").datepicker({
                format: "dd/mm/yyyy",
                autoclose: true,
            });
            $("#datepicker-kembali").datepicker({
                format: "dd/mm/yyyy",
                autoclose: true,
            });
        });
    </script>

    <script>

        // Validasi ketika input data peminjaman
        $('input, select').change(function () {
            let data = $('.form-peminjaman').serialize();
            $.ajax({
                url: "{{route('peminjaman.validate')}}",
                data: data,
                type: 'POST',
                success: (response) => {
                    $('.detail-peminjaman').hide();
                    $('.next-step').show();
                    $('.is-invalid').removeClass("is-invalid");
                    $('span.siswa_id, span.buku_id').html(" ");
                    $('.validate').remove();

                    let tanggal_pinjam = $('input[name="tanggal_pinjam"]').val();
                    let yymmdd = tanggal_pinjam.split("/");
                    tanggal_pinjam = `${yymmdd[2]}-${yymmdd[1]}-${yymmdd[0]}`;
                    tanggal_pinjam = new Date (tanggal_pinjam);


                    let tanggal_kembali = $('input[name="tanggal_kembali"]').val();
                    yymmdd = tanggal_kembali.split("/");
                    tanggal_kembali = `${yymmdd[2]}-${yymmdd[1]}-${yymmdd[0]}`;
                    tanggal_kembali = new Date (tanggal_kembali);

                    // To calculate the time difference of two dates
                    let difference = tanggal_kembali.getTime() - tanggal_pinjam.getTime();

                    // To calculate the no. of days between two dates
                    let lama_pinjam = difference / (1000 * 3600 * 24);

                    $('p.day-pinjam').html(`${lama_pinjam} Hari`);
                    $('input[name="durasi_pinjam_hari"]').val(lama_pinjam);

                    $('.next-step').css("visibility", "visible");
                },
                error: (response) => {
                    $('p.day-pinjam').html("");
                    $('.detail-peminjaman').hide();
                    $('.next-step').show();
                    $('.next-step').css("visibility", "hidden");
                    $('.is-invalid').removeClass("is-invalid");
                    $('span.siswa_id, span.buku_id').html(" ");
                    $('.validate').remove();
                    let error = response.responseJSON.errors;
                    $.each(error, function (key, value) {
                        let input = $(`input[name=${key}]`)

                        if (input.length > 0) {
                            $(input).addClass('is-invalid');

                            let msg = `
                                <span class="text-danger validate" role="alert">
                                    <p>${value}</p>
                                </span>
                            `;
                            $( msg ).insertAfter( input );
                        } else {
                            let select = $(`span.${key}`);
                            $(select[0]).html("This field is required");
                        }
                    })
                }
            })
        })
    </script>

    <script>
        // Ketika button lanjut diklik
        $('.next-step').click(function (e) {
            $('.next-step').hide();
            e.preventDefault();
            let data = $('.form-peminjaman').serialize();
            $('.detail-peminjaman').show();
            $.ajax({
                url: "{{route('peminjaman.confirm')}}",
                type: "POST",
                data: data,
                success: (response) => {
                    console.log(response);
                    // Update detail buku
                    let srcimg = "{{ asset('img_book') }}/" + response.buku.gambar;
                    let tablecontent = `
                    <tr>
                        <th>Cover</th>
                        <th>ISBN</th>
                        <th>Judul Buku</th>
                        <th>Stok Tersedia</th>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <div class="d-flex justify-content-center">
                                <div class="image-preview" style="width: 80px; height: 100px;">
                                    <img class="cover-img-detail" style="width: 100%; height: 100%;" src="${srcimg}">
                                </div>
                            </div>
                        </td>
                        <td class="text-center">${response.buku.no_isbn}</td>
                        <td class="text-center">${response.buku.judul}</td>
                        <td class="text-center"><span class="badge badge-success">${response.buku.stok}</span></td>
                    </tr>
                    `;
                    $('.table-buku-confirm').html(tablecontent);

                    // Update detail peminjaman
                    let detailcontent = `
                    <ul class="p-0">
                        <li>${response.siswa.nama}</li>
                        <li>${response.siswa.email}</li>
                        <li>${response.siswa.no_hp}</li>
                        <li>${response.tanggal_pinjam}</li>
                        <li>${response.tanggal_kembali}</li>
                        <li><span class="badge badge-info">${response.durasi} Hari</span></li>
                    </ul>
                    `;
                    $('.detail-peminjaman-confirm').html(detailcontent);

                },
                error: (response) => {
                    alert("Something is wrong");
                }
            })
        })
    </script>

    <script>
        // cancel-confirm button di klik
        $('.cancel-confirm').click(function () {
            $('.next-step').show();
            $('.detail-peminjaman').hide();
        })

        // confirm-peminjaman button di klik
        $('.confirm-peminjaman').click(function () {
            Swal.fire({
                    title: 'Buat Peminjaman?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Buat'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('.form-peminjaman').submit();
                    }
                })
        })
    </script>

    <script>
        $(document).ready(function () {
            $('#table-data-peminjaman').DataTable( {
                "pageLength": 5,
                "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All Data"]]
            } );
        });
    </script>

    <script>
        $('.btn-form-batal-pinjam').click(function (e) {
            e.preventDefault();
            Swal.fire({
                    title: 'Batalkan Peminjaman?',
                    text: 'Peminjaman tidak akan bisa dikembalikan lagi',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Lanjut'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).parent().submit();
                    }
                })
        })
    </script>
@endpush
@endsection


