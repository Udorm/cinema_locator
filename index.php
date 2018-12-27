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
        <a class="navbar-brand" href="/CinemaLocator/">Movie Locator</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/CinemaLocator/send_current_location.php">Nearby Cinema</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li>
            </ul>
        </div>
    </nav>       
    
    <div class="container" style="margin-top:30px;">
        <form action="" method="post">
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

<?php

//Read API Key
$f = fopen("api_key.txt", "r") or die("Unable to open file!");
$api_key = fread($f, filesize("api_key.txt"));

function searchCinemas($query, $key, $next_page_token=""){
    // url encode the query
    $query = urlencode($query);

    // search places api url
    if ($next_page_token == ""){
        $url = "https://maps.googleapis.com/maps/api/place/textsearch/json?type=movie_theater&query={$query}&key={$key}";
    }else{
        $url = "https://maps.googleapis.com/maps/api/place/textsearch/json?type=movie_theater&query={$query}&key={$key}&pagetoken={$next_page_token}";
    }
    

    // get the json response
    $resp_json = file_get_contents($url);

    // decode the json
    $resp = json_decode($resp_json, true);

    // response status will be 'OK', if able to geocode given address 
    if($resp['status']=='OK'){
        return $resp;
    }else{
        ?>
        <div class="row"><div class="col-md-12">
            <h5 style="color:red;"><?php echo "<strong>ERROR: {$resp['status']}</strong>"; ?></h5>
        </div></div>
        <?php
        return false;
    }
}

?>
<?php
if($_POST){
    $q = $_POST['queryString'] . " in " . $_POST['searchLocation'];
?>
    <div class="container">
        <div class="row">
            <div class="col-md-12"><h5>Result of "<?php echo($q); ?>"</h5></div>
        </div>
        <div class="row"><div class="col-md-12"><div class="card-columns">
            <?php 
            $cinemas = searchCinemas($q, $api_key);
            for($i = 0; $i < sizeof($cinemas[results]); $i++){
                //echo($cinemas[results][$i][formatted_address]);
            ?>
            <div class="card">
                <div class="border-dark">
                    <div class="card-header"><?php echo(isset($cinemas[results][$i][opening_hours][open_now])?($cinemas[results][$i][opening_hours][open_now]==true?"Open":"Closed"):"N/A"); ?></div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo(isset($cinemas[results][$i][name])?$cinemas[results][$i][name]:"N/A"); ?></h5>
                        <p class="card-text"><?php echo(isset($cinemas[results][$i][formatted_address])?$cinemas[results][$i][formatted_address]:"N/A"); ?></p>
                        <form action="/CinemaLocator/viewMap.php" method="post" target="_blank">
                            <div class="form-group">
                            <input hidden type="text" name="lat" value="<?php echo($cinemas[results][$i][geometry][location][lat]); ?>" />
                            <input hidden type="text" name="lng" value="<?php echo($cinemas[results][$i][geometry][location][lng]); ?>" />
                            <input hidden type="text" name="formated_address" value="<?php echo($cinemas[results][$i][formatted_address]); ?>" />
                            <input type="submit" class="btn btn-secondary btn-sm" value="view map"/>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">Rating: <?php echo(isset($cinemas[results][$i][rating])?$cinemas[results][$i][rating]:"N/A"); ?></div>
                </div>
            </div>
            <?php
            } 
            ?>
        </div></div></div>
    </div>
<?php
}else{ ?>
    <div class="container"><div class="row"><div class="col-md-12">
        <h5>Search results will be shown here!</h5>
    </div></div></div>
<?php
}
?>

<p hidden id="user_lat">k</p>
<p hidden id="user_lng">k<p>
<script>
        var lat = document.getElementById("user_lat");
        var lng = document.getElementById("user_lng")
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
                lat.innerHTML = lati;
                lng.innerHTML = long;
            }
            getlocation()
    </script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>