<section class="banner_main">
    <div id="myCarousel" class="carousel slide banner" data-ride="carousel" data-interval="2000">
       <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
       </ol>
       <div class="carousel-inner">
          <div class="carousel-item active">
             <img class="first-slide" src="slider/slide1.JPG" alt="First slide">
             <div class="container">
             </div>
          </div>
          <div class="carousel-item">
             <img class="second-slide" src="slider/slide2.JPG" alt="Second slide">
          </div>
          <div class="carousel-item">
             <img class="third-slide" src="slider/slide3.jpg" alt="Third slide">
          </div>
       </div>
       <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
       <span class="carousel-control-prev-icon" aria-hidden="true"></span>
       <span class="sr-only">Previous</span>
       </a>
       <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
       <span class="carousel-control-next-icon" aria-hidden="true"></span>
       <span class="sr-only">Next</span>
       </a>
    </div>
   
 </section>

 <style>
   /* Set fixed height for the carousel images */
   .carousel-item img {
     width: 100%; /* Ensures the image fills the width of the carousel */
     height: 640px; /* Adjust height as desired */
     object-fit: cover; /* Ensures the image covers the area without distortion */
     
   }
   </style>