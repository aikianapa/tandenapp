<?php
class visitsClass extends cmsFormsClass
{
    public function beforeItemShow(&$item)
    {
        $item['show'] = [
            "count"=> 0
        ];
        if (isset($item['members'])) {
            $item['show']['count'] = count($item['members']);
        }
        $item['show']['date'] = date('d.m.Y', strtotime($item['id']));
        if (!isset($item['_form'])) {
            $item['_form'] = 'visits';
        }
    }

    public function rep_month()
    {
        $app=$this->app;
        $form = $app->fromFile(__DIR__."/rep_month.php");
        $list = [];
        $line = [];
        $rep = [];
        //echo $app->vars('_post.formdata.month');
        if ($app->vars('_post.formdata.month')>"") {
            $mon = explode("-", $app->vars('_post.formdata.month'));
            $days = cal_days_in_month(CAL_GREGORIAN, $mon[1], $mon[0]);
            $list = $app->itemList("visits", [
                'filter' => ['month' => $app->vars('_post.formdata.month') ]
            ]);
            $list = $list["list"];
            for ($i=1;$i<=$days;$i++) {
                $line[$i] = "";
            }
            $rep = [];
            foreach ($list as $item) {
                $d = explode('-', $item['id'])[2]*1;
                foreach ((array)$item['members'] as $m) {
                    if (is_array($m) && !isset($rep[$m['member']])) {
                        $name=$app->correlation('members', $m['member'], 'name');
                        $rep[$m['member']] = ['id'=>$m['member'],'name'=>$name,'days'=>$line];
                    }
                    if (isset($m['member'])) {
                        $rep[$m['member']]['days'][$d] = "on";
                    }
                }
            }
        }
        $form->fetch(['rep'=>$rep,'days'=>$line]);
        echo $form->outer();
        die;
    }



    public function success()
    {
        header('Content-Type: charset=utf-8');
        header('Content-Type: application/json');
        $member = $this->app->vars('_post.formdata.member');
        $date = $this->app->vars('_post.formdata.date');
        $visits = $this->app->itemRead('visits', $date);
        if (!$visits) {
            $visits = ['id'=>$date,'members'=>[],'month'=>date('Y-m')];
        }
        $visits['members'] = (array)$visits['members'];
        $members = array_column((array)$visits['members'], 'member');
        if ($member > "" && $date > "" and !in_array($member, $members)) {
            $visits['members'][] = ["member"=>$member];
            $res = $this->app->itemSave('visits', $visits);
            if ($res) {
                echo json_encode(["error"=>false,"result"=>$res]);
                die;
            }
        }
        echo json_encode(["error"=>true]);
        die;
    }

    public function decline()
    {
        header('Content-Type: charset=utf-8');
        header('Content-Type: application/json');
        $member = $this->app->vars('_post.formdata.member');
        $date = $this->app->vars('_post.formdata.date');
        $visits = $this->app->itemRead('visits', $date);
        if (!$visits) {
            $visits = ['id_'=>$date,'members'=>[]];
        }
        $visits['members'] = (array)$visits['members'];
        $members = array_column((array)$visits['members'], 'member');
        if ($member > "" && $date > "" and in_array($member, $members)) {
            $index = array_search($member, $members);
            array_splice($visits['members'], $index, 1);
            $res = $this->app->itemSave('visits', $visits);
            if ($res) {
                echo json_encode(["error"=>false,"result"=>$res]);
                die;
            }
        }
        echo json_encode(["error"=>true]);
        die;
    }
}
