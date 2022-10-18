@extends('layouts.app')

@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<style>
    body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
    }

    .topnav {
        overflow: hidden;
    }

    .topnav a {
        float: left;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
    }

    .topnav a:hover {
        background-color: #ddd;
        color: black;
    }

    .topnav a.active {
        background-color: #04AA6D;
        color: white;
    }

    .topnav-right {
        float: right;
    }
</style>

<div class="topnav">
    <div class="topnav-right">
        <a class="active" href="{{route('events.create')}}">Add Event</a>
        <a class="" href="#"></a>
    </div>
</div>
<!--<div class="pull-right">-->
<!--    <a class="btn btn-success" href="{{route('events.create')}}"> Add Event</a>-->
<!--</div>-->
@if ($message = Session::get('message'))
    <div class="alert alert-danger">
        <p>{{ $message }}</p>
    </div>
@endif
<br><br>
<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Title</th>
        <th>Description</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Status</th>
        <th width="280px">Action</th>
    </tr>

    @foreach ($events as $event)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $event->title }}</td>
        <td>{{ $event->description }}</td>
        <td>{{ $event->start_date }}</td>
        <td>{{ $event->end_date }}</td>
        <td> @if($event->status == "active") Active  @else Inactive @endif</td>
        <td>
            <form action="{{ route('events.destroy',$event->id) }}" method="POST">

<!--                <a class="btn btn-info" href="{{ route('events.show',$event->id) }}">Show</a>
-->
                <a class="btn btn-primary" href="{{ route('events.edit',$event->id) }}">Edit</a>

                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{!! $events->links() !!}

@endsection


