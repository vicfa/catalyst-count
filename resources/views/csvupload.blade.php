@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if(session('success'))
                        <div>{{ session('success') }}</div>
                    @endif

                    <br>
                    <br>

                    <h1>Filter Records</h1>

                    <form action="{{ url('/filter-records') }}" method="post">
                        @csrf
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}">
                        <!-- Add more input fields for other filters... -->

                        <button type="submit">Filter</button>
                    </form>

                    @isset($count)
                        <p>Total matching records: {{ $count }}</p>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
