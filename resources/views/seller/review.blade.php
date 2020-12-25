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
        <th scope="col">Comment</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>

      <% 
      comments.forEach( function(Comment){ %>
      <tr>
          <td><%= Comment.customerid %></td>
          
         
          <td><%= Comment.productid %></td>
          <td><%= Comment.date %></td>
          <td><%= Comment.comment %></td>
         
          <td>
           
            <a class="editdltbtn2" href="/product/<%= Comment.productid%>" id="dltitembtn" value="<%= Comment.id %>" >View</a>
            
          </td>
      </tr>

  <%
      }); 
  %>

     
    </tbody>
  </table>
  </div>
@endsection