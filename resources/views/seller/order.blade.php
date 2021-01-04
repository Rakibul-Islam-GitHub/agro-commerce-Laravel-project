@extends('seller.layout')
@section('title', 'Order')
@section('Dashboard', 'Orders')
@section('content')
<div class="card mb-3">
  <div class="card-header">
    <i class="fa fa-table"></i> Order Management Table</div>
  <div class="card-body">

    <div class="input-group mb-0">
      <div class="form-group">
        <input type="text" id="myInput" class="form-control" placeholder="Search order by ID..">
      </div>

    </div>
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Order ID</th>
            <th>Subtotal</th>
            <th>Date</th>
            <th>Shipping</th>
            <th>Status</th>
            <th>Action</th>

          </tr>
        </thead>


        @foreach($data as $d)
        <tr>
          <td> {{$d->oid}}</td>
          <td> {{$d->subtotal}}</td>
          <td> {{$d->date}}</td>
          <td> {{$d->shipping_method}}</td>
          <td> {{$d->status}}</td>

          @if($d->status=='incomplete')

          <td>

            <a class="editdltbtn2 approvebtn" id="dltitembtn" value="{{$d->oid}}">Approve Now</a>

          </td>

          @else
          <td>
            <p class="color-green" style="color: green">Approved</p>
          </td>
          @endif

        </tr>
        @endforeach


        </tbody>
      </table>
    </div>
  </div>

</div>

@endsection

@section('script')

<script>
  $(document).ready(function() {
   // $('#dataTable').DataTable();
   $('#myInput').keyup(function(){
    myFunction();
  });
  
   function myFunction() {
     
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("dataTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }

  /// order approve by ajax
  $('.approvebtn').click(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
      
      var id = $(this).attr("value");
      
      approve(id);

  });
  
  function approve(id) {
   
    $.ajax({
      url: "/seller/order/approveorder",
type: "put",

data: {
 
  'pid': id

},
success: function(response) {

  if (response=='success') {
    alert('This order is approved!');
    window.location.href= '/seller/order';
    
  }
  
  

},
error: function (request, status, error) {
alert(error);  //it will show error in webpage if any
}
      

    });
    
  }

  /// order approve end
  
    $('#logoutbtn').click(function(){
        
  
        $.ajax({
        method: "GET",
        url: "/logout", 
      
      })
      .done(function( res ) {
          window.location.href= '/login';
      });
  
    });
  
  
  });
  
        
</script>

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
  
  });
   
</script>

@endsection