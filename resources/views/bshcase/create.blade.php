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
      <form method="post" action="{{ route('bsh_cases.store') }}" style="display: inline;">
          <div class="form-group">
              {{ csrf_field() }}
              <label for="description">Description:</label>
              <input type="text" class="form-control text-form-input" name="description"/>
          </div>
          <div class="form-group">
              <label for="customer_name">Customer name :</label>
              <input type="text" class="form-control text-form-input" name="customer_name"/>
          </div>
          <div class="form-group">
              <label for="customer_phone">Customer phone number:</label>
              <input type="text" class="form-control text-form-input" name="customer_phone"/>
          </div>
            <!-- <div id="pac-container">
                <input id="pac-input" name="position2"  class="k-textbox controls"
                      placeholder="Enter a location" style="width: 100%" autocomplete="off">
            </div> -->
          <button type="submit" class="btn btn-primary">Add</button>
      </form>
      <a href="{{ route('bsh_cases.index') }}" style="display: inline;"><button class="btn">Exit</button></a>
  </div>
</div>

@endsection

