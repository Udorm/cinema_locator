<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cinema Locator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
    /* some custom css */
    #gmap_canvas{
        width:100%;
        height:30em;
    }
    </style>
</head>
<body>
<?php
if($_POST){
 
    //Read API Key
    $f = fopen("api_key.txt", "r") or die("Unable to open file!");
    $api_key = fread($f, filesize("api_key.txt"));
 
    // if able to geocode the address
    if(true){
        $latitude = $_POST['lat'];
        $longitude = $_POST['lng'];
        $formatted_address = $_POST['formated_address'];
                     
    ?>
 
    <!-- google map will be shown here -->
    <div id="gmap_canvas">Loading map...</div>
    <div id='map-label'>Map shows approximate location.</div>
 
    <!-- JavaScript to show google map -->
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=<?php echo $api_key; ?>"></script>   
    <script type="text/javascript">
        function init_map() {
            var myOptions = {
                zoom: 14,
                center: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
            marker = new google.maps.Marker({
                map: map,
                position: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>)
            });
            infowindow = new google.maps.InfoWindow({
                content: "<?php echo $formatted_address; ?>"
            });
            google.maps.event.addListener(marker, "click", function () {
                infowindow.open(map, marker);
            });
            infowindow.open(map, marker);
        }
        google.maps.event.addDomListener(window, 'load', init_map);
    </script>
 
    <?php
 
    // if unable to geocode the address
    }else{
        echo "No map found.";
    }
}
?>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>