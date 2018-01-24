login
{{ $errors->first('email') }}
{{ $errors->first('password') }}
{{ $errors->first('error_msg') }}
<input name="email" value="{{ old('email') }}">