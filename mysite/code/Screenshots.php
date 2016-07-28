<?php
/**
 */
class Screenshots extends Page {
	  private static $db = array(
                'Writer' => 'HTMLText',
                'Calc' => 'HTMLText',
                'Impress' => 'HTMLText',
                'Draw' => 'HTMLText',
                'Base' => 'HTMLText',
                'Math' => 'HTMLText',
                'Charts' => 'HTMLText',
        );
	
function getCMSFields() {
		$fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', new HTMLEditorField('Writer', "Writer"), 'Content');
        $fields->addFieldToTab('Root.Main', new HTMLEditorField('Calc', "Calc"), 'Content');
        $fields->addFieldToTab('Root.Main', new HTMLEditorField('Impress', "Impress"), 'Content');
        $fields->addFieldToTab('Root.Main', new HTMLEditorField('Draw', "Draw"), 'Content');
        $fields->addFieldToTab('Root.Main', new HTMLEditorField('Base', "Base"), 'Content');
        $fields->addFieldToTab('Root.Main', new HTMLEditorField('Math', "Math"), 'Content');
        $fields->addFieldToTab('Root.Main', new HTMLEditorField('Charts', "Charts"), 'Content');
		return $fields;
	}
}

class Screenshots_Controller extends Page_Controller {
}
