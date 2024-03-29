@extends('layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row">

                <div class="col-md-4">
                    <div class="card radius-10 bg-primary">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-white">Takım</p>
                                    <h4 class="my-1 text-white">{{$teams->count()}}</h4>
                                </div>
                                <div class="widgets-icons bg-light-transparent text-white ms-auto"><i class="bx bxs-wallet"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card radius-10 bg-danger">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-white">Hafta</p>
                                    <h4 class="my-1 text-white">{{$currentWeek}}</h4>
                                </div>
                                <div class="widgets-icons bg-light-transparent text-white ms-auto"><i class="bx bxs-group"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card radius-10 bg-success">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-white">Oynanan Maç</p>
                                    <h4 class="my-1 text-white">{{$totalMatch}}</h4>
                                </div>
                                <div class="widgets-icons bg-light-transparent text-white ms-auto"><i class="bx bxs-binoculars"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->

            <div class="row">
                <div class="col-md-12">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h5 class="mb-0">Puan Durumu</h5>
                                </div>
                                <div class="font-22 ms-auto"><i class='bx bx-dots-horizontal-rounded'></i>
                                </div>
                            </div>
                            <hr/>
                            <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <thead class="table-light">
                                    <tr>
                                        <th>Takım</th>
                                        <th>G</th>
                                        <th>B</th>
                                        <th>M</th>
                                        <th>AG</th>
                                        <th>YG</th>
                                        <th>Puan</th>
                                        @if($currentWeek > 3 && $currentWeek < 6)
                                            <th>Şampiyonluk İhtimali</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($standings as $standing)
                                        <tr>
                                            <td>
                                                {{ $standing->team->name }}
                                                @if($currentWeek == 6 && $loop->first)
                                                    <b class="text-danger">(Şampiyon)</b>
                                                @endif
                                            </td>
                                            <td>{{ $standing->wins }}</td>
                                            <td>{{ $standing->draws }}</td>
                                            <td>{{ $standing->losses }}</td>
                                            <td>{{ $standing->goals_for }}</td>
                                            <td>{{ $standing->goals_against }}</td>
                                            <td>{{ $standing->points }}</td>
                                            @if($currentWeek > 3 && $currentWeek < 6)
                                                <td>%{{ $standing->team->calculateChampionshipProbabilities() }}</td>
                                            @endif
                                        </tr>
                                    @empty
                                        @foreach($teams as $team)
                                            <tr>
                                                <td>{{$team->name}}</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                            </tr>
                                        @endforeach
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
@endsection
