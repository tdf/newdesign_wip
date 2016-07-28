<?php
class Events extends Page {
	private static $db = array(
		'Subtitle'      => 'HTMLText',
		'Customsidebar' => 'HTMLText',
		'SliderLink1'   => 'HTMLText',
		'SliderText1'   => 'HTMLText',
		'SliderLink2'   => 'HTMLText',
		'SliderText2'   => 'HTMLText',
		'SliderLink3'   => 'HTMLText',
		'SliderText3'   => 'HTMLText',
	);
	private static $has_one = array(
		'SliderImg1' => 'Image',
		'SliderImg2' => 'Image',
		'SliderImg3' => 'Image'
	);

	function getCMSFields() {
		$fields = parent::getCMSFields();
		$images = array();
		$fields->addFieldToTab('Root.Main', new TextField('Subtitle', "Subtitle"), 'Content');
		$fields->addFieldToTab('Root.Main', new HTMLEditorField('Customsidebar', "Custom Sidebar"));
		$fields->addFieldToTab('Root.Main', $images[] = new UploadField('SliderImg1', "Slider Image 1 (1132 x 388px)"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('SliderLink1', "Slider Link 1"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('SliderText1', "Slider Text 1"), 'Content');
		$fields->addFieldToTab('Root.Main', $images[] = new UploadField('SliderImg2', "Slider Image 2 (1132 x 388px)"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('SliderLink2', "Slider Link 2"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('SliderText2', "Slider Text 2"), 'Content');
		$fields->addFieldToTab('Root.Main', $images[] = new UploadField('SliderImg3', "Slider Image 3 (1132 x 388px)"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('SliderLink3', "Slider Link 3"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('SliderText3', "Slider Text 3"), 'Content');
		foreach($images as $imagefield) {
			$imagefield->setAllowedFileCategories('image');
			$imagefield->setFolderName('Uploads/Events/' . $this->Subsite()->Language);
		}
		return $fields;
	}
}

class Events_Controller extends Page_Controller {
}
