@extends('adminlte::page')

@section('title', 'Mi Dashboard')

@section('content_header')
    <h1>Inici</h1>
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Benvinguts</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
