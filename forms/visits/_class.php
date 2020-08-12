<?php
require(__DIR__."/../tickets/_class.php");

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
        if ($app->vars('_post.formdata.month') == "") {$app->vars('_post.formdata.month',date('Y-m'));}
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

    public function check() {
      header('Content-Type: charset=utf-8');
      header('Content-Type: application/json');
      $result = ['visit'=>false,'tickets'=>0,'lastdate'=>'','fromdate'=>''];
      $member = $this->app->vars('_post.member');
      $date = $this->app->vars('_post.date');
      $visits = $this->app->itemRead('visits', $date);
      if ($visits) {
          $members = array_column((array)$visits['members'], 'member');
          if (in_array($member, $members)) {
            $index = array_search($member, $members);
            $result['visit'] = $visits['members'][$index];
            if (isset($result['visit']['ticket']) && $result['visit']['ticket'] > '') {
                $result['visit']['ticket'] = $this->app->itemRead('tickets',$result['visit']['ticket']);
            }
          }
      }
      $ti = new ticketsClass($this->app);
      $free = $ti->freeTickets($date,$member);
      foreach($free as $t) {
          if ($result['fromdate'] == '' OR $result['fromdate'] > $t['start']) $result['fromdate'] = $t['start'];
          if ($result['lastdate'] == '' OR $result['lastdate'] < $t['stop']) $result['lastdate'] = $t['stop'];
      }
      $result['fromdate'] = date('d.m.Y',strtotime($result['fromdate']));
      $result['lastdate'] = date('d.m.Y',strtotime($result['lastdate']));
      $result['tickets'] = count($free);
      $credits = $ti->creditTickets($date,$member);
      $result['credits'] = count($credits);
      $result['credits_data'] = $credits;
      echo json_encode($result);
    }

    public function success()
    {
        header('Content-Type: charset=utf-8');
        header('Content-Type: application/json');
        $member = $this->app->vars('_post.formdata.member');
        $date = $this->app->vars('_post.formdata.date');

        $ti = new ticketsClass($this->app);
        $ticket = $ti->getTicket($date,$member);

        $visits = $this->app->itemRead('visits', $date);
        if (!$visits) {
            $visits = ['id'=>$date,'members'=>[],'month'=>date('Y-m')];
        }
        $visits['members'] = (array)$visits['members'];
        $members = array_column((array)$visits['members'], 'member');
        if ($member > "" && !in_array($member, $members)) {

          if (!$ticket) {
              echo json_encode(["error"=>true,"ticket"=>false]);
              die;
          } else {
              $ticket['used'] = $date;
              $this->app->itemSave('tickets',$ticket,true);
          }

          if ($date > '') {
              $visits['members'][] = ['member'=>$member,'ticket'=>$ticket['id']];
              $res = $this->app->itemSave('visits', $visits);
              if ($res) {
                  echo json_encode(['error'=>false,'result'=>$res]);
                  die;
              }
          }
        }
        echo json_encode(['error'=>true]);
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
            $visit = $visits['members'][$index];
            if (isset($visit['ticket']) AND $visit['ticket'] > '') {
                $ticket = $this->app->itemRead('tickets',$visit['ticket']);
                if ($ticket) {
                    $ticket['used'] = false;
                    $this->app->itemSave('tickets', $ticket);
                }
            }
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
