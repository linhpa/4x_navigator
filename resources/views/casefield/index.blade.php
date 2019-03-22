@extends('layouts.app')

@section('css')
<style type="text/css">
  .uper {
    margin: 20px;
  }
</style>
@endsection

@section('content')
<div class="uper">
    <h2 style="text-align: center;">Case Fields</h2>
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
      <a href=""><button class="btn btn-success"><i class="fa fa-plus"></i> </button></a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
              <td>Key</td>
              <td>Name</td>
              <td>Description</td>
              <td>Position</td>
              <td>Show on grid</td>
              <td>Show on edit</td>
              <td>Created At</td>
              <td>Updated At</td>
              <td>Command</td>
            </tr>
        </thead>
        <tbody>
            @foreach($caseFields as $caseField)
            <tr>
                <td>{{@$caseField->key}}</td>
                <td>{{@$caseField->name}}</td>
                <td>{{@$caseField->description}}</td>
                <td>{{@$caseField->position}}</td>
                <td>{{@$caseField->on_grid}}</td>
                <td>{{@$caseField->editable}}</td>
                <td>{{@$caseField->created_at}}</td>
                <td>{{@$caseField->updated_at}}</td>
                <td>                    
                    <a href="{{ route('bsh_cases.edit', $caseField->id) }}">
                        <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                    </a>
                    <div style="display: inline-block;">
                    <form id="destroy-form" action="{{ route('bsh_cases.destroy', $caseField->id)}}" method="post">
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
        {{ $caseFields->appends(Request::all())->links() }}
    </div>
</div>

@endsection
