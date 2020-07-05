<html>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; user-scalable=no" />

<wb-data wb="table=members&filter[card]={{_route.id}}">
  <div class="row">
    <div class="col-sm-6  offset-sm-3">

        <form id="visitData" class="m-0">

          <div class="card bg-dark text-white">
            <img src="{{show.image}}" class="card-img" alt="">
            <div class="card-img-overlay text-center">
              <h5 class="card-title">{{name}}</h5>
              <i class="ri-checkbox-circle-line pos-absolute d-none r-0 tx-100 check tx-success"></i>
              <i class="ri-close-circle-line pos-absolute d-none r-0 tx-100 uncheck tx-danger"></i>


              <div class="pos-absolute b-0">
                <div wb-if='"{{aaac}}"=="on"'><img src="/assets/images/aaac_small_stamp.png" /></div>
                <div>{{show.bdate}}</div>
              </div>

              <div class="pos-absolute t-20 r-20">
                <a href="#" class="btn btn-primary rounded-pill lh-8 tx-20"
                data-ajax="{'url':'/cms/ajax/form/finance/pay/','form':'#visitData','html':'#visitData .modalsBlock'}">
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
                <input class="form-control text-center" name="date" type="date" value='{{date("Y-m-d")}}' />
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
          }
      }
    }
  })
</script>
</html>
