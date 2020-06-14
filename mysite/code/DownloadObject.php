<?php
/**
 * for Downloads - as available via rsync
 */
class DownloadObject extends DataObject {
/* <perms> <Size> <timestamp> libreoffice/<Type:box,portable>/<Version>/<Filename> */
/* <perms> <Size> <timestamp> libreoffice/<Type:src>/<Filename> */
/* <perms> <Size> <timestamp> libreoffice/<Type:stable,testing>/<Version>/<Filename> */
	static $db = array(
		'Type' => 'Varchar(20)', /* box, portable, src, stable, testing */
		'Platform' => 'Varchar(10)', /* deb, rpm, win, mac, multi (box) */
		'Arch' => 'Varchar(10)', /* x86, x86_64, ppc, multi (box) */
		'Version' => 'Varchar(20)', /* 3.3.0, 3.3.1-rc2, 3.3.0.4 (Sources),...*/
		'Size' => 'DBFileSize',  /* varchartype not int because of dvd-isos, larger than int-type */
		'Fullpath' => 'Varchar(256)', /* redundant, but as the scheme differs between type... */
		'Filename' => 'Varchar(100)', /* redundant, but as the scheme differs between type... */
		'InstallType' => 'Varchar(20)', /* Full, Helppack, Languagepack, SDK */
		'Lang' => 'Varchar(20)', /* multi/all_lang (win), en-US,...pt-BR,... */
		);

	// used by Download page type
	public static $typenames = array (
		"win-x86"      => "Windows",
		"win-x86_64"   => "Windows x86_64 (Windows 7 or newer required)",
		"mac-x86"      => "Mac OS X (Intel)",
		"mac-x86_64"   => "Mac OS X x86_64 (10.10 or newer required)",
		"mac-ppc"      => "Mac OS X (PPC)",
		"deb-x86"      => "Linux - deb (x86)",
		"deb-x86_64"   => "Linux - deb (x86_64)",
		"rpm-x86"      => "Linux - rpm (x86)",
		"rpm-x86_64"   => "Linux - rpm (x86_64)",
		"box"          => "CD/DVD-images",
		"src"          => "Source code"
	);
	

	public function NicePlatform() {
        switch($this->Platform."/".$this->Arch) {
            case "win/x86"    : return "Windows"; break;
            case "win/x86_64" : return "Windows x86_64 ("._t('Download.Win64reqs', 'Windows 7 or newer required').")"; break;
            case "deb/x86"    : return "Linux x86 (deb)";  break;
            case "deb/x86_64" : return "Linux x64 (deb)";  break;
            case "rpm/x86"    : return "Linux x86 (rpm)";  break;
            case "rpm/x86_64" : return "Linux x64 (rpm)";  break;
            case "mac/ppc"    : return "Mac OS X (PPC)";   break;
            case "mac/x86"    : return "Mac OS X (Intel)"; break;
            case "mac/x86_64" : return "macOS x86_64 ("._t('Download.Mac64reqs', '10.10 or newer required').")"; break;
        }

	}
    public function NicePlatformShort() {
        switch($this->Platform."/".$this->Arch) {
            case "win/x86"    : return "Windows (32-bit)"; break;
            case "win/x86_64" : return "Windows (64-bit)"; break;
            case "deb/x86"    : return "Linux (32-bit) (deb)";  break;
            case "deb/x86_64" : return "Linux (64-bit) (deb)";  break;
            case "rpm/x86"    : return "Linux (32-bit) (rpm)";  break;
            case "rpm/x86_64" : return "Linux (64-bit) (rpm)";  break;
            case "mac/ppc"    : return "Mac OS X (PPC)";   break;
            case "mac/x86"    : return "macOS (32-bit)"; break;
            case "mac/x86_64" : return "macOS (64-bit)"; break;
        }
    }
	public function NiceLang() {
		return i18n::get_language_name($this->Lang, true);
	}
//	public function Helppacks() {
//		//$cache = SS_Cache::factory("Download");
//		//if (!($return = unserialize($cache->load(str_replace(array(".", "-"), "_", "-helppacks-$this->Type-$this->Version-$this->Platform-$this->Arch"))))) {
//		$return = DownloadObject::get()->filter(array(
//					'Type'        => $this->Type,
//					'Version'     => $this->Version,
//					'InstallType' => 'Helppack',
//					'Platform'    => $this->Platform,
//					'Arch'        => $this->Arch
//				))->sort('Lang');
//			//$cache->save(serialize($return));
//		//}
//		//return $return;
//	}
//	public function Langpacks() {
//		//$cache = SS_Cache::factory("Download");
//		//if (!($return = unserialize($cache->load(str_replace(array(".", "-"), "_", "-langpacks-$this->Type-$this->Version-$this->Platform-$this->Arch"))))) {
//		$return = DownloadObject::get()->filter(array(
//					'Type'        => $this->Type,
//					'Version'     => $this->Version,
//					'InstallType' => 'Languagepack',
//					'Platform'    => $this->Platform,
//					'Arch'        => $this->Arch
//				))->sort('Lang');
//		//	$cache->save(serialize($return));
//		//}
//		//return $return;
//	}
//	public function langForDropdown() {
//		return $this->Lang." - ".Convert::html2raw(self::NiceLang());
//	}
	/* change default of persistent-parameter to avoid invalidating the cache on each save */
	public function flushCache($persistent = False) {
		parent::flushCache($persistent);
	}
//	/* workaround for SS 2.4 limitations that can only substitute one single parameter in templates */
//	public function PlainLink() {
//		return "<a href='http://download.documentfoundation.org/$this->Fullpath'>$this->Filename</a>";
//	}
	public function Link($language = false) {
		if($language && $language != 'fi') {
			$lang = 'home';
			$localized_donates = array('de', 'fr', 'zh-CN', 'pt-BR');
			if (in_array($language, $localized_donates)) {
				$lang = $language;
			}
			if ($lang === "pt-BR") {
				$lang = 'pt';
			}
			// https://donate.libreoffice.org/home/dl/rpm-x86_64/4.1.4/de/LibreOffice_4.1.4_Linux_x86-64_rpm.tar.gz
			if (Subsite::currentSubsiteID() == 0) {
				return "https://www.libreoffice.org/donate/dl/$this->Platform-$this->Arch/$this->Version/$language/$this->Filename";
            # todo: don't hardcode this with "magic numbers" (aka subsiteIDs and page-URLs) manually
            # should be in sync with useNewDonate in DonatePage.php
            } elseif (Subsite::currentSubsiteID() == 5) {
				return "https://pt-br.libreoffice.org/donate/dl/$this->Platform-$this->Arch/$this->Version/$language/$this->Filename";
            } elseif (Subsite::currentSubsiteID() == 17) {
				return "https://fr.libreoffice.org/donate/dl/$this->Platform-$this->Arch/$this->Version/$language/$this->Filename";
            } elseif (Subsite::currentSubsiteID() == 20) {
				return "https://de.libreoffice.org/donate/dl/$this->Platform-$this->Arch/$this->Version/$language/$this->Filename";
            } elseif (Subsite::currentSubsiteID() == 10) {
				return "https://cs.libreoffice.org/donate/dl/$this->Platform-$this->Arch/$this->Version/$language/$this->Filename";
            } elseif (Subsite::currentSubsiteID() == 27) {
				return "https://ja.libreoffice.org/donate/dl/$this->Platform-$this->Arch/$this->Version/$language/$this->Filename";
            } elseif (Subsite::currentSubsiteID() == 49) {
				return "https://es.libreoffice.org/colabora/dl/$this->Platform-$this->Arch/$this->Version/$language/$this->Filename";
            } elseif (Subsite::currentSubsiteID() == 41) {
				return "https://ro.libreoffice.org/donate/dl/$this->Platform-$this->Arch/$this->Version/$language/$this->Filename";
            } elseif (Subsite::currentSubsiteID() == 26) {
				return "https://it.libreoffice.org/donazioni/dl/$this->Platform-$this->Arch/$this->Version/$language/$this->Filename";
			} else {
                return "https://www.libreoffice.org/donate/dl/$this->Platform-$this->Arch/$this->Version/$language/$this->Filename";

				#return "https://donate.libreoffice.org/$lang/dl/$this->Platform-$this->Arch/$this->Version/$language/$this->Filename";
			}
		} else {
			return "//download.documentfoundation.org/$this->Fullpath";
		}
	}
	public function Helppack($language = null) {
		if ($language) {
			return $this->Helppacks()->filter('Lang',$language)->First();
		} else {
			return false;
		}
	}
	public function Langpack($language = null) {
		if ($language) {
			return $this->Languagepacks()->filter('Lang',$language)->First();
		} else {
			return false;
		}
	}
	public function Sources() {
		return Src_Dl::get()->filter(array(
					'Version'     => $this->Version,
				))->sort('Filename');
	}
//	public function ButtonLabel($fallback = false) {
//		if ($this->InstallType == "Full") {
//			return _t("DownloadSimplePage.ss.DownloadsInstallTypeFull", "Main installer");
//		} elseif ($this->InstallType == "Languagepack" ) {
//			return _t("DownloadSimplePage.ss.DownloadsInstallTypeLanguagepack", "Translated user interface");
//		} elseif ($this->InstallType == "Helppack" ) {
//			if ($fallback) {
//				return _t("DownloadSimplePage.ss.DownloadsInstallTypeHelppackFallback", "LibreOffice built-in help (English fallback)");
//			} else {
//				return _t("DownloadSimplePage.ss.DownloadsInstallTypeHelppack", "LibreOffice built-in help");
//			}
//		} else {
//			return $this->Filename;
//		}
//	}
}

class MainDownload extends DownloadObject {
	private static $has_many = array(
    		"Languagepacks" => "LangPack",
    		"Helppacks" => "HelpPack");
	private static $belongs_to = array("SDK" => "SDK_Dl");
	private static $defaults = array('InstallType' => 'Full');

    public function parseRCVersion() {
        $split = explode("_", $this->Filename);
        $additional = substr($split[1],6);
        if (strlen($split[1]) == 7) {
            return "RC".$additional;
        } elseif (strlen($split[1]) == 13) {
            return "Beta".substr($additional,6);
        } elseif (strlen($split[1]) == 14) {
            return "Alpha".substr($additional,7);
        }
        return "unknown release-state";
    }
}

class HelpPack extends DownloadObject {
	private static $has_one = array("Maininstaller" => "MainDownload");
	private static $defaults = array('InstallType' => 'Helppack');
}
class LangPack extends DownloadObject {
	private static $has_one = array("Maininstaller" => "MainDownload");
	private static $defaults = array('InstallType' => 'Languagepack');
}
// suffix with _Dl to avoid any name clashes
class SDK_Dl extends DownloadObject {
	private static $has_one = array("Maininstaller" => "MainDownload");
	private static $defaults = array('InstallType' => 'SDK');

	public function Link($language = false) {
		//if($language) {
			// https://donate.libreoffice.org/home/dl/rpm-x86_64/4.1.4/de/LibreOffice_4.1.4_Linux_x86-64_rpm.tar.gz
		//	return "https://www.libreoffice.org/donate/dl/SDK/$this->Version/$this->ID/$this->Filename";
		//} else {
			return "//download.documentfoundation.org/$this->Fullpath";
		//}
	}
}
class Portable_Dl extends DownloadObject {
}
class Box_Dl extends DownloadObject {
}
class Src_Dl extends DownloadObject {
	public function Link($language = false) {
		//if($language) {
			// https://donate.libreoffice.org/home/dl/rpm-x86_64/4.1.4/de/LibreOffice_4.1.4_Linux_x86-64_rpm.tar.gz
		//	return "https://www.libreoffice.org/donate/dl/src/$this->Version/all/$this->Filename";
		//} else {
			return "//download.documentfoundation.org/$this->Fullpath";
		//}
	}
}
class Appstore_Dl extends DownloadObject {
}
