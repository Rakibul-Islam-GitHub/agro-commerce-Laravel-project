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
        <th scope="col">ProductID</th>
        <th scope="col">Date</th>
        <th scope="col">Review</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>

      @foreach ($data as $d)

      <tr>
        <td>{{$d->rid}}</td>
        <td>{{$d->productid}}</td>
        <td>{{$d->date}}</td>
        <td>{{$d->review}}</td>

        <td>

          <a class="editdltbtn2" href="/product/{{$d->rid}}" id="dltitembtn" value="{{$d->rid}}">Delete</a>

        </td>
      </tr>

      @endforeach


    </tbody>
  </table>
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