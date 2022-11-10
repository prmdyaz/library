<div class="tab-pane fade show active" id="proses-pengembalian" role="tabpanel" aria-labelledby="proses-pengembalian-tab5">
    <div class="row">
        <div class="col-md-4">
            <div class="card p-0">
                <div class="card-header mt-0">
                    <h4> Proses Pengembalian </h4>
                </div>
                <div class="card-body py-0">
                    <div class="card-body pl-0 pt-0">
                        <form action="{{route('peminjaman.store')}}" class="form-peminjaman" method="POST">
                            @csrf
                            <div class="mb-3">
                                <span class="text-muted">Pilih Peminjaman</span>
                                <select class="choose-peminjaman" required name="peminjaman_id"
                                    id="choose-peminjaman">
                                    <option></option>
                                    @foreach ($peminjaman as $p)
                                        <option value="{{$p->id}}">{{$p->siswa->nama}} - {{$p->buku->judul}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 detail-peminjaman" style="display: none">
            <div class="card">
                <div class="card-header">
                    <h4>Detail Peminjaman</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered table-buku-peminjaman">

                        </table>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="row ">
                                <div class="col-6">
                                    <ul class="p-0">
                                        <li><strong>Nama Siswa</strong></li>
                                        <li><strong>Email</strong></li>
                                        <li><strong>No Handphone</strong></li>
                                        <li><strong>Tanggal Pinjam</strong></li>
                                        <li><strong>Tanggal Kembali</strong></li>
                                        <li><strong>Keterlambatan</strong></li>
                                        <li><strong>Denda</strong></li>
                                    </ul>
                                </div>
                                <div class="col-6 d-flex justify-content-end detail-peminjam">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <form action="{{route('pengembalian.store')}}" class="form-pengembalian" method="POST">
                        @csrf
                        <input type="hidden" name="peminjaman_id">
                        <input type="hidden" name="buku_id">
                        <input type="hidden" name="keterlambatan">
                        <input type="hidden" name="denda">
                    </form>
                    <button class="btn btn-primary proses-pengembalian">Proses Pengembalian</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $('select[name="peminjaman_id"]').change(function () {

           let id = $(this).val();
           let url = `${window.location.href}/peminjaman/detail/${id}`;
           $.ajax({
            url : url,
            type : "GET",
            success: (response) => {
                $('.detail-peminjaman').show()
                let srcimg = "{{ asset('img_book') }}/" + response.buku.gambar;
                let tablecontent = `
                <tr>
                    <th>Cover</th>
                    <th>ISBN</th>
                    <th>Judul Buku</th>
                    <th>Penerbit</th>
                    <th>Pengarang</th>
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
                    <td class="text-center">${response.buku.penerbit}</td>
                    <td class="text-center">${response.buku.pengarang}</td>
                </tr>
                `;
                $('.table-buku-peminjaman').html(tablecontent);

                let tanggal_kembali = new Date (response.tanggal_kembali);
                let tanggal_hari_ini = new Date ();
                tanggal_hari_ini= tanggal_hari_ini.getFullYear()+"-"+(tanggal_hari_ini.getMonth()+1)+"-"+ tanggal_hari_ini.getDate();
                let hari_ini = new Date (tanggal_hari_ini);

                let difference = hari_ini.getTime() - tanggal_kembali.getTime();
                let terlambat = Math.round(difference / (1000 * 3600 * 24));
                detailcontent = ``;

                let denda = "{{config('library.library.denda')}}";

                if (terlambat <= 0) {
                    total_denda = 0;
                    terlambat = 0

                    detailcontent = `
                        <ul class="p-0">
                            <li>${response.siswa.nama}</li>
                            <li>${response.siswa.email}</li>
                            <li>${response.siswa.no_hp}</li>
                            <li>${response.tanggal_pinjam}</li>
                            <li>${response.tanggal_kembali}</li>
                            <li><span class="badge badge-info">0 Hari</span></li>
                            <li><span class="badge badge-success">Rp. 0</span></li>
                        </ul>
                        `;
                } else if (terlambat > 0) {
                    total_denda = denda * terlambat;
                    detailcontent = `
                        <ul class="p-0">
                            <li>${response.siswa.nama}</li>
                            <li>${response.siswa.email}</li>
                            <li>${response.siswa.no_hp}</li>
                            <li>${response.tanggal_pinjam}</li>
                            <li>${response.tanggal_kembali}</li>
                            <li><span class="badge badge-info">${terlambat} Hari</span></li>
                            <li><span class="badge badge-danger">Rp. ${total_denda}</span></li>
                        </ul>
                        `;
                }
                $('.detail-peminjam').html(detailcontent);

                // Set value input type hide
                $('input[name="peminjaman_id"]').val(id);
                $('input[name="buku_id"]').val(response.buku.id);
                $('input[name="keterlambatan"]').val(terlambat);
                $('input[name="denda"]').val(total_denda);
            },
            error: (error) => {
                alert('Something is wrong');
            }
           })
        })
    </script>

    <script>
        $('.proses-pengembalian').click(function () {
            $('.form-pengembalian').submit();
        })
    </script>
@endpush
