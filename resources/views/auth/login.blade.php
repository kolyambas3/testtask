@extends('layouts.master')

@section('content')

    <h2>Log In</h2>

    <form method="POST" action="/login">
        @csrf
        @include('partials.register_login')
    </form>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

@endsection
