<?php

use Adbar\Dot;

class financeClass extends cmsFormsClass {
    public function beforeItemShow(&$item) {
        if (isset($item['member']) AND $item['member']> "") $item['show']['member'] = wbCorrelation("members",$item['member'],"name");
        $item['date'] =  date('d.m.Y',strtotime($item['date']));
    }

    public function afterItemRead(&$item) {
        if (!isset($item['month'])) $item['month'] = date('Y-m',strtotime($item['date']));
    }

    public function beforeItemSave(&$item) {
        $app = $this->app;
				$newitem = false;
				$checked = 0;
				$lessons = $item['lessons'];
				$start = $item['date'];
	      if ($item['monthes'] == 0) {
	          $stop = $start;
	      } else {
	          $stop = date('Y-m-d',strtotime($start. '+'.$item['monthes'].' month -1 day'));
	      }
                if (!isset($app->route->item) or $app->route->item == '_new') {
                    $newitem = $item['id'] = wbNewId('', 'fi');
                }

				if ($newitem) {
						/******* При первом сохранении чистим кредиты  ********/
						if (isset($item['credits']) AND $item['credits'] > '') {
		              $tickets = $app->itemList('tickets',[
		                'filter'=>[
		                    'member' => $item['member'],
		                    'tarif' => 'credit',
		                    'closed' => NULL
		                ],
		                'sort' => ['used:d'],
		                'limit' => $item['credits']
		              ]);
									$item['credits'] = [];
		            foreach($tickets['list'] as $ticket) {
		                $ticket['closed'] = $item['id'];
		                $ticket = $app->itemSave('tickets',$ticket,false);
										if ($ticket) $item['credits'][] = $ticket['id'];
										$checked++;
		            }
		            $app->tableFlush('tickets');
		        }
						/******* И создаём тикеты *******/
						$item['tickets'] = [];
						for ($i=1; $i<=($lessons - $checked); $i++) {
	              $ticket = [
	                '_id' => wbNewId('','ti'),
	                'payment' => $item['id'],
	                'tarif' => $item['tarif'],
	                'start' => $start,
	                'stop'  => $stop,
	                'member' => $item['member'],
	                'used'  => false
	              ];
	              $ticket = $app->itemSave('tickets',$ticket,false);
								if ($ticket) $item['tickets'][] = $ticket;
	          }
						$app->tableFlush('tickets');
				}
    }

    public function afterItemSave(&$item) {
      $app = $this->app;
      $pay = new Dot($item);
      //if ($pay->get('tarif')) $this->updateTickets($pay);
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


			/*

			если в тикет присутствует в item.credits, то восстанавливаем tarif credit
			если тикет погашен, то переводим его в состояние credit
			если тикет не погашен, то просто его удаляем

			*/




/*
      foreach($tickets['list'] as $ticket) {
					if (isset($item['credits']) AND is_array($item['credits']) AND in_array($ticket['id'],$item['credits'])) {
							$ticket['tarif'] = 'credit';
					}
          if ($ticket['used'] == false OR ($ticket['tarif'] == 'credit' AND $ticket['payment'] == $item['id'] )) {
              $app->itemRemove('tickets',$ticket['id'],false);
          } else if ($ticket['closed'] > '') {
              unset($ticket['closed']);
              $app->itemSave('tickets',$ticket,false);
          }
      }
      $app->tableFlush('tickets');
			*/
    }
/*
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
			$credits = [];
			if (is_array($pay->get('credits'))) $credits = $pay->get('credits');
      foreach($tickets["list"] as &$ticket) {
          $ticket['start'] = $start;
          $ticket['stop'] = $stop;
          $checked++;
          if ($checked > $lessons) {
              if ($ticket['used'] == '' AND !in_array($ticket['id'],$credits)) {
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
		*/
}
?>
