<div class="tab-pane fade show active" id="peminjaman" role="tabpanel" aria-labelledby="peminjaman-tab5">
    <div class="row">
        <div class="col-md-4">
            <div class="card p-0">
                <div class="card-header mt-0">
                    <h4> Buat Peminjaman Baru </h4>
                </div>
                <div class="card-body py-0">
                    <div class="row">
                        <div class="card">
                            <div class="card-body pl-3 pt-0">
                                <form action="{{route('peminjaman.store')}}" class="form-peminjaman" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <span class="text-muted">Pilih Siswa Yang Meminjam</span>
                                        <select class="choose-siswa" required name="siswa_id"
                                            id="choose-siswa">
                                            <option></option>
                                            @foreach ($siswa as $item)
                                            <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger siswa_id"></span>
                                    </div>
                                    <div class="mb-3">
                                        <span class="text-muted">Pilih Buku Yang Dipinjam</span>
                                        <select class="choose-book" required name="buku_id"
                                            id="choose-book">
                                            <option></option>
                                            @foreach ($buku as $item)
                                            <option value="{{$item->id}}">{{$item->judul}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger buku_id"></span>
                                    </div>
                                    <div class="mb-3">
                                        <span class="text-muted">Tanggal Pinjam</span>
                                        <input type="text" class="form-control" name="tanggal_pinjam" id="datepicker-pinjam"
                                            placeholder="Tanggal Pinjam">
                                    </div>
                                    <div class="mb-3">
                                        <span class="text-muted">Tanggal Kembali</span>
                                        <input type="text" class="form-control" name="tanggal_kembali" id="datepicker-kembali"
                                            placeholder="Tanggal Kembali">
                                    </div>
                                    <div class="mb-3">
                                        <span class="text-muted">Lama Pinjam</span>
                                        <p class="day-pinjam">- Hari</p>
                                        <input type="hidden" name="durasi_pinjam_hari">
                                    </div>

                                    <button type="submit" class="btn btn-primary next-step" style="visibility: hidden">Lanjut</button>
                                </form>
                            </div>
                        </div>
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
                        <table class="table table-bordered table-buku-confirm">

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
                                        <li><strong>Lama Pinjam</strong></li>
                                    </ul>
                                </div>
                                <div class="col-6 d-flex justify-content-end detail-peminjaman-confirm">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-warning confirm-peminjaman" href="">Konfirmasi dan Buat Peminjaman</button>
                    <button class="btn btn-primary cancel-confirm">Batal</button>
                </div>
            </div>
        </div>
    </div>
</div>
