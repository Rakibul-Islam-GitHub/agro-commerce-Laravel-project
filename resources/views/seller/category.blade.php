@extends('seller.layout')
@section('title', 'Category')

@section('Dashboard', 'Category')
@section('content')



<div class="container">
    @foreach ($var as $d)
    <ul>
        <li>{{$d->name}}</li>


    </ul>

    @endforeach

    <div>
        <form method="POST" action="/seller/addcategory">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input name="name" type="text">
            <input type="submit" value="Add more category">

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