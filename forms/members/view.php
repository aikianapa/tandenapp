<html>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; user-scalable=no" />

<wb-data wb="table=members&filter[card]={{_route.id}}">
  <div class="row">
    <div class="col-sm-6  offset-sm-3">

        <form id="visitData" class="m-0" style="height: calc(100vh - 60px);">
          <div class="card bg-dark text-white">
            <img src="{{show.image}}" class="card-img" alt="">
            <div class="card-img-overlay text-center">
              <h5 class="card-title">{{name}}</h5>
              <i class="ri-checkbox-circle-line pos-absolute d-none r-0 tx-100 check tx-success"></i>
              <i class="ri-close-circle-line pos-absolute d-none r-0 tx-100 uncheck tx-danger"></i>

              <div class="pos-absolute r-10 b-10"><img src="/assets/images/aaac_small_stamp.png"></div>
              <div class="pos-absolute b-10 text-left">
                <div class="card bg-black-3">
                  <div class="card-body">
                    <div class='tickets' id='visitDataTickets'>
                    <template id='visitDataTicketsTpl'>
                          <nobr><i class="ri-coupon-3-line"></i> {{tickets}}</nobr>
                          {{#if credits }}
                          &nbsp;&nbsp;<nobr class='tx-danger'><i class="ri-coupon-3-fill"></i> {{credits}}</nobr>
                          {{/if}}
                          <br>
                          {{#if lastdate !== '01.01.1970'}}
                          <nobr><i class="ri-calendar-line"></i> {{fromdate}} - {{lastdate}}</nobr>
                          {{else}}
                          <nobr class="tx-danger"><i class="ri-calendar-line"></i> Нет тикетов</nobr>
                          {{/if}}
                    </template>
                    </div>
                    <div><nobr><i class="ri-star-smile-line"></i> {{show.bdate}}</nobr></div>
                  </div>
                </div>
              </div>

              <div class="pos-absolute t-20 r-20">
                <a href="#" class="btn btn-primary rounded-pill lh-8 tx-20 btn-payment"
                data-ajax="{'url':'/cms/ajax/form/finance/pay/','form':'#visitData','html':'#visitData .modalsBlock'}">
                <i class="ri-hand-coin-line"></i></a>
              </div>
              <div class="pos-absolute t-20 r-20 d-none">
                <a href="#" class="btn btn-warning rounded-pill lh-8 tx-20 btn-credit"
                data-ajax="{'url':'/cms/ajax/form/finance/credit/','form':'#visitData','html':'#visitData .modalsBlock'}">
                <i class="ri-hand-coin-line"></i></a>
              </div>


            </div>

          </div>
          <div class="container">
            <br />
            <div class="row">
              <div class="col-3 p-0">
                <a href="#" class="btn btn-success rounded-pill lh-8 tx-20 pos-absolute l-20"
                data-ajax="{'url':'/cms/ajax/form/visits/success/','form':'#visitData'}">
                <i class="ri-user-follow-line"></i></a>
              </div>
              <div class="col-6 p-0">
                <input class="form-control text-center date" name="date" type="date" value='{{date("Y-m-d")}}' />
                <input type='hidden' name='member' value='{{id}}' />
              </div>

              <div class="col-3 p-0">
                <a href="#" class="btn btn-danger rounded-pill lh-8 tx-20 pos-absolute r-20"
                data-ajax="{'url':'/cms/ajax/form/visits/decline/','form':'#visitData'}">
                <i class="ri-user-unfollow-line"></i></a>
              </div>
            </div>

          </div>
          <div class="modalsBlock"></div>
        </form>
        <div class="modal fade effect-scale" id="ticketWarning" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Внимание!</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  <span class="sr-only">Close</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Не найден действующий абонемент</p>
              </div>
              <div class="modal-footer">
                <a href="javascript:$('.btn-payment').trigger('click');" type="button" class="btn btn-primary" data-dismiss="modal">С оплатой</a>
                <a href="javascript:$('.btn-credit').trigger('click');" type="button" class="btn btn-danger" data-dismiss="modal">Без оплаты</a>
                <button type="button" class="btn btn-secondary"  data-dismiss="modal">Отмена</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
  </div>

  <wb-empty>
    <div class="alert alert-primary mg-t-100 text-center">
      Данные по карте не найдены!<br />
      <a href="#" data-ajax="{'url':'/cms/ajax/form/members/scanner','html':'.content-body'}" class="btn btn-primary mg-t-10">
        <i class="ri-barcode-box-line"></i>&nbsp;&nbsp;
        <span>Сканер</span>
      </a>

    </div>

  </wb-empty>
</div>
</wb-data>
<script>

  $(document).on("wb-save-done",function(ev,params){
    if (params.params.url == "/ajax/save/finance/") {
        $("#visitData .btn-success").trigger('tap click');
    }
  });

  $("#visitData").off("ajax-done");
  $("#visitData").on("ajax-done",function(ev,params){
    if (params.form !== undefined && params.form == "#visitData") {
      if (params.data !== undefined) {
          if (params.data.error == false) {
              let members = array_column(params.data.result.members,'member');
              if ( params.formdata !== undefined) {
                  if (in_array(params.formdata.member,members) ) {
                      $("#visitData .check").removeClass("d-none");
                  }
              }
              $("#visitData .uncheck").addClass("d-none");
              $("#visitData .check").addClass("d-none");
              if (strpos(params.url,'decline')) {
                  $("#visitData .uncheck").removeClass("d-none");
              } else if (strpos(params.url,'success')) {
                  $("#visitData .check").removeClass("d-none");
              }
          } else if (params.data.error == true) {
              if (params.data.ticket !== undefined && params.data.ticket == false) {
                  $('#ticketWarning').modal('show');
              }
          }
          $("#visitData input[name=date]").trigger('change');
      }
    }
  });
  $("#visitData input[name=date]").off('change');
  $("#visitData input[name=date]").on('change', async function(){
      let res = await wbapp.postSync('/cms/ajax/form/visits/check/',{
        date:$("#visitData input[name=date]").val(),
        member:$("#visitData input[name=member]").val()
      });
      if (res.visit == false) {
          $("#visitData .check").addClass("d-none");
      } else {
          $("#visitData .check").removeClass("d-none");
      }
      wbapp.renderTemplate({
        _tid:'#visitDataTicketsTpl',
        bind:'cms.visit.tickets',
        target:'#visitDataTickets'
      },res);
  });

  $("#visitData input[name=date]").trigger('change');
</script>
<style>
    #visitData > .card {
        height: calc( 100vh - 140px);
    }    
</style>
</html>
