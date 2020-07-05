<?php
class membersClass extends cmsFormsClass {
    public function beforeItemShow(&$item) {
        if (is_string($item['images'])) $item['images'] = json_decode($item['images'],true);
        $image = "";
        $item['show'] = [
            "image"=> $image
        ];
        if (isset($item['images'][0])) $image = '/uploads/members/'.$item['id'].'/'.$item['images'][0]['img'];
        if (is_file($_ENV['path_app'].$image)) {
            $item['show']['image'] = $image;
        }
        $item['show']['bdate'] = date('d.m.Y',strtotime($item['bdate']));
        if (!isset($item['_form'])) {$item['_form'] = 'members';}
    }

}
?>
