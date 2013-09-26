<script type="text/javascript">
function formatSeconds(seconds) {
    var date = new Date(1970,0,1);
    date.setSeconds(seconds);
    return date.toTimeString().replace(/.*(\d{2}:\d{2}:\d{2}).*/, "$1");
}
$(function () {
    	
    	// Radialize the colors
		Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function(color) {
		    return {
		        radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
		        stops: [
		            [0, color],
		            [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
		        ]
		    };
		});
		

        $('#containerLeft').highcharts({
            chart: {
				backgroundColor:'rgba(255, 255, 255, 0)'
            },
            title: {
                text: ''
            },
			yAxis:{
				labels: {
					enabled: false
				},
				title: {
					text: null
				}
			},
            xAxis: {
			
			<?php
			$html = 'categories: [';
			foreach ($dates as $date)
				$html .= "'$date',";
			
			$html .= "]";
			
			echo $html;
			?>
                
            },
            tooltip: {
                formatter: function() {
                    var s;
                    if (this.point.name) { // the pie chart
                        s = ''+
                            this.point.name +': worked '+ formatSeconds(this.y) +' ';
                    } else {
                        s = ''+
                            this.x  +' : '+ formatSeconds(this.y);
                    }
                    return s;
                }
            },
					
            series: [<?php
			$html = '';
			foreach ($highchart as $user_detail) {
				$html .= '{'."\n";
				$html .= "type: 'column',"."\n";
				$html .= "name: '".$user_detail['name']."',"."\n";
				$html .= "data: [".$user_detail['dates']."]"."\n";
				$html .= "},"."\n";
			}
			
			
			echo $html;
			?>
/*
	{
                type: 'spline',
                name: 'Average',
                data: [3, 2.67, 3,],
                marker: {
                	lineWidth: 2,
                	lineColor: Highcharts.getOptions().colors[3],
                	fillColor: 'white'
                }
            } , */ {
                type: 'pie',
                name: 'Total worked',
                data: [
						<?php
			$html = '';
			foreach ($highchart as $key => $user_detail) {
				$html .= '{'."\n";
				$html .= "name: '".$user_detail['name']."',"."\n";
				$html .= "y: ".$user_detail['total'].","."\n";
				$html .= "color: Highcharts.getOptions().colors[".$key."]"."\n";
				$html .= "},"."\n";
			}
			
			
			echo $html;
			?>
			],
                center: [50, 50],
                size: 100,
                showInLegend: false,
                dataLabels: {
                    enabled: false
                }
            }]
        });
		
		
    });
</script>

xxx
project id = <?php echo $this->uri->segment(2) ?><br>

<div id="containerRight"></div>

<div id="containerLeft"></div>

<?php
$html = '';
if ($project_details) {
	foreach ($project_details as $row) {
		$html .= $row->name . ' - '. $row->time_done . '<br>';
	}	
}
echo $html;


echo "<pre>";
print_r($project_details);
echo "</pre>";

echo project_details::convertSeconds($sum_seconds);

?>