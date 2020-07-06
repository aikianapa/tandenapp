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
                    <div class="form-group row">
                        <label class="col-sm-1 control-label">ID</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="id" placeholder="ID абонемента" readonly>
                        </div>
                        <label class="col-sm-2 control-label">Ф.И.О.</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="name" placeholder="Ф.И.О." required>
                        </div>
                    </div>
                    <nav>
                        <div class="nav nav-tabs" role="tablist">
                            <a class="nav-item nav-link active" href="#{{_form}}Descr" data-toggle="tab">Характеристики</a>
                            <a class="nav-item nav-link" href="#{{_form}}Aaac" data-toggle="tab">Ассоциация</a>
                            <a class="nav-item nav-link" href="#{{_form}}Visits" data-toggle="tab">Посещения</a>
                            <a class="nav-item nav-link" href="#{{_form}}Finance" data-toggle="tab">Финансы</a>
                            <a class="nav-item nav-link" href="#{{_form}}Images" data-toggle="tab">Изображения</a>
                        </div>
                        <br>
                    </nav>
                    <div class="tab-content  p-a m-b-md">
                        <div id="{{_form}}Descr" class="tab-pane fade show active" role="tabpanel">
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">Дата регистрации</label>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control" name="clubdate" placeholder="Дата регистрации" required>
                                </div>
                                <label class="col-sm-3 control-label">Номер карты</label>
                                <div class="col-sm-3">
                                    <input type="text" wb-mask="9990000009999" class="form-control" name="card" placeholder="Номер карты">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">Архив</label>
                                <div class="col-sm-2">
                                    <label class="switch switch-success">
                                        <input type="checkbox" name="arch"><span></span></label>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group row">
                                        <label class="col-sm-4 control-label">Договор</label>
                                        <div class="col-sm-2">
                                            <label class="switch switch-success">
                                                <input type="checkbox" name="doc"><span></span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label">Ребёнок</label>
                                        <div class="col-sm-2">
                                            <label class="switch switch-success">
                                                <input type="checkbox" name="child"><span></span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-info">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label class="control-label">Дата рождения</label>
                                            <input type="date" class="form-control" name="bdate" placeholder="Дата рождения"> </div>
                                        <div class="col-sm-6">
                                            <label class="control-label">Адрес проживания</label>
                                            <input type="text" class="form-control" name="address" placeholder="Адрес проживания"> </div>
                                        <div class="col-sm-3">
                                            <label class="control-label">Телефон</label>
                                            <input type="phone" class="form-control" name="phone" placeholder="Контактный телефон"> </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label class="control-label">Место работы (учёбы)</label>
                                            <input type="text" class="form-control" name="employment" placeholder="Место работы (учёбы)"> </div>
                                        <div class="col-sm-6">
                                            <label class="control-label">Должность</label>
                                            <input type="text" class="form-control" name="job" placeholder="Должность"> </div>
                                    </div>
                                    <div class="d-none d-sm-block">
                                        <div class="form-group row mg-b-0 parents">
                                            <div class="col-sm-6">
                                                <label class="control-label">Ф.И.О. родителей</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="control-label">Телефон</label>
                                            </div>
                                        </div>
                                    </div>
                                    <wb-multiinput name="parents" class="parents">

                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" name="parent_name" placeholder="Ф.И.О. родителей"> </div>
                                                <div class="col-sm-6">
                                                    <input type="phone" class="form-control" name="parent_phone" placeholder="Телефон"> </div>

                                    </wb-multiinput>
                                </div>
                            </div>
                        </div>
                        <div id="{{_form}}Aaac" class="tab-pane fade" role="tabpanel">
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label class="control-label">Дата регистрации</label>
                                    <input type="date" class="form-control" name="adate" placeholder="Дата регистрации в АКАА"> </div>
                                <div class="col-sm-6">
                                    <label class="control-label">Регистрационный №</label>
                                    <input type="number" class="form-control" name="regnum" placeholder="Регистрационный №"> </div>
                            </div>
                            <div class="cart" id="exam">
                                <h6>Аттестации</h6>
                                <wb-multiinput name="exam">
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control" name="ldate" placeholder="Дата">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" name="level" data-wb-mask="9" placeholder="Уровень">
                                    </div>
                                    <div class="col-sm-2">
                                        <select name="kudan" class="form-control" placeholder="Кю/Дан">
                                            <option value="ku">Кю</option>
                                            <option value="dan">Дан</option>
                                        </select>
                                    </div>
                                </wb-multiinput>
                            </div>

							<div class="cart" id="fees">
								<h6>Взносы</h6>
								<wb-multiinput name="apay">
                      <div class="col-sm-4">
                          <input type="date" class="form-control" name="apay_date" placeholder="Дата">
                      </div>
                      <div class="col-sm-3">
                          <input type="number" class="form-control" name="apay_sum" placeholder="Сумма">
                      </div>
                      <div class="col-sm-2">
                          <input type="number" class="form-control" name="apay_year" placeholder="Год">
                      </div>
								</wb-multiinput>

							</div>

                        </div>
                        <div id="{{_form}}Finance" class="tab-pane fade" role="tabpanel">
                            <div class="block" data-wb-role="foreach" data-wb-table="finance" data-wb-where=' member = "{{id}}"' data-wb-sort="date:d" data-wb-size="100"> <a data-wb-ajax="/form/edit/finance/{{id}}" data-wb-append="body" class="btn btn-sm btn-info mb-1 mr-1">{{date}}</a> </div>
                        </div>
                        <div id="{{_form}}Visits" class="tab-pane fade" role="tabpanel">
                            <div class="block" data-wb-role="foreach" data-wb-table="visits" data-wb-where=' members like "{{id}}"' data-wb-sort="date:d" data-wb-size="100"> <span class="btn btn-sm btn-info mb-1 mr-1">{{date}}</span> </div>
                        </div>
                        <div id="{{_form}}Images" class="tab-pane fade" role="tabpanel">
                            <wb-module wb="{'module':'filepicker','path':'/uploads/members/{{id}}/'}" name="images" />
                        </div>
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
