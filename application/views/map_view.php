<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<script type="text/javascript">

    $(document).ready(function() {
        var locations="";
        myMap(locations);
          url = "<?php echo base_url(); ?>index.php/mapview/get_cities";
          $.ajax({url, success: function(result){
            final_data=JSON.parse(result);
              $.each(final_data.city_records, function (key, value) {
                values_temp=JSON.stringify(value);
                $("#sel-cities").append($('<option></option>').val(values_temp).html(value.area));
              }); 
              $.each(final_data.state_records, function (key, value) {
                values_temp=JSON.stringify(value);
                $("#sel-states").append($('<option></option>').val(values_temp).html(value.area));
                $("#sel-district").append($('<option></option>').val(values_temp).html(value.area));
              });     

          }});

          $("#submit_but").click(function(){
            var selectedStates = $("#sel-states option:selected");
            var selectedCities = $("#sel-cities option:selected");
            var selectedDistrict = $("#sel-district option:selected");

            var states = "";
              if(selectedStates != ''){                                       
              selectedStates.each(function () {
                states += $(this).val() + "|";
              });
            }
              if(selectedCities != ''){                                       
                selectedCities.each(function () {
                  states += $(this).val() + "|";
                });
              }
              if(selectedDistrict != ''){
                selectedDistrict.each(function () {
                    states += $(this).val() + "|";
                  });
              }

            var states = states.replace(/(^\s*,)|(,\s*$)/g, '');
            final_data=states.split("|");
            myMap(final_data);
              
          });              
    });


</script>

</script>
</head>
<body>


<div class="g-map" id="map"></div>&nbsp;&nbsp;
<div class="map-filters">
<div >
<div class="form-group col-md-6 col-lg-6 col-sm-6 filters-width">
  <label>Choose states</label>
    <select id="sel-states" data-style="btn-default" class="selectpicker form-control" multiple data-max-options="5">     
    </select>
</div>

<div class="form-group col-md-6 col-lg-6 col-sm-6 filters-width">
  <label>Choose district</label>
    <select id="sel-district" data-style="btn-default" class="selectpicker form-control" multiple data-max-options="5">     
    </select>
</div>


<div class="form-group col-md-6 col-lg-6 col-sm-6 filters-width">
  <label>Choose Cities</label>
    <select id="sel-cities" data-style="btn-default" class="selectpicker form-control" multiple data-max-options="5">     
    </select>
</div>

<button type="button" id="submit_but" class="btn btn-primary filters-search">Search</button>
</div>
<script>
  var gmarkers = [];
      function myMap(locations='') {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 5,
          center: new google.maps.LatLng(20.5937,78.9629),
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var infowindow = new google.maps.InfoWindow();
        google.maps.event.addListener(map, 'click', function() {
            infowindow.close();
        });

        var marker, i,locate,temp;
        
        for (j = 0; j < locations.length; j++) {
            if(locations[j] != '') {
              temp=JSON.parse(locations[j]);
              delete locations[j];
              locations[j] = temp;
            }            
        }
        for (i = 0; i < locations.length; i++) {
            
            marker = new google.maps.Marker({
              position: new google.maps.LatLng(locations[i]['lat'], locations[i]['longi']),
              icon: { path: google.maps.SymbolPath.BACKWARD_CLOSED_ARROW,
                      strokeColor: locations[i]['color'],
                      scale: 4
                    },
              map: map
            });
            gmarkers.push(marker);
            var area_content;
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
              return function() {
                if(typeof locations[i]['state'] != 'undefined'){
                  area_content=locations[i]['area'] + " is superb city which is located in "+locations[i]['state'];
                }else{
                  area_content=locations[i]['area']+" is superb state which is part of INDIA";
                }
                infowindow.setContent(area_content);
                infowindow.open(map, marker);
              }
            })(marker, i));
        }   
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnwHQfUe5zD3AHaO-mOgbK6pL_xoBAwCo&callback=myMap"></script>

</body>
</html>