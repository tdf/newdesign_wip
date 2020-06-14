<?php
/**
 * Task to update the List of available downloads
 */
class UpdateDownloadsTask extends CliController {
	function process() {
		self::parseDownloads();
	}
	private static function parseDownloads() {
		exec("rsync -r --exclude \*.asc rsync://rsync.documentfoundation.org/tdf-pub/ | sed -e 's/_testing_/testing/' > ".TEMP_FOLDER."/rsynclist.lst");
		$array = file(TEMP_FOLDER."/rsynclist.lst",FILE_IGNORE_NEW_LINES);
		if (!$array) { Debug::message("Failed to read rsynclist!"); return False; }
		print " flushing tables…";
		// too slow :-( DownloadObject::get()->removeAll();
		DB::query('TRUNCATE TABLE DownloadObject');
		DB::query('TRUNCATE TABLE SDK_Dl');
		DB::query('TRUNCATE TABLE LangPack');
		DB::query('TRUNCATE TABLE HelpPack');

		$maindl = null;
		$i=0;
		$skiplist = array();
		foreach ($array as $line) {
			if (++$i % 10 == 0) print "#";
			//-rw-r--r--    12063639 2010/11/11 13:31:05 libreoffice/src/libreoffice-build-3.2.99.3.tar.gz
			$columns = preg_split("/ +/", $line);
			$size = intval(str_replace(',', '', $columns[1]));
			$path = $columns[4];
			if ($path=="TIMESTAMP" || substr($path,-4)==".log") continue;

			$pathcomponents = explode("/", $path);
			$type = count($pathcomponents) > 1 ? $pathcomponents[1] : "";
			$version = count($pathcomponents) > 2 ? $pathcomponents[2] : "";
			if ($line[0]=="d") {
				//drwxr-x---             46 2016/08/01 20:31:50 libreoffice/stable/5.1.5
				if ($line[9]=="-" && $type !== '' && $version !== '') {
					//others might not traverse, so is a staged directory
					print "adding $type/$version is in skiplist\n";
					$skiplist[] = "$type/$version";
				}
				continue; // ignore directories
			} elseif (in_array("$type/$version", $skiplist)) {
				print "s";
				continue;
			}
			$filename = $pathcomponents[count($pathcomponents) - 1];

			if ($type == "box") {
				$maindl = null;
				//-rw-r--r--  2830882816 2011/02/10 14:17:09 libreoffice/box/3.3.0/LibO-3.3.0-1_DVD_allplatforms_de.iso
				$dbtmp = new Box_Dl(array(
					'Type'     => 'box',
					'Platform' => "multi",
					'Arch'     => "multi",
					'Version'  => $version,
					'Size'     => $size,
					'Fullpath' => $path,
					'Filename' => $filename));
				$dbtmp->write();
			} elseif ($type == "portable") {
				$maindl = null;
				//-rw-r--r--   123947264 2011/01/27 11:14:23 libreoffice/portable/3.3.0/LibreOfficePortable_3.3.0.paf.exe
				$dbtmp = new Portable_Dl(array(
					'Type'     => 'portable',
					'Platform' => "win",
					'Arch'     => "x86",
					'Version'  => $version,
					'Size'     => $size,
					'Fullpath' => $path,
					'Filename' => $filename));
				$dbtmp->write();
			} elseif ($type == "src" && (substr($filename, -8) == ".tar.bz2" || substr($filename, -7) == ".tar.gz" || substr($filename, -7) == ".tar.xz")) {
				$maindl = null;
				//-rw-r--r--    35706005 2011/01/18 18:16:37 libreoffice/src/3.3.0.4/libreoffice-libs-extern-sys-3.3.0.4.tar.bz2
				//only accept real src tarballs, no .log/.txt stuff anymore
				$dbtmp = new Src_Dl(array(
					'Type'     => 'src',
					'Platform' => "multi",
					'Arch'     => "multi",
					'Version'  => $version,
					'Size'     => $size,
					'Fullpath' => $path,
					'Filename' => $filename));
				$dbtmp->write();
			} elseif ($type == "stable" || $type == "testing" ) {
				//-rw-r--r--   223750368 2011/02/16 23:31:06 libreoffice/stable/4.0.0/win/x86/LibreOffice_4.0.0_Win_x86_sdk.msi
				//-rw-r--r--   223750368 2011/02/16 23:31:06 libreoffice/stable/4.0.0/win/x86/LibreOffice_4.0.0_Win_x86.msi
				//-rw-r--r--   223750368 2011/02/16 23:31:06 libreoffice/stable/4.0.0/deb/x86/LibreOffice_4.0.0_Linux_x86_deb.tar.gz
				//-rw-r--r--   223750368 2011/02/16 23:31:06 libreoffice/stable/4.0.0/deb/x86/LibreOffice_4.0.0_Linux_x86_deb_sdk.tar.gz
				//-rw-r--r--   223750368 2011/02/16 23:31:06 libreoffice/stable/4.0.0/deb/x86/LibreOffice_4.0.0_Linux_x86_deb_helppack_ta.tar.gz
				//-rw-r--r--   223750368 2011/02/16 23:31:06 libreoffice/stable/4.0.0/deb/x86/LibreOffice_4.0.0_Linux_x86_deb_langpack_ta.tar.gz
				$temp = explode("_", $filename);
				$temp = array_slice($temp, -1, 1); // last element of _ split
				$temp = explode(".", $temp[0]);    // first part of said last element
				$lang = $temp[0];
				if ($lang == "ns")    $lang = "nso";
				if ($lang == "be-BY") $lang = "be";
				if ($lang == "sh")    $lang = "sr-Latn";
				if ($lang == "ca-XV") $lang = "ca-valencia";
				if ($lang == "ku")    $lang = "kmr-Latn";
				$data = array(
					'Type'     => $type,
					'Platform' => $pathcomponents[3],
					'Arch'     => $pathcomponents[4],
					'Version'  => $version,
					'Size'     => $size,
					'Fullpath' => $path,
					'Filename' => $filename,
					'Lang'     => $lang);
				if(strpos($filename,"_sdk.") !== false) {
					$dl = new SDK_Dl($data);
				} elseif (strpos($filename,"_helppack_") !== false) {
					$dl = new HelpPack($data);
				} elseif (strpos($filename,"_langpack_") !== false) {
					$dl = new LangPack($data);
				} else {
					if (substr($pathcomponents[3],0,3) == "win") {
						$data['Lang'] = 'multi';
					}
					$maindl = new MainDownload($data);
					$maindl->write();
					continue;
				}
				$dl->MaininstallerID = $maindl->ID;
				$dl->write();
			} else {
				$maindl = null;
				Debug::message("Unknown install-type: ".$path);
			}
		}

		// stick in Intel AppUp version statically for the while - until someone figures out their API
		$dbtmp = new Appstore_Dl(
				array(
					'Type'     => 'appstore',
					'Platform' => "win",
					'Arch'     => "x86",
					'Lang'     => "multi",
					'Version'  => "3.5.4",
					'Size'     => "136000000",
					'InstallType' => "AppUp",
					'Fullpath' => "http://www.appup.com/app-details/libreoffice",
					'Filename' => "libreoffice"));
		$dbtmp->write();

		print "\nremoving duplicates from testing that are already in stable…\n";
		DownloadObject::get()->filter(array(
				'Type'    => 'testing',
				'Version' => MainDownload::get()->filter('Type','stable')->column('Version')
			))->removeAll();

		foreach (LangPack::get()->filter(array('Platform' => 'mac', 'Arch' => 'x86')) as $macPack) {
			$maclang64 = $macPack->duplicate(False);
			$maclang64->MaininstallerID = MainDownload::get()->filter(array('Platform' => 'mac', 'Arch' => 'x86_64', 'Version' => $macPack->Version))->first()->ID;
			$maclang64->write();
		}
		Aggregate::flushCache('DownloadObject');
		print "\nFinished :-)\n";
	}
}
