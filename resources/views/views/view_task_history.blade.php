@extends('layouts.app')

@section('content')

@if(count($history) > 0)
<div class="container">
    <h1 style="font-size: 28px; color: Grey; text-align: center; text-transform: uppercase; font-weight: bold;">Task History</h1>

    @foreach($history as $index => $record)
    <div class="card">
        <div class="card-header text-center">
            <h5><strong>Update {{ $index + 1 }} </strong></h5>
        </div>

        @if ($index > 0)
        <div class="card-footer">
            Changes made by <h5><i><strong>{{ $record->updated_by }}</strong></i> on <i><strong>{{ \Carbon\Carbon::parse($record->updated_on)->format('j F Y  g:i A') }}</strong></i>
            <ul>
                @foreach($record as $field => $value)
                @if ($field != 'id' && $field != 'updated_on' &&  $field != 'updated_by' && $value != $history[$index - 1]->$field)
                <li><strong>{{ $field }}:</strong>
                    <span class="before">{!! $history[$index - 1]->$field !!}</span> &rarr;
                    <span class="after">{!! $value !!}</span>
                </li>
                @endif
                @endforeach
            </ul>
        </div>
        @else
        <div class="card-footer">
            Changes made by <h5><i><strong>{{ $record->updated_by }}</strong></i> on <i><strong>{{ \Carbon\Carbon::parse($record->updated_on)->format('j F Y  g:i A') }}</strong></i>
        </div>
        @endif
    </div>
    @endforeach
</div>
@else
<div class="card">
    <div class="card-header text-center">
        <h5><strong>NO UPDATES TO SHOW</strong></h5>
    </div>
</div>
@endif

@endsection

<style>
.before {
    color: red;
}

.after {
    color: green;
}
</style>
