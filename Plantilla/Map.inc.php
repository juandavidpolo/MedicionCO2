<?php
$link = mysqli_connect("localhost", "root", "");  
mysqli_select_db($link, "proyectogrado"); 
$sql=("SELECT latitud, longitud FROM medicion WHERE id=(SELECT COUNT(*) FROM medicion)");
$result1=mysqli_query($link, $sql);
$result2=mysqli_query($link, $sql);
?>
<html>
  <head>
      <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" />
      <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"></script>
      <style>
          body { margin:0; padding:0; }
          #map { position:static; width:100%; height:400px; }
      </style>
  </head>
  <body>
      <div id="map"></div>
      <script>
            var map = L.map('map').setView([<?php echo htmlentities($result['latitud']);?>,
                <?php echo htmlentities($result['longitud']);?>], 17);
            L.tileLayer('https://api.maptiler.com/maps/topo/{z}/{x}/{y}.png?key=Be4lmuCMHfvPdx0f9wAV',{
                attribution:'<a href="https://www.maptiler.com/copyright/" target="_blank">© MapTiler</a> \n\ <a href="https://www.openstreetmap.org/copyright" target="_blank">© OpenStreetMap contributors</a>'
            }).addTo(map);
            var marker = L.marker([<?php echo htmlentities($result['latitud']);
            echo","; echo htmlentities($result['longitud'])?>]).addTo(map);
      </script>
  </body>
</html>