<?php
/**
 */

class Homepage extends Page {
	  private static $db = array(
                'HomepageTitleMain' => 'HTMLText',
                'HomepageFullwidthtext1' => 'HTMLText',
                'HomepageIcon1' => 'HTMLText',
                'HomepageIconLink1' => 'HTMLText',
                'HomepageTitle1' => 'HTMLText',
                'HomepageText1' => 'HTMLText',
                'HomepageCall1' => 'HTMLText',
                'HomepageLink1' => 'HTMLText',
                'HomepageIconLink2' => 'HTMLText',
                'HomepageIcon2' => 'HTMLText',
                'HomepageTitle2' => 'HTMLText',
                'HomepageText2' => 'HTMLText',
                'HomepageCall2' => 'HTMLText',
                'HomepageLink2' => 'HTMLText',
                'HomepageIcon3' => 'HTMLText',
                'HomepageIconLink3' => 'HTMLText',
                'HomepageTitle3' => 'HTMLText',
                'HomepageText3' => 'HTMLText',
                'HomepageCall3' => 'HTMLText',
                'HomepageLink3' => 'HTMLText',
                'QuoteText' => 'HTMLText',
                'QuoteCall' => 'HTMLText',
                'QuoteLink' => 'HTMLText',
        );

        private static $has_one = array(
           "PrimaryFeed"   => "MysiteRSSFeed",
           "SecondaryFeed" => "MysiteRSSFeed"
          );

function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->addFieldToTab('Root.Main', new TextField('HomepageTitleMain', "Main text title"), 'Content');
		$editorbox1 = new HTMLEditorField('HomepageFullwidthtext1', "Main text");
        $editorbox1->setRows(3);
        $fields->addFieldToTab('Root.Main', $editorbox1, 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('HomepageIcon1', "Box 1 - Font Awesome Icon"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('HomepageIconLink1', "Box 1 - Icon Link"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('HomepageTitle1', "Box 1 - Title"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('HomepageText1', "Box 1 - Text"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('HomepageCall1', "Box 1 - Call to action"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('HomepageLink1', "Box 1 - Call to action Link"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('HomepageIcon2', "Box 2 - Font Awesome Icon"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('HomepageIconLink2', "Box 2 - Icon Link"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('HomepageTitle2', "Box 2 - Title"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('HomepageText2', "Box 2 - Text"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('HomepageCall2', "Box 2 - Call to action"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('HomepageLink2', "Box 2 - Call to action Link"), 'Content');	
		$fields->addFieldToTab('Root.Main', new TextField('HomepageIcon3', "Box 3 - Font Awesome Icon"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('HomepageIconLink3', "Box 3 - Icon Link"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('HomepageTitle3', "Box 3 - Title"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('HomepageText3', "Box 3 - Text"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('HomepageCall3', "Box 3 - Call to action"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('HomepageLink3', "Box 3 - Call to action Link"), 'Content');	
		$fields->addFieldToTab('Root.Main', new TextField('QuoteText', "Quote Box - Text"), 'Content');	
		$fields->addFieldToTab('Root.Main', new TextField('QuoteCall', "Quote Box - Button Text"), 'Content');	
		$fields->addFieldToTab('Root.Main', new TextField('QuoteLink', "Quote Box - Button Link"), 'Content');	
        $rssfield  = new DropdownField('PrimaryFeedID', 'Primary Feed', MysiteRSSFeed::get()->map('ID', 'RSSTitle'));
        $rssfield->setEmptyString('(Select one/create new with the below feed)');
        $rssfield2 = new DropdownField('SecondaryFeedID', 'Secondary Feed', MysiteRSSFeed::get()->map('ID', 'RSSTitle'));
        $rssfield2->setEmptyString('(Select one/create new with the below feed)');
        $fields->addFieldToTab('Root.Main', $rssfield, 'Content');
        $fields->addFieldToTab('Root.Main', $rssfield2, 'Content');
        $gf = GridFieldConfig_RecordEditor::create();
        $myTableField = new GridField('PrimaryFeed', "Manage Feeds", MysiteRSSFeed::get(), $gf);
        $myTableField->setModelClass("MysiteRSSFeed");
        $fields->addFieldToTab('Root.Main', $myTableField, 'Content');
		return $fields;
	}
}

class Homepage_Controller extends Page_Controller {
	function DownloadPageLink() {
		return Download::get()->first()->Link();
	}
}
