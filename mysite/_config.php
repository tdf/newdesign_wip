<?php

global $project;
$project = 'mysite';

global $databaseConfig;
$databaseConfig = array(
	"type" => 'MySQLDatabase',
	"server" => 'localhost',
	"username" => 'somedbuser',
	"password" => 'secretdbpassword',
	"database" => 'dbname',
	"path" => '',
);

// Set the site locale
i18n::set_locale('en_US');

// force https for logins
if(!Director::is_cli()) Director::forceSSL(array('/^admin/', '/^Security/','/^ForumMemberProfile/'));

SS_Log::add_writer(new SS_LogFileWriter('/var/tmp/newdesign_warnings_and_errors.log'), SS_Log::WARN, '<=');
$common_languages["am"] = array('name' => 'Amharic', 'native' => '&#4768;&#4635;&#4653;&#4763;');
$common_languages["bn-IN"] = array('name' => 'Bengali (India)', 'native' => '&#2476;&#2494;&#2434;&#2482;&#2494; (&#2477;&#2494;&#2480;&#2468;)');
$common_languages["pt-BR"] = array('name' => 'Portuguese (Brazil)', 'native' => 'portugu&ecirc;s (Brasil)');

$common_languages["as"]	= array('name' => 'Assamese', 'native' => 'অসমীয়া');
$common_languages["ast"]	= array('name' => 'Asturian', 'native' => 'Asturianu');
$common_languages["be-BY"]	= array('name' => 'Belarusian', 'native' => 'беларуская');
$common_languages["be"]	= array('name' => 'Belarusian', 'native' => 'беларуская');
$common_languages["bo"]	= array('name' => 'Tibetan', 'native' => 'བོད་ཡིག');
$common_languages["br"]	= array('name' => 'Breton', 'native' => 'brezhoneg');
$common_languages["brx"]	= array('name' => 'Bodo (India)', 'native' => 'बोडो');
$common_languages["bs"]	= array('name' => 'Bosnian', 'native' => 'Bosanski');
$common_languages["ca-XV"]	= array('name' => 'Catalan (Valencia)', 'native' => 'català (valencià)');
$common_languages["ca-valencia"]	= array('name' => 'Catalan (Valencian)', 'native' => 'català (valencià)');
$common_languages["dgo"]	= array('name' => 'Dogri', 'native' => 'डोगरी');
$common_languages["dz"]	= array('name' => 'Dzongkha', 'native' => 'རྫོང་ཁ');
$common_languages["en-GB"]	= array('name' => 'English (GB)', 'native' => 'English (GB)');
$common_languages["en-US"]	= array('name' => 'English (US)', 'native' => 'English (US)');
$common_languages["en-ZA"]	= array('name' => 'English (ZA)', 'native' => 'English (ZA)');
$common_languages["hi-IN"]	= array('name' => 'Hindi', 'native' => 'हिन्दी');
$common_languages["ka"]	= array('name' => 'Georgian', 'native' => 'ქართული');
$common_languages["kk"]	= array('name' => 'Kazakh', 'native' => 'Қазақша');
$common_languages["km"]	= array('name' => 'Khmer', 'native' => 'ខ្មែរ');
$common_languages["kmr-Latn"]	= array('name' => 'Kurdish (latin script)', 'native' => 'Kurdish (latin script)'); 
$common_languages["kn"]	= array('name' => 'Kannada', 'native' => 'ಕನ್ನಡ');
$common_languages["kok"]	= array('name' => 'Konkani', 'native' => 'कोंकणी');
$common_languages["ks"]	= array('name' => 'Kashmiri', 'native' => 'ﻚﺸﻤﻳﺮﻳ');
$common_languages["ky"]	= array('name' => 'Kyrgyz', 'native' => 'Кыргыз');
$common_languages["lb"]	= array('name' => 'Luxembourgish', 'native' => 'Lëtzebuergesch');
$common_languages["lo"]	= array('name' => 'Lao', 'native' => 'ພາສາລາວ');
$common_languages["mai"]	= array('name' => 'Maithili', 'native' => 'मैथिली');
$common_languages["ml"]	= array('name' => 'Malayalam', 'native' => 'മലയാളം');
$common_languages["mn"]	= array('name' => 'Mongolian', 'native' => 'монгол');
$common_languages["mni"]	= array('name' => 'Manipuri', 'native' => 'মৈইতৈইলোন');
$common_languages["my"]	= array('name' => 'Burmese', 'native' => 'မန္မာစာ');
$common_languages["nb"]	= array('name' => 'Norwegian Bokmål', 'native' => 'Bokmål');
$common_languages["nn"]	= array('name' => 'Norwegian Nynorsk', 'native' => 'Nynorsk');
$common_languages["nr"]   = array('name' => 'Ndebele (South)', 'native' => 'Ndébélé');
$common_languages["ns"]   = array('name' => 'Northern Sotho', 'native' => 'Sesotho sa Leboa'); /* obsolete, nso preferred */
$common_languages["nso"]  = array('name' => 'Northern Sotho', 'native' => 'Sesotho sa Leboa');
$common_languages["oc"]   = array('name' => 'Occitan', 'native' => 'occitan');
$common_languages["or"]   = array('name' => 'Oriya', 'native' => 'ଓଡ଼ିଆ');
$common_languages["pa-IN"]= array('name' => 'Panjabi', 'native' => 'ਪੰਜਾਬੀ');
$common_languages["pap"]  = array('name' => 'Papiamento', 'native' => 'Papiamentu');
$common_languages["ps"]   = array('name' => 'Pushto', 'native' => 'پښﺕﻭ');
$common_languages["pt"]   = array('name' => 'Portuguese', 'native' => 'português');
$common_languages["rw"]   = array('name' => 'Kinyarwanda', 'native' => 'kinyaRwanda');
$common_languages["sa-IN"]= array('name' => 'Sanskrit', 'native' => 'संस्कृतम्');
$common_languages["sat"]  = array('name' => 'Santali', 'native' => 'संथाली');
$common_languages["sc"]   = array('name' => 'Sardinian', 'native' => 'sardu');
$common_languages["sd"]   = array('name' => 'Sindhi', 'native' => 'ﺲﻧﺩھی');
$common_languages["sh"]   = array('name' => 'Serbo-Croatian (latin script)', 'native' => 'srpski latinicom'); //obsolete
$common_languages["si"]   = array('name' => 'Sinhala', 'native' => 'සිංහල');
$common_languages["si-LK"]   = array('name' => 'Sinhala', 'native' => 'සිංහල');
$common_languages["sid"] = array('name' => 'Sidama', 'Sidama');
$common_languages["sl"]   = array('name' => 'Slovenian', 'native' => 'slovenski');
$common_languages["ss"]   = array('name' => 'Swati', 'native' => 'siSwati');
$common_languages["sr-Latn"]   = array('name' => 'Serbian (latin script)', 'native' => 'srpski latinicom');
$common_languages["st"]   = array('name' => 'Southern Sotho', 'native' => 'Sesotho');
$common_languages["sw-TZ"]= array('name' => 'Swahili ', 'native' => 'kiswahili');
$common_languages["tg"]   = array('name' => 'Tajik', 'native' => 'тоҷикӣ');
$common_languages["th"]   = array('name' => 'Thai', 'native' => 'ภาษาไทย');
$common_languages["ti"]   = array('name' => 'Tigrinya', 'native' => 'ትግርኛ');
$common_languages["tt"]   = array('name' => 'Tatar', 'native' => 'татар теле');
$common_languages["ug"]   = array('name' => 'Uighur', 'native' => 'ﺉۇﻲﻏۇﺭچە');
$common_languages["zh-CN"]= array('name' => 'Chinese (simplified)', 'native' => '中文 (简体)');
$common_languages["zh-TW"]= array('name' => 'Chinese (traditional)', 'native' => '中文 (正體)'); 
$common_languages["ga"]   = array('name' => 'Irish', 'native' => 'Gaeilge'); 
$common_languages["lt"]   = array('name' => 'Lithuanian', 'native' => 'Lietuvių kalba'); 
$common_languages["gd"]   = array('name' => 'Scottish Gaelic', 'native' => 'Gàidhlig');
$common_languages["gug"]   = array('name' => 'Guarani', 'native' => 'avañe’ẽ');

Config::inst()->update('i18n', 'common_languages', $common_languages);

ShortcodeParser::get('default')->register('bitpay', array('MysiteShortcodes', 'bitpay_shortcode'));
ShortcodeParser::get('default')->register('donateform', array('MysiteShortcodes', 'donateform_shortcode'));
ShortcodeParser::get('default')->register('devDL', array('MysiteShortcodes', 'devDL_shortcode'));
ShortcodeParser::get('default')->register('portableDL', array('MysiteShortcodes', 'portableDL_shortcode'));
ShortcodeParser::get('default')->register('photoShuffler', array('PagePhotoShuffler', 'photoShuffler_shortcode'));
