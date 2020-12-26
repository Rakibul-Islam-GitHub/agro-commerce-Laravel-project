@extends('seller.layout')
@section('title', 'Seller-Dashboard')
@section('Dashboard', 'Dashboard')
@section('content')

<div class="row">
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-primary o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-comments"></i>
        </div>
        <div class="mr-5"> {{$reviews}} reviews!</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="/seller/comments">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-warning o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-list"></i>
        </div>
        <div class="mr-5"> {{$products}} Products!</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="/seller/manageitem">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-success o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-shopping-cart"></i>
        </div>
        <div class="mr-5"> {{$datas}} Orders!</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="/seller/order">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>

  <div class="chart-container">
    <canvas id="chart"></canvas>
  </div>

  <!-- Example Social Card-->

  <!-- Example Notifications Card-->

  <!-- Example DataTables Card-->
  <div class="card mb-3" id="pdfprint">
    <div class="card-header">
      <i class="fa fa-table"></i> Completed orders
      <a id="order-report" class="order-report">Excel Report</a>
      <a id="pdf-report" class="pdf-report"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF Report</a>

    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Subtotal</th>
              <th>Date</th>
              <th>Action</th>

            </tr>
          </thead>
          @foreach($data as $d)
          <tr>
            <td> {{$d->oid}}</td>
            <td> {{$d->subtotal}}</td>
            <td> {{$d->date}}</td>

            <td>

              <a class="editdltbtn2" id="dltitembtn" href="/seller/order" value="{{$d->oid}}">View</a>

            </td>
          </tr>
          @endforeach




          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>

@endsection

@section('script')
<script>
  // -- main function start
  
  const EXCEL_TYPE = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=UTF-8';
  const EXCEL_EXTENSION = '.xlsx';
  $(document).ready(function() {
  
    // chart start
  
    $.ajax({
  
  url: "/seller/report",
  type: "POST",
  data: {
  
  'sellerid': 'seller id'
  
  },
  success: function(response) {
    showchart(response.length);
  
  
  },
  error: function (request, status, error) {
  //alert('error');  //it will show error in webpage if any
  }
  
  });
  
  
    
    //alert(monthdata);
  
    function showchart(lastdata){
      let monthdata =  [.4, .2, .2, .6, .1, .3, 1];
    monthdata[6]= lastdata;
      
    var data = {
    labels: ["May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov"],
    datasets: [{
      label: "Total order per month",
      backgroundColor: "rgba(255,99,132,0.2)",
      borderColor: "rgba(255,99,132,1)",
      borderWidth: 2,
      hoverBackgroundColor: "rgba(255,99,132,0.4)",
      hoverBorderColor: "rgba(255,99,132,1)",
      data: monthdata,
    }]
  };
  
  var options = {
    maintainAspectRatio: false,
    scales: {
      yAxes: [{
        stacked: true,
        gridLines: {
          display: true,
          color: "rgba(255,99,132,0.2)"
        }
      }],
      xAxes: [{
        gridLines: {
          display: false
        }
      }]
    }
  };
  
  Chart.Bar('chart', {
    options: options,
    data: data
  });
  
    }
  
    // chart end
    
  
    function downloadexcel(data) {
      const worksheet = XLSX.utils.json_to_sheet(data);
      const workbook = {
        Sheets:{
          'data': worksheet
        },
        SheetNames :['data']
      };
      const excelBuffer= XLSX.write(workbook, {booktype: 'xlsx', type: 'array'});
      console.log(excelBuffer);
      saveexcel(excelBuffer, 'order_report');
    }
    function saveexcel(buffer, filename) {
      const data =new Blob([buffer], {type: EXCEL_TYPE});
      saveAs(data, filename+'_export_'+new Date().getTime()+EXCEL_EXTENSION);
      
    }
  
        // var dltid = $(this).attr("value");
      // // alert(dltid);
      // report(dltid); 
    $('.order-report').click(function() {
  
  $.ajax({
  
  url: "/seller/report",
  type: "POST",
  data: {
  
  'sellerid': 'seller id'
  
  },
  success: function(response) {
  
  downloadexcel(response);
  // window.location.href= '/seller/manageitem/delete/confirm';
  
  
  
  },
  error: function (request, status, error) {
  //alert('error');  //it will show error in webpage if any
  }
  
  });
      
    });
  
  
    
  // pdf generator
  
  document.getElementById("pdf-report")
          .addEventListener("click", () => {
              const pdfprint = document.getElementById("pdfprint");
              
              
              html2pdf().from(pdfprint).save();
          })
  
  
  
  // pdf generator end
   
  
  
    $('.logoutbtn').click(function(){
        
  
        $.ajax({
        method: "GET", 
        url: "/logout", 
       
      })
      .done(function( res ) {
          
          window.location.href= '/login';
      });
  
  
  
  
  
  
    });
  
  
  });
  
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
        
</script>


@endsection