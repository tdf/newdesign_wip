<?php
/**
 * Task to update the List of available availabe Portable versions
 */
class UpdateDownloadsPortable extends CliController {
	function process() {
		self::parseDownloads();
	}
	private static function parseDownloads() {
		exec("rsync -r --exclude \*.asc rsync://rsync.documentfoundation.org/tdf-pub/ > ".TEMP_FOLDER."/rsynclist.lst");
		$array = file(TEMP_FOLDER."/rsynclist.lst",FILE_IGNORE_NEW_LINES);
		if (!$array) { Debug::message("Failed to read rsynclist!"); return False; }
		$old_portables = Portable_Dl::get();
		$newid = null;
		print " there are ".$old_portables->count()." portable versions in the database";

		foreach ($array as $line) {
			if ($line[0]=="d") continue; // ignore directories
			//-rw-r--r--    12063639 2010/11/11 13:31:05 libreoffice/src/libreoffice-build-3.2.99.3.tar.gz
			$columns = preg_split("/ +/", $line);
			$size = intval(str_replace(',', '', $columns[1]));
			$path = $columns[4];
			if ($path=="TIMESTAMP" || substr($path,-4)==".log") continue;

			$pathcomponents = explode("/", $path);
			$type = count($pathcomponents) > 1 ? $pathcomponents[1] : "";
			// skip everything tht's not related to the portable versions
			if ($type != "portable") continue;

			$version = count($pathcomponents) > 2 ? $pathcomponents[2] : "";
			$filename = $pathcomponents[count($pathcomponents) - 1];

			//-rw-r--r--   123947264 2011/01/27 11:14:23 libreoffice/portable/3.3.0/LibreOfficePortable_3.3.0.paf.exe
			$portableid = Portable_Dl::create(array(
				'Type'     => 'portable',
				'Platform' => "win",
				'Arch'     => "x86",
				'Version'  => $version,
				'Size'     => $size,
				'Fullpath' => $path,
				'Filename' => $filename))->write();
			if($newid === null) $newid = $portableid;
			print "\nadded $filename with id $portableid";
		}

		print "\nremoving entries...\n";
		// if you wouldn't filter here, lazy loading would remove all including the newly added entries
		$old_portables->filter("ID:LessThan", $newid)->removeAll();

		$objects_left = Portable_Dl::get()->count();
		
		print "\nthere are $objects_left portable downloads remaining\n";
		Aggregate::flushCache('DownloadObject');
		print "\nFinished :-)\n";
	}
}
