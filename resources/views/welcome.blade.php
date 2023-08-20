<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <title> Markers Map</title>
</head>
<body>
<div id="map" data-url="{{ route('maps.index') }}" style="height: 350px; width: 100%"></div>

<div class="container">
    <h2>Map Info</h2>
    <p>This show the attributes of the markers:</p>
    <table class="table table-bordered">
        <tr>
            <th>Marker</th>
            <th>Color</th>
            <th>Status</th>
            <th>Url</th>
        </tr>
        <tr>
            <td><img src="https://cdn4.iconfinder.com/data/icons/small-n-flat/24/map-marker-512.png" style="width: 32px"
                     alt=""></td>
            <td> Red</td>
            <td> Negative</td>
            <td><a href="?status=Negative">Negative</a></td>
        </tr>
        <tr>
            <td><img src="https://www.clipartmax.com/png/small/86-869339_yellow-map-marker-png.png" style="width: 32px"
                     alt=""></td>
            <td> Yellow</td>
            <td> Neutrual</td>
            <td><a href="?status=Neutrual">Neutrual</a></td>
        </tr>

        <tr>
            <td><img src="https://www.clipartmax.com/png/small/274-2748470_google-maps-green-marker.png"
                     style="width: 32px" alt=""></td>
            <td> Green</td>
            <td> Positive</td>
            <td><a href="?type=Positive">Positive</a></td>

        </tr>
    </table>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
{{--Replace `GOOGLE_MAP_KEY` by your API key. If you don't have a such key, refer to
https://developers.google.com/maps/doc…--}}
<script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAP_KEY')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"
        integrity="sha512-uMtXmF28A2Ab/JJO2t/vYhlaa/3ahUOgj1Zf27M5rOo8/+fcTUVH0/E0ll68njmjrLqOBjXM3V9NiPFL5ywWPQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('js/map.js') }}"></script>
</body>
</html>
