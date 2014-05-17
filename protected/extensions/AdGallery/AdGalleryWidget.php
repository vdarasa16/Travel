<?php

class AdGalleryWidget extends CWidget
{

	public $options = array();
	public $htmlOptions = array();
	public $data;
	public $hasControl = false;

	/**
	 * Renders the widget.
	 */
	public function run()
	{
		$id = (isset($this->id)) ? $this->id : $this->getId();
		$this->htmlOptions['id'] = $id;

		if (isset($this->htmlOptions['class']))
			$this->htmlOptions['class'] .= ' ad-gallery';
		else
			$this->htmlOptions['class'] = 'ad-gallery';

		$this->htmlOptions['style'] = 'padding: 30px;';

		$defaultOptions = array(
			'width' => '600',
			'height' => '400',
			'thumb_opacity' => '0.7',
			'start_at_index' => '0',
			'update_window_hash' => true,
			'animate_first_image' => false,
			'animation_speed' => '400',
			'display_next_and_prev' => true,
			'display_back_and_forward' => false,
			'hooks' => array('displayDescription' => 'js:function(image) {}'),
		);
		$this->options = CMap::mergeArray($defaultOptions, $this->options);

		echo CHtml::openTag('div', $this->htmlOptions);
		echo CHtml::openTag('div', array('class' => 'ad-image-wrapper'));
		echo CHtml::closeTag('div');
		if ($this->hasControl)
		{
			echo CHtml::openTag('div', array('class' => 'ad-controls'));
			echo CHtml::closeTag('div');
		}
		echo CHtml::openTag('div', array('class' => 'ad-nav'));
		echo CHtml::openTag('div', array('class' => 'ad-thumbs'));
		echo CHtml::openTag('ul', array('class' => 'ad-thumb-list'));

		if (isset($this->data))
		{
			foreach ($this->data as $data)
			{
				if (!isset($data['image']) || !isset($data['thumbnail']))
					continue;

				$aTagOptions = array('href' => $data['image']);
				$imgTagOptions = array('src' => $data['thumbnail']);

				if (isset($data['title']))
					$imgTagOptions['title'] = $data['title'];
				if (isset($data['description']))
					$imgTagOptions['alt'] = $data['description'];
				if (isset($data['url']))
					$imgTagOptions['longdesc'] = $data['url'];

				echo CHtml::openTag('li');
				echo CHtml::openTag('a', $aTagOptions);
				echo CHtml::openTag('img', $imgTagOptions);
				echo CHtml::closeTag('img');
				echo CHtml::closeTag('a');
				echo CHtml::closeTag('li');
			}
		}

		echo CHtml::closeTag('ul');
		echo CHtml::closeTag('div');
		echo CHtml::closeTag('div');
		echo CHtml::closeTag('div');

		$jsOptions = CJavaScript::encode($this->options);
		$this->registerScripts(__CLASS__ . '#' . $id, "var galleries = $('.ad-gallery').adGallery($jsOptions);");
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
		$scriptFile = '/jquery.ad-gallery.min.js';
		$cssFile = '/jquery.ad-gallery.css';

		$cs = Yii::app()->clientScript;
		$cs->registerCoreScript('jquery');
		$cs->registerScriptFile($baseUrl . $scriptFile);
		$cs->registerCssFile($baseUrl . $cssFile);

		$cs->registerScript($id, $embeddedScript, CClientScript::POS_LOAD);
	}

}