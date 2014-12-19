<!-- facebook tab apps size: 520x800 -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
<link rel="stylesheet" href="<?=base_url('css/campaign.css')?>" /><style>

	@import "<?=base_url('css/LightFace/LightFace.css')?>";
</style>
<link rel="stylesheet" href="<?=base_url('css/LightFace/LightFace.css')?>" />
<script src="https://ajax.googleapis.com/ajax/libs/mootools/1.3.0/mootools.js"></script>
<script src="<?=base_url('js/LightFace/LightFace.js')?>"></script>
<script src="<?=base_url('js/LightFace/LightFace.IFrame.js')?>"></script>

<script type="text/javascript" src="https://connect.facebook.net/en_US/all.js"></script>
<script type="text/javascript" charset="utf-8">
    /* Resizing code will be here. */
   //FB.Canvas.setSize({ width: 300, height: 300 });
   FB.Canvas.setAutoResize();
</script>  

	
<div id="fb-root"></div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url('js/jquery/jquery.jcarousel.js')?>"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url('css/jcarousel/jcarousel-skin-ie7.css')?>" />

<?php
//echo $user_compaign_data_id;
if($user_compaign_data_id)
{	
?>
<script type='text/javascript'>
window.onload = function() {
	light = new LightFace.IFrame({ height:600, width:500, 
					url: '<?=site_url("campaign/contest_entry/{$user_compaign_data_id}/{$user_fbid}");?>', 
					title: '<?=$contest_entry['user_name']?>的作品',
					 }).addButton('Close', function() { light.close(); },true).open();
}
</script>

hahahah
<?
}
?>


<script type="text/javascript">

function mycarousel_itemLoadCallback(carousel, state)
{
    // Check if the requested items already exist
    if (carousel.has(carousel.first, carousel.last)) {
        return;
    }

    jQuery.get(
        '<?=site_url('musicnext_ajax/jcarousel_test')?>',
        {
            first: carousel.first,
            last: carousel.last
        },
        function(xml) {
            mycarousel_itemAddCallback(carousel, carousel.first, carousel.last, xml);
        },
        'xml'
    );
};

function mycarousel_itemAddCallback(carousel, first, last, xml)
{
    // Set the size of the carousel
    carousel.size(parseInt(jQuery('total', xml).text()));

    jQuery('image', xml).each(function(i) {
        carousel.add(first + i, mycarousel_getItemHTML(jQuery(this).text()));
    });
};

/**
 * Item html creation helper.
 */
function mycarousel_getItemHTML(url)
{
    return '<img src="' + url + '" width="75" height="75" alt="" />';
};

jQuery(document).ready(function() {
    jQuery('#mycarousel').jcarousel({
        // Uncomment the following option if you want items
        // which are outside the visible range to be removed
        // from the DOM.
        // Useful for carousels with MANY items.

        // itemVisibleOutCallback: {onAfterAnimation: function(carousel, item, i, state, evt) { carousel.remove(i); }},
        itemLoadCallback: mycarousel_itemLoadCallback
    });
});

</script>




<h1><?=$campaign['campaign_name']?></h1>
<!--<h2><?=$campaign['artist_name']?></h2>-->



<iframe width="500" height="284" src="https://www.youtube.com/embed/<?=$campaign['youtube_vid']?>?wmode=opaque" frameborder="0" allowfullscreen></iframe>

<div id="content">
<p></p>	
<a href="#"
onclick = "light = new LightFace.IFrame({ height:500, width:500, 
				url: '<?=site_url("campaign/contest_rules/{$campaign['campaign_id']}/{$user_fbid}");?>', 
				title: '我又參加',
				 }).addButton('Close', function() { light.close(); },true).open();"> 
我又參加!
</a>
<p></p>	


<!--
<div id="mycarousel" class="jcarousel-skin-ie7">
    <ul>
      <!-- The content will be dynamically loaded in here - ->
    </ul>
</div>
-->
<?php
		
		
		foreach($user_campaign_datas as $contest_entry)
		{//debug($contest_entry);
			?>
			<div style="float:left; margin: 5px">
			
			<a href="#"><img width="150" src="http://img.youtube.com/vi/<?=$contest_entry['youtube_vid']?>/0.jpg"
			onclick = "light = new LightFace.IFrame({ height:600, width:500, 
				url: '<?=site_url("campaign/contest_entry/{$contest_entry['user_campaign_data_id']}/{$user_fbid}");?>', 
				title: '<?=$contest_entry['user_name']?>的作品',
				 }).addButton('Close', function() { light.close(); },true).open();"></a>

			<br>by <?=$contest_entry['user_name']?>
			<br>another line
			
			</div>
			<?php
		}

?>
</div>

