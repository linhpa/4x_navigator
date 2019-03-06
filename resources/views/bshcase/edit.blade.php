@extends('layouts.app')

@section('css')

<style>
  .uper {
    margin: 20px;
  }

  .text-form-input {
    width: 40%;
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
      <form method="post" action="{{ route('bsh_cases.update', $case->id) }}" style="display: inline;">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="PATCH">
        <div class="form-group">
          <label for="customer_name">Customer Name: </label>
          <input type="text" class="form-control text-form-input" name="customer_name" value="{{ $case->customer_name }}"  />
        </div>
        <div class="form-group">
          <label for="customer_phone">Customer Phone :</label>
          <input type="text" class="form-control text-form-input" name="customer_phone" value="{{ $case->customer_phone }}" />
        </div>
        <div class="form-group">
          <label for="description">Description:</label>
          <input type="text" class="form-control text-form-input" name="description" value="{{ $case->description }}" />
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
      <a href="{{ route('bsh_cases.index') }}" style="display: inline;"><button class="btn">Exit</button></a>
  </div>
</div>
@endsection