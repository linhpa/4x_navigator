@extends('layouts.app')

@section('css')
<style>
  .uper {
    margin: 20px
  }
</style>
@endsection

@section('content')
<div class="uper">
    <h2 style="text-align: center;">Monitor</h2>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
              <td>User ID</td>
              <td>Email</td>
              <td>Name</td>
              <td>Phone</td>
              <td>Role</td>
              <td>Status</td>
              <td>Availability</td>
              <td>Last Activity</td>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{@$user->id}}</td>
                <td>{{@$user->email}}</td>
                <td>{{@$user->name}}</td>
                <td>{{@$user->phone}}</td>
                <td>{{@$user->role}}</td>
                @if (in_array($user->id, $loggedIds))
                <td><span class="label label-success">Online</span></td>
                @else
                <td><span class="label label-danger">Offline</span></td>
                @endif

                @if (in_array($user->id, $availableIds))
                <td><span class="label label-success">Available</span></td>
                @else
                <td><span class="label label-danger">Unavailable</span></td>
                @endif
                <td>{{@$user->last_activity}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="text-center">
        {{ $users->appends(Request::all())->links() }}
    </div>
</div>

@endsection
