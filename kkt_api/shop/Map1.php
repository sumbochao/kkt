
  <!DOCTYPE html>
<html> 
<head> 
   <meta http-equiv="content-type" content="text/html; charset=UTF-8"/> 
   <title>Google Maps Geometry</title> 
   <script src="http://maps.google.com/maps/api/js?sensor=false" 
           type="text/javascript"></script> 
</head> 
<body> 
    <div id="odo" style="width: 200; height: 200">đ</div> 
    <div id="dis" style="width: 200; height: 200">đ</div> 
   <div id="map" style="width: 1000px; height: 1000px"></div> 

   <script type="text/javascript"> 
      Number.prototype.toRad = function() {
         return this * Math.PI / 180;
      }

      Number.prototype.toDeg = function() {
         return this * 180 / Math.PI;
      }

      google.maps.LatLng.prototype.destinationPoint = function(brng, dist) {
         dist = dist / 6371;  
         brng = brng.toRad();  

         var lat1 = this.lat().toRad(), lon1 = this.lng().toRad();

         var lat2 = Math.asin(Math.sin(lat1) * Math.cos(dist) + 
                              Math.cos(lat1) * Math.sin(dist) * Math.cos(brng));

         var lon2 = lon1 + Math.atan2(Math.sin(brng) * Math.sin(dist) *
                                      Math.cos(lat1), 
                                      Math.cos(dist) - Math.sin(lat1) *
                                      Math.sin(lat2));

         if (isNaN(lat2) || isNaN(lon2)) return null;

         return new google.maps.LatLng(lat2.toDeg(), lon2.toDeg());
      }

      var pointA = new google.maps.LatLng(21.0349901, 105.7977281);   // Circle center
      var radius = 10;                                      // 10km

      var mapOpt = { 
         mapTypeId: google.maps.MapTypeId.TERRAIN,
         center: pointA,
         zoom: 10
      };

      var map = new google.maps.Map(document.getElementById("map"), mapOpt);

      // Draw the circle
      new google.maps.Circle({
         center: pointA,
         radius: radius * 1000,       // Convert to meters
         fillColor: '#FF0000',
         fillOpacity: 0.2,
         map: map
      });

      // Show marker at circle center
      new google.maps.Marker({
         position: pointA,
         map: map
      });

      // Show marker at destination point
      new google.maps.Marker({
         position: pointA.destinationPoint(-135, radius),
         map: map,
         title: pointA.destinationPoint(-135, radius).lat()+"-"+pointA.destinationPoint(-135, radius).lng()
      });
      
        new google.maps.Marker({
         position: pointA.destinationPoint(180, radius),
         map: map,
         title: pointA.destinationPoint(180, radius).lat()+"-"+pointA.destinationPoint(180, radius).lng()
      });
      
      document.getElementById("odo").textContent = pointA.destinationPoint(-135, radius).lat()+"-"+pointA.destinationPoint(-135, radius).lng();


       new google.maps.Marker({
         position: pointA.destinationPoint(0, radius),
         map: map,
          title: pointA.destinationPoint(0, radius).lat()+"-"+pointA.destinationPoint(0, radius).lng()
      });
      
       new google.maps.Marker({
         position: pointA.destinationPoint(-90, radius),
         map: map,
         title: pointA.destinationPoint(-90, radius).lat()+"-"+pointA.destinationPoint(-90, radius).lng()
      });
      
       new google.maps.Marker({
         position: pointA.destinationPoint(90, radius),
         map: map,
          title: pointA.destinationPoint(90, radius).lat()+"-"+pointA.destinationPoint(90, radius).lng()
      });
      
      
      var pointB = new google.maps.LatLng(20.9794096, 105.745132);   // Circle center
      var radius = 10;                                      // 10km

      var mapOpt = { 
         mapTypeId: google.maps.MapTypeId.TERRAIN,
         center: pointB,
         zoom: 10
      };

     // var map = new google.maps.Map(document.getElementById("map"), mapOpt);

      // Draw the circle
      new google.maps.Circle({
         center: pointB,
         radius: radius * 1000,       // Convert to meters
         fillColor: '#FF0000',
         fillOpacity: 0.2,
         map: map
      });

      // Show marker at circle center
      new google.maps.Marker({
         position: pointB,
         map: map
      });
      
      var rad = function(x) {
  return x * Math.PI / 180;
};

var getDistance = function(p1, p2) {
  var R = 6378; // Earth’s mean radius in meter
  var dLat = rad(p2.lat() - p1.lat());
  var dLong = rad(p2.lng() - p1.lng());
  var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
    Math.cos(rad(p1.lat())) * Math.cos(rad(p2.lat())) *
    Math.sin(dLong / 2) * Math.sin(dLong / 2);
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
  var d = R * c;
  return p2.lat() - p1.lat(); // returns the distance in meter
}; 
    
     document.getElementById("dis").textContent = getDistance(pointA,pointA.destinationPoint(180, 10));
   </script> 
   <?php 
     function toRad($fDeg) {
         return $fDeg * pi() / 180;
      }

      function toDeg($fRad) {
         return $fRad * 180 / pi();
      }
      
    function getMaxLatitue($lat1,$lon1,$dist){
         $brng = 180;
         $dist = $dist / 6371;  
         $brng = toRad($brng);//($brng * pi())/ 180;
         $lat1 = toRad($lat1);//($lat1 * pi())/ 180;
         $lon1 =toRad($lon1);// ($lon1 * pi())/ 180;

         $lat2 = asin(sin($lat1) * cos($dist) + cos($lat1) * sin($dist) * cos($brng));
         $lon2 = $lon1 + atan2(sin($brng) * sin($dist) * cos($lat1),cos($dist) - sin($lat1) *sin($lat2));

         if (is_NaN($lat2) || is_NaN($lon2)) return 0;
         else return toDeg($lat2);
    }
    
    function getMinLatitue($lat1,$lon1,$dist){
         $brng = 0;
         $dist = $dist / 6371;  
         $brng = toRad($brng);//($brng * pi())/ 180;
         $lat1 = toRad($lat1);//($lat1 * pi())/ 180;
         $lon1 =toRad($lon1);// ($lon1 * pi())/ 180;

         $lat2 = asin(sin($lat1) * cos($dist) + cos($lat1) * sin($dist) * cos($brng));
         $lon2 = $lon1 + atan2(sin($brng) * sin($dist) * cos($lat1),cos($dist) - sin($lat1) *sin($lat2));

         if (is_NaN($lat2) || is_NaN($lon2)) return 0;
         else return toDeg($lat2);
    }
    
    function getMaxLongtitue($lat1,$lon1,$dist){
         $brng = 90;
         $dist = $dist / 6371;  
         $brng = toRad($brng);//($brng * pi())/ 180;
         $lat1 = toRad($lat1);//($lat1 * pi())/ 180;
         $lon1 =toRad($lon1);// ($lon1 * pi())/ 180;

         $lat2 = asin(sin($lat1) * cos($dist) + cos($lat1) * sin($dist) * cos($brng));
         $lon2 = $lon1 + atan2(sin($brng) * sin($dist) * cos($lat1),cos($dist) - sin($lat1) *sin($lat2));

         if (is_NaN($lat2) || is_NaN($lon2)) return 0;
         else return toDeg($lon2);
    }
    
     function getMinLongtitue($lat1,$lon1,$dist){
         $brng = -90;
         $dist = $dist / 6371;  
         $brng = toRad($brng);//($brng * pi())/ 180;
         $lat1 = toRad($lat1);//($lat1 * pi())/ 180;
         $lon1 =toRad($lon1);// ($lon1 * pi())/ 180;

         $lat2 = asin(sin($lat1) * cos($dist) + cos($lat1) * sin($dist) * cos($brng));
         $lon2 = $lon1 + atan2(sin($brng) * sin($dist) * cos($lat1),cos($dist) - sin($lat1) *sin($lat2));

         if (is_NaN($lat2) || is_NaN($lon2)) return 0;
         else return toDeg($lon2);
    }
    
    
         $lat1 = 21.0349901; $lon1 =105.7977281;
         $dist = 10; // KM Khoang cach
         $brng = 180;
         $dist = $dist / 6371;  
         //this * Math.PI / 180; 
         // doi do to radias
         $brng = ($brng * pi())/ 180;

         $lat1 = ($lat1 * pi())/ 180;
         $lon1 = ($lon1 * pi())/ 180;

         $lat2 = asin(sin($lat1) * cos($dist) + 
                              cos($lat1) * sin($dist) * cos($brng));

         $lon2 = $lon1 + atan2(sin($brng) * sin($dist) *
                                      cos($lat1), 
                                      cos($dist) - sin($lat1) *
                                      sin($lat2));

         if (is_NaN($lat2) || is_NaN($lon2)) echo "loi";
         echo ($lat2* 180 / pi())."<br>";
         echo ($lon2* 180 / pi())."<br>";
         $lat1 = 21.0349901; $lon1 =105.7977281;
         $dist = 10; // KM Khoang cach
         echo getMaxLatitue($lat1,$lon1,$dist)."<br>";
         echo getMinLatitue($lat1,$lon1,$dist)."<br>";
         echo getMaxLongtitue($lat1,$lon1,$dist)."<br>";
         echo getMinLongtitue($lat1,$lon1,$dist)."<br>";
        
   ?>
</body> 
</html>

