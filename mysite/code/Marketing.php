<?php
/**
 */
class Marketing extends Page {
	  private static $db = array(
                'Subtitle' => 'HTMLText',
                'Customsidebar' => 'HTMLText',
                'Customlink1' => 'HTMLText',
                'Customlink2' => 'HTMLText',
                'Customlink3' => 'HTMLText',
        );
	
function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->addFieldToTab('Root.Main', new TextField('Subtitle', "Subtitle"), 'Content');
        $fields->addFieldToTab('Root.Main', new HTMLEditorField('Customsidebar', "Custom Sidebar"));
        $fields->addFieldToTab('Root.Main', new HTMLEditorField('Customlink1', "Other Button, Link, Text, etc - 1"));
        $fields->addFieldToTab('Root.Main', new HTMLEditorField('Customlink2', "Other Button, Link, Text, etc - 2"));
        $fields->addFieldToTab('Root.Main', new HTMLEditorField('Customlink3', "Other Button, Link, Text, etc - 3"));
		return $fields;
	}
}

class Marketing_Controller extends Page_Controller {
}
