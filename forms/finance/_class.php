<?php
class financeClass extends cmsFormsClass {
    public function beforeItemShow(&$item) {
        $item['show'] = [];
        if (isset($item['member']) AND $item['member']> "") $item['show']['member'] = wbCorrelation("members",$item['member'],"name");

    }

}
?>
