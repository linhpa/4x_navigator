<html>
	<body>
	<p>Dear <strong>{{ $user->name }}</strong>,</p>
	<p>We've detected a login on new device: <strong>{{ $agent->browser() }}, {{ $agent->platform() }}, {{ $agent->device() }}</strong>. </p>
	<p>OTP: <input type="text" readonly value="{{ $user->token_2fa }}" style="text-align: center;"></p>
	</body>
</html>
