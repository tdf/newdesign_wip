<?php
class MysiteShortcodes {
	public static function bitpay_shortcode($arguments, $disclaimer, $parser, $shortcode) {
        return Controller::curr()->renderWith("BitPay");
	}
    /* Bad example for a shortcode, as it doesn't check for supported ClassName */
    public static function donateform_shortcode($arguments, $disclaimer, $parser, $shortcode) {
        return Controller::curr()->DonationProceed()->forTemplate();
    }
    public static function devDL_shortcode($arguments, $content, $parser, $shortcode) {
        if (isset($arguments['ver'])) {
            $rc = MainDownload::get()->filter(array("Platform" => "win", "Version:StartsWith" => $arguments['ver'],
                "Type" => 'testing'))->sort("Version", "DESC")->first();
        } else {
            $rc = MainDownload::get()->filter(array("Platform" => "win", "Type" => 'testing'))->sort("Version", "DESC")->first();
        }
        if ($rc == null) {
            if (isset($arguments['ver'])) {
                return _t('Shortcode.NoRC_Codeline', 'No RC is currently available for the {version} codeline', 'no rc available for selected codeline message', array('version' => $arguments['ver']));
            } else {
                return _t('Shortcode.NoRC', 'No RC is currently available', 'no rc available, no version preference given');
            }
        }
        $rclabel = $rc->parseRCVersion();
        return '<a href="'.Download::get()->first()->Link().'?version='.$rc->Version.'">LibreOffice '.$rc->Version.' '.$rclabel.'</a> (<a href="https://wiki.documentfoundation.org/Releases/'.$rc->Version.'/'.$rclabel.'">'._t('Shortcode.ReleaseNotesLinkText', 'Release Notes').'</a>)';
    }
    public static function portableDL_shortcode($arguments, $content, $parser, $shortcode) {
        $type = "All";
        if (isset($arguments['type'])) {
            $type = $arguments['type'];
        }
        if (isset($arguments['ver'])) {
            $rc = Portable_Dl::get()->filter(array("Version:StartsWith" => $arguments['ver'], 'Filename:PartialMatch' => $type))->sort(array("Version" => "DESC", "Filename" => "DESC"))->first();
        } else {
            $rc = Portable_Dl::get()->filter('Filename:PartialMatch', $type)->sort("Version", "DESC")->first();
        }
        if ($rc == null) {
            if (isset($arguments['ver'])) {
                return _t('Shortcode.NoPortable', 'No Portable Version ({multilingualtype}) is currently available for the {version} codeline', 'no portable available for selected codeline', array('multilingualtype' => "Multilingual$type", 'version' => $arguments['ver']));
            } else {
                return _t('Shortcode.NoPortable', 'No Portable Version ({multilingualtype}) is currently available', 'no portable available, no version preference given', array('multilingualtype' => "Multilingual$type"));
            }
        }
        return '<a href="http://download.documentfoundation.org/'.$rc->Fullpath.'">LibreOffice '.$rc->Version.' Portable Multilingual'.$type.'</a>';
    }
}
