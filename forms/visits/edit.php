<html>
<div class="modal fade effect-scale show removable" id="{{_form}}ModalEdit" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                <h5 class="modal-title">{{header}}</h5>
            </div>
            <div class="modal-body">
                <form id="{{_form}}EditForm" data-wb-form="{{_form}}" data-wb-item="{{_item}}" class="form-horizontal" role="form">

                  <div class="input-group mg-b-10">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ri-calendar-line"></i></span>
                    </div>
                    <input class="form-control" name="date" type="date" value='{{date("Y-m-d")}}' />
                  </div>

                  <wb-multiinput name="members">
                      <div class="col-9">
                        <button class="form-control tx-left dropdown-toggle" type="button" data-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false">
                          <span wb-if='"{{member}}" == ""'>Клиент...</span>
                          <wb-data wb="{'table':'members','item':'{{member}}'}">
                          {{name}}
                          </wb-data>
                        </button>
                        <div class="dropdown-menu">
                          <div class="search-form">
                            <input type="hidden" name="member" />
                            <input type="search" class="form-control" placeholder="Клиент..." data-ajax="{'target':'#visitsModalFindMembers','filter_add':{ 'name': {'$like' : '$value'} } }" />
                            <button class="btn" type="button"><i class="ri-search-line"></i></button>
                          </div>
                          <div>

                          </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <input name="payed" class="form-control" />
                      </div>
                  </wb-multiinput>
                </form>
            </div>
            <div id="visitsModalFindMembers" class="d-none">
              <wb-foreach data-ajax="{'url':'/ajax/form/members/list/','size':'15','sort':'name','filter':{'arch':''},'bind':'cms.edit.visits','render':'client'}" auto>
                <div class="p-1 cursor-pointer" data-id="{{_id}}" onclick="setDropdown(this)">
                  {{name}}
                </div>
              </wb-foreach>
            </div>
            <div class="modal-footer">
                <wb-include wb="{'form':'common_formsave.php'}" />
            </div>
        </div>
    </div>

</div>
<script>
    $(document).ready(function () {
        if ($('input[name=child]').val() !== "on") {
            $("#membersEditForm .parents").hide();
        }
        $('input[name=child]').on('change', function (event, state) {
            if ($(this).prop("checked")) {
                $("#membersEditForm .parents").show();
            }
            else {
                $("#membersEditForm .parents").hide();
            }
        });
    });
    $(document).off('bind-cms.edit.visits');
    $(document).on('bind-cms.edit.visits',function(){
        $('#{{_form}}EditForm [name=members] .dropdown-menu:visible .search-form').next().html($('#visitsModalFindMembers').html());
    });
    var setDropdown = function(ev) {
        var btn = $(ev).parents(".dropdown-menu").prev(".dropdown-toggle");
        var inp = $(ev).parents(".dropdown-menu").find("input[type=hidden]");
        $(inp).val($(ev).data("id"));
        $(btn).text($(ev).text());
    }
</script>
</html>
