@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Profils</div>
                @foreach($user as $use)
                <div class="panel-body">
                    <div class="panel-section"><p>{{ $use->name }}<span style='margin-left:15px'></span>{{ $use->email }}</p></div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection