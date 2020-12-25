<!DOCTYPE html>
<html lang="en">
  <head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="/js/filesaver.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.2/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <style>
        table{
            margin-left: 0;
        }
        .card.mb-3 {
    width: 100%;
}
a{
  cursor: pointer;
  text-decoration: none !important;
}
.order-report {
    background: linear-gradient(to bottom, #3d94f6 5%, #1a386a 100%);
    background-color: #81a719;
    border-radius: 5px;
    border: 1px solid #506b91;
    display: inline-block;
    cursor: pointer;
    color: #ffffff;
    font-family: Arial;
    font-size: 16px;
    font-weight: bold;
    padding: 6px 14px;
    text-decoration: none;
    position: relative;
    left: 893px;
}
.order-report:hover {
  background: linear-gradient(to bottom, #3d94f6 5%, #1a386a 100%);
    background-color: #81a719;
	background-color:#1e62d0;
  color: white;
}
.order-report:active {
	position:relative;
	top:1px;
}
a#pdf-report {
    color: #f1f1f1;
    margin-left: 613px;
}

.pdf-report {
	background:linear-gradient(to bottom, #d0451b 5%, #f53913 100%);
	background-color:#d0451b;
	border-radius:5px;
	border:2px solid #942911;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:13px;
	padding:6px 24px;
	text-decoration:none;
}
.pdf-report:hover {
	background:linear-gradient(to bottom, #f53913 5%, #d0451b 100%);
	background-color:#f53913;
}
.pdf-report:active {
	position:relative;
	top:1px;
}

canvas {
  border: 1px dotted red;
}

.chart-container {
  position: relative;
  margin: auto;
  height: 80vh;
  width: 80vw;
}
#chart{
      display: block;
    height: 288px;
    width: 1205px;
}


    </style>
  </head>
  
  
  <body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
<a class="navbar-brand" href="/">Agriculture Market</a>
<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarResponsive">
  <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
      <a class="nav-link" href="/seller">
        <i class="fa fa-fw fa-dashboard"></i>
        <span class="nav-link-text">Dashboard</span>
      </a>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Add Items">
      <a class="nav-link" href="/seller/additem">
        <i class="fa fa-fw fa-cart-plus"></i>
        <span class="nav-link-text">Add Items</span>
      </a>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Manage Items">
      <a class="nav-link" href="/seller/manageitem">
        <i class="fa fa-fw fa-bars"></i>
        <span class="nav-link-text">Manage Items</span>
      </a>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Comments">
        <a class="nav-link" href="/seller/review">
          <i class="fa fa-fw fa-commenting-o"></i>
          <span class="nav-link-text">Reviews</span>
        </a>
      </li>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Order">
        <a class="nav-link" href="/seller/order">
          <i class="fa fa-fw fa-shopping-cart"></i>
          <span class="nav-link-text">Order</span>
        </a>
      </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
      <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
        <i class="fa fa-fw fa-wrench"></i>
        <span class="nav-link-text">Components</span>
      </a>
      <ul class="sidenav-second-level collapse" id="collapseComponents">
        <li>
          <a href="/seller/comments">Comments</a>
        </li>
        <li>
          <a href="/seller/message">Message</a>
        </li>
      </ul>
    </li>
   
  </ul>


              <ul class="navbar-nav sidenav-toggler">
                <li class="nav-item">
                  <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                  </a>
                </li>
              </ul>
              <ul class="topnav navbar-nav ml-auto">

                <!-- message alert dropdown start -->
               
                <!-- message alert dropdown end-->
        
        
                
                
                <li class="nav-item">
                    <a href="/seller/profile" class="nav-link">
                        <i class=" color-white fa fa-fw fa-user"></i>Profile</a>
                  </li>
        
        
                <li class="nav-item color-red">
                  <a class="nav-link color-red" data-toggle="modal" data-target="#exampleModal">
                    <i  class="color-red fa fa-fw fa-sign-out"></i>Logout</a>
                </li>
              </ul>
            </div>
          </nav>
    <!-- nav end -->



  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/seller">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">@yield('Dashboard')</li>
      </ol>



      <!-- content starts here-->

      @yield('content')

      <!-- contents end -->


    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Rakibul</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>


    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a id="logoutbtn" class="btn btn-primary logoutbtn">Logout</a>
          </div>
        </div>
      </div>
    </div>

  </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    
    
</body>
</html>