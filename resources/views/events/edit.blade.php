@extends('layouts.app')

@section('content')
<style>
    .uper {
        margin-top: 40px;
    }
</style>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Event</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('events.index') }}"> Back</a>
        </div>
    </div>
</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('events.update', $event->id ) }}" method="POST" >
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Event Title:</strong>
                <br><br><input type="text" name="title" class="" placeholder="title" value="{{$event->title}}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Starting date</strong>
                <br><br>
                <input type="date" name="start_date" id="start_date" class="" placeholder="Format : yyyy-mm-dd" value="{{$event->start_date}}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>End date date</strong> <br> <br>
                <input type="date" name="end_date" id="end_date" class="" placeholder="Format : yyyy-mm-dd" value="{{$event->end_date}}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Status:</strong> <br> <br>
                <select id="status" name="status" class="" value="{{$event->status}}">
                    <option value="active">Active</option>
                    <option value="in_active">Inactive</option>
                </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                <br><br>
                <textarea class="form-control" style="height:150px" name="description" placeholder="Detail">{!! $event->description !!}</textarea>
            </div>
        </div>
        <title>

        </title>
        <div class="col-xs-4 col-sm-4 col-md-4 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>

</form>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    // $( function() {
    //     $( "#start_date" ).datepicker({ dateFormat: 'yyyy-mm-dd' });
    //     $( "#end_date" ).datepicker({ dateFormat: 'yyyy-mm-dd' });
    // } );
</script>

@endsection
