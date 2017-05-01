<!-- Cards container -->
<div id="card-container" class="row" style="margin-top: 50px">
  <div class="section"></div>
    <div class="row">
      <div class="col s0 m2 l2"></div>
      <div class="col s12 m8 l8 card-panel z-depth-3 hoverable direction_card">
        <div class="col s12 m12 l12">
          <center><h3 class="transportation_icon_container">{{ $itinerary->title }}</h3></center>
        </div>
        <!--END OF TRANSPORTATION METHOD-->

        <!--DESTINATION INFO-->
        <div class="col s12 m6 l6">
          <div class="col s12 m12 l12 center-align"><h5 class="direction_info"><i class="small material-icons">av_timer</i> <strong>Total Duration:</strong> ~{{ $itinerary->displayDuration }}</h5></div>
          <div class="col s12 m12 l12 center-align grey-text"><p class="direction_info"><strong>Duration Preference:</strong> {{ $itinerary->displayDurationPreference }}</p></div>
        </div>
        <!--END DESTINATION INFO-->

        <!--DIRECTION SUMMARY INFO-->
        <div class="col s12 m6 l6">
          <div class="col s12 m12 l12 center-align"><h5 class="direction_info"><i class="small material-icons">trending_up</i> <strong>Total Cost:</strong> ~{{ $itinerary->displayBudget }}</h5></div>
          <div class="col s12 m12 l12 grey-text center-align"><p class="direction_info"><strong>Budget:</strong> ~{{ $itinerary->displayBudgetPreference }}</p></div>
        </div>
      </div>
      <!--END OF TOTAL SUMMARY ROW-->
      <div class="col s0 m2 l2"></div>
    </div>
    @foreach($experiences as $experience)
    <div class="row">
      <div class="col m2 l2"></div>
      <!--START OF DIRECTION CARD-->
      <div class="col s12 m8 l8 card-panel z-depth-3 hoverable direction_card">
        <div class="row">
          <!--TRANSPORTATION METHOD-->
          <div class="col s12 m3 l3">
            <center><h4 class="transportation_icon_container">{{ $experience->fromPrevTravelMode }}</h4></center>
          </div>
          <!--END OF TRANSPORTATION METHOD-->

          <!--DESTINATION INFO-->
          <div class="col s12 m5 l5">
            <div class="col s12"><p class="direction_info"><i class="tiny material-icons">room</i> <strong>Start:</strong> {{ $experience->prevAddress }}</p></div>
            <div class="col s12"><p class="direction_info"><i class="tiny material-icons">room</i> <strong>End:</strong> {{ $experience->address }}</p></div>
          </div>
          <!--END DESTINATION INFO-->

          <!--DIRECTION SUMMARY INFO-->
          <div class="col s12 m4 l4">
            <div class="col s6 m12 l12"><p class="direction_info"><i class="tiny material-icons">av_timer</i> <strong>Duration:</strong> {{ $experience->displayDurationFromPrevious }}</p></div>
            <div class="col s6 m12 l12"><p class="direction_info"><i class="tiny material-icons">swap_calls</i> <strong>Distance:</strong> {{ $experience->displayDistanceFromPrevious }}</p></div>
          </div>
          <!--END OF DIRECTION SUMMARY INFO-->
        </div>
        <!--END OF INNER ROW-->
      </div>
      <!--END OF DIRECTION CARD-->
      <div class="col m2 l2"></div>
    </div> <!--END OF ROW-->
    <div class="row">

        <!--START OF EXPERIENCE CONTENT-->
        <div class="col m2 l2"></div>
        <div class="col s12 m8 l8 card-panel z-depth-3 hoverable experience_card">
          <div class="row">
            <div class="col s6 image_container" style="background-image: url('{{ $experience->image_url }}');"> </div>
            <div class="col s6">
                <div class="row">
                  <div class="col s12"><h4 class="black-text text-darken-4"> {{ $experience->business_name }}</h4></div>

                  <div class="grey-text lighten-2">
                    <div class="col s12"><p class="experience_info"><i class="tiny material-icons">room</i> {{ $experience->address }}</p></div>
                  </div>
                  <div class="col s12 ">
                      <div class="col s12"><p class="experience_info text-darken-4 orange-text"><i class="tiny material-icons">phone</i>&nbsp;{{ $experience->phone }}</p></div>
                      <div class="col s12 m6 l6"><span class="experience_info text-darken-4 orange-text"><i class="tiny material-icons">stars</i>&nbsp;{{ $experience->rating }} stars</span></div>
                      <div class="col s12 m6 l6"><span class="experience_info text-darken-4 orange-text"><i class="tiny material-icons">comment</i>&nbsp;{{ $experience->review_count}} reviews on Yelp</span></div>
                      <div class="col s12 m6 l6"><a href="{{ $experience->yelp_url }}" class="orange-text lighten-2 experience_info" target="_blank"><i class="material-icons">&nbsp;language</i>Check out on Yelp</a></div>
                      <div class="col s12 m6 l6"><a href="#" class="orange-text lighten-2 experience_info"><i class="material-icons">&nbsp;launch</i>Learn More</a></div>
                      <!-- /experiences/{{ $experience->yelp_id }} for learn more, but doesn't work for now-->
                  </div>
                </div>
            </div>
            <div class="col s12">
              <div class="col s6"><p class="direction_info"><i class="tiny material-icons">av_timer</i> <strong>Duration:</strong> {{ $experience->displayDuration }}</p></div>
              <div class="col s6"><p class="direction_info"><i class="tiny material-icons">trending_up</i> <strong>Cost:</strong> ${{ $experience->price_estimate }}</p></div>
            </div>
          </div>
        </div>
        <!--END OF EXPERIENCE CARD-->
        <div class="col m2 l2"></div>
    </div><!--END OF ROW-->

      @if($experience == end($experiences))
        <div class="row">
          <div class="col m2 l2"></div>
          <!--START OF DIRECTION CARD-->
          <div class="col s12 m8 l8 card-panel z-depth-3 hoverable direction_card">
            <div class="row">
              <!--TRANSPORTATION METHOD-->
              <div class="col s12 m3 l3">
                <center><h4 class="transportation_icon_container">{{ $experience->fromPrevTravelMode }}</h4></center>
              </div>
              <!--END OF TRANSPORTATION METHOD-->

              <!--DESTINATION INFO-->
              <div class="col s12 m5 l5">
                <div class="col s12"><p class="direction_info"><i class="tiny material-icons">room</i> <strong>Start:</strong> {{ $experience->address }}</p></div>
                <div class="col s12"><p class="direction_info"><i class="tiny material-icons">room</i> <strong>End:</strong> {{ $experience->startAddress }}</p></div>
              </div>
              <!--END DESTINATION INFO-->

              <!--DIRECTION SUMMARY INFO-->
              <div class="col s12 m4 l4">
                <div class="col s6 m12 l12"><p class="direction_info"><i class="tiny material-icons">av_timer</i> <strong>Duration:</strong> {{ $experience->displayDurationToStart }}</p></div>
                <div class="col s6 m12 l12"><p class="direction_info"><i class="tiny material-icons">room</i> <strong>Distance:</strong> {{ $experience->displayDistanceToStart }}</p></div>
              </div>
              <!--END OF DIRECTION SUMMARY INFO-->
            </div>
            <!--END OF INNER ROW-->
          </div>
          <!--END OF DIRECTION CARD-->
          <div class="col m2 l2"></div>
        </div> <!--END OF ROW-->
      @endif
    @endforeach

    @if(!$preview)
      <div class="section"></div>
    <div class="row">
      <div class="col s12">
        <center><button onclick="getNewItinerary()" class="btn yellow darken-4"><i class="material-icons">&nbsp;replay</i>Generate Another Itinerary</button> </center>
      </div>
      <div class="section"></div>
      <div class="section"></div>
      <div class="col s12">
        <center><button onclick="saveItinerary()" class="btn yellow darken-2"><i class="material-icons">&nbsp;library_add</i>Save Itinerary</button> </center>
      </div>
    </div>
    @endif
    <div class="section"></div>
</div>
<!-- card container -->
