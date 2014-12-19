<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script>
function createMarker(markerOptions){var marker=new google.maps.Marker(markerOptions);markers.push(marker);lat_longs.push(marker.getPosition());return marker;}
var myOptions={zoom:18,mapTypeId:google.maps.MapTypeId.ROADMAP,mapTypeControl:false,streetViewControl:false}
var iw=new google.maps.InfoWindow();
var lat_longs=new Array();
var markers=new Array();
//google.maps.event.addDomListener(window, "load", map_initialize);
<?php //echo $middle_part_of_script_var; ?>
function map_initialize() {
// create the map <?php echo $middle_part_of_script; ?>
}
jQuery(function($) {
    //$("a[rel^='lightbox']").slimbox({});
    $("a[rel^='lightbox']").colorbox({rel:'group1'});
    setTimeout(function(){map_initialize();},1000);
});
</script>