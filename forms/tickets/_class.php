<?php
class ticketsClass extends cmsFormsClass {

    public function beforeItemShow(&$item) {
        $item['show'] = [];
        if (isset($item['member']) AND $item['member']> "") $item['show']['member'] = wbCorrelation("members",$item['member'],"name");
        $item['start'] =  date('d.m.Y',strtotime($item['start']));
        $item['stop'] =  date('d.m.Y',strtotime($item['stop']));
    }

  function ticket() {
      $app = $this->date();
  }

  function freeTickets($date, $member) {
    $list = $this->app->itemList('tickets',[
        'filter' => [
              'member'=> $member,
              'used' => false,
              'stop'  => ['$gte' => $date]
        ],
        'sort' => 'stop'
    ]);
    return $list['list'];
  }

  function creditTickets($date, $member) {
    $list = $this->app->itemList('tickets',[
        'filter' => [
              'member'=> $member,
              'tarif'=> 'credit',
              'stop'  => ['$lte' => $date]
        ]
    ]);
    foreach($list['list'] as $i => $item) {
        if (isset($item['closed']) AND $item['closed'] > '') {
            unset($list['list'][$i]);
        }
    }
    return $list['list'];
  }


  function getTicket($date, $member) {
      $app = $this->app;
      $list = $app->itemList('tickets',[
          'filter' => [
                'member'=> $member,
                'used' => false,
                'start' => ['$lte' => $date],
                'stop'  => ['$gte' => $date]
          ],
          'limit' => 1
      ]);
      return array_pop($list['list']);
  }
}
?>
