@extends('seller.layout')
@section('title', 'Messenger')
{{-- @section('Dashboard', 'Manage Product') --}}
<style>
    /* style for chat page start */



    #chatpage {


        justify-content: center;

        height: 100vh;

        font-family: Helvetica, sans-serif;
        overflow: hidden;
    }

    .msger {
        display: flex;
        flex-flow: column wrap;
        justify-content: space-between;
        width: 70%;
        max-width: 867px;

        height: 650px;
        border: 2px solid #ddd;
        border-radius: 5px;
        background: #fff;
        box-shadow: 0 15px 15px -5px rgba(0, 0, 0, 0.2);
    }

    .msger-header {
        background-color: #ee5522;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 200 200'%3E%3Cdefs%3E%3ClinearGradient id='a' gradientUnits='userSpaceOnUse' x1='100' y1='33' x2='100' y2='-3'%3E%3Cstop offset='0' stop-color='%23000' stop-opacity='0'/%3E%3Cstop offset='1' stop-color='%23000' stop-opacity='1'/%3E%3C/linearGradient%3E%3ClinearGradient id='b' gradientUnits='userSpaceOnUse' x1='100' y1='135' x2='100' y2='97'%3E%3Cstop offset='0' stop-color='%23000' stop-opacity='0'/%3E%3Cstop offset='1' stop-color='%23000' stop-opacity='1'/%3E%3C/linearGradient%3E%3C/defs%3E%3Cg fill='%23ca481d' fill-opacity='0.6'%3E%3Crect x='100' width='100' height='100'/%3E%3Crect y='100' width='100' height='100'/%3E%3C/g%3E%3Cg fill-opacity='0.5'%3E%3Cpolygon fill='url(%23a)' points='100 30 0 0 200 0'/%3E%3Cpolygon fill='url(%23b)' points='100 100 0 130 0 100 200 100 200 130'/%3E%3C/g%3E%3C/svg%3E");

        display: flex;
        justify-content: space-between;
        padding: 10px;
        border-bottom: 2px solid #ddd;
        background: #eee;
        color: #666;
    }


    .msger-chat {
        flex: 1;
        overflow-y: auto;
        padding: 10px;
    }

    .msger-chat::-webkit-scrollbar {
        width: 6px;
    }

    .msger-chat::-webkit-scrollbar-track {
        background: #ddd;
    }

    .msger-chat::-webkit-scrollbar-thumb {
        background: #bdbdbd;
    }

    .msg {
        display: flex;
        align-items: flex-end;
        margin-bottom: 10px;
    }

    .msg:last-of-type {
        margin: 0;
    }

    .msg-img {
        position: fixed;
        width: 50px;
        height: 50px;
        margin-right: 10px;
        background: #ddd;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        border-radius: 50%;
    }

    .msg-bubble {
        margin-left: 58px;
        max-width: 450px;
        padding: 15px;
        border-radius: 15px;
        background: #ececec;
    }

    .msg-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        border-bottom: 1px solid #25265733;
    }

    .msg-info-name {
        font-family: cursive;
        font-size: 13px;
        color: #acccd0;
    }

    .msg-info-time {
        font-size: 11px;
        color: #b6c1d8
    }

    .left-msg .msg-bubble {
        border-bottom-left-radius: 0;
    }

    .right-msg {
        flex-direction: row-reverse;
        display: block;
    }

    .right-msg .msg-bubble {
        background: #2f316b9e;
        color: #fff;
        border-bottom-right-radius: 0;
    }

    .right-msg .msg-img {
        margin: 0 0 0 10px;
    }

    .msger-inputarea {
        display: flex;
        padding: 10px;

        border-top: 2px solid #ddd;
        background: #eee;
    }

    .msger-inputarea * {
        padding: 10px;
        border: none;


        border-radius: 3px;
        font-size: 1em;
    }

    .msger-input {
        flex: 1;
        background: #ddd;
    }

    .msger-send-btn {
        margin-left: 10px;
        background: rgb(0, 196, 65);
        color: #fff;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.23s;
    }

    .msger-send-btn:hover {
        background: rgb(0, 180, 50);
    }

    .msger-chat {

        background-color: #2885aa;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100%25' height='100%25' viewBox='0 0 2 1'%3E%3Cdefs%3E%3ClinearGradient id='a' gradientUnits='userSpaceOnUse' x1='0' x2='0' y1='0' y2='1' gradientTransform='rotate(66,0.5,0.5)'%3E%3Cstop offset='0' stop-color='%232885aa'/%3E%3Cstop offset='1' stop-color='%23cb72ff'/%3E%3C/linearGradient%3E%3ClinearGradient id='b' gradientUnits='userSpaceOnUse' x1='0' y1='0' x2='0' y2='1' gradientTransform='rotate(18,0.5,0.5)'%3E%3Cstop offset='0' stop-color='%23ffeb7a' stop-opacity='0'/%3E%3Cstop offset='1' stop-color='%23ffeb7a' stop-opacity='1'/%3E%3C/linearGradient%3E%3ClinearGradient id='c' gradientUnits='userSpaceOnUse' x1='0' y1='0' x2='2' y2='2' gradientTransform='rotate(53,0.5,0.5)'%3E%3Cstop offset='0' stop-color='%23ffeb7a' stop-opacity='0'/%3E%3Cstop offset='1' stop-color='%23ffeb7a' stop-opacity='1'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect x='0' y='0' fill='url(%23a)' width='2' height='1'/%3E%3Cg fill-opacity='0.16'%3E%3Cpolygon fill='url(%23b)' points='0 1 0 0 2 0'/%3E%3Cpolygon fill='url(%23c)' points='2 1 2 0 0 0'/%3E%3C/g%3E%3C/svg%3E");
        /* background-attachment: fixed; */
        background-size: cover;
    }

    #showmsg {

        overflow: auto;
        display: flex;
        flex-direction: column-reverse;
    }

    .chatimg {
        border-radius: 50%;
        margin-top: -110px;
        width: 50px;
    }

    #sendmsg {
        width: 117px;
        height: 44px;
    }


    /* style for chat page end */
</style>
@section('content')
<!-- chat page start -->
<div class="col-sm-12 chatpage" id="chatpage">
    <div class="userlist1 float-right">
        <h4>Users Available to chat :</h4>
        <div class="userlist">

            @foreach ($data as $d)
            <a href='#' name='{{$d->uid}}' class='start_chat badge badge-primary'>{{$d->name}}</a>

            @endforeach

        </div>
    </div>
    <section class="msger">

        <header class="msger-header">
            <div class="msger-header-title">
                <i class="fa fa-envelope-open mr-1"></i> Agro Commerce
            </div>
            <div class="msger-header-options">
                <span><i class="fa fa-commenting"></i></span>
            </div>
        </header>

        <main class="msger-chat" id="showmsg">


            <div class="msg right-msg showmsg mt-3">


            </div>


        </main>

        <form class="msger-inputarea">
            <input type="text" id="msg" autocomplete="off" value="" class="msger-input"
                placeholder="Enter your message...">
            <!-- <div class="emoji">
  
        <select class="emoji" id="emoji" name="emoji">
         <option value=""></option>
         <option value="😚">😚</option>
         <option value="2">2</option>
         <option value="😚">😚</option>
         <option value="😚">😚</option>
        </select>
        </div> -->
            <button type="submit" id="sendmsg" class="msger-send-btn">Send</button>
        </form>
    </section>

</div>

<!-- chat page end -->
@endsection

@section('script')

<script>
    $(document).ready(function() {
   // alert('ok');
   



   loadallchat();

function loadallchat(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    //var username = $(this).attr('name');
    var id= 1;
    

$.ajax({
 url: "/seller/messageshow",
 type: "post",
 data: {

   'userid': id
 },

 success: function(response) {

   //alert(response);
    $('.showmsg').html(response);

 },
 error: function (request, status, error) {
 alert(error);
 }
});
}


});
</script>

@endsection