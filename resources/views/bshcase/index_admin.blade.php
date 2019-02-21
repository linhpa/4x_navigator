@extends('layouts.app')

@section('css')

@endsection

@section('content')
<div class="uper">
    <h2 style="text-align: center;">Case List</h2>
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
    <div>
      <a href="{{ route('bsh_cases.create') }}"><button class="btn btn-success"><i class="fa fa-plus"></i> </button></a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
              <td>Case ID</td>
              <td>Customer Name</td>
              <td>Customer Phone</td>
              <td>Address 1</td>
              <td>Address 2</td>
              <td>Description</td>
              <td>Command</td>
            </tr>
        </thead>
        <tbody>
            @foreach($cases as $case)
            <tr>
                <td>{{@$case->id}}</td>
                <td>{{@$case->customer_name}}</td>
                <td>{{@$case->customer_phone}}</td>
                <td>{{@$case->address1}}</td>
                <td>{{@$case->address2}}</td>
                <td>{{@$case->description}}</td>
                <td>                    
                    <a href="{{ route('bsh_cases.edit', $case->id) }}">
                        <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                    </a>
                    <div style="display: inline-block;">
                    <form id="destroy-form" action="{{ route('bsh_cases.destroy', $case->id)}}" method="post">
                      {{ csrf_field() }}                      
                      <input name="_method" type="hidden" value="DELETE">
                      <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this case?');"><i class="fa fa-trash"></i></button>
                    </form>                       
                    </div>                 
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="text-center">
        {{ $cases->appends(Request::all())->links() }}
    </div>
</div>

@endsection
