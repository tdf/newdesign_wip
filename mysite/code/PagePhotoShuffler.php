<?php
class ImagePhotoShuffler extends DataExtension {
    private static $belongs_many_many = array('ShufflerPages' => 'Page');
}
class PagePhotoShuffler extends DataExtension {
    private static $summary_fields = array('PiwikID' => 'Piwik ID');
    private static $db = array(
        'ShufflerWidth' => 'Int',
        'ShufflerHeight' => 'Int',
        'PauseSeconds' => 'Decimal',
        'FadeSeconds' => 'Decimal',
    );
    private static $defaults = array(
        'ShufflerWidth' => 400,
        'ShufflerHeight' => 300,
        'PauseSeconds' => 5.0,
        'FadeSeconds' => 0.70
    );
    private static $many_many = array (
        'ShufflerImages' => 'Image'
    );

    public function updateCMSFields(FieldList $fields) {
        $width = new NumericField('ShufflerWidth', "Scale images to width x height (keeps aspect ratio)");
        $height = new NumericField('ShufflerHeight', " x ");
        $width->setMaxLength(4);
        $height->setMaxLength(4);
        $fields->addFieldToTab("Root.PhotoShuffler",new FieldGroup($width,$height));

        $pause = new NumericField('PauseSeconds', "Pause between changing images (seconds)");
        $fade = new NumericField('FadeSeconds', " Duration of the fade (seconds) ");
        $pause->setMaxLength(4);
        $fade->setMaxLength(4);
        $fields->addFieldToTab("Root.PhotoShuffler",new FieldGroup($pause,$fade));

        $uploadField = new UploadField($name = 'ShufflerImages',
            $title = 'PhotoShuffler Images (similar aspect ratios work best)');
        $uploadField->setFolderName('Uploads/PhotoShuffler');
        $fields->addFieldToTab("Root.PhotoShuffler",$uploadField);

        return $fields;
    }
    public static function photoShuffler_shortcode($arguments, $content, $parser, $shortcode) {
        $page = Controller::curr();
        if($page->ShufflerImages()->Count() && $page->ShufflerWidth != 0) {
            $replacement = array();
            foreach ($page->ShufflerImages() as $image) {
                $resized = $image->PaddedImage($page->ShufflerWidth,$page->ShufflerHeight);
                array_push($replacement, $resized->Filename);
            }
            Requirements::javascript("mysite/javascript/photoshuffler.js");
            Requirements::javascriptTemplate("mysite/javascript/photoshufflertemplate.js",
                array( "imagearray"      => json_encode($replacement),
                "gblPauseSeconds" => $page->PauseSeconds,
                "gblFadeSeconds"  => $page->FadeSeconds));
            return '<div style="width: '.$page->ShufflerWidth.'px;" id="screenshot-slide"><img id="screenshot-slide-image" class="right" src="'.$replacement[array_rand($replacement)].'" width="'.$page->ShufflerWidth.'" height="'.$page->ShufflerHeight.'"/></div>';
        } else {
            return '';
        }
    }
}
