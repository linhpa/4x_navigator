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
    Create New Case
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
      <form method="post" action="{{ route('bsh_cases.store') }}">
          <div class="form-group">
              {{ csrf_field() }}
              <label for="description">Description:</label>
              <input type="text" class="form-control" name="description"/>
          </div>
          <div class="form-group">
              <label for="customer_name">Customer name :</label>
              <input type="text" class="form-control" name="customer_name"/>
          </div>
          <div class="form-group">
              <label for="customer_phone">Customer phone number:</label>
              <input type="text" class="form-control" name="customer_phone"/>
          </div>
          <button type="submit" class="btn btn-primary">Add</button>
      </form>
  </div>
</div>

@endsection

