<div class="tab-pane fade" id="data-peminjaman" role="tabpanel" aria-labelledby="data-peminjaman-tab5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Data Peminjaman</h4>
                </div>
                <div class="card-body">
                        <table class="table table-bordered" id="table-data-peminjaman">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Siswa</th>
                                    <th>Judul Buku</th>
                                    <th>Durasi Pinjam</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($peminjaman as $p)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$p->siswa->nama}}</td>
                                        <td>{{$p->buku->judul}}</td>
                                        <td><span class="badge badge-success">{{$p->durasi_pinjam_hari}} Hari</span></td>
                                        <td>
                                            @if ($p->status_kembali == 0)
                                                    <span class="badge badge-info">Dipinjam</span>
                                            @elseif ($p->status_kembali == 1)
                                                    <span class="badge badge-success">Dikembalikan</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-6 d-flex justify-content-center">
                                                    <button class="btn btn-primary detail" data-toggle="modal" data-target="#modalDetail"
                                                        data-backdrop="static" data-keyboard="false" data-id="{{$p->id}}">Detail</button>
                                                </div>
                                                @if ($p->status_kembali == 0)
                                                    <div class="col-6 d-flex justify-content-center">
                                                        <form action="{{route('peminjaman.destroy', $p->id)}}" class="form-cancel-peminjaman" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-form-batal-pinjam">Batalkan</button>
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="modalDetailTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="modalDetailTitle">Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate="">
                        <h6 class="text-dark text-center">Detail Siswa</h6>
                        <div class="form-group mb-1">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" readonly>
                        </div>
                        <div class="form-group mb-1">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" readonly>
                        </div>
                        <div class="form-group mb-1">
                            <label>Nomor Handphone</label>
                            <input type="text" class="form-control" name="nohp" readonly>
                        </div>
                        <h6 class="text-dark text-center mt-3">Detail Buku</h6>
                        <div class="form-group mb-1">
                            <label>Judul</label>
                            <input type="text" class="form-control" name="judul" readonly>
                        </div>
                        <div class="form-group mb-1 ">
                            <label>Cover</label>
                            <div class="d-flex justify-content-center">
                                <div class="image-preview" style="width: 200px; height: 250px;">
                                    <img class="cover-img" style="width: 100%; height: 100%;" src="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-1">
                            <label>Penerbit</label>
                            <input type="text" class="form-control" name="penerbit" readonly>
                        </div>
                        <div class="form-group mb-1">
                            <label>Pengarang</label>
                            <input type="text" class="form-control" name="pengarang" readonly>
                        </div>
                        <h6 class="text-dark text-center mt-3">Detail Peminjaman</h6>
                        <div class="form-group mb-1">
                            <label>Tanggal Pinjam</label>
                            <input type="text" class="form-control" name="tgl-pinjam" readonly>
                        </div>
                        <div class="form-group mb-1">
                            <label>Tanggal Kembali</label>
                            <input type="text" class="form-control" name="tgl-kembali" readonly>
                        </div>
                        <div class="form-group mb-1">
                            <label>Lama Pinjam</label>
                            <input type="text" class="form-control" name="durasi" readonly>
                        </div>
                        <div class="form-group mb-1">
                            <label>Status</label>
                            <div>
                                <span class="badge badge-info pinjam">Dipinjam</span>
                                <span class="badge badge-info kembali">Dikembalikan</span>
                                <span class="badge badge-success tepat">Tepat Waktu</span>
                                <span class="badge badge-danger terlambat">Terlambat</span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@push('js')
    <script>
        $(document).ready(function () {
            $("#modalDetail").appendTo("body");
        });

        function datemontyear(date) {
                let datetimearr = date.split(" ");
                let dates = datetimearr[0];
                dates = dates.split("-");
                return `${dates[2]}-${dates[1]}-${dates[0]}`;
            }

        $(".detail").click(function(){
                let id = $(this).data("id");
                let url = `${window.location.href}/detail/${id}`;
                $.ajax({
                    url: url,
                    type: "GET",
                    success: (response) => {
                        // Update value input
                        $('input[name=nama]').val(response.siswa.nama);
                        $('input[name=email]').val(response.siswa.email);
                        $('input[name=nohp]').val(response.siswa.no_hp);
                        $('input[name=judul]').val(response.buku.judul);
                        $('input[name=penerbit]').val(response.buku.penerbit);
                        $('input[name=pengarang]').val(response.buku.pengarang);
                        $('input[name=tgl-pinjam]').val(datemontyear(response.tanggal_pinjam));
                        $('input[name=tgl-kembali]').val(datemontyear(response.tanggal_kembali));
                        $('input[name=durasi]').val(response.durasi_pinjam_hari + " hari");

                        // Update cover img
                        let srcimg = "{{ asset('img_book') }}/" + response.buku.gambar;
                        $('.cover-img').attr('src', srcimg);

                        // Status Pengembalian
                        let status = response.status_kembali;
                        // let terlambat = response.pengembalian.keterlambatan;
                            if (status == 0) {
                                $('.pinjam').show();
                                $('.kembali').hide();
                                $('.terlambat').hide();
                                $('.tepat').hide();
                            } else if (status == 1) {
                                $('.kembali').show();
                                $('.pinjam').hide();
                                $('.tepat').hide();
                                $('.terlambat').hide();
                                // if (terlambat == null) {
                                // }  else if (terlambat <= 0) {
                                //     $('.tepat').show();
                                //     $('.terlambat').hide();
                                // } else {
                                //     $('.terlambat').show();
                                //     $('.tepat').hide();
                                // }
                            }
                    },
                    error: (error) => {
                        alert('Cannot get Detail Peminjaman')
                    }
                })
            });

    </script>
@endpush
