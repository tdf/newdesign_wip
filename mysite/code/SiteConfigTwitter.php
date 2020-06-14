<?php
class SiteConfigTwitter extends DataExtension {

    private static $db = array (
        'TwitterLeftHandle' => 'Varchar',
        'TwitterLeftWID' => 'Varchar',
        'TwitterRightHandle' => 'Varchar',
        'TwitterRightWID' => 'Varchar',
    );

    public function updateCMSFields(FieldList $fields) {
        $fields->addFieldsToTab('Root.Social', array (
            TextField::create('TwitterLeftHandle','left Twitter Hanlde (without @)'),
            TextField::create('TwitterLeftWID','left Twitter Widget-ID'),
            TextField::create('TwitterRightHandle','right Twitter Handle (without @)'),
            TextField::create('TwitterRightWID','right Twitter Widget-ID')
        ));
    }
}
