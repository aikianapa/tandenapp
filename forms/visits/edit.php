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

                  {{members}}

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> Закрыть</button>
                <button type="button" class="btn btn-primary" data-wb-formsave="#{{_form}}EditForm"><span class="fa fa-check"></span> Сохранить изменения</button>
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
</script>
</html>
