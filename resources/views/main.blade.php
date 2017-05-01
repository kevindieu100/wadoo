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

  <link rel="stylesheet" href="{{ asset('css/materializecss/material-icons.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/materializecss/nouislider.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/main.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/global.css') }}" rel="stylesheet">

	<!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>

  <!--the slide out side menu-->
  <ul id="slide-out" class="side-nav">
    <li><div class="userView">
      <div class="background">
        <img src="images/office.jpg">
      </div>
      <a href="#!user"><img class="circle" src="images/yuna.jpg"></a>
      <a href="#!name"><span class="white-text name">John Doe</span></a>
      <a href="#!email"><span class="white-text email">jdandturk@gmail.com</span></a>
    </div></li>
    <li><a href="#!"><i class="material-icons">cloud</i>First Link With Icon</a></li>
    <li><a href="#!">Second Link</a></li>
    <li><div class="divider"></div></li>
    <li><a class="subheader">Subheader</a></li>
    <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
  </ul>
  <!--end of slide out side menu-->

  <!--NAV MENU-->
  <div class="navbar-fixed">
    <nav class="nav-extended orange darken-1">
      <div class="nav-wrapper">
        <!-- <a href="#" class="button-collapse show-on-large" data-activates="slide-out"><i class="material-icons left">menu</i></a> -->
        <a href="#" class="brand-logo center"><img class="responsive-img" style="width: 120px;" src="{{asset('img/wadooLogoWhite.png')}}" /></a>
      </div>
      <div class="nav-content">
        <ul class="tabs tabs-transparent tabs-fixed-width">
					<li class="tab"><a id="profileNav" href="#profileContainer"><i class="large material-icons">perm_identity</i></a></li>
          <li class="tab"><a id="optionsNav" href="#optionsContainer"><i class="large material-icons">settings</i></a></li>
          <li class="tab"><a href="#itineraryContainer"><i class="large material-icons">list</i></a></li>
	        <li class="tab disabled"><a href="#test4"><i class="large material-icons">language</i></a></li>
        </ul>
      </div>
    </nav>
  </div>
  <!--end of NAV MENU-->

  <main id="mainContainer">

		<!--OPTION CONTAINER-->
		<div id="optionsContainer">
	    <div class="section"></div>
	    <form id="mainForm" method="POST" class="col s12 m12 l12">
	      <!--LOCATION OPTION -->
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
	      <div class="section"></div>
	      <div class="row">
	        <div class="col s12 m7 l7">
	          <div id="locationCard" class="card-panel hoverable horizontal z-depth-3">
	              <h5 class="center-align">LOCATION</h5>
	              <div class="section"></div>
	              <!--LEFT SIDE WITH MAP-->
	              <div class="col s12 m12 l12">
	                  <div class="card-image">
	                    <div id="map"></div>
	                  </div>
	              </div>

	              <!--RIGHT SIDE WITH LOCATION INPUT-->
	              <div class="col s12 m12 l12">
	                  <div id="locationCardContent" class="card-content valign-wrapper">
	                      <!-- <h6>Enter a Starting Location</h6> -->
	                      <div class="input-field col s12">
	                        <input placeholder="Enter a starting location" type="text" name="pickupLocation" id="pickupLocation">
	                        <label for="pickUpLocation">Enter a Starting Location</label>
	                      </div>
	                  </div>
	              </div>
	            </div>
	          </div><!--end of locationCard-->
	      <!--END OF LOCAITON OPTION-->
				<div class="col s12 m5 l5">
					<!--BUDGET OPTION-->
					<div class="col s12 m12 l12" style="height: auto">
					<div id="durationCard"class="card-panel hoverable z-depth-3 center-align" style="height: 100%">
						<h5 class="center-align">DURATION</h5>
						<div class="section"></div>
							<div id="durationDisplay" class="Number">0</div>
						<div id="durationSlider" class="orange"></div>
					</div><!--END OF BUDGETCARD-->
				</div>
	      <!--END OF DURATION OPTION-->`

	      <!--BUDGET OPTION-->
	      <div class="col s12 m12 l12" style="height: auto">
	      <div id="budgetCard"class="card-panel hoverable z-depth-3 center-align" style="height: 100%">
					<h5 class="center-align">BUDGET</h5>
					<div class="section"></div>
						<div id="budgetDisplay" class="Number">0</div>
					<div id="budgetSlider" class="orange"></div>
				</div><!--END OF BUDGETCARD-->
	      </div>
	      <!--END OF BUDGET OPTION-->
			</div>
		</div>

				<div class='row'>
					<div class="col s4"></div>
					<button type="submit" name='btn_login' class='col s4 btn btn-large waves-effect yellow darken-4'>Let's Go!</button>
					<div class="col s4"></div>
				</div>

	    </form><!--end of form-->
	</div>
	<!--END OF OPTION DIV-->

	<!--ITINERARY TAB-->
	<div id="itineraryContainer">
	</div>
	<!--END OF ITINERARY TAB-->

	<!--PROFILE TAB-->
	<div id="profileContainer">
		<div class="section"></div>
		<div class="section"></div>
		<div class="section"></div>
		<div class="row">
		<!--USER'S PROFILE INFO-->
			<div id="userProfileContainer" class="col s12 m4 l4">
							<!--WHERE THE SIGN UP BOX BEGINS-->
							<div class="z-depth-5 grey lighten-4 col s12 m12 l12" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">
								<div class="row center-align">
									<img class="circle" src="{{ asset('img/profile_image.png') }}" style="width: 10vw; height: auto ">
									<h3>Welcome, {{ $user->first_name }}. </h3>
								</div>
								@if (count($errors) > 0)
									<div class="pink-text text-darken-4">
										<ul>
											@foreach ($errors->all() as $error)
												<li>{{ $error }} </li>
											@endforeach
										</ul>
									</div>
								@endif

								<!--displays success message if tweet was added to database-->
								@if(session('successStatus'))
									<center><div class="green-text text-lighten-2">
										{{ session('successStatus') }}
									</div></center>
								@endif
								<ul class="collapsible" data-collapsible="accordion">
						    <li>
						      <div class="collapsible-header"><center>Click Here To Update Profile</center></div>
						      <div class="collapsible-body row" style="height: auto">
										<form id="profileForm" class="col s12 m12 l12" method="post" action='/user/{{ $user->id }}/update'>
											{{ csrf_field() }}
											<input name="_method" type="hidden" value="PUT">
											<!--NAME ROW-->
											<div class="row">
												<div class="input-field col s12 m12 l12">
													<input placeholder="Enter your first name" id="first_name" type="text" name="first_name" value="{{ $user->first_name }}"></input>
													<label for="first_name">First Name</label>
												</div>
												<div class="input-field col s12 m12 l12">
													<input placeholder="Enter your last name" id="last_name" type="text" name="last_name" value="{{ $user->last_name }}"></input>
													<label for="last_name">Last Name</label>
												</div>
											</div>
											<!--end of NAME ROW-->

											<!--EMAIL ROW-->
											<div class="row">
												<div class="input-field col s12 m12 l12">
													<input placeholder="Enter your email" id="email" type="email" name="email" value="{{ $user->email }}">
													<label for="email">Email</label>
												</div>
											</div>
											<!--end of EMAIL ROW-->

											<br />
											<center>
												<div class='row'>
													<div class="col m2 l2"></div>
													<button type='submit' name='btn_login' class='col s12 m8 l8 btn btn-large waves-effect yellow darken-4'>Update Profile</button>
													<div class="col m2 l2"></div>
												</div>
											</center>
										</form>
									</div> <!--END OF COLLAPSIBLE BODY-->
							</div><!--END OF SIGN UP BOX-->
		</div>
		<!--END OF USER PROFILE INFO-->

		<!--USER'S SAVED ITINERARIES-->
			<div id="userItineraryContainer" class="col s12 m8 l8">
				<div class="row">
					<div class="col s12 z-depth-5 grey lighten-4">
						<center> <h4>Your Saved Itineraries</h4></center>
						@if(session('updateSuccess'))
							<center><div class="green-text text-lighten-2">
								{{ session('updateSuccess') }}
							</div></center>
						@endif
						<table class="centered highlight responsive-table">
							<thead>
								<tr>
										<th>Title</th>
										<th>Total Cost</th>
										<th>Total Duration</th>
										<th># of Experiences</th>
										<th>Preview</th>
										<th>Update</th>
										<th>Delete</th>
								</tr>
							</thead>

							<tbody>
								@foreach($itineraries as $itinerary)
								<tr>
									<td><input id="title_{{ $itinerary->id }}" class="itinerary_title" type="text" name="itinerary_{{ $itinerary->id }}" value="{{ $itinerary->title }}"></td>
									<td>{{ $itinerary->displayBudget }}</td>
									<td>{{ $itinerary->displayDuration }}</td>
									<td>{{ $itinerary->numExperiences }}</td>
									<td><a class="preview_button waves-effect waves-light btn-floating amber lighten-2"><i id="{{ $itinerary->id }}" class="tiny material-icons">view_list</i></a></td>
									<td><a class="update_button waves-effect waves-light btn-floating blue lighten-2"><i id="{{ $itinerary->id }}" class="tiny material-icons">loop</i></a></td>
									<td><a href="/itineraries/{{$itinerary->id}}/delete" class="waves-effect waves-light btn-floating red lighten-1"><i class="tiny material-icons">delete</i></a></td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
			</div><!--END OF ROW-->
		<!--END OF USER'S SAVED ITIENRARIES-->
		</div>

		<!--ITINERARY PREVIEW MODAL-->
		<div id="itineraryPreviewModal" class="modal" style="width:100%;height:100%;">
			<div id="itineraryPreviewModalContent" class="modal-content">
			</div>
		</div>
		<!--END OF ITINERARY PREVIEW MODAL-->

		<div class="section"></div>
	</div>
	<!--END OF PROFILE TAB-->

  </main>
	<div id="loadingContainer">
	</div>
  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/js/materialize.min.js"></script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3M4VP_4FThlKqHoK_GXooKnhrbV48M70&libraries=places"></script>
  <!-- <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script> -->
	<script src="{{ asset('js/materializecss/nouislider.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/main.js') }}" type="text/javascript"></script>

</body>

</html>
