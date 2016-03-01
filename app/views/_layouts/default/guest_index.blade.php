<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Laravel Quiz - Welcome</title>
    <link href="{{asset('css/main/guest_style.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('js/jquery/jquery.js')}}"></script>
	<script>
	$(document).ready(function () {
		$('#login-button').on('click',function(){
			$('#login-button').css("background-color","#00b0e6");
			$('#signup-button').css("background-color","rgba(0, 145, 160, 1)");
			$('#login-form').slideDown();
			$('#signup-form').hide();
			$('.alert').hide();
		});
		$('#signup-button').on('click',function(){
			$('#login-button').css("background-color","rgba(0, 145, 160, 1)");
			$('#signup-button').css("background-color","#00b0e6");
			$('#login-form').hide();
			$('#signup-form').slideDown();
			$('.alert').hide();

		});
	});
	</script>
</head>
<body>

	<div id="main-container">


		<nav class="clearfix">
			<h2 id="login-button">Login</h2>
			<h2 id="signup-button">Signup</h2>
		</nav>

		@include('flash::message')
        @include('_layouts.default.partials.errors')

		<!--Signup-->
		<div id="signup-form">
            {{Form::open(array('action' => 'signup'))}}
            <div class="form-group">
                {{Form::text('fname',null, array('placeholder'=>'First Name'))}}
            </div>

            <div class="form-group">
                {{Form::text('lname',null, array('placeholder'=>'Last Name'))}}
            </div>

            <div class="form-group">
                {{Form::text('email',null, array('placeholder'=>'Email address'))}}
            </div>

            <div class="form-group">
                {{Form::text('faculty_number',null, array('placeholder'=>'Faculty Number'))}}
            </div>

            <div class="form-group">
                {{Form::password('password' ,array('placeholder'=>'Password'))}}
            </div>

            <div class="form-group">
                {{Form::password('password_confirmation', array('placeholder'=>'Password Confirmation'))}}
            </div>

            {{Form::submit('Signup',array('class'=>'btn btn-info btn-s'))}}
            {{ Form::close() }}
        </div>

        <!--Login-->
		<div id="login-form">
            {{Form::open(array('action' => 'login'))}}
            <div class="form-group">
                {{Form::text('email',null, array('placeholder'=>'Email address' ))}}
            </div>

            <div class="form-group">
                {{Form::password('password' ,array('placeholder'=>'Password'))}}
            </div>

            {{Form::submit('Login',array('class'=>'btn btn-info btn-s'))}}

            {{ Form::close() }}
	    </div>

	</div>
</body>
</html>
