@extends('seller.layout')
@section('title', 'Manage Product')
@section('Dashboard', 'Manage Product')
@section('content')
<div class="card mb-3">
  <div class="card-header">
    <i class="fa fa-table"></i> Product management Data Table</div>
  <div class="card-body">

    <div class="input-group mb-0">
      <div class="form-group">
        <input type="text" id="myInput" class="form-control" placeholder="Search product by ID..">
      </div>

    </div>
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>#ID</th>
            <th>Image</th>
            <th>Title</th>
            <th>Price</th>
            <th>Description</th>
            <th>Status</th>
            <th>Action</th>

          </tr>
        </thead>

        <tbody>
          @foreach ($data as $d)

          <tr>
            <td>{{$d->pid}}</td>
            <td><img src="/upload/{{$d->image}}" width="60" height="50" alt="pic"></td>
            <td>{{$d->title}}</td>
            <td>{{$d->price}}</td>
            <td>{{$d->description}}</td>
            <td>{{$d->status}}</td>
            <td>
              <a class="editdltbtn" href="/seller/manageitem/edit/{{$d->pid}}">Edit</a> |
              <a class="editdltbtn2" data-toggle="modal" data-target="#exampleModal2" id="dltitembtn"
                value="{{$d->pid}}">Delete</a>

            </td>
          </tr>


          @endforeach
        </tbody>
      </table>
    </div>
  </div>

</div>
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Do you want to delete this?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">If you once delete it, you will never get back this data.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a id="dltconbtn" class="btn btn-primary logoutbtn">Confirm</a>
      </div>
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
  
  
    $('.editdltbtn2').click(function() {
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
      
      var dltid = $(this).attr("value");
     // alert(dltid);
      deletebyId(dltid);
      
    });
    
  
   function deletebyId(pid) {
  
    $('#dltconbtn').click(function(e){      // delete item confirm btn
      // var token = $("meta[name='csrf-token']").attr("content");
      e.preventDefault();
          $.ajax({
  
       url: "/seller/manageitem/delete",
       type: "get",
       
       data: {
        
        
         'pid': pid
  
       },
       success: function(response) {
         alert(response);
         window.location.href= '/seller/manageitem';
  
          
  
       },
       error: function (request, status, error) {
       alert(error);  //it will show error in webpage if any
       }
  
       });
      });
     
   };
   
  
    
  
    
  
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