
<div class="our_room">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="titlepage">
               <h2>Rooms</h2>
               <p>Lorem Ipsum available, but the majority have suffered</p>
            </div>
         </div>
      </div>
      <div class="row">
         @foreach($room->take(6) as $rooms) <!-- Limit to 6 rooms -->
         <div class="col-md-4 col-sm-6">
            <div id="serv_hover" class="room">
               <div class="room_img">
                  <figure><img style="height: 200px; width:400px" src="room/{{$rooms->room_image}}" alt="#"/></figure>
               </div>
               <div class="bed_room">
                  <h3>{{ $rooms->business_name }}</h3>
                  <p>{{ $rooms->room_type }}</p>
                  <p>{{ $rooms->price }}₱</p>
                  <p>Location: {{ $rooms->new_location }}</p>

                  <a class="btn btn-primary" href="{{url('room_details',$rooms->id)}}">Room Details</a>
               </div>
               
              
            </div>
         </div>
        @endforeach
      </div>
   </div>
</div>
<div class="our_room">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="titlepage">
               <h2>Tours and Activities</h2>
               <p>Lorem Ipsum available, but the majority have suffered</p>
            </div>
         </div>
      </div>
      <div class="row">
         @foreach($data->take(6) as $data) <!-- Limit to 6 data -->
         <div class="col-md-4 col-sm-6">
            <div id="serv_hover" class="room">
               <div class="room_img">
                  <figure><img style="height: 200px; width:400px" src="tours_activities/{{$data->image}}" alt="#"/></figure>
               </div>
               <div class="bed_room">
                  <h3>{{ $data->business_name }}</h3>
                  <p>{{ $data->type }}</p>
                  <p>{{ $data->price }}₱</p>
                  <p>{{ $data->location }}</p>

                  <a class="btn btn-primary" href="{{url('tours_activities_details',$data->id)}}">Room Details</a>
               </div>
               
              
            </div>
         </div>
        @endforeach
      </div>
   </div>
</div>

