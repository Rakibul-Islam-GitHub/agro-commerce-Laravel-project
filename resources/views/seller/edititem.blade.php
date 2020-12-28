@extends('seller.layout')
@section('title', 'Add Product')
@section('Dashboard', 'Add Product')
@section('content')


<div class="row justify-content-center additemdiv">
    <div class="col-12 col-md-8 col-lg-8 col-xl-6">
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class=" col-10 ">
                <div class="form-group">
                    <label class="control-label">Product Title</label>
                    <div class="">
                        <input type="text" value="{{$data->title}} " name="title" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Product Price</label>
                    <div class="">
                        <input type="text" name="price" value="{{$data->price}}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label">Description</label>
                    <div class="">
                        <textarea name="description" id="des" cols="60" rows="6">{{$data->description}}</textarea>
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label">Update Picture</label>
                    <div class="">
                        <input type="file" name="pic" id="pic-input" />
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-primary btn-block " id="itemupdatebtn">Update</button>
            </div>
        </form>



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
  
  });
   
</script>

@endsection