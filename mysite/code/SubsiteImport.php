<?php
/* Helper to import subsites - first import csv on Subsite tab to create the
 * subsites, then import the same csv on the SubsiteDomain tab to add the
 * domain-mappings. (hardcodes libreofficenew theme)
 */
class SubsiteImportAdmin extends ModelAdmin {
    private static $managed_models = array(
        'Subsite', 'SubsiteDomain',
    );
    private static $model_importers = array(
        'Subsite' => 'SubsiteCsvBulkLoader',
        'SubsiteDomain' => 'SubsiteDomainCsvBulkLoader',
    );
    private static $url_segment = 'subsite_import';
}

class SubsiteCsvBulkLoader extends CsvBulkLoader {
    public $columnMap = array(
        'Subsite Name' => '->TitleAndTheme',
        'Active subsite' => 'IsPublic',
        'Google Site Verification meta-Tag' => 'GoogleSiteVerification',
        'Piwik ID' => 'PiwikID',
        'Language' => 'Language',
    );
    public $duplicateChecks = array(
        'Subsite Name' => array('callback' => 'getSubsiteByTitle'),
    );
    public static function TitleAndTheme(&$obj, $val, $record) {
        $obj->Title = $val;
        $obj->Theme = 'libreofficenew';
    }
    public static function getSubsiteByTitle($val, $record) {
        return Subsite::get()->filter('Title', $val)->First();
    }
}
class SubsiteDomainCsvBulkLoader extends CsvBulkLoader {
    public $columnMap = array(
        'Subsite Name' => 'Subsite.Title',
        'Primary Domain' => '->setprimary',
    );
    public $duplicateChecks = array(
        'Primary Domain' => array('callback' => 'getSubsiteDomainByTitle'),
    );
    public $relationCallbacks = array(
        'Subsite.Title' => array(
            'relationname' => 'Subsite',
            'callback' => 'getSubsiteByTitle',
        ),
    );
    public static function setprimary(&$obj, $val, $record) {
        $obj->IsPrimary = 1;
        $obj->Domain = $val;
    }
    public static function getSubsiteByTitle(&$obj, $val, $record) {
        return Subsite::get()->filter('Title', $val)->First();
    }
    public static function getSubsiteDomainByTitle($val, $record) {
        return SubsiteDomain::get()->filter(array('Domain' => $val, 'IsPrimary' => 1))->First();
    }
}
