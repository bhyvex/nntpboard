<?php

require_once(dirname(__FILE__)."/config.inc.php");

/**
 * Fuehre hier den Cache-Tausch durch
 *  - Nachrichten in den Cache herunterladen
 **/
foreach ($config->getBoardIDs() as $boardid) {
	$cache = $config->getBoard($boardid)->getConnection(NULL);
	
	// Nur bei CacheConnections macht das wirklich Sinn ...
	if (!($cache instanceof AbstractCacheConnection)) {
		continue;
	}

	try {
		$cache->open();

		// Versuche neue Nachrichten zu ergattern
		$cache->loadMessages();
		
		$cache->close();
	} catch (Exception $e) {
// TODO debug...
var_dump($e);
		echo "<pre>".$e->getMessage()."</pre>";
	}
}

?>
