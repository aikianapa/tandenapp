<?php
class membersClass extends cmsFormsClass {

    public function afterItemRead(&$item) {
        $aaac = '';
        $aaac_paydate = '';
        $aaac_amount = 0;

        isset($item['apay']) ? null : $item['apay'] = [];
        foreach((array)$item['apay'] as $apay) {
            if (isset($apay['apay_date']) AND $apay['apay_date'] > '' AND date('Y', strtotime($apay['apay_date'])) == date('Y')) {
                $aaac = 'on';
                $aaac_paydate = $apay['apay_date'];
                $aaac_amount = $apay['apay_sum'];

                      //  echo($aaac_paydate.' '.$item['name']."\n");
                break;
            }
        }
        $ldate = '';
        $level = '';
        if (isset($item['exam'])) {
        foreach((array)$item['exam'] as $exam) {
            if ($exam['ldate'] > $ldate AND $exam['level'] > '') {
                $ldate = $exam['ldate'];
                $level = $exam['level']. ' ' . $exam['kudan'];
            }
        }
        }
        $level == '' ? $ldate = '' : $ldate = date('d.m.Y',strtotime($ldate));
        $item['level'] = $level;
        $item['ldate'] = $ldate;
        $item['aaac'] = $aaac;
        $item['aaac_paydate'] = $aaac_paydate;
        $item['aaac_amount'] = $aaac_amount;
        if (isset($item['child']) && $item['child'] !== 'on') $item['child'] = 'off';
        if (isset($item['archive']) && $item['archive'] !== 'on') $item['archive'] = 'off';
        isset($item['bdate']) ? null : $item['bdate'] = '1970-01-01';
        $item['byear'] = date('Y',strtotime($item['bdate']));
        $item['age'] = date_diff(date_create($item['bdate']), date_create('now'))->y;
        if ($item['age'] < 18) $item['child'] = 'on';
    }

    public function beforeItemShow(&$item) {
        !isset($item['images']) ? $item['images'] = [] : null;
        !isset($item['bdate']) ? $item['bdate'] = '' : null;
        !isset($item['_form']) ? $item['_form'] = 'members' : null;

        if (is_string($item['images'])) $item['images'] = json_decode($item['images'],true);
        $image = "";
        $item['show'] = ["image"=> $image];  
        
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

        $item['byear'] = date('Y',strtotime($item['bdate']));
        $item['age'] = date_diff(date_create($item['bdate']), date_create('now'))->y;
        if ($item['age'] < 18) $item['child'] = 'on';

    }

}
?>
