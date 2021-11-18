@extends('layouts.master')

@section('content')

    <h2>Create post</h2>

    @include('partials.create_edit_form')

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
