<?php
/**
 */
class Discover extends Page {
	  private static $db = array(
                'Thumb' => 'HTMLText',
                'Caption' => 'HTMLText',
        );
	
function getCMSFields() {
		$fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', new TextField('Thumb', "Main Image"), 'Content');
        $fields->addFieldToTab('Root.Main', new TextField('Caption', "Image Caption"), 'Content');
		return $fields;
	}
}

class Discover_Controller extends Page_Controller {
}
