@extends('layouts.app')

@section('css')
<style>
  .uper {
    margin-top: 40px;
  }

    @import url("https://fonts.googleapis.com/css?family=Roboto:400,700");

body {
  color: #000;
  font-family: "Roboto", sans-serif;
  /*font-size: 18px;
  font-weight: 400;*/
  line-height: 1.6;
}

.container {
  max-width: 1335px;
  margin: 0 auto;
}

.grid-row {
  display: flex;
  flex-flow: row wrap;
  justify-content: flex-start;
}

.grid-item {
  height: 350px;
  flex-basis: 20%;
  -ms-flex: auto;
  width: 259px;
  position: relative;
  padding: 10px;
  box-sizing: border-box;
}

.grid-row a {
  text-decoration: none;
}

.wrapping-link {
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  z-index: 2;
  color: currentColor;
}

.grid-item-wrapper {
  -webkit-box-sizing: initial;
  -moz-box-sizing: initial;
  box-sizing: initial;
  background: #ececec;
  margin: 0;
  height: 100%;
  width: 100%;
  overflow: hidden;
  -webkit-transition: padding 0.15s cubic-bezier(0.4,0,0.2,1), margin 0.15s cubic-bezier(0.4,0,0.2,1), box-shadow 0.15s cubic-bezier(0.4,0,0.2,1);
  transition: padding 0.15s cubic-bezier(0.4,0,0.2,1), margin 0.15s cubic-bezier(0.4,0,0.2,1), box-shadow 0.15s cubic-bezier(0.4,0,0.2,1);
  position: relative;
}

.grid-item-container {
  height: 100%;
  width: 100%;
  position: relative;
}

.grid-image-top {
  height: 30%;
  width: 120%;
  background-size: cover;
  position: relative;
  background-position: 50% 50%;
  left: -10.5%;
  top: -4.5%;
}

.grid-image-top .centered {
  font-size: 20px;
  font-weight: 700;
  text-align: center;
  transform: translate(-50%, -50%);
  background-size: contain;
  background-repeat: no-repeat;
  position: absolute;
  top: 54.5%;
  left: 50%;
  width: 60%;
  height: 60%;
  background-position: center;
}

.grid-image-top.new-case {
  background: -webkit-gradient(linear,left top, left bottom,from(#1AA9FB),to(#1785C4));
  background: -webkit-linear-gradient(#1AA9FB,#1785C4);
  background: -o-linear-gradient(#1AA9FB,#1785C4);
  background: linear-gradient(#1AA9FB,#1785C4);
}

.grid-image-top.pending-case {
  background: -webkit-gradient(linear,left top, left bottom,from(#FFB266),to(#FF9933));
  background: -webkit-linear-gradient(#FFB266,#FF9933);
  background: -o-linear-gradient(#FFB266,#FF9933);
  background: linear-gradient(#FFB266,#FF9933);
}

.grid-image-top.done-case {
  background: -webkit-gradient(linear,left top, left bottom,from(#2db89a),to(#00793d));
  background: -webkit-linear-gradient(#2db89a,#00793d);
  background: -o-linear-gradient(#2db89a,#00793d);
  background: linear-gradient(#2db89a,#00793d);
}

.grid-item-content {
  padding: 0 20px 20px 20px;
}

.item-title {
  font-size: 24px;
  line-height: 26px;
  font-weight: 700;
  margin-bottom: 18px;
  display: block;
}

.item-category {
  text-transform: uppercase;
  display: block;
  margin-bottom: 20px;
  font-size: 14px;
}

.item-excerpt {
  margin-bottom: 20px;
  display: block;
  font-size: 14px;
}

.more-info {
  position: absolute;
  bottom: 0;
  margin-bottom: 25px;
  padding-left: 0;
  transition-duration: .5s;
  font-size: 12px;
  display: flex;
}

.more-info i {
  padding-left: 5px;
  transition-duration: .5s;
}

.grid-item:hover .more-info i {
  padding-left: 20px;
  transition-duration: .5s;
}

.more-info i::before {
  font-size: 16px;
}

.grid-item:hover .grid-item-wrapper {
  padding: 2% 2%;
  margin: -2% -2%;
}

@media(max-width: 1333px) {
  .grid-item {
    flex-basis: 33.33%;
  }
}

@media(max-width: 1073px) {
   .grid-item {
    flex-basis: 33.33%;
  }
}

@media(max-width: 815px) {
  .grid-item {
    flex-basis: 50%;
  }
}

@media(max-width: 555px) {
  .grid-item {
    flex-basis: 100%;
  }
}

</style>
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
    <div style="text-align: center;">
      <a href="{{ route('bsh_cases.create') }}"><button class="btn btn-success"><i class="fa fa-plus"></i> Create New Case</button></a>
    </div>
        <div class="container">
          <div class="grid-row">
            @foreach($cases as $case)
            <div class="grid-item">
              <a class="wrapping-link" href="{{ url('bsh_cases/handle', $case->id)}}"></a>
              <div class="grid-item-wrapper">
                <div class="grid-item-container">
                  <div class="grid-image-top pending-case">
                    <span class="centered">{{@$case->customer_name}} -- {{@$case->customer_phone}}</span>
                  </div>
                  <div class="grid-item-content">
                    <span class="item-title">Case ID: {{ @$case->id }}</span>
                    <span class="item-category">{{ @$case->description }}</span>
                    <span class="item-excerpt">Address: {{ @$case->address2 }}</span>
                    @if (!isset($case->address2))
                    <span class="item-excerpt">Address: {{ @$case->address1 }}</span>
                    @endif                    
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>


    <div class="text-center">
        {{ $cases->appends(Request::all())->links() }}
    </div>
</div>

@endsection

@section('javascript')
$('.wrapping-link').on('click', (e) {
  
})
@endsection