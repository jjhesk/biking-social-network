<style type="text/css">
<? //$this->load->file('css/page.css.php'); ?>

/*----------------------------------------------------*/
.petsprofile *{
position: relative;
}
.status{
font-size: 17px;
font-weight: bold;
padding: 6px;
background-color: red;
position: absolute;
right: 6px;
top: 5px;
padding-top: 7px;
border-radius: 7px;
padding-bottom: 9px;
text-transform: uppercase;
}
.index_block_summary{
    background-color:transparent !important;
    display: inline;
}
.status.active{
    display:block;
}
.status.inactive{
    display:none;
}
.petsprofile,.petsprofile>section{
    border-radius:6px;
}
.petsprofile>section{
margin: 6px;
background-color: white;
display: inline-table;
min-height: 110px;
}
.petsprofile{
background-color: #D9D9D9;
width: 100%;
display: inline-block;
position: relative;
}
.extra_data>div,
.petsprofile .row>div{
    float:left;
}
.petsprofile .row{
    width:100%;
}
.petsprofile .row > div{
    margin-right:10px;
}
.petsprofile .row{
border-bottom: 1px dashed #D9D9D9;
padding-top: 5px;
padding-bottom: 5px;
margin: 0;
}

.petsname{
color: #F0A23F;
font-size: 26px;
font-weight: bold;
}
.tag{
     color:rgb(128, 128, 128);
     display:block;
     height:100%;
     text-transform: capitalize;
}
.detail_data{
     color:#333333;
     display:block;
     height:100%;
}
.profilepic {
height: 100px;
width: 100px;
margin: 5px;
background-size:cover;
background-position:top left;
}
.namespace{
padding-left: 20px;
padding-top: 5px;
height:36px;
}
.profilepic,.namespace_rightside{
float: left;
position: relative;
}

.namespace_rightside{
width: 847px;
}
</style>

<?php

$single = $app_profile[0];
if(isset($single['image'])){
    if(trim($single['image'])==""){
        $profileimage=base_url()."images/petnfans/no_photo_pets.png";
    }else{
        $profileimage=$single['image'];
    }
}else{
    $profileimage=base_url()."images/petnfans/no_photo_pets.png";
}
?>

<div class="petsprofile">
    <div class="namespace"></div>
    <div class="status <?=$single['is_lost']?'active':'inactive'?>">Lost</div>
    <section>
        <div class="profilepic" style="background-image:url(<?=$profileimage; ?>);"></div>
        <div class="namespace_rightside">
            <div class="row petsname"><?=$single['name']?></div>
            <div class="row">
                <div class="tag">Description:</div>
                <div class="detail_data"><?=$single['description']?></div>
            </div>
                <!--<div class="extra_data"></div>-->
                <div class="row">
                <?
                $buffer="";
                $exceptions =array('description','image','name');
                   $tmp = json_decode($single['custom_data_json'], true);
                            if(isset($tmp[0]))
                            foreach($tmp[0] as $key=>$item){
                                if(!in_array($key, $exceptions)){
                                     $buffer.="<div class=\"extra_data\"><div class=\"tag\">";
                                     $buffer.=$key." : ";
                                     $buffer.="</div><div class=\"detail_data\">";
                                     $buffer.=$item;
                                     $buffer.="</div></div>";
                                }
                            }
                    echo $buffer;
                    ?>
               </div>
            </div>
        </div>
        <div class="both"></div>
    </section>
</div>
<?php 
//print_r($app_profile);
?>