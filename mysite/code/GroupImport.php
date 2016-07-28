<?php
/* Helper to import Members - first import subsite-export csv on Group tab to
 * create groups for the subsites with the same name, then import the
 * Member-Export (with Group-membership info) on the Member Tab.
 * applies Publisher Role to all groups
 * Password-hash needs to be set in the database directly
 */
class GroupImportAdmin extends ModelAdmin {
    private static $managed_models = array(
        'Group', 'Member',
    );
    private static $model_importers = array(
        'Group' => 'MysiteGroupCsvBulkLoader',
        'Member' => 'MysiteMemberCsvBulkLoader',
    );
    private static $url_segment = 'group_import';

    public function init() {
        // show all, not only those applying to the currently active Subsite
        Subsite::disable_subsite_filter(TRUE);
        parent::init();
    }
}

class MysiteGroupCsvBulkLoader extends CsvBulkLoader {
    public $columnMap = array(
        'Subsite Name' => '->TitleAndSubsite',
    );
    public $duplicateChecks = array(
        'Subsite Name' => array('callback' => 'getGroupByTitle'),
    );
    public static function TitleAndSubsite(&$obj, $val, $record) {
        $obj->Title = $val;
        $obj->Subsites()->add(Subsite::get()->filter('Title', $val)->First());
        $obj->AccessAllSubsites = 0;
        $obj->Description = "publishers of the $val";
        $obj->Roles()->add(PermissionRole::get()->filter('Title', 'Publisher')->First());
    }
    public static function getGroupByTitle($val, $record) {
        Subsite::disable_subsite_filter(TRUE);
        $group = Group::get()->filter('Title', $val)->First();
        Subsite::disable_subsite_filter(FALSE);
        return $group;
    }
}

class MysiteMemberCsvBulkLoader extends MemberCsvBulkLoader {
    public $columnMap = array(
        'publishergroups' => '->setupGroups',
    );
    public static function setupGroups(&$obj, $val, $record) {
        $groupTitles = explode(',', $val);
        if (! $obj->ID) {
            $obj->write();
        }
        foreach ($groupTitles as $title) {
            $obj->Groups()->add(Group::get()->filter('Title', $title)->First());
        }
    }
}
