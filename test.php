<?php
setlocale(LC_ALL, 'ru_RU.UTF-8');
require __DIR__."/engine/engine.php";
$app = new wbApp();
$item = $app->itemRead('finance', 'id5fcb85cc24f2');
echo wbUsageStat();

?>