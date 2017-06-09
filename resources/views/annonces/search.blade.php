@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Search Annonce</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('annonce/search') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">title</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value=""  autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('after_price') ? ' has-error' : '' }}">
                            <label for="after_price" class="col-md-4 control-label">after_price</label>

                            <div class="col-md-6">
                                <input id="after_price" type="number" class="form-control" name="after_price" value="" >

                                @if ($errors->has('after_price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('after_price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('before_price') ? ' has-error' : '' }}">
                            <label for="before_price" class="col-md-4 control-label">before_price</label>

                            <div class="col-md-6">
                                <input id="before_price" type="number" class="form-control" name="before_price" value="" >

                                @if ($errors->has('before_price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('before_price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('after_date') ? ' has-error' : '' }}">
                            <label for="after_date" class="col-md-4 control-label">after_date</label>

                            <div class="col-md-6">
                                <input id="after_date" type="date" class="form-control" name="after_date">

                                @if ($errors->has('after_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('after_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('before_date') ? ' has-error' : '' }}">
                            <label for="before_date" class="col-md-4 control-label">before_date</label>

                            <div class="col-md-6">
                                <input id="before_date" type="date" class="form-control" name="before_date">

                                @if ($errors->has('before_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('before_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name_author') ? ' has-error' : '' }}">
                            <label for="name_author" class="col-md-4 control-label">name_author</label>

                            <div class="col-md-6">
                                <input id="name_author" type="name_author" class="form-control" name="name_author">

                                @if ($errors->has('name_author'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name_author') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('word') ? ' has-error' : '' }}">
                            <label for="word" class="col-md-4 control-label">word</label>

                            <div class="col-md-6">
                                <input id="word" type="word" class="form-control" name="word">

                                @if ($errors->has('word'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('word') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                   Submit annonce
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection