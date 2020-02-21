@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @foreach($messages as $message)
                @if ($message->sender_id === $userId)
                    <div class="col-md-6"></div>
                    <div class="col-md-6 text-right">
                        <i>{{ $message->sender->name }}</i>
                        <div class="card fit-content p-1 mr-0 ml-auto">
                            {{ $message->content }}
                        </div>
                    </div>
                @else
                    <div class="col-md-6">
                        <i>{{ $message->sender->name }}</i>
                        <div class="card fit-content p-1">
                            {{ $message->content }}
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                @endif
            @endforeach
        </div>
        <div class="row mt-5">
            <form method="POST"  class="col" action="{{ route('sendMessage') }}">
                @csrf

                <div class="form-group row justify-content-center">
                    <div class="col-md-8 d-flex">
                        <input id="message" type="text" class="form-control @error('message') is-invalid @enderror" name="message" value="{{ old('message') }}" required autocomplete="message" autofocus>
                        <input id="otherUserId" name="otherUserId" type="number" class="d-none" value="{{ $otherUserId }}">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Envoyer') }}
                        </button>
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
