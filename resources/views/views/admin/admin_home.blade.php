@extends('layouts.app')

@section('content')

<div class="container">

        <form action="{{ route('sprint-mail') }}" method="POST">
            @csrf 
            <div class="form-group">
                <br></br>
                <label for="sprint">Select a Sprint:</label>
                <select name="sprint" id="sprint" class="form-control">
                    @foreach ($sprints as $sprint)
                        <option value="{{ $sprint->id }}">{{ $sprint->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Send Sprint Mail</button>
        </form>
</div>



@endsection