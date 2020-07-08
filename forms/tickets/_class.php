<?php
class ticketsClass extends cmsFormsClass {

  function ticket() {
      $app = $this->date();
  }

  function freeTickets($date, $member) {
    $list = $this->app->itemList('tickets',[
        'filter' => [
              'member'=> $member,
              'used' => false,
              'stop'  => ['$lte' => $date]
        ],
        'sort' => 'stop'
    ]);
    return $list['list'];
  }

  function getTicket($date, $member) {
      $app = $this->app;
      $list = $app->itemList('tickets',[
          'filter' => [
                'member'=> $member,
                'used' => false,
                'start' => ['$gte' => $date],
                'stop'  => ['$lte' => $date]
          ],
          'limit' => 1
      ]);
      return array_pop($list['list']);
  }
}
?>
