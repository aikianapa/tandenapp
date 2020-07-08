<html>
<div class="modal fade effect-scale show removable saveclose" data-backdrop="static" id="{{_form}}ModalEdit" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title tx-white">Без оплаты</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
            <div class="modal-body">
                <form id="{{_form}}EditForm" class="form-horizontal" role="form">
                  <input type="hidden" name="member" value="{{_post.formdata.member}}" />
                  <input type="hidden" name="account" value="tanden" />
                  <input type="hidden" name="monthes" value="0" />
                  <input type="hidden" name="lessons" value="1" />
                  <input type="hidden" name="wallet" value="" />
                  <input type="hidden" name="summ" value="0" />
                  <input type="hidden" name="name" value="Разовая тренировка без оплаты" />

                  <h6 class="text-center">{{wbCorrelation("members",{{_post.formdata.member}},"name")}}</h6>

                  <div class="input-group mg-b-10">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ri-calendar-line"></i></span>
                    </div>
                    <input class="form-control" name="date" type="date" value='{{date("Y-m-d")}}' readonly />
                  </div>

                  <div class="input-group mg-b-10">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ri-stack-line"></i></span>
                    </div>
                    <select name="tarif" class="form-control" wb-tree='table=catalogs&item=tarifs&field=tree' value="credit" disabled>
                        <option value="{{id}}" data-price="{{data.price}}" data-month="{{data.month}}" data-lessons="{{data.lessons}}" wb-if='"{{id}}"=="credit" ==> selected'>
                          {{name}}
                        </option>
                    </select>
                    <input type="hidden" name="tarif" value="credit" />
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
    $modal.find("select[name=tarif]").off("change");
    $modal.find("select[name=tarif]").on("change",function(){
        var data = $(this).find("option:selected")[0].dataset;
        $modal.find("[name=summ]").val(data.price);
        $modal.find("[name=monthes]").val(data.month);
        $modal.find("[name=lessons]").val(data.lessons);
    }).trigger("change");
});
</script>
</html>
