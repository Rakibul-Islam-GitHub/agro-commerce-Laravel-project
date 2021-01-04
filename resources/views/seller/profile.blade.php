@extends('seller.layout')
@section('title', 'Profile')
{{-- @section('Dashboard', 'Manage Product') --}}
@section('content')

<div class="row justify-content-center additemdiv">
    <div class="col-12 col-md-8 col-lg-8 col-xl-6">
        <div class="col-6 mb-5">
            <div>
                <img src="/image/<%=image%>" width="160px" height="120px" alt="profile_pic">
                <a class="d-block" href="/seller/profile/edit">Change profile picture</a>
            </div>

        </div>

        <form method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class=" col-6 ">

                <div class="form-group">
                    <label class="control-label">Name</label>
                    <div class="">

                        <input type="text" value="{{$data[0]->name}}" name="name" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Address</label>
                    <div class="">
                        <input type="text" name="address" value="{{$data[0]->address}}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label">Phone</label>
                    <div class="">
                        <input type="text" name="phone" value="{{$data[0]->phone}}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Email</label>
                    <div class="">
                        <input type="text" name="email" value="{{$data[0]->email}}" class="form-control">
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary btn-block " id="itemupdatebtn">Edit profile</button>
                </div>



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