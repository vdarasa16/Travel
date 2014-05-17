<?php

class GoogleMapWidget extends CWidget
{

	public $options = array();
	public $htmlOptions = array();
	public $data;
	public $width = 500;
	public $height = 380;

	/**
	 * Renders the widget.
	 */
	public function run()
	{
		if (!isset($this->options['center']['latitude']) || !isset($this->options['center']['longitude']))
			return false;

		$center = 'js:new google.maps.LatLng(\'' . $this->options['center']['latitude'] . '\',\'' . $this->options['center']['longitude'] . '\')';
		$this->options['center'] = $center;

		$id = (isset($this->id)) ? $this->id : $this->getId();
		$this->htmlOptions['id'] = $id;
		$size = 'width: ' . $this->width . 'px; height: ' . $this->height . 'px;';
		if (isset($this->htmlOptions['style']))
			$this->htmlOptions['style'] .= ' ' . $size;
		else
			$this->htmlOptions['style'] = $size;

		echo CHtml::openTag('div', $this->htmlOptions);
		echo CHtml::closeTag('div');

		$script = $this->createJsCode();
		$this->registerScripts(__CLASS__ . '#' . $id, $script);
	}

	/**
	 * Publishes and registers the necessary script files.
	 *
	 * @param string the id of the script to be inserted into the page
	 * @param string the embedded script to be inserted into the page
	 */
	protected function registerScripts($id, $embeddedScript)
	{
		$basePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR;
		$baseUrl = Yii::app()->getAssetManager()->publish($basePath, false, 1, YII_DEBUG);
		$scriptFile = 'http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false';

		$cs = Yii::app()->clientScript;
		$cs->registerCoreScript('jquery');
		$cs->registerScriptFile($scriptFile);

		echo '<script>' . $embeddedScript . '</script>';
	}

	protected function createJsCode()
	{
		$marker = array();
		if (isset($this->options['marker']))
		{
			$marker = $this->options['marker'];
			unset($this->options['marker']);
		}

		$defaultOptions = array(
			'disableDefaultUI' => true,
			'zoomControl' => false,
			'scrollwheel' => true,
			'zoom' => 5,
			'mapTypeId' => 'js:google.maps.MapTypeId.ROADMAP',
		);

		$this->options = CMap::mergeArray($defaultOptions, $this->options);
		$jsOptions = CJavaScript::encode($this->options);
		$markerOptions = CJavaScript::encode($marker);


		$js = <<<EOT
function initialize()
{
	var mapProp = $jsOptions;
	var map=new google.maps.Map(document.getElementById('$this->id'), mapProp);
	var beaches = $markerOptions;

	setMarkers(map, beaches);
}

function setMarkers(map, locations)
{
  $.each(locations, function(index, location){
    location = $.merge(location, {title: '', latitude: '', longitude: '', image: '', zIndex: 1});
	
	var image = {};
	if(location.image != '')
	{
		image = {
			url: location.image,
			size: new google.maps.Size(20, 32),
		};
	}
	
    var myLatLng = new google.maps.LatLng(location.latitude, location.longitude);
    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
		icon: image,
        title: location.title,
        zIndex: location.zIndex
    });
  });
}

google.maps.event.addDomListener(window, 'load', initialize);
EOT;

		return $js;
	}

}