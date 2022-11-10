@extends('layouts.index')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="tabPengembalian" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="proses-pengembalian-tab5" data-toggle="tab" href="#proses-pengembalian" role="tab"
                                aria-controls="proses-pengembalian" aria-selected="true">
                                <i class="fas fa-file-lines"></i> Proses Pengembalian </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="data-pengembalian-tab5" data-toggle="tab" href="#data-pengembalian" role="tab" aria-controls="data-pengembalian"
                                aria-selected="false">
                                <i class="fas fa-clock-rotate-left"></i> Data Pengembalian</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="tabPengembalianContent">
                        @include('pengembalian.tabs.tabpengembalian')
                        @include('pengembalian.tabs.tabdatapengembalian')
                    </div>
                </div>
            </div>
        </div>
    </div>


@push('js')
    <script>
        $(document).ready(function () {
            $(".choose-peminjaman").select2({
                placeholder: "Pilih Peminjaman",
                allowClear: true,
            });
        });
    </script>
@endpush
@endsection


