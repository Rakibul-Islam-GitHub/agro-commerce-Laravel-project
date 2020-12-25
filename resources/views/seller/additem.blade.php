@extends('seller.layout')
@section('title', 'Add Product')
@section('Dashboard', 'Add Product')
@section('content')


<div class="row justify-content-center additemdiv">
    <div class="col-12 col-md-8 col-lg-8 col-xl-6">

        <form method="POST" action=""  enctype="multipart/form-data">
            
            <div class=" col-10 ">
              <div class="form-group">
                <label class="control-label">Product Title</label>
                <div class="">
                  <input type="text" id="title" name="title" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">Product Price</label>
                <div class="">
                  <input type="text" id="price" name="price" class="form-control">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label">Description</label>
                <div class="">
                    <textarea name="description" id="description" cols="60" rows="6"></textarea>
                </div>
              </div>
              

              <div class="form-group">
                <label class="control-label">Product Picture</label>
                <div class="">
                    <input type="file" name="pic" id="pic-input" />
                </div>
              </div>
            </div>
          
            
          
            <div class=" col-10 text-center">
              <button class="btn btn-primary btn-block " id="itemupdatebtn">Add Item</button>
            </div>
            <input type="hidden" name="action" id="action" value="event_dialog_add_newpartnerdata" />
          </form>
          


    </div>
  </div>

@endsection


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