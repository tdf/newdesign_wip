<?php
/** 
 * This report lists all the pages in the CMS
 * of type Page. Sorted by title.
 */
class YoutubeEmbedReport extends SS_Report {
    public function title() {
        // this is the title of the report
        return "All Pages with youtube.com/embed URL";
    }
    public function sourceRecords($params = null) {
        Subsite::disable_subsite_filter(TRUE);
        return Page::get()->filter("Content:PartialMatch", "youtube.com/embed")->sort("Title");
    }

    public function columns() {
        $linkBase = singleton('CMSPageEditController')->Link('show');
        $fields = array(
            "Title" => array(
                "title" => "Page title",
                'formatting' => function($value, $item) use ($linkBase) {
                    return sprintf('<a href="%s" title="%s">%s</a>',
                        Controller::join_links($linkBase, $item->ID),
                        'Edit page',
                        $value
                    );
                }
        ),
            "LastEdited" => array(
                "title" => $dateTitle,
                'casting' => 'SS_Datetime->Full'
            )
        );
        return $fields;

    }
}
