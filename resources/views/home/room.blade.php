<style>

.our_room .row {
    display: flex;
    flex-wrap: wrap;
    gap: 15px; /* Space between cards */
    justify-content: center; /* Center the cards evenly */
}

.our_room .col-md-3 {
    flex: 0 0 calc(33.333% - 15px); /* Each card takes 1/3 of the row width */
    max-width: calc(33.333% - 15px); /* Ensure consistent width */
    box-sizing: border-box;
}

.our_room .col-md-3.col-sm-6 {
    margin-bottom: 30px; /* Add spacing between rows */
}

.our_room .room {
    display: flex;
    flex-direction: column; /* Stack content vertically */
    justify-content: space-between; /* Evenly distribute content */
    text-align: center;
    background-color: #fff;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    height: 100%; /* Make all cards the same height */
}

.our_room .room .room_img {
    overflow: hidden;
    height: 200px; /* Set a fixed height for images */
    display: flex;
    justify-content: center;
    align-items: center;
}

.our_room .room .room_img figure {
    margin: 0;
    width: 100%;
    height: 100%;
}

.our_room .room .room_img figure img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ensure images fit within the container */
    transition: transform 0.5s ease;
}

.our_room .room .room_img figure img:hover {
    transform: scale(1.05); /* Slight zoom effect on hover */
}

.our_room .room .bed_room {
    margin-top: 15px;
}

.our_room .room .bed_room p {
    margin: 5px 0;
    font-size: 14px;
    color: #333;
}

.our_room .room .bed_room h3 {
    font-size: 18px;
    font-weight: bold;
    margin: 10px 0;
    color: #121212;
}

.our_room .btn-primary {
    display: inline-block;
    margin-top: 10px;
    padding: 10px 15px;
    font-size: 14px;
    color: white;
    background-color: #007bff;
    border: none;
    border-radius: 20px;
    text-transform: uppercase;
    transition: all 0.3s ease;
    text-decoration: none;
}

.our_room .btn-primary:hover {
    background-color: #0056b3;
    box-shadow: 0 4px 6px rgba(0, 123, 255, 0.5);
    transform: scale(1.05);
}

@media (max-width: 992px) {
    .our_room .col-md-3 {
        flex: 0 0 calc(50% - 15px); /* 2 items per row for tablets */
        max-width: calc(50% - 15px);
    }
}

@media (max-width: 768px) {
    .our_room .col-md-3 {
        flex: 0 0 100%; /* 1 item per row for small devices */
        max-width: 100%;
    }
}

</style>
<div class="our_room" style="padding-top: 40px">
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
         <div class="col-md-4 col-sm-6 mb-4">
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
<div class="our_room" style="padding-top: 40px">
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

