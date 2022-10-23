@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Event</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('events.index') }}"> Back</a>
        </div>
    </div>
</div>

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

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">


<form action="{{ route('events.store') }}" method="POST">
    @csrf

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong><br><br>Event Title:</strong>
                <br><br><input type="text" name="title" value="{{old('title')}}" class="" placeholder="title">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Starting date</strong>
                <br><br><input type="date"  value="{{old('starting_date')}}" id="start_date"  value="{{old('title')}}" function="hello()" name="start_date" class="" placeholder="Format : yyyy-mm-dd">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>End date</strong>
                <br><br>
                <input type="date" id="end_date"  value="{{old('ending_date')}}" name="end_date" class="" placeholder="Format : yyyy-mm-dd">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Status:</strong> <br>
                <br>
                <select id="status" name="status" class="">
                    <option value="active" @if(old('status') == 'active') selected @endif>Active</option>
                    <option value="in_active" @if(old('status') == 'inactive') selected @endif >Inactive</option>
                </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                <textarea class="form-control" style="height:150px" name="description" placeholder="Detail"></textarea>
            </div>
        </div>
        <title>

        </title>
        <div class="col-xs-2 col-sm-2 col-md-2 text-center">
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
