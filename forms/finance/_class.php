<?php

use Adbar\Dot;

class financeClass extends cmsFormsClass {
    public function beforeItemShow(&$item) {
        $item['show'] = [];
        if (isset($item['member']) AND $item['member']> "") $item['show']['member'] = wbCorrelation("members",$item['member'],"name");
    }

    public function beforeItemSave(&$item) {
        $app = $this->app;
        if (isset($item['credits']) AND $item['credits'] > '' AND strtotime($item['_created'])+1000 > strtotime('now')) {
            // При первом сохранении чистим кредиты
              $tickets = $app->itemList('tickets',[
                'filter'=>[
                    'member' => $item['member'],
                    'tarif' => 'credit',
                    'closed' => NULL
                ],
                'sort' => ['used:d'],
                'limit' => $item['credits']
              ]);
            foreach($tickets['list'] as $ticket) {
                $ticket['closed'] = $item['id'];
                $app->itemSave('tickets',$ticket,false);
            }
            $app->tableFlush('tickets');
        }
    }
    
    public function afterItemSave(&$item) {
      $app = $this->app;
      $pay = new Dot($item);
      if ($pay->get('tarif')) $this->updateTickets($pay);
    }

    public function beforeItemRemove(&$item) {
      $app = $this->app;
      $tickets = $app->itemList('tickets',[
        'filter'=>[
          '$or' => [
            'payment' => $item['id'],
            'closed' => $item['id']
          ]
        ],
        '_sort' => ['used:d']
      ]);
        //print_r($tickets['list']);        die;
      foreach($tickets['list'] as $ticket) {
          if ($ticket['used'] == false OR ($ticket['tarif'] == 'credit' AND $ticket['payment'] == $item['id'] )) {
              $app->itemRemove('tickets',$ticket['id'],false);
          } else if ($ticket['closed'] > '') {
              unset($ticket['closed']);
              $app->itemSave('tickets',$ticket,false);
          } else {
              $ticket['dirty'] = true;
              $app->itemSave('tickets',$ticket,false);
          }
      }
      $app->tableFlush('tickets');
    }

    function updateTickets(&$pay) {
      $app = $this->app;
      $tickets = $app->itemList('tickets',[
        'filter'=>[
          'payment' => $pay->get('id')
        ],
        '_sort' => ['used:d']
    ]);

      $lessons = $pay->get('lessons');
      $start = $pay->get('date');
      if ($pay->get('monthes') == 0) {
          $stop = $start;
      } else {
          $stop = date('Y-m-d',strtotime($start. '+'.$pay->get('monthes').' month -1 day'));
      }
      $checked = 0;
      $remove = [];
      foreach($tickets["list"] as &$ticket) {
          $ticket['start'] = $start;
          $ticket['stop'] = $stop;
          $checked++;
          if ($checked > $lessons) {
              if ($ticket['used'] == '') {
                  $remove[] = $ticket['id'];
              } else {
                  $checked--;
              }
          }
          $app->itemSave('tickets',$ticket,false);
      }
      if (count($remove)) $app->itemRemove('tickets',$remove,false);

      if ($lessons > $checked) {
          for ($i=1; $i<=($lessons-$checked); $i++) {
              $ticket = [
                '_id' => wbNewId('','ti'),
                'payment' => $pay->get('id'),
                'tarif' => $pay->get('tarif'),
                'start' => $start,
                'stop'  => $stop,
                'member' => $pay->get('member'),
                'used'  => false
              ];
              $app->itemSave('tickets',$ticket,false);
          }
      }
      $app->tableFlush('tickets');
    }
}
?>
