<?php
/**
 */
class GetInvolved extends Page {
	  private static $db = array(
                'Subtitle' => 'HTMLText',
                'Customsidebar' => 'HTMLText',
                'SliderLink1' => 'HTMLText',
                'SliderImg1' => 'HTMLText',
                'SliderTitle1' => 'HTMLText',
                'SliderText1' => 'HTMLText',
                'SliderLink2' => 'HTMLText',
                'SliderImg2' => 'HTMLText',
                'SliderTitle2' => 'HTMLText',
                'SliderText2' => 'HTMLText',
                'SliderLink3' => 'HTMLText',
                'SliderImg3' => 'HTMLText',
                'SliderTitle3' => 'HTMLText',
                'SliderText3' => 'HTMLText',
                'SliderLink4' => 'HTMLText',
                'SliderImg4' => 'HTMLText',
                'SliderTitle4' => 'HTMLText',
                'SliderText4' => 'HTMLText',
                'SliderLink5' => 'HTMLText',
                'SliderImg5' => 'HTMLText',
                'SliderTitle5' => 'HTMLText',
                'SliderText5' => 'HTMLText',
                'SliderLink6' => 'HTMLText',
                'SliderImg6' => 'HTMLText',
                'SliderTitle6' => 'HTMLText',
                'SliderText6' => 'HTMLText',
                'SliderLink7' => 'HTMLText',
                'SliderImg7' => 'HTMLText',
                'SliderTitle7' => 'HTMLText',
                'SliderText7' => 'HTMLText',
        );
	
function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->addFieldToTab('Root.Main', new TextField('Subtitle', "Subtitle"), 'Content');
        $fields->addFieldToTab('Root.Main', new HTMLEditorField('Customsidebar', "Custom Sidebar"));
		$fields->addFieldToTab('Root.Main', new TextField('SliderTitle1', "Slider Title 1"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('SliderImg1', "Slider Image 1 (1132 x 388px)"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('SliderLink1', "Slider Link 1"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('SliderText1', "Slider Text 1"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('SliderTitle2', "Slider Title 2"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('SliderImg2', "Slider Image 2 (1132 x 388px)"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('SliderLink2', "Slider Link 2"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('SliderText2', "Slider Text 2"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('SliderTitle3', "Slider Title 3"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('SliderImg3', "Slider Image 3 (1132 x 388px)"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('SliderLink3', "Slider Link 3"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('SliderText3', "Slider Text 3"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('SliderTitle4', "Slider Title 4"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('SliderImg4', "Slider Image 4 (1132 x 388px)"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('SliderLink4', "Slider Link 4"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('SliderText4', "Slider Text 4"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('SliderTitle5', "Slider Title 5"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('SliderImg5', "Slider Image 5 (1132 x 388px)"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('SliderLink5', "Slider Link 5"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('SliderText5', "Slider Text 5"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('SliderTitle6', "Slider Title 6"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('SliderImg6', "Slider Image 6 (1132 x 388px)"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('SliderLink6', "Slider Link 6"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('SliderText6', "Slider Text 6"), 'Content');
	    $fields->addFieldToTab('Root.Main', new TextField('SliderTitle7', "Slider Title 7"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('SliderImg7', "Slider Image 7 (1132 x 388px)"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('SliderLink7', "Slider Link 7"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('SliderText7', "Slider Text 7"), 'Content');
		return $fields;
	}
}

class GetInvolved_Controller extends Page_Controller {
}
