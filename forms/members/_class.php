<?php
class membersClass extends cmsFormsClass {
    public function beforeItemShow(&$item) {
        !isset($item['images']) ? $item['images'] = [] : null;
        !isset($item['bdate']) ? $item['bdate'] = '' : null;
        !isset($item['_form']) ? $item['_form'] = 'members' : null;

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
        
        $aaac = '';
        is_array($item['apay']) ? null : $item['apay'] = [];
        foreach($item['apay'] as $apay) {
            if (isset($apay['apay_date']) AND date('Y', strtotime($apay['apay_date'])) == date('Y')-1) {
                $aaac = 'on';
                break;
            }
        }
        $item['aaac'] = $aaac;
    }

}
?>
