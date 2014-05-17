<html>
	<head>
	</head>
	<body>
		<div>
			sdfsdf
			<?php
			$this->Widget('ext.GoogleMap.GoogleMapWidget', array(
				'id' => 'test',
				'options' => array(
					'center' => array(
						'latitude' => '51.508742',
						'longitude' => '-0.120850',
					),
					'marker' => array(
						array(
							'title' => 'Bondi Beach',
							'latitude' => '51.508742',
							'longitude' => '-0.120850',
							'zIndex' => '1',
							'image' => 'http://localhost/scorpion/images/icons/fail.png',
						),
					),
				),
			));
			?>

			<!--			<div id="test" style="width:500px;height:380px;"></div>-->
		</div>
	</body>
</html>