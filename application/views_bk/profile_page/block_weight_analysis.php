<? /*
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/jquery.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
 * 
 */?>
<div class= "notranslate" id="container" style="min-width: 400px; height: 600px; margin: 0 auto;">
<script>
	
function block_weight_analysis(){
	//CSS.theme for the weight chart
	var chart;
   
	 

	
//===============================================================================================================================================================================

	 chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: 'line',
                marginRight: 130,
                marginBottom: 25
            },
            title: {
                text: '<?=$block_weight_analysis_data['title']?>',
                x: -20 //center,
            },
            xAxis: {
                categories: ['Jan', '', '', '', 'Feb', '', '', '', 'Mar', '', '', '', 'Apr', '', '', '', 'May', '', '', '', 'Jun', '', '', '', 'Jul', '', '', '', 'Aug', '', '', '', 'Sep', '', '', '', 'Oct', '', '', '', 'Nov', '', '', '', 'Dec', '', '', ''],
             },
            /*xAxis: {
            	categories: [<?=$block_weight_analysis_data['x-axis']?>]
            },*/ 
           
            yAxis: [
            
            <? 
            	foreach($block_weight_analysis_data['y-axis'] as $key => $item)
				{
					$is_opposite = ($key%2)?'true':'false';
					
					echo "
					 { // Primary yAxis
		            	gridLineWidth: 1,
		                title: {
		                    text: '{$item['title']}',
		                    style: {
		                    	color: '{$item['color']}',
		                    },
		                },
						labels: {
		                    formatter: function() {
		                        return this.value + ' {$item['unit']}';
		                    },
		                    style: {
		                    	color: '{$item['color']}',
		                    },
		                },
		              opposite: {$is_opposite}},
					";
				}
            
            ?>
            
            /*
            { // Primary yAxis
            	gridLineWidth: 1,
                title: {
                    text: 'Weight',
                    style: {
                    	color: '#00BE96',
                    },
                },
				labels: {
                    formatter: function() {
                        return this.value + ' kg';
                    },
                    style: {
                    	color: '#00BE96',
                    },
                },
              opposite: false},
            { // Secondary yAxis
                gridLineWidth: 0,
                title: {
                    text: 'BMI',
                    style: {
                    	color: '#7798BF',
                    },
                },
                labels: {
                    formatter: function() {
                        return this.value + '';
                    },
                    style: {
                    	color: '#7798BF',
                    },
                },
                opposite: true},
              */  
                ],

			tooltip: {
                formatter: function() {
                    var unit = {
                    	<? foreach($block_weight_analysis_data['tooltip'] as $tooltip)
						echo "
                        '{$tooltip['title']}': '{$tooltip['unit']}',
                        ";
                        ?>
                    }[this.series.name];

                    return '' + this.x + ': ' + this.y + ' ' + unit;
                }
            },



            // tooltip: {
                // formatter: function() {
                    // var unit = {
                        // 'Weight': 'Kg',
                        // 'BMI': '',
                    // }[this.series.name];
// 
                    // return '' + this.x + ': ' + this.y + ' ' + unit;
                // }
            // },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
            },
            series: [
            	// {
            	// name: 'Weight',
                // yAxis: 0,
                // data: [83, 83.2, 83.4, 83.1, 82.7, 82.6, 82.3, 82.3, 82.3, 81.9, 81.7, 81.5]
                // },
//                 
            	// {
                // name: 'BMI',
                // yAxis: 1,
                // data: [25.6, 25.7, 25.7, 25.6, 25.5, 25.5, 25.4, 25.4, 25.4, 25.3, 25.2, 25.2]
                // },
            	 <?
            	 foreach($block_weight_analysis_data['plot'] as $item)
				 {
				 	echo "
					 {
						name: '{$item['name']}',
						yAxis: {$item['axis']},
						data:{$item['data']},
					 },
					 ";					 
				 }
            	 ?>
            	]
        });
}

Highcharts.theme = {
	   colors: ["#00BE96", "#7798BF", "#FF1F84", "#DF5353", "#aaeeee", "#ff0066", "#eeaaee",
	      "#55BF3B", "#DF5353", "#7798BF", "#aaeeee"],
	   chart: {
	      backgroundColor: {
	         linearGradient: [0, 0, 0, 400],
	         stops: [
	            [0, 'rgb(96, 96, 96)'],
	            [1, 'rgb(16, 16, 16)'],
	         ]
	      },
	      borderWidth: 0,
	      borderRadius: 0,
	      plotBackgroundColor: null,
	      plotShadow: false,
	      plotBorderWidth: 0,
	   },
	   title: {
	      style: {
	         color: '#FFF',
	         font: '16px Lucida Grande, Lucida Sans Unicode, Verdana, Arial, Helvetica, sans-serif',
	      }
	   },
	   subtitle: {
	      style: {
	         color: '#DDD',
	         font: '12px Lucida Grande, Lucida Sans Unicode, Verdana, Arial, Helvetica, sans-serif',
	      }
	   },
	   xAxis: {
	      gridLineWidth: 0,
	      lineColor: '#999',
	      tickColor: '#999',
	      labels: {
	         style: {
	            color: '#999',
	            fontWeight: 'bold',
	         }
	      },
	      title: {
	         style: {
	            color: '#AAA',
	            font: 'bold 12px Lucida Grande, Lucida Sans Unicode, Verdana, Arial, Helvetica, sans-serif',
	         }
	      }
	   },
	   yAxis: {
	      alternateGridColor: null,
	      minorTickInterval: null,
	      gridLineColor: 'rgba(255, 255, 255, .1)',
	      lineWidth: 0,
	      tickWidth: 0,
	      labels: {
	         style: {
	            color: '#999',
	            fontWeight: 'bold',
	         }
	      },
	      title: {
	         style: {
	            color: '#AAA',
	            font: 'bold 12px Lucida Grande, Lucida Sans Unicode, Verdana, Arial, Helvetica, sans-serif',
	         }
	      }
	   },
	   legend: {
	      itemStyle: {
	         color: '#CCC',
	      },
	      itemHoverStyle: {
	         color: '#FFF',
	      },
	      itemHiddenStyle: {
	         color: '#333',
	      }
	   },
	   labels: {
	      style: {
	         color: '#CCC',
	      }
	   },
	   tooltip: {
	      backgroundColor: {
	         linearGradient: [0, 0, 0, 50],
	         stops: [
	            [0, 'rgba(96, 96, 96, .8)'],
	            [1, 'rgba(16, 16, 16, .8)'],
	         ]
	      },
	      borderWidth: 0,
	      style: {
	         color: '#FFF',
	      }
	   },
	
	
	   plotOptions: {
	      line: {
	         dataLabels: {
	            color: '#CCC',
	         },
	         marker: {
	            lineColor: '#333',
	         }
	      },
	      spline: {
	         marker: {
	            lineColor: '#333',
	         }
	      },
	      scatter: {
	         marker: {
	            lineColor: '#333',
	         }
	      },
	      candlestick: {
	         lineColor: 'white',
	      }
	   },
	
	   toolbar: {
	      itemStyle: {
	         color: '#CCC',
	      }
	   },
	
	   navigation: {
	      buttonOptions: {
	         backgroundColor: {
	            linearGradient: [0, 0, 0, 20],
	            stops: [
	               [0.4, '#606060'],
	               [0.6, '#333333'],
	            ]
	         },
	         borderColor: '#000000',
	         symbolStroke: '#C0C0C0',
	         hoverSymbolStroke: '#FFFFFF',
	      }
	   },
	
	   exporting: {
	      buttons: {
	         exportButton: {
	            symbolFill: '#55BE3B',
	         },
	         printButton: {
	            symbolFill: '#7797BE',
	         }
	      }
	   },
	
	   // scroll charts
	   rangeSelector: {
	      buttonTheme: {
	         fill: {
	            linearGradient: [0, 0, 0, 20],
	            stops: [
	               [0.4, '#888'],
	               [0.6, '#555'],
	            ],
	         },
	         stroke: '#000000',
	         style: {
	            color: '#CCC',
	            fontWeight: 'bold',
	         },
	         states: {
	            hover: {
	               fill: {
	                  linearGradient: [0, 0, 0, 20],
	                  stops: [
	                     [0.4, '#BBB'],
	                     [0.6, '#888'],
	                  ]
	               },
	               stroke: '#000000',
	               style: {
	                  color: 'white',
	               }
	            },
	            select: {
	               fill: {
	                  linearGradient: [0, 0, 0, 20],
	                  stops: [
	                     [0.1, '#000'],
	                     [0.3, '#333'],
	                  ]
	               },
	               stroke: '#000000',
	               style: {
	                  color: '#00BE96',
	               }
	            }
	         }
	      },
	      inputStyle: {
	         backgroundColor: '#333',
	         color: 'silver',
	      },
	      labelStyle: {
	         color: 'silver',
	      }
	   },
	
	   navigator: {
	      handles: {
	         backgroundColor: '#666',
	         borderColor: '#AAA',
	      },
	      outlineColor: '#CCC',
	      maskFill: 'rgba(16, 16, 16, 0.5)',
	      series: {
	         color: '#7798BF',
	         lineColor: '#A6C7ED',
	      }
	   },
	
	   scrollbar: {
	      barBackgroundColor: {
	            linearGradient: [0, 0, 0, 20],
	            stops: [
	               [0.4, '#888'],
	               [0.6, '#555'],
	            ]
	         },
	      barBorderColor: '#CCC',
	      buttonArrowColor: '#CCC',
	      buttonBackgroundColor: {
	            linearGradient: [0, 0, 0, 20],
	            stops: [
	               [0.4, '#888'],
	               [0.6, '#555'],
	            ]
	         },
	      buttonBorderColor: '#CCC',
	      rifleColor: '#FFF',
	      trackBackgroundColor: {
	         linearGradient: [0, 0, 0, 10],
	         stops: [
	            [0, '#000'],
	            [1, '#333'],
	         ]
	      },
	      trackBorderColor: '#666',
	   },
	
	   // special colors for some of the demo examples
	   legendBackgroundColor: 'rgba(48, 48, 48, 0.8)',
	   legendBackgroundColorSolid: 'rgb(70, 70, 70)',
	   dataLabelsColor: '#444',
	   textColor: '#E0E0E0',
	   maskColor: 'rgba(255,255,255,0.3)',
	};
	 var highchartsOptions = Highcharts.setOptions(Highcharts.theme);
$(document).ready(function(){
		block_weight_analysis();
});
</script>
</div>