<html>
<div class="modal fade effect-scale show removable" data-backdrop="static" id="{{_form}}ModalEdit" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Оплата</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
            <div class="modal-body">
                <form id="{{_form}}EditForm" data-wb-form="{{_form}}" data-wb-item="{{_item}}" class="form-horizontal" role="form">
                  <input type="hidden" name="member" value="{{_post.formdata.member}}" />
                  <input type="hidden" name="account" value="tanden" />
                  <input type="hidden" name="monthes" value="" />
                  <input type="hidden" name="lessons" value="" />
                  <input type="hidden" name="name" value="" />

                  <h6 class="text-center">{{wbCorrelation("members",{{_post.formdata.member}},"name")}}</h6>

                  <div class="input-group mg-b-10">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ri-calendar-line"></i></span>
                    </div>
                    <input class="form-control" name="date" type="date" value='{{date("Y-m-d")}}' />
                  </div>

                  <div class="input-group mg-b-10">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ri-hand-coin-line"></i></span>
                    </div>
                    <select name="wallet" class="form-control">
                      <option value="cash">Наличные</option>
                      <option value="card">Карта</option>
                      <!--option value="bank">Банк</option-->
                    </select>
                  </div>

                  <div class="input-group mg-b-10">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ri-stack-line"></i></span>
                    </div>
                    <select name="tarif" class="form-control" wb-tree='table=catalogs&item=tarifs&field=tree'>
                        <option value="{{id}}" data-price="{{data.price}}" data-month="{{data.month}}" data-lessons="{{data.lessons}}">
                          {{name}}
                        </option>
                    </select>
                  </div>

                  <div class="input-group mg-b-10">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ri-coin-line"></i></span>
                    </div>
                    <input class="form-control" name="summ" type="number" value='' />
                  </div>
                </form>
            </div>
            <div class="modal-footer">
                <wb-include wb="{'form':'common_formsave.php'}" />
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        var $modal = $("#{{_form}}ModalEdit");
        $modal.find("[name=tarif]").on("change",function(){
            var data = $(this).find("option:selected")[0].dataset;
            $modal.find("[name=summ]").val(data.price);
            $modal.find("[name=monthes]").val(data.month);
            $modal.find("[name=lessons]").val(data.lessons);
            $modal.find("[name=name]").val(("Абонемент " + $(this).find("option:selected").text()).replace(/\s*\n\s*/g," ").trim());
        }).trigger("change");
    });
</script>
</html>
