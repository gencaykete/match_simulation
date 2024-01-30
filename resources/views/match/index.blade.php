@extends('layouts.master')
@section('title', 'Maçlar')
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Maçlar</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Maç Listesi</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ev Sahibi Takım</th>
                                <th>Deplasman Takım</th>
                                <th>Skor</th>
                                <th>Sonuç</th>
                                <th>Maç Tarihi</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
@endsection

@section('page-scripts')
    <script>
        let DATA_URL = "{{route('match.datatable')}}";
        let DATA_COLUMNS = [
            {data: 'id'},
            {data: 'homeTeam'},
            {data: 'awayTeam'},
            {data: 'score'},
            {data: 'result'},
            {data: 'match_date'},
        ];
    </script>
    <script src="/backend/custom/js/datatable-init.js"></script>
@endsection
