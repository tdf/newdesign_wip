<?php
class MysiteRSSFeed extends DataObject {
    private static $db = array(
        'RSSHeader' => 'Varchar(255)',
        'RSSTitle' => 'Varchar(255)',
        'RSSFeed' => 'Varchar(255)',
        'RSSLink' => 'Varchar(255)',
        'ConnectionWord' => 'Varchar(255)',
    );

    private static $summary_fields = array(
        'ID' => "ID",
        'RSSTitle' => "Title"
    );
    private static $belongs_to = array(
        'Homepage' => 'Homepage',
    );

    function getCMSFields_forPopup() {
        $fields = new FieldSet(
            new TextField('RSSHeader', "the header text"),
            new TextField('ConnectionWord', "optional string like 'from ' that connects the header with a link to the feed"),
            new TextField('RSSTitle', "the title/label of the feed"),
            new TextField('RSSFeed', 'URL of the feed (fetched using this link)'),
            new TextField('RSSLink','link to website of feed (the link that should be pointed to)')
        );
        return $fields;
    }
    private function getUseCount() {
        Subsite::disable_subsite_filter(TRUE);
        $usecount = Homepage::get()->filterAny(array('PrimaryFeedID' => $this->ID, 'SecondaryFeedID' => $this->ID))->Count();
        Subsite::disable_subsite_filter(FALSE);
        return $usecount;
    }
    function getCMSFields() {
        $fields = parent::getCMSFields();
        $fields->insertBefore(new LabelField('UseCount','used in '. $this->getUseCount() .' pages (editing disabled if used more than once)', 'RSSHeader'));
        return $fields;
    }
    function canView($member = false)   { return true;}
    function canCreate($member = false) { return Permission::check('CMS_ACCESS_CMSMain'); }
    function canEdit($member = false)   {
        // restrict editing to the case where the feed is only assigned to a single site
        // but admin can do anything
        return $this->getUseCount() <= 1 && Permission::check('CMS_ACCESS_CMSMain')
            || Permission::check('ADMIN');
    }
    function canDelete($member = false)   {
        // restrict editing to the case where the feed is only assigned to a single site
        // even admin shouldn't be able to override this
        return $this->getUseCount() === 0 && Permission::check('CMS_ACCESS_CMSMain');
    }

    function forTemplate() {
        $this->Feed = new ArrayList();

        include_once(Director::getAbsFile(FRAMEWORK_DIR . '/thirdparty/simplepie/simplepie_131.inc'));

        $feed = new SimplePie();
	$feed->set_feed_url($this->RSSFeed);
	$feed->set_cache_location(TEMP_FOLDER);
        $feed->init();
        $feed->handle_content_type();
        if($items = $feed->get_items(0, 2)) {
            foreach($items as $item) {

                // Cast the Date
                $date = new Date('Date');
                $date->setValue($item->get_date());

                // Cast the Title
                $title = new Text('Title');
                $title->setValue($item->get_title());

                // Cast the description
                $desc_text = $item->get_description();
                // Strip all HTML except links and breaks
                $desc_text = strip_tags($desc_text, "<a><p><br>");
                if(strlen($desc_text) > 505) {
                    $desc_text = substr($desc_text, 0, 500).'[…]';
                }
                // Catch all plain text links (not in a link tag) and convert to HTML links
                $desc_text = preg_replace("#(?<!href=[\"'])\s+((http|https|ftp)://(\S*?\.\S*?))(\s|\;|\)|\]|\[|\{|\}|,|\"|'|:|\<|$|\.\s)#i", " <a href=\"$1\" target=\"_blank\">$3</a>$4", $desc_text);

                $desc = new HTMLText('Description');
                $desc->setValue($desc_text);

                $this->Feed->push(new ArrayData(array(
                    'Title'         => $title,
                    'Date'         => $date,
                    'Link'         => $item->get_link(),
                    'Description'   => $desc
                )));
            }
            return $this->renderWith("MysiteRSSFeed");
        } elseif ($feed->error()) {
                $this->Feed->push(new ArrayData(array(
                    'Title'         => "error parsing feed",
                    'Link'         => $this->RSSFeed,
                    'Description'   => $feed->error()
                )));
                $this->Feed->push(new ArrayData(array(
                    'Title'         => "error parsing feed",
                    'Link'         => $this->RSSFeed,
                    'Description'   => $feed->error()
                )));
            return $this->renderWith("MysiteRSSFeed");
        }

        return false;
    }
}
