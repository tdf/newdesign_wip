<?php
/**
 */
class Community extends Page {
	  private static $db = array(
                'Subtitle' => 'HTMLText',
                'CommunityTitle1' => 'HTMLText',
                'CommunityIcon1' => 'HTMLText',
                'CommunityLink1' => 'HTMLText',
                'CommunityText1' => 'HTMLText',
                'CommunityTitle2' => 'HTMLText',
                'CommunityIcon2' => 'HTMLText',
                'CommunityLink2' => 'HTMLText',
                'CommunityText2' => 'HTMLText',
                'CommunityTitle3' => 'HTMLText',
                'CommunityIcon3' => 'HTMLText',
                'CommunityLink3' => 'HTMLText',
                'CommunityText3' => 'HTMLText',
                'CommunityTitle4' => 'HTMLText',
                'CommunityIcon4' => 'HTMLText',
                'CommunityLink4' => 'HTMLText',
                'CommunityText4' => 'HTMLText',
                'CommunityTitle5' => 'HTMLText',
                'CommunityIcon5' => 'HTMLText',
                'CommunityLink5' => 'HTMLText',
                'CommunityText5' => 'HTMLText',
                'CommunityTitle6' => 'HTMLText',
                'CommunityIcon6' => 'HTMLText',
                'CommunityLink6' => 'HTMLText',
                'CommunityText6' => 'HTMLText',
        );
	
function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->addFieldToTab('Root.Main', new TextField('Subtitle', "Subtitle"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('CommunityTitle1', "Box 1 Title"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('CommunityIcon1', "Box 1 Icon"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('CommunityLink1', "Box 1 Link"), 'Content');
		$editorbox1 = new HTMLEditorField('CommunityText1', "Box 1 Description");
        $editorbox1->setRows(3);
        $fields->addFieldToTab('Root.Main', $editorbox1, 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('CommunityTitle2', "Box 2 Title"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('CommunityIcon2', "Box 2 Icon"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('CommunityLink2', "Box 2 Link"), 'Content');
		$editorbox2 = new HTMLEditorField('CommunityText2', "Box 2 Description");
        $editorbox2->setRows(3);
        $fields->addFieldToTab('Root.Main', $editorbox2, 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('CommunityTitle3', "Box 3 Title"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('CommunityIcon3', "Box 3 Icon"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('CommunityLink3', "Box 3 Link"), 'Content');
		$editorbox3 = new HTMLEditorField('CommunityText3', "Box 3 Description");
        $editorbox3->setRows(3);
        $fields->addFieldToTab('Root.Main', $editorbox3, 'Content');
        $fields->addFieldToTab('Root.Main', new TextField('CommunityTitle4', "Box 4 Title"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('CommunityIcon4', "Box 4 Icon"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('CommunityLink4', "Box 4 Link"), 'Content');
		$editorbox4 = new HTMLEditorField('CommunityText4', "Box 4 Description");
        $editorbox4->setRows(3);
        $fields->addFieldToTab('Root.Main', $editorbox4, 'Content');
        $fields->addFieldToTab('Root.Main', new TextField('CommunityTitle5', "Box 5 Title"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('CommunityIcon5', "Box 5 Icon"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('CommunityLink5', "Box 5 Link"), 'Content');
		$editorbox5 = new HTMLEditorField('CommunityText5', "Box 5 Description");
        $editorbox5->setRows(3);
        $fields->addFieldToTab('Root.Main', $editorbox5, 'Content');
        $fields->addFieldToTab('Root.Main', new TextField('CommunityTitle6', "Box 6 Title"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('CommunityIcon6', "Box 6 Icon"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('CommunityLink6', "Box 6 Link"), 'Content');
		$editorbox6 = new HTMLEditorField('CommunityText6', "Box 6 Description");
        $editorbox6->setRows(3);
        $fields->addFieldToTab('Root.Main', $editorbox6, 'Content');
		return $fields;
	}
}

class Community_Controller extends Page_Controller {
}
