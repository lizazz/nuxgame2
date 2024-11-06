@extends('imfeelinglucky::layouts.master')

@section('content')
    <h1>Register</h1>
    <form action="{{ url('/imfeelinglucky') }}" method="POST">
        @csrf
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="{{ old('username') }}">
            @if ($errors->has('username'))
                <div>{{ $errors->first('username') }}</div>
            @endif
        </div>
        <div>
            <label for="phonenumber">Phonenumber (only "+" and digits):</label>
            <input type="text" id="phonenumber" name="phonenumber" value="{{ old('phonenumber') }}" placeholder="+XXXXXXXXXXXXX">
            @if ($errors->has('phonenumber'))
                <div>{{ $errors->first('phonenumber') }}</div>
            @endif
        </div>
        <div>
            <button type="submit">Register</button>
        </div>
    </form>
@endsection
