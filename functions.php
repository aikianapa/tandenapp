<?php
function modCmsBeforeShow(&$cms) {
		$cms->find('title')->after('<link rel="manifest" href="/manifest.json">');
}

function dateout($date) {
    return date('d/m/Y', strtotime($date));
}

?>
