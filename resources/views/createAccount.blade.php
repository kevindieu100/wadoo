<!doctype html>
<html>
<head>
	<meta charset='utf-8'>
	<title>Wadoo</title>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
  <!--Import Google Icon Font-->
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/css/materialize.min.css">

  <link rel="stylesheet" href="{{ asset('css/createAccount.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/global.css') }}" rel="stylesheet">
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>
  <main id="mainContainer">
    <center>
      <img class="responsive-img" style="width: 300px;" src="{{asset('img/wadooLogoWhite.png')}}" />

      <h5 class="white-text">create an account to simply discover things to do.</h5>
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
        <center>
        <div class="row">
          <div class="col s1 m3 l3"></div>
          <!--WHERE THE SIGN UP BOX BEGINS-->
          <div class="z-depth-5 grey lighten-4 col s10 m6 l6" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">
            <form class="col s12 m12 l12" method="post" action='/user/create'>
							{{ csrf_field() }}
							<!--NAME ROW-->
              <div class="row">
                <div class="input-field col s12 m6 l6">
                  <input placeholder="Enter your first name" id="first_name" type="text" name="first_name"></input>
                  <label for="first_name">First Name</label>
                </div>
                <div class="input-field col s12 m6 l6">
                  <input placeholder="Enter your last name" id="last_name" type="text" name="last_name"></input>
                  <label for="last_name">Last Name</label>
                </div>
              </div>
              <!--end of NAME ROW-->

              <!--GENDER ROW-->
              <!-- <div class="row">
                <div class="input-field col s12">
                  <select>
                    <option value="" disabled selected>Choose your gender</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                    <option value="3">Trans</option>
                    <option value="4">Other</option>
                  </select>
                  <label>Gender</label>
                </div>
              </div> -->
              <!--END OF GENDER ROW-->

              <!--EMAIL ROW-->
              <div class="row">
                <div class="input-field col s12 m12 l12">
                  <input placeholder="Enter your email" id="email" type="email" name="email">
                  <label for="email">Email</label>
                </div>
              </div>
              <!--end of EMAIL ROW-->

              <!--PASSWORD ROW-->
              <div class="row">
                <div class="input-field col s12 m12 l12">
                  <input placeholder="Password must be 8 characters" id="password" type="password" name="password"></input>
                  <label for="password">Password</label>
                </div>
                <div class="input-field col s12 m12 l12">
                  <input placeholder="Re-enter the above password" id="repassword" type="password" name="repassword"></input>
                  <label for="repassword">Re-enter Password</label>
                </div>
              </div>
              <!--end of PASSWORD ROW-->

              <br />
              <center>
                <div class='row'>
                  <div class="col m2 l4"></div>
                  <button type='submit' name='btn_login' class='col s12 m8 l4 btn btn-large waves-effect yellow darken-4'>Create Account</button>
                  <div class="col m2 l4"></div>
                </div>
              </center>
            </form>

          </div><!--END OF SIGN UP BOX-->
          <div class="col s1 m3 l3"></div>
        </div> <!--end of outer row-->
    </center>
  </main>
  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/js/materialize.min.js"></script>
  <script>
    $(document).ready(function() {
      $('select').material_select();
    });
  </script>

</body>

</html>
