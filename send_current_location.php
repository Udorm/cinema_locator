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
        <a class="navbar-brand" href="#">Movie Locator</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Nearby Cinema</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li>
            </ul>
        </div>
    </nav>       
    
    <div class="container" style="margin-top:30px;">
        <form action="/CinemaLocator/index.php" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <select name="searchLocation" class="form-control">
                        <option selected disabled>Choose Location...</option>
                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                        <option value="cambodia">Cambodia</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Lao">Lao</option>
                        <option value="Malaysia">Malaysia</option>
                        <option value="Myanmar">Myanmar</option>
                        <option value="Philippines">Philippines</option>
                        <option value="Singapore">Singapore</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Viet Nam">Viet Nam</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="queryString" placeholder="Search Cinema">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary" style="margin:0px auto;display:block;width:200px;">Search</button>
                </div>
            </div>
        </form>
    </div>

    <div class="container"><div class="row"><div class="col-md-12">
        <h5>Loading nearby cinemas...</h5>
    </div></div></div>

    <form action="/CinemaLocator/nearby_cinemas.php" method="get" name="myform" hidden>
        <input type="text" id="user_lat" name="user_lat" value=""/>
        <input type="text" id="user_lng" name="user_lng" value=""/>
        <input type="submit" id="searchNearbyCinema" name="searchNearbyCinema" value="Search Nearby Cinema" />
    </form>
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
            document.getElementById("searchNearbyCinema").click();
        }
        getlocation()
    </script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>