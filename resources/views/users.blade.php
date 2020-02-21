@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @foreach($users as $user)
                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-header">{{$user->name}}</div>

                        <div class="card-body">
                            <a href="{{route('conv', ['id'=> $user->id])}}" class="btn btn-success" >
                                Envoyer un message
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            @if(count($users) < 1)
                <div class="col-md-8">
                    Aucun utilisateur inscrit sur l'application
                </div>
            @endif
        </div>
    </div>
@endsection
