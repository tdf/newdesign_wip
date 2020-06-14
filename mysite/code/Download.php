<?php
/**
 */
class Download extends Page {
	  private static $db = array(
                'Customsidebar' => 'HTMLText',
		'Codeline' => 'Varchar(3)',
                'Subtitle' => 'HTMLText',
                'MainInstallerText' => 'HTMLText',
                'MainInstallerLink' => 'HTMLText',
                'MainInstallerButton' => 'HTMLText',
                'MainInstallerNotes' => 'HTMLText',
                'TranslatedText' => 'HTMLText',
                'TranslatedLink' => 'HTMLText',
                'TranslatedButton' => 'HTMLText',
                'TranslatedNotes' => 'HTMLText',
                'BIHText' => 'HTMLText',
                'BIHLink' => 'HTMLText',
                'BIHButton' => 'HTMLText',
                'BIHNotes' => 'HTMLText',
                
        );
	
function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->addFieldToTab('Root.Main', new TextField('Subtitle', "Subtitle"), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('Codeline', "codeline to offer on this page (major.minor)"), 'Content');
        $fields->addFieldToTab('Root.Main', new HTMLEditorField('Customsidebar', "Custom Sidebar"));
        $editorbox1 = new HTMLEditorField('MainInstallerText', "Main Installer Text");
        $editorbox1->setRows(5);
        $fields->addFieldToTab('Root.Main', $editorbox1, 'Content');
        $editorbox2 = new HTMLEditorField('TranslatedText', "Translated Language Text");
        $editorbox2->setRows(5);
        $fields->addFieldToTab('Root.Main', $editorbox2, 'Content');
        $editorbox3 = new HTMLEditorField('BIHText', "Built in help Text");
        $editorbox3->setRows(5);
        $fields->addFieldToTab('Root.Main', $editorbox3, 'Content');
        // repurposed links for the sidebar - ugly duckling....
        //$fields->addFieldToTab('Root.Main', new TextField('MainInstallerLink', "System requirement link (without domain)"), 'Content');
        //$fields->addFieldToTab('Root.Main', new TextField('MainInstallerButton', "System requirements button label"), 'Content');
        //$fields->addFieldToTab('Root.Main', new TextField('TranslatedLink', "Join the project link (without domain)"), 'Content');
        //$fields->addFieldToTab('Root.Main', new TextField('TranslatedButton', "Join the project button label"), 'Content');
        //$fields->addFieldToTab('Root.Main', new TextField('BIHLink', "Do more with libreoffice link (without domain)"), 'Content');
        //$fields->addFieldToTab('Root.Main', new TextField('BIHButton', "Do more with libreoffice button label"), 'Content');
        //$fields->addFieldToTab('Root.Main', new TextField('MainInstallerNotes', "Good looking documents link (without domain)"), 'Content');
        $editorbox4 = new HTMLEditorField('TranslatedNotes', "Sidebar buttons, see https://redmine.documentfoundation.org/issues/1023");
        $editorbox4->setRows(5);
        $fields->addFieldToTab('Root.Main', $editorbox4, 'Content');
        //$fields->addFieldToTab('Root.Main', new TextField('BIHNotes', "Built in help Notes"), 'Content');
       
		return $fields;
	}
}

class Download_Controller extends Page_Controller {
	// the OS/Type detection
	public function init() {
		parent::init();
		// respect URL-query parameters
		$this->Type = (isset($_GET["type"]) && array_key_exists($_GET["type"], DownloadObject::$typenames) ? $_GET["type"] : null);
		$this->Lang = (isset($_GET["lang"]) && preg_match('/^(multi|pick|[a-z]{2,3}(-[A-Za-z]{2,8})?)$/', $_GET["lang"]) ? $_GET["lang"] : null);
		$this->Version = (isset($_GET["version"]) && preg_match('/^\d+(\.\d+){2,3}$/', $_GET["version"]) ? $_GET["version"] : $this->Codeline);
		// sampe user agents:
                //
                // opensuse: Mozilla/5.0 (X11; Linux x86_64; rv:12.0) Gecko/20100101 Firefox/12.0
                // fedora:   Mozilla/5.0 (X11; Linux x86_64; rv:13.0) Gecko/20100101 Firefox/13.0
                // ubuntu:   Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:13.0) Gecko/20100101 Firefox/13.0
                // Mozilla/5.0 (iPad; U; CPU OS 3_2 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Version/4.0.4 Mobile/7B334b Safari/531.21.102011-10-16 20:23:10
                // Mozilla/5.0 (Windows NT 6.1; WOW64; rv:7.0.1) Gecko/20100101 Firefox/7.0.12011-10-16 20:23:00
                // Mozilla/5.0 (Linux; U; Android 2.3.3; en-au; GT-I9100 Build/GINGERBREAD) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.12011-10-16 20:22:55
                // Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; InfoPath.2; .NET CLR 2.0.50727; .NET CLR 3.0.04506.648; .NET CLR 3.5.21022; .NET CLR 1.1.4322)2011-10-16 20:22:33
                // Mozilla/5.0 (Windows NT 6.1; rv:5.0) Gecko/20100101 Firefox/5.02011-10-16 20:21:42
                // Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_2) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/14.0.835.202 Safari/535.12011-10-16 20:21:13
                // Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0)2011-10-16 20:21:07
                // Mozilla/5.0 (Windows NT 6.1; WOW64; rv:7.0.1) Gecko/20100101 Firefox/7.0.12011-10-16 20:21:05
                // Mozilla/5.0 (X11; Linux i686) AppleWebKit/534.34 (KHTML, like Gecko) rekonq Safari/534.342011-10-16 20:21:01
                // Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; GTB6; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; OfficeLiveConnector.1.4; OfficeLivePatch.1.3)2011-10-16 20:20:48
                // IE 7 ? Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30)2011-10-16 20:20:09
                // Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.23) Gecko/20110920 Firefox/3.6.23 SearchToolbar/1.22011-10-16 20:20:07

                // Detect platform and language
                $fua = strtolower($_SERVER["HTTP_USER_AGENT"]);
                $al = $_SERVER["HTTP_ACCEPT_LANGUAGE"];
                $ua = strpos($fua, ")") ? substr($fua, 0, strpos($fua, ")")) : $fua;
                $ua = strpos($ua, "(") ? substr($ua, strpos($ua, "(") + 1) : $fua;

                // default to win
                $platform = 'win';
                $arch = 'x86';
                if (strpos($ua, "macintosh") !== FALSE || strpos($ua, "mac os") !== FALSE) {
                    $platform = 'mac';
                    if (strpos($ua, "intel") === FALSE) {
                        $arch = 'ppc';
                    } else {
                        // 10.8 and 10.9 can get the 64bit build
                        $arch = preg_match('/mac os x 10.[189]/',$ua) ? 'x86_64' : 'x86';
                    }
                } elseif (strpos($ua, "linux") !== FALSE) {
                    $platform = strpos($fua, "buntu") !== FALSE || strpos($fua, "debian") !== FALSE || strpos($fua, "mint") !== FALSE || strpos($fua, "iceweasel") !== FALSE ? "deb" : "rpm";
                    $arch = strpos($ua, "x86_64") || strpos($ua, "amd64") ? "x86_64" : "x86";
                } else {
                    $arch = strpos($ua, "wow64")  || strpos($ua, "win64") ? "x86_64" : "x86";
                }
                $type = "$platform-$arch";

                // Find langauge candidates
                $langCandidates = array();
                if ($this->Lang) array_push($langCandidates, $this->Lang);
                if (i18n::get_locale() != "en_US") array_push($langCandidates, i18n::get_locale());
                foreach (explode(",", $al) as $value) {
                        $parts = explode(";", $value);
                        array_push($langCandidates, $parts[0]);
                }
                foreach (explode(";", $ua) as $value) {
                        array_push($langCandidates, $value);
                }
                array_push($langCandidates, i18n::get_locale());

                $lang = "";
                if ($type && !$this->Type) {
                        $this->Type = $type;
                }
                //if($this->Type == "mac-x86_64" && strpos($this->Version, "4.1") !== FALSE ) {
                //    $this->Type = "mac-x86";
                //}
                // Check langauge candidates
						//'Version:StartsWith' => $this->Version))->column("Lang");
                $this->AvailableLangs = DownloadObject::get()->filter(array(
						'ClassName'          => array('LangPack', 'HelpPack')))->column("Lang");
                foreach ($langCandidates as $value) {
			$parts = explode("-", str_replace("_", "-", trim($value)));
			if (count($parts) > 1) {
				if (in_array($parts[0]."-".strtoupper($parts[1]), $this->AvailableLangs)) {
					$lang = $parts[0]."-".strtoupper($parts[1]); break;
				} elseif (in_array($parts[0]."-".$parts[1], $this->AvailableLangs)) {
                                        $lang = $parts[0]."-".$parts[1]; break;
				}
			}
			// only one part or no match with two
			if (in_array($parts[0],$this->AvailableLangs)) {
				$lang = $parts[0];
				break;
			}
		}
                if (!isset($_GET["lang"]) || $_GET["lang"] != "pick") $this->Lang = $lang;

                $this->DebugInfo = htmlentities("User-Agent:$fua\nAccept-language:$al\ntype:$type\nLangCand:".implode("|",$langCandidates)."\nlang:$lang\ntype $this->Type - lang $this->Lang - version $this->Version");

		$splittype = explode('-', $this->Type);
		$this->Download = $this->getMainDownloads($this->Version, $this->Type)->First();
		if(is_null($this->Download)) {
			$this->Download = $this->getMainDownloads($this->VersionFresh()->Version, $this->Type)->First();
			$this->Version = $this->VersionFresh()->Version;
		}
		$this->DisplayVersion = $this->Download->Version;
		if ("LibreOfficeDev" === substr($this->Download->Filename, 0, 14)) {
			$this->DisplayVersion = "{$this->Download->Version} {$this->Download->parseRCVersion()}";
		}

		// both FreshText as well as StillText inside <span class="dl_description_text">...</span>
		// $this->FreshText = 'The latest "fresh" version of LibreOffice, recommended for technology enthusiasts.';
		// $this->StillText = 'The mature "still" version of LibreOffice, recommended for enterprises.';
		$this->FreshText = _t("DownloadRefresh.FreshText", "If you're a technology enthusiast, early adopter or power user, this version is for you!");
		$this->StillText = _t("DownloadRefresh.StillText", 'This version is slightly older and does not have the latest features, but it has been tested for longer. For business deployments, we <a href="https://www.libreoffice.org/download/libreoffice-in-business/">strongly recommend support from certified partners</a> which also offer long-term support versions of LibreOffice.');
	}
	public function getMainDownloads($version, $platform) {
		$splittype = explode('-', $platform);
		return MainDownload::get()->filter(array(
				'Version:StartsWith' => $version,
				'Type' => array('stable','testing'),
				'Platform' => $splittype[0],
				'Arch' => $splittype[1]))->sort(array('Type' => 'ASC','Version' => 'DESC'));
	}
	public function PlatformsList($version = null) {
		if (is_null($version)) {
			$version = $this->Version;
		}
		$types = new ArrayList();
		foreach (MainDownload::get()->filter('Version:StartsWith',$version) as $installer) {
			$types->push(new ArrayData(array("Type" => $installer->Platform."-".$installer->Arch,
				"NicePlatform"=> $installer->NicePlatform(),
				"NicePlatformShort"=> $installer->NicePlatformShort()
			)));
		}
		$types->removeDuplicates('NicePlatform');
		return $types->sort("NicePlatform");
	}
	public function VersionsList($type='stable') {
		$versions = new ArrayList();
		foreach (MainDownload::get()->filter('Type',$type)->sort('Version', 'DESC')->column('Version') as $version) {
            if ($type != 'stable' || $version != "5.2.1hideme") {
                $versions->push(new ArrayData(array("Version" => $version)));
            }
		}
		return $versions;
	}
	public function VersionFresh() {
		return $this->VersionsList()->first();
	}
	public function VersionStill() {
		# ArrayList only has simple excludes/cannot use "startswith" modifier, so assemble maj.min. and add 0-9
		# via the preg_filter and filter those out...
		if ($this->VersionFresh()) {
			return $this->VersionsList()->exclude('Version',preg_filter('/^/', substr($this->VersionFresh()->getField('Version'), 0, 4), array(0,1,2,3,4,5,6,7,8,9)))->first();
		} else {
			return null;
		}
	}
	public function LanguagePicklist($chunks = 3) {
		$arraylist = new ArrayList();
		foreach ($this->AvailableLangs as $language) {
			$arraylist->push(new ArrayData(array(
				'Lang'       => $language,
				'Name'       => i18n::get_language_name($language, false),
				'NativeName' => i18n::get_language_name($language, true))));
		}
		$per_chunk = (int) ceil($arraylist->Count() / $chunks);
		$returnlist = new ArrayList();
		for ($i = 0; $i < $chunks; $i++) {
			$returnlist->push(new ArrayData(array(
				'Chunk' => $arraylist->sort('Name')->limit($per_chunk, $i*$per_chunk))));
		}

		return $returnlist;
	}
    public function fullLink() {
            return $this->Link()."?version=".$this->Version."&lang=".$this->Lang;
    }
    /* site-IDs that should use the newstyle downloadpage */
    public function useNewStyle() {
        // 5089 → en/mainsite 5298 → fr 5299 → de, 5300 → pt-BR, 5301 → ro, 5302 → es, 5095 → it
        return in_array($this->ID, array(5089, 5298, 5299, 5300, 5301, 5302, 5095)) || $this->Codeline == "999";
    }
}
