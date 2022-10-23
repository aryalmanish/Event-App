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
    #add_event {
        margin-left: 40px;
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
    .dropbtn {
        background-color: #4CAF50;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
        cursor: pointer;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

        .dropdown-content a:hover {background-color: #f1f1f1}

    .dropdown:hover .dropdown-content {
        display: block;
        }

    .dropdown:hover .dropbtn {
        background-color: #3e8e41;
    }

</style>
        <br><br>
    
<div style="display: flex; justify-content: flex-end">
        <div class="dropdown">
        <i class="fa fa-arrow-down" aria-hidden="true"></i>
            <button class="dropbtn" style="margin-right:40px;">My Events <i class="fa fa-angle-double-down" style="font-size:24px"></i></button>
            <div class="dropdown-content">
                <a href="{{url('/finished_events')}}">Finished Events</a>
                <a href="{{url('/upcoming_events')}}">Upcoming Events</a>
                <a href="{{url('/upcoming_events_within_seven_days')}}">Upcoming Events within 7 days</a>
                <a href="{{url('/finished_events_within_seven_days')}}">Finished Events within 7 days</a>
            </div>
        </div>

</div>

<div class="topnav">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <div class="topnav-right">
        <br><br>
        <a class="active" id="add_event" href="{{route('events.create')}}">Add Event</a>
        <a class="" href="#"></a>
    </div>
</div>
<!-- <div class="pull-right">-->
<!--    <a class="btn btn-success" href="{{route('events.create')}}"> Add Event</a>-->
<!--</div> -->
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

                <!-- <button type="submit"  data-id="{{ $event->id }}" class="btn btn-danger">Delete</button>
                 -->
            </form>
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <button type=""  data-id="{{ $event->id }}" class="btn btn-danger deleteRecord">Delete</button>
        </td>
    </tr>
    @endforeach
</table>
{!! $events->links() !!}
<script>
$(".deleteRecord").click(function(){
    var id = $(this).data("id");
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax(
    {
        url: "eventdelete/"+id,
        type: 'POST',
        data: {
            "id": id,
            "_token": token,
        },
        success: function (){
            console.log("Event Deleted");
        }
    });
   
});
</script>
@endsection


