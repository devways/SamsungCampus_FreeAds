@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Profils</div>
                <div class="panel-body">
                    <div class="panel-section"><p>{{ $user->name }}<span style='margin-left:15px'></span>{{ $user->email }}</p></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection