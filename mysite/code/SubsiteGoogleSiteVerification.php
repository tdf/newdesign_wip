<?php
/**
 * use as $Subsite.GoogleSiteVerification in the <head> section
 */
class SubsiteGoogleSiteVerification extends DataExtension {
    private static $db = array('GoogleSiteVerification' => 'HTMLVarchar(100)');
    private static $summary_fields = array('GoogleSiteVerificationRAW' => 'Google Site Verification meta-Tag');

    public function updateCMSFields(FieldList $fields) {
        $fields->addFieldToTab('Root.Configuration', TextField::create('GoogleSiteVerification', 'Google Site Verification meta-Tag',null,100), 'Language');
    }
    public function getGoogleSiteVerificationRAW() {
        /* HTML gets interpreted by the summary table, thus escape it as xml-string */
        return $this->owner->obj("GoogleSiteVerification")->XML();
    }
}
