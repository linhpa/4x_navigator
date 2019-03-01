<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
	    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' />

	    <!-- CSRF Token -->
	    <meta name="csrf-token" content="{{ csrf_token() }}">

	    <title>{{ config('app.name', 'Laravel') }}</title>

	    <!-- Styles -->
	    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">        
	</head>
	<body>
		<div class="container">
		    <div class="row">
		        <div class="col-md-8 col-md-offset-2">
		            <div class="panel panel-default">
		                <div class="panel-heading" style="text-align: center;">Enter Your OTP</div>

		                <div class="panel-body" style="text-align: center;">
		                	@if (session('error'))
			                    <div class="alert alert-danger">
			                        {{ session('error') }}
			                    </div>
			                @endif		                	
		                    @if (session('status'))
		                        <div class="alert alert-success">
		                            {{ session('status') }}
		                        </div>
		                    @endif
							<form role="form" method="POST" action="/2fa">
								{{ csrf_field() }}
								<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
									<input id="2fa" type="text" class="form-control center-block" name="2fa" required autofocus style="width: 100px; text-align: center; font-size: 22px" autocomplete="off" maxlength="5">
									@if ($errors->has('2fa'))
									<span class="help-block">
										<strong>{{ $errors->first('2fa') }}</strong>
									</span>
									@endif
								</div>
								<div class="form-group">
									@if (isset($attempts))
									<span style="color: red">Attempts: {{ $attempts }}/5</span>
									@endif
								</div>
								<div class="form-group">
									<a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <button class="btn">Exit</button>                                      
                                    </a>                                    
									<button class="btn btn-primary" type="submit">Send</button>
								</div>								
							</form>
							<form role="form" method="POST" action="/2fa_resend">
								{{ csrf_field() }}
								<input type="submit" value="Haven't received OTP email? Request new email" style="background:none; border-width:0px; color:blue; text-decoration:underline;" />
							</form>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
						</div>
		            </div>
		        </div>
		    </div>
		</div>
	</body>
</html>