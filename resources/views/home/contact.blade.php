<div class="contact">
   <div class="container">
       <div class="row">
           <div class="col-md-12">
               <div class="titlepage">
                   <h2 style="text-align: center; margin-bottom: 20px;">Contact Us</h2>
               </div>
               <!-- Toastr success message -->
               @if(session()->has('message'))
               <div class="alert alert-success alert-dismissible fade show" id="success-alert">
                   {{ session()->get('message') }}
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>
               @endif
           </div>
       </div>
       <div class="row justify-content-center">
           <div class="col-md-8">
               <form id="request" class="main_form" action="{{ url('contacts') }}" method="POST">
                   @csrf
                   <div class="row">
                       <div class="col-md-12 mb-3">
                           <input class="form-control" placeholder="Name" type="text" name="name" required>
                       </div>
                       <div class="col-md-12 mb-3">
                           <input class="form-control" placeholder="Email" type="email" name="email" required>
                       </div>
                       <div class="col-md-12 mb-3">
                           <input class="form-control" placeholder="Phone Number" type="number" name="phone" required>
                       </div>
                       <div class="col-md-12 mb-3">
                           <textarea class="form-control" placeholder="Message" name="message" rows="5" required></textarea>
                       </div>
                       <div class="col-md-12">
                           <button type="submit" class="btn btn-primary w-100">Send</button>
                       </div>
                   </div>
               </form>
           </div>
       </div>
   </div>
</div>

<!-- Toastr Script -->
<script>
   document.addEventListener('DOMContentLoaded', function () {
       @if(session()->has('message'))
           toastr.options = {
               "closeButton": true,
               "progressBar": true,
               "positionClass": "toast-top-right",
               "timeOut": "5000",
           };
           toastr.success("{{ session('message') }}", "Success");
       @endif
   });
</script>

<!-- Style -->
<style>
   .contact {
       padding: 40px 0;
       background-color: #f8f9fa;
   }

   .titlepage h2 {
       font-size: 2.5rem;
       color: #1e49a1;
       font-weight: bold;
   }

   .form-control {
       border-radius: 8px;
       border: 1px solid #ddd;
       padding: 10px;
       font-size: 1rem;
   }

   .form-control:focus {
       border-color: #007bff;
       box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
   }

   .btn-primary {
       background-color: #007bff;
       border: none;
       padding: 10px 20px;
       font-size: 1rem;
       font-weight: bold;
       border-radius: 8px;
       transition: all 0.3s;
   }

   .btn-primary:hover {
       background-color: #0056b3;
   }
</style>
