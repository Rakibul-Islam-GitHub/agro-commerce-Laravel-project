@extends('seller.layout')
@section('title', 'Category')

@section('Dashboard', 'Category')
@section('content')



<div class="container">

    <div class="container table-responsive py-5">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>

                    <th scope="col">Category Name</th>

                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if(gettype($var)=='NULL')
                <td style="color: red">No category found </td>
                <td></td>
                @else
                @foreach ($var as $d)

                <tr>
                    <td>{{$d->name}}</td>


                    <td>

                        <a class="editdltbtn2 reviewdltbtn" id="dltitembtn" data-toggle="modal"
                            data-target='#reviewdltmodal' value="{{$d->id}}">Delete</a>

                    </td>
                </tr>

                @endforeach
                @endif




            </tbody>
        </table>
    </div>
    <div>
        <form method="POST" action="/seller/addcategory">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input name="name" type="text">
            <input type="submit" value="Add more category">

        </form>
        @foreach($errors->all() as $err)
        <span style=" color: red;">{{$err}} <br></span>
        @endforeach
    </div>
</div>

<div class="modal fade" id="reviewdltmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Do you want to delete this <em> Category? </em></h5>
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
         
        $('.reviewdltbtn').click(function () {
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
      var id = $(this).attr('value');
      deletereview(id);
    });

    function deletereview(id) {
  
  $('#reviewdltconbtn').click(function(e){      // delete  confirm btn of modal
    
    e.preventDefault();
        $.ajax({

     url: "/seller/category/delete",
     type: "post",
     
     data: {
      
      
       'id': id

     },
     success: function(response) {
       //alert(response);
       window.location.href= '/seller/category';

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