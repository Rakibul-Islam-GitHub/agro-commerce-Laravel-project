<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/dashboard.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
    body {
        background-color: #5cb85c !important;
    }

    #msform,
    .msform {
        width: 400px;
        margin: 20px auto;
        text-align: center;
        position: relative;
    }

    #msform fieldset {
        background: white;
        border: 0 none;
        border-radius: 3px;
        box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
        padding: 20px 30px;

        box-sizing: border-box;
        width: 80%;
        margin: 0 10%;
        position: absolute;
    }

    #msform fieldset:not(:first-of-type) {
        display: none;
    }

    .justify-content-center.additemdiv {
        margin-left: 40%;
    }

    .errmsg {
        position: absolute;
        /* position: relative; */
        top: 410px;
        left: 593px;
    }

    img {
        width: 50px;
    }
</style>

<body>
    <h1 class=" mb-5 mt-5 text-center">Please login here</h1>
    <div class="justify-content-center additemdiv">


    </div>



    <form method="POST" id="msform">
        <fieldset>
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <h1 class="mt-3"> </h1> <br>
            <div class="input-group input-group-lg">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"> </span></span>
                <input type="text" name="username" class="form-control" placeholder="Email">
            </div><br>
            <div class="input-group input-group-lg">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"> </span></span>
                <input type="password" name="password" class="form-control" placeholder="•••••••••••">
            </div>
            <br>
            <input type="submit" name="submit" value="Sign In" class="btn btn-success">

        </fieldset>

    </form>
    <div class="msform">
        <a href="login/google"><img src="/upload/google.png" alt="pic"><input type="button" name="submit"
                value="Login With Google" class="btn btn-success"></a>
    </div>
    <div class="errmsg">
        <h3 style="color: red">
            {{session('msg')}}
        </h3>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

</body>

</html>