<?php
/**
 */
class Feedback extends Page {
	  private static $db = array(
                'Feedbacksidebar' => 'HTMLText',
                'Fullwidthtext1' => 'HTMLText',
                'Subtitle1' => 'HTMLText',
                'FeedbackTitle1' => 'HTMLText',
                'FeedbackLink1' => 'HTMLText',
                'FeedbackIcon1' => 'HTMLText',
                'FeedbackText1' => 'HTMLText',
                'FeedbackTitle2' => 'HTMLText',
                'FeedbackLink2' => 'HTMLText',
                'FeedbackIcon2' => 'HTMLText',
                'FeedbackText2' => 'HTMLText',
                'FeedbackTitle3' => 'HTMLText',
                'FeedbackLink3' => 'HTMLText',
                'FeedbackIcon3' => 'HTMLText',
                'FeedbackText3' => 'HTMLText',
        );
	
function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->addFieldToTab('Root.Main', new TextField('Fullwidthtext1', "Fullwidth text"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('Subtitle1', "Subtitle"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('FeedbackIcon1', "Box 1 - Font Awesome Icon"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('FeedbackTitle1', "Box 1 - Title"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('FeedbackLink1', "Box 1 - Title Link"), 'Content');
		$fields->addFieldToTab('Root.Main', new HTMLEditorField('FeedbackText1', "Box 1 - Text"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('FeedbackIcon2', "Box 2 - Font Awesome Icon"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('FeedbackTitle2', "Box 2 - Title"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('FeedbackLink2', "Box 2 - Title Link"), 'Content');
		$fields->addFieldToTab('Root.Main', new HTMLEditorField('FeedbackText2', "Box 2 - Text"), 'Content');	
		$fields->addFieldToTab('Root.Main', new TextField('FeedbackIcon3', "Box 3 - Font Awesome Icon"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('FeedbackTitle3', "Box 3 - Title"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('FeedbackLink3', "Box 3 - Title Link"), 'Content');
		$fields->addFieldToTab('Root.Main', new HTMLEditorField('FeedbackText3', "Box 3 - Text"), 'Content');		
        $fields->addFieldToTab('Root.Main', new HTMLEditorField('Feedbacksidebar', "Custom Sidebar"));
		return $fields;
	}
}

class Feedback_Controller extends Page_Controller {
}
