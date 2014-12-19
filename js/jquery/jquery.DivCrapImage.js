(function( $ ){
			$.fn.DivCrapImage = function(imagesrc, iwidth, iheight, crap) {
				var img = new Image();
				var divname=$(this).attr("id");
				var $this=$(this);
				loadingwidth=parseInt(iwidth)/4;
				loadingheight=parseInt(iheight)/4;
				//alert(divname);
				
				img.onload = function() {
					//alert(this.width + 'x' + this.height);
					var less=0;
					var oldwidth=parseInt(this.width);
					var oldheight=parseInt(this.height);
					var oldcondition=(oldwidth > oldheight);
					more=pare(oldcondition, this.height, this.width);
					leat=pare(oldcondition, "h", "w");
					$("#"+divname).html('<img id="'+divname+'_ii" style="position: relative; top:0px; left:0px; text-align:none;" src="" />');
					$("#"+divname+"_ii").attr("src", imagesrc);
					//alert($this.index());
					//$this.append('<img id="'+divname+'_'+$this.index()+'" style="position: relative; top:0px; left:0px;" src="" />')
					//$this.find("img").attr("src", imagesrc);
					//$("#"+divname+"_ii").attr("src", imagesrc);
					//alert(leat);
					if( (crap==false)&&!( (oldwidth>=iwidth)&&(oldheight>=iheight) ) ){
						//if not crap, image will check size and place in the middle of the div 
						//if image is bigger than the area, should choose crap==true
						//alert("jquery divcrapimage 28");
						if(oldwidth>=iwidth){
							//alert("jquery divcrapimage 30");
							$("#"+divname+"_ii").css("width", iwidth+"px");
						}else if(oldheight>=iheight){
							//alert("jquery divcrapimage 33");
							$("#"+divname+"_ii").css("height", iheight+"px");
						}else if( (oldwidth<iwidth)&&(oldheight<iheight) ){
							//alert("jquery divcrapimage 36 "+oldwidth+":"+oldheight+":"+iwidth+":"+iheight);
							$("#"+divname+"_ii").css("position", "relative");
							/*var new_left=parseInt( (iwidth/2)-(oldwidth/2) );
							var new_top=parseInt( (iheight/2)-(oldheight/2) );
							$("#"+divname+"_ii").css("text-align", "none");
							$("#"+divname+"_ii").css("left", new_left+"px");
							$("#"+divname+"_ii").css("top", new_top+"px");*/
						}
							var new_left=parseInt( (iwidth/2)-(oldwidth/2) );
							var new_top=parseInt( (iheight/2)-(oldheight/2) );
							$("#"+divname+"_ii").css("text-align", "none");
							$("#"+divname+"_ii").css("left", new_left+"px");
							$("#"+divname+"_ii").css("top", new_top+"px");

					}else{
						if(leat=="h"){
							radius=iheight/parseInt(this.height)*parseInt(this.width);
							if(radius<iwidth){
								radius=iwidth/parseInt(this.width)*parseInt(this.height);
								resultwidth=iwidth;
								resultheight=radius;//more
								//alert(resultwidth+":"+resultheight);
								movement=-resultheight/2+(iheight/2);
								$("#"+divname+"_ii").css({left: "0px", top: movement+"px", width: resultwidth+"px", height:resultheight+"px"});
								
							}else{
								resultheight=iheight;
								resultwidth=radius;//more
								movement=-resultwidth/2+(iwidth/2);
								$("#"+divname+"_ii").css({left: movement+"px", top: "0px", width: resultwidth+"px", height:resultheight+"px"});
							}
						}else if(leat=="w"){
							radius=iwidth/parseInt(this.width)*parseInt(this.height);
							if(radius<iheight){
								radius=iheight/parseInt(this.height)*parseInt(this.width);
								resultheight=iheight;
								resultwidth=radius;//more
								movement=-resultwidth/2+(iwidth/2);
								$("#"+divname+"_ii").css({left: movement+"px", top: "0px", width: resultwidth+"px", height:resultheight+"px"});
							
							}else{
								resultwidth=iwidth; //170
								resultheight=radius;//more
								//alert(resultwidth+":"+resultheight);
								movement=-resultheight/2+(iheight/2);
								$("#"+divname+"_ii").css({left: "0px", top: movement+"px", width: resultwidth+"px", height:resultheight+"px"});
							}
						}
					}
					//this.width=resultwidth;
					//this.height=resultheight;
					
				}
				img.src = imagesrc;
				return $(this);
			};
			
})( jQuery );
function pare(v1, v2, v3){
		//LV3 return v1? v2: v3;
		if(v1){
			return v2;
		}else{
			return v3;
		}
	}