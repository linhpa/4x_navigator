@extends('layouts.app')

@section('css')

<style>
  .uper {
    margin-top: 40px;
  }
</style>

@endsection

@section('content')
<div class="card uper">
  <div class="card-header">
    Edit Case
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
      <form method="post" action="{{ route('bsh_cases.update', $case->id) }}">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="PATCH">
        <div class="form-group">
          <label for="customer_name">Customer Name: </label>
          <input type="text" class="form-control" name="customer_name" value="{{ $case->customer_name }}"  />
        </div>
        <div class="form-group">
          <label for="customer_phone">Customer Phone :</label>
          <input type="text" class="form-control" name="customer_phone" value="{{ $case->customer_phone }}" />
        </div>
        <div class="form-group">
          <label for="description">Description:</label>
          <input type="text" class="form-control" name="description" value="{{ $case->description }}" />
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection