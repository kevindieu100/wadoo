<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>



<!--DURATION OPTION-->
  <div class="col s12 m6 l6">
    <div id="durationCard" class="card-panel hoverable z-depth-3 halign-wrapper">
      <h5 class="center-align">DURATION</h5>
      <div class="section"></div>
      <div class="col s0 m1 l3"></div>
      <div class="materialPicker col s12 m10 l6">
          <!--HOURS-->
          <div class="timeContainer first center-align col s6">
              <div class="waves-effect waves-light btn pickerButton btnUp orange">
                  <i class="mdi-hardware-keyboard-arrow-up"></i>
              </div>
              <div id="hoursDisplay" class="Number">00</div>
              <div class="waves-effect waves-light btn pickerButton btnDown orange">
                  <i class="mdi-hardware-keyboard-arrow-down"></i>
              </div>
              <h6>Hours</h6>
          </div>

          <!--MINUTES-->
          <div class="timeContainer second center-align col s6">
              <div class="waves-effect waves-light btn pickerButton btnUp orange">
                  <i class="mdi-hardware-keyboard-arrow-up"></i>
              </div>
              <div id="minutesDisplay" class="Number">00</div>
              <div class="waves-effect waves-light btn pickerButton btnDown orange">
                  <i class="mdi-hardware-keyboard-arrow-down"></i>
              </div>
              <h7>Minutes</h7>
          </div><!--END OF MINUTES CONTAINER-->
      </div><!--END OF MATERIALPICKER-->
      <div class="col s0 m1 l3"></div>
    </div><!--end of card-->
  </div><!--end of col-->
