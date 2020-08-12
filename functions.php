<?php
function modCmsBeforeShow(&$cms) {
		$cms->find('title')->after('<link rel="manifest" href="/manifest.json">');
}
?>
