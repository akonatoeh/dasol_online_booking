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
                  <h3>{{ $rooms->room_title }}</h3>
                  <p>{{ $rooms->room_type }}</p>
                  <p>Price: {{ $rooms->price }}₱</p>
                  <p>Location: {{ $rooms->new_location }}</p>

                  <a class="btn btn-primary" href="{{url('room_details',$rooms->id)}}">Room Details</a>
               </div>
               
              
            </div>
         </div>
        @endforeach
      </div>
   </div>
</div>
