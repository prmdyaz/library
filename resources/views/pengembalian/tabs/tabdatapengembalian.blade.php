<div class="tab-pane fade" id="data-pengembalian" role="tabpanel" aria-labelledby="data-pengembalian-tab5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Data Pengembalian</h4>
                </div>
                <div class="card-body">
                        <table class="table table-bordered" id="table-data-pengembalian">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Siswa</th>
                                    <th>Judul Buku</th>
                                    <th>Status</th>
                                    <th>Terlambat</th>
                                    <th>Denda</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengembalian as $p)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$p->peminjaman->siswa->nama}}</td>
                                        <td>{{$p->peminjaman->buku->judul}}</td>
                                        <td>
                                            @if ($p->peminjaman->status_kembali == 0)
                                                    <span class="badge badge-info">Dipinjam</span>
                                            @elseif ($p->peminjaman->status_kembali == 1)
                                                    <span class="badge badge-success">Dikembalikan</span>
                                            @endif
                                        </td>
                                        <td><span class="badge badge-info">{{$p->keterlambatan}} Hari</span></td>
                                        <td><span class="badge badge-danger">Rp. {{$p->denda}}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    $(document).ready(function () {
        $('#table-data-pengembalian').DataTable( {
            "pageLength": 5,
            "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All Data"]]
        } );
    });
</script>
@endpush
