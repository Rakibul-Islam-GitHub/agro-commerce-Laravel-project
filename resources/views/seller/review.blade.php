@extends('seller.layout')
@section('title', 'Review')
@section('Dashboard', 'Review')
@section('content')
<h1>Comment list</h1>
<div class="container table-responsive py-5">
  <table class="table table-bordered table-hover">
    <thead class="thead-dark">
      <tr>

        <th scope="col">Customer</th>
        <th scope="col">Product</th>
        <th scope="col">Date</th>
        <th scope="col">Review</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>

      @foreach ($data as $d)

      <tr>
        <td>{{$d->rid}}</td>
        <td>{{$d->title}}</td>
        <td>{{$d->date}}</td>
        <td>{{$d->review}}</td>

        <td>

          <a class="editdltbtn2 reviewdltbtn" id="dltitembtn" data-toggle="modal" data-target='#reviewdltmodal'
            value="{{$d->rid}}">Delete</a>

        </td>
      </tr>

      @endforeach


    </tbody>
  </table>
</div>

{{-- delete review modal --}}
<div class="modal fade" id="reviewdltmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Do you want to delete this <em> Review? </em></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary  reviewdltcon" id="reviewdltconbtn">Confirm</a>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  $(document).ready(function() {
    $('#logoutbtn').click(function(){
        $.ajax({
        method: "GET", 
        url: "/logout", 
       
      })
      .done(function( res ) {
          window.location.href= '/login';
      });
  
    });

/// review delete by ajax start
    $('.reviewdltbtn').click(function () {
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
      var id = $(this).attr('value');
      alert(id);
      deletereview(id);
    });

    function deletereview(id) {
  
  $('#reviewdltconbtn').click(function(e){      // delete  confirm btn of modal
    
    e.preventDefault();
        $.ajax({

     url: "/seller/review/delete",
     type: "post",
     
     data: {
      
      
       'id': id

     },
     success: function(response) {
       //alert(response);
       window.location.href= '/seller/review';

     },
     error: function (request, status, error) {
     alert(error);  //it will show error in webpage if any
     }

     });
    });
   
 };
  
    // tooltip functions start
    (function($) {
    "use strict"; // Start of use strict
    // Configure tooltips for collapsed side navigation
    $('.navbar-sidenav [data-toggle="tooltip"]').tooltip({
      template: '<div class="tooltip navbar-sidenav-tooltip" role="tooltip" style="pointer-events: none;"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
    })
    // Toggle the side navigation
    $("#sidenavToggler").click(function(e) {
      e.preventDefault();
      $("body").toggleClass("sidenav-toggled");
      $(".navbar-sidenav .nav-link-collapse").addClass("collapsed");
      $(".navbar-sidenav .sidenav-second-level, .navbar-sidenav .sidenav-third-level").removeClass("show");
    });
    // Force the toggled class to be removed when a collapsible nav link is clicked
    $(".navbar-sidenav .nav-link-collapse").click(function(e) {
      e.preventDefault();
      $("body").removeClass("sidenav-toggled");
    });
    // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
    $('body.fixed-nav .navbar-sidenav, body.fixed-nav .sidenav-toggler, body.fixed-nav .navbar-collapse').on('mousewheel DOMMouseScroll', function(e) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    });
    // Scroll to top button appear
    $(document).scroll(function() {
      var scrollDistance = $(this).scrollTop();
      if (scrollDistance > 100) {
        $('.scroll-to-top').fadeIn();
      } else {
        $('.scroll-to-top').fadeOut();
      }
    });
    // Configure tooltips globally
    $('[data-toggle="tooltip"]').tooltip()
    // Smooth scrolling using jQuery easing
    $(document).on('click', 'a.scroll-to-top', function(event) {
      var $anchor = $(this);
      $('html, body').stop().animate({
        scrollTop: ($($anchor.attr('href')).offset().top)
      }, 1000, 'easeInOutExpo');
      event.preventDefault();
    });
  })(jQuery); // End of use strict
  
  
  });
  
        
</script>

@endsection