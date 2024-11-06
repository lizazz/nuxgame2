@extends('imfeelinglucky::layouts.master')

@section('content')
    <h1>Im Feeling lucky</h1>
    <div class="table">
        <div class="row">
            <div class="cell header-cell"></div>
            <div class="cell header-cell"></div>
        </div>
        <div class="row">
            <div class="cell">URL</div>
            <div class="cell"><a href="{{ route('imfeelinglucky.show', ['hash' => $hash]) }}">{{$hash}}</a></div>
        </div>
        <div class="row">
            <div class="cell">
                <button onclick="window.location.href='{{ route('imfeelinglucky.generate', ['hash' => $hash]) }}'">
                    Generate
                </button>
            </div>
            <div class="cell">
                <button onclick="window.location.href='{{ route('imfeelinglucky.deactivate', ['hash' => $hash]) }}'">
                    Deactivate
                </button>
            </div>
        </div>
        <div class="row">
                <div class="cell">
                    <button onclick="window.location.href='{{ route('imfeelinglucky.try', ['hash' => $hash]) }}'">
                        Imfeelinglucky
                    </button>
                </div>
            <div class="cell">
                <button onclick="window.location.href='{{ route('imfeelinglucky.history', ['hash' => $hash]) }}'">
                    History
                </button>
            </div>
        </div>
    </div>

    @if(is_array($results))
    <div class="table">
        <div class="row">
            <div class="cell header-cell">Number</div>
            <div class="cell header-cell">Result</div>
            <div class="cell header-cell">Sum</div>
        </div>
        <div class="row">
            <div class="cell">
                {{$results['value']}}
            </div>
            <div class="cell">
                {{$results['result']}}
            </div>
            <div class="cell">{{$results['sum']}}</div>
        </div>
    </div>
    @endif

    @if(is_array($histories))
        <div class="table">
            <div class="row">
                <div class="cell header-cell">Number</div>
                <div class="cell header-cell">Result</div>
                <div class="cell header-cell">Sum</div>
            </div>
            @foreach($histories as $history)
            <div class="row">
                <div class="cell">
                    {{$history['value']}}
                </div>
                <div class="cell">
                    {{$history['result']}}
                </div>
                <div class="cell">
                    {{$history['sum']}}
                </div>
            </div>
            @endforeach
        </div>
    @endif
@endsection
