<?php

class Page_Controller extends ContentController
{
    /**
     * An array of actions that can be accessed via a request. Each array element should be an action name, and the
     * permissions or conditions required to allow the user to access it.
     *
     * <code>
     * array (
     *     'action', // anyone can access this action
     *     'action' => true, // same as above
     *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
     *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
     * );
     * </code>
     *
     * @var array
     */
    private static $allowed_actions = array(
    );

    public function mainLanguages() {

        $result = "";
        $shown = array();
        $user_locale = explode(",", $_SERVER['HTTP_ACCEPT_LANGUAGE'])[0];
        $preferredLanguage = ucwords(i18n::get_language_name($user_locale, true));
        
        if (strlen($user_locale) == 2) {
            $user_locale .= "_" . strtoupper($user_locale);
        }
        
        $Languages = array(
            array(
                "URL" => "//www.libreoffice.org",
                "NativeName" => "English"
            ),
            array(
                "URL" => "//zh-cn.libreoffice.org",
                "NativeName" => "&#20013;&#25991; (&#31616;&#20307;)"
            ),
            array(
                "URL" => "//de.libreoffice.org",
                "NativeName" => "Deutsch"
            ),
            array(
                "URL" => "//es.libreoffice.org",
                "NativeName" => "Espa&#241;ol"
            ),
            array(
                "URL" => "//fr.libreoffice.org",
                "NativeName" => "Fran&#231;ais"
            ),
            array(
                "URL" => "//it.libreoffice.org",
                "NativeName" => "Italiano"
            )
        );
        
        $local_subsite = Subsite::get()->filter('Language', $user_locale)->first();
        
        if ($local_subsite) {
            $domain = DataObject::get("SubsiteDomain", "ID = '".$local_subsite->ID."'")->first()->Domain;
            $Languages[0] = array(
                "URL" => "//" . $domain,
                "NativeName" => $preferredLanguage
            );
        }
        
        foreach ($Languages as $language) {
            if (!in_array($language["URL"], $shown)) {
                $result .= " <a href='" . $language["URL"] . "'>" . $language["NativeName"] . "</a> |";
                $shown[] = $language["URL"];
            }
        }
        
        return $result;

    }

    public function init()
    {
        parent::init();
        // You can include any CSS or JS required by your project here.
        // See: http://doc.silverstripe.org/framework/en/reference/requirements
    }
}
