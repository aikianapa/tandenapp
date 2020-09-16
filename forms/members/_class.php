<?php
class membersClass extends cmsFormsClass {
    public function beforeItemShow(&$item) {
        if (is_string($item['images'])) $item['images'] = json_decode($item['images'],true);
        $image = "";
        $item['show'] = [
            "image"=> $image
        ];  
        
        if (isset($item['images'][0]) && !is_file($_ENV['path_app'].$item['images'][0]['img'])) {
            $image = '/uploads/members/'.$item['id'].'/'.$item['images'][0]['img'];
        } else if (isset($item['images'][0])) {
            $image = $item['images'][0]['img'];
        }
        $image = str_replace('//','/',$image);
        if (is_file($_ENV['path_app'].$image)) {
            $item['show']['image'] = $image;
        } else {
            $item['show']['image'] = "/forms/members/user.jpg";
        }
        $item['show']['bdate'] = date('d.m.Y',strtotime($item['bdate']));
        if (!isset($item['_form'])) {$item['_form'] = 'members';}
    }

}
?>
