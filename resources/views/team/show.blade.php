@extends('layouts.master')

@section('title','Takım | '.$team->name)

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Takım</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{$team->name}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="container">
                <div class="main-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <div class="mt-3">
                                            <h4>{{$team->name.' '.$team->surname}}</h4>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6>Takım Adı</h6>
                                            <span class="text-secondary">{{$team->name}}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6>Güç</h6>
                                            <span class="text-secondary">
                                                {{($team->strength)}}
                                            </span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6>Oynanan Maç</h6>
                                            <span class="text-secondary">
                                                {{$team->getTotalMatchesPlayed()}}
                                            </span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6>Lig Sıralaması</h6>
                                            <span class="text-secondary">
                                                {{$team->getLeaguePosition()}}
                                            </span>
                                        </li>

                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6>Kayıt Tarihi</h6>
                                            <span class="text-secondary">{{$team->created_at->translatedFormat('d F Y, H:i')}}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6>Son Güncellenme Tarihi</h6>
                                            <span class="text-secondary">{{$team->updated_at->translatedFormat('d F Y, H:i')}}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="d-flex align-items-center mb-3">Ev Sahibi Olduğu Maçlar</h5>
                                            <div class="table-responsive">
                                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th>Rakip</th>
                                                        <th>Maç Skoru</th>
                                                        <th>Tarih</th>
                                                        <th>Maç Sonucu</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @forelse($team->homeMatches as $row)
                                                        <tr>
                                                            <td>{{$row->awayTeam->name}}</td>
                                                            <td>{{$row->home_score.' - '.$row->away_score}}</td>
                                                            <td>{{$row->match_date}}</td>
                                                            <td>
                                                                @if($row->home_score > $row->away_score)
                                                                    Galibiyet
                                                                @elseif($row->home_score == $row->away_score)
                                                                    Beraberlik
                                                                @else
                                                                    Mağlubiyet
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="4" class="text-center">Henüz Ev Sahibi Olunan Maç Yok</td>
                                                        </tr>
                                                    @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="d-flex align-items-center mb-3">Deplasman Maçlar</h5>
                                            <div class="table-responsive">
                                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th>Rakip</th>
                                                        <th>Maç Skoru</th>
                                                        <th>Tarih</th>
                                                        <th>Maç Sonucu</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @forelse($team->awayMatches as $row)
                                                        <tr>
                                                            <td>{{$row->homeTeam->name}}</td>
                                                            <td>{{$row->home_score.' - '.$row->away_score}}</td>
                                                            <td>{{$row->match_date}}</td>
                                                            <td>
                                                                @if($row->away_score > $row->home_score)
                                                                    Galibiyet
                                                                @elseif($row->away_score == $row->home_score)
                                                                    Beraberlik
                                                                @else
                                                                    Mağlubiyet
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="4" class="text-center">Henüz Deplasman Maç Yok</td>
                                                        </tr>
                                                    @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
@endsection
