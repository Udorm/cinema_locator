<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cinema Locator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/">Movie Locator</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/send_current_location.php">Nearby Cinema</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li>
            </ul>
        </div>
    </nav>       
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" style="padding:0px;">
                <img src="/images/Welcome Banner.png" style="width:100%" />
            </div>
        </div>
    </div>

    <div class="form-row">
        <form action="/nearby_cinemas.php" method="get" name="myform" style="margin:0px auto;display:inline-block;">
            <input hidden type="text" id="user_lat" name="user_lat" value=""/>
            <input hidden type="text" id="user_lng" name="user_lng" value=""/>
            <div class="col-lg-12 col-md-12 col-sm-12" style="margin:5px;">
                <input class="btn btn-secondary" type="submit" id="searchNearbyCinema" 
                    name="searchNearbyCinema" value="Show Nearby Cxinemas" 
                    style="width:100%;"/>
                <a class="btn btn-secondary" href="/" style="margin-top:5px; width:100%; background-color: #f7931e">Search Cinemas</a>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12" style="margin:5px;">
                
            </div>
        </form>
    </div>

    <script>
        var lat = document.getElementById("user_lat");
        var lng = document.getElementById("user_lng");
        function getlocation() {
            if (navigator.geolocation) { 
                navigator.geolocation.getCurrentPosition(visitorLocation);
            } else { 
                $('#location').html('This browser does not support Geolocation Service.');
            }
        }
        function visitorLocation(position) {
            var lati = position.coords.latitude;
            var long = position.coords.longitude;
            console.log(lati);
            console.log(long);
            document.getElementById("user_lat").value = lati;
            document.getElementById("user_lng").value = long;
            //document.getElementById("searchNearbyCinema").click();
        }
        getlocation()
    </script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>