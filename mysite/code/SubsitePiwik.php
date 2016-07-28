<?php
class SubsitePiwik extends DataExtension {
    private static $db = array('PiwikID' => 'Int');
    private static $summary_fields = array('PiwikID' => 'Piwik ID');

    public function updateCMSFields(FieldList $fields) {
        $fields->addFieldToTab('Root.Configuration', NumericField::create('PiwikID', 'Piwik Site-ID'),'Language');
    }
}
