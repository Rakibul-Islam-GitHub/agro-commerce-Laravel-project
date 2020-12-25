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
          <input type="text" id="myInput" class="form-control"  placeholder="Search product by ID..">
        </div>
        
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>#ID</th>
              <th>Image</th>
              <th>Product Name</th>
              <th>Price</th>
              <th>Description</th>
              <th>Action</th>
              
            </tr>
          </thead>
          
          <tbody>
           
           

            <% 
            items.forEach( function(item){ %>
            <tr>
                <td><%= item.id %></td>
                <td><img src="/image/<%= item.image %>" width="60" height="50" alt="pic"></td>
               
                <td><%= item.title %></td>
                <td><%= item.price %></td>
                <td><%= item.description %></td>
               
                <td>
                  <a class="editdltbtn" href="/seller/manageitem/edit/<%= item.id %>">Edit</a> |
                  <a class="editdltbtn2" href="/seller/manageitem/delete/<%= item.id %>" id="dltitembtn" value="<%= item.id %>" >Delete</a>
                  
                </td>
            </tr>

        <%
            }); 
        %>
            
           
          </tbody>
        </table>
      </div>
    </div>
   
  </div>
@endsection