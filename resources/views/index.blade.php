<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'/>
	<title>Wadoo</title>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
  <!--Import Google Icon Font-->
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/css/materialize.min.css">

  <link rel="stylesheet" href="./css/index.css" rel="stylesheet">
	<link rel="stylesheet" href="./css/global.css" rel="stylesheet">
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>
  <main id="mainContainer">
    <center>
      <img class="responsive-img" style="width: 500px;" src="./img/wadooLogoWhite.png" />
      <div class="section"></div>

      <h4 class="white-text">what to do, simplified.</h4>

			<!--displays error message if one does exist for the tweet-->
			@if (count($errors) > 0)
				<div class="pink-text text-darken-4">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }} </li>
						@endforeach
					</ul>
				</div>
			@endif

      <div class="row">
				<div class = "col s2 m3 l4"></div>
        <div class="z-depth-5 grey lighten-4 col s8 m6 l4" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

          <form class="col s12" action="/login" method="post">
						{{ csrf_field() }}
            <div class='row'>
              <div class='col s12'>
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='text' name='email' id='email' value="{{ old('email') }}" data-error=""></input>
                <label for='email'>Enter your email</label>
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='password' name='password' id='password' value="{{ old('password') }}" data-error=""></input>
                <label for='password'>Enter your password</label>
              </div>
              <!-- <label style='float: right;'>
								<a class='pink-text' href='#!'><b>Forgot Password?</b></a>
							</label> -->
            </div>

            <br />
            <center>
              <div class='row'>
                <button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect yellow darken-4'>Login</button>
              </div>
            </center>

            <center>
              <a href="/signup">Create account</a>
            </center>
            <div class="section"></div>
            <div class="section"></div>
          </form>
        </div>
				<div class = "col s2 m3 l4"></div>
      </div>
    </center>
  </main>
  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/js/materialize.min.js"></script>

</body>

</html>
