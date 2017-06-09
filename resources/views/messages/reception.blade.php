@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($message as $data)
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $data->name }}</div>
                    <div class="panel-body">
                        {{ $data->content }}
                    </div>
                    <div class="panel-body">
                        <span style='margin-left:350px'></span>author: {{ $data->email }}<span style='margin-left:25px'></span> le {{ $data->created_at }}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
