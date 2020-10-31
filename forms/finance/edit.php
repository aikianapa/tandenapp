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

                  <div class="input-group mg-b-10">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ri-user-line"></i></span>
                    </div>


                      <button class="form-control tx-left dropdown-toggle" type="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" wb-if='"{{company}}" > "" ==> disabled'>
                        <span wb-if='"{{member}}" == ""'>Клиент...</span>
                        <wb-data wb="{'table':'members','item':'{{member}}'}">
                        {{name}}
                        </wb-data>
                      </button>
                      <div class="dropdown-menu">

                        <div class="search-form">
                          <input type="hidden" name="member" />
                          <input type="search" class="form-control" placeholder="Клиент..." data-ajax="{'target':'#{{_form}}ModalEditMembers','filter_add':{ 'name': {'$like' : '$value'} } }" />
                          <button class="btn" type="button"><i class="ri-search-line"></i></button>
                        </div>
                        <div id="{{_form}}ModalEditMembers">
                          <wb-foreach data-ajax="{'url':'/ajax/form/members/list/','size':'15','sort':'name','filter':{'arch':''},'bind':'cms.edit.finown','render':'client'}" auto>
                            <div class="p-1 cursor-pointer" data-id="{{_id}}" onclick="setDropdown(this)">
                              {{name}}
                            </div>
                          </wb-foreach>
                        </div>

                      </div>

                  </div>

                  <div class="input-group mg-b-10">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ri-calendar-line"></i></span>
                    </div>
                    <input class="form-control" name="date" type="date" value='{{date("Y-m-d")}}' wb-if='"{{_route.id}}" !== "_new"' readonly />
										<input class="form-control" name="date" type="date" value='{{date("Y-m-d")}}' wb-if='"{{_route.id}}" == "_new"' />
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

                  <div class="input-group mg-b-10" wb-if='"{{date}}">="2020-07-01" OR "{{date}}"==""'>
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

                  <div class="input-group mg-b-10">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ri-align-left"></i></span>
                    </div>
                    <input class="form-control" name="name" type="text" />
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
        $modal.find("[name=tarif]").off("change");
        $modal.find("[name=tarif]").on("change",function(){
            var data = $(this).find("option:selected")[0].dataset;
            if ($modal.find("[name=date]").val() >= "2020-07-01") {
                $modal.find("[name=summ]").val(data.price);
                $modal.find("[name=monthes]").val(data.month);
                $modal.find("[name=lessons]").val(data.lessons);
                $modal.find("[name=name]").val(("Абонемент " + $(this).find("option:selected").text()).replace(/\s*\n\s*/g," ").trim());
            }
        }).trigger("change");
        var setDropdown = function(ev) {
            var btn = $(ev).parents(".dropdown-menu").prev(".dropdown-toggle");
            var inp = $(ev).parents(".dropdown-menu").find("input[type=hidden]");
            $(inp).val($(ev).data("id"));
            $(btn).text($(ev).text());
        }
    });
</script>
</html>