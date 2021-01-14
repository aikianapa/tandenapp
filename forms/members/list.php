
<html>
<div class="chat-wrapper chat-wrapper-two">


    <nav class="nav navbar navbar-expand-md col">
      <a class="navbar-brand tx-bold tx-spacing--2 order-1" href="javascript:">Клиенты</a>
      <button class="navbar-toggler order-2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="wd-20 ht-20 fa fa-ellipsis-v"></i>
      </button>

      <div class="collapse navbar-collapse order-2" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link active" href="#" data-ajax="{'target':'#{{_form}}List','filter': 'clear'}">Все
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" data-ajax="{'target':'#{{_form}}List','filter_remove': 'active','filter_add':{'arch':''}}">Активные</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" data-ajax="{'target':'#{{_form}}List','filter_remove': 'active','filter_add':{ 'arch': 'on' } }">Архивные</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" data-ajax="{'target':'#{{_form}}List','filter_remove': 'active','filter_add':{ 'aaac': 'on' } }">АКАА</a>
          </li>
        </ul>
        <form class="form-inline mg-t-10 mg-lg-0">
              <input class="form-control search-header" type="search" placeholder="Поиск..." aria-label="Поиск..."
               data-ajax="{'target':'#{{_form}}List','filter_add':{'$or':[{ 'name': {'$like' : '$value'} }, { 'card': {'$like' : '$value'} }  ]} }">

          <button class="btn btn-success" type="button" data-ajax="{'url':'/cms/ajax/form/{{_form}}/edit/_new','html':'.members-edit-modal'}">Создать</button>
        </form>
      </div>
    </nav>


    <div class="list-group m-2" id="{{_form}}List">
      <wb-foreach data-ajax="{'url':'/ajax/form/members/list/','size':'15','sort':'name','filter':{ 'arch' : {'$ne':'on'} },'bind':'cms.list.members','render':'client'}">
        <div class="list-group-item d-flex align-items-center">

            <div>
              <a href="javascript:" data-ajax="{'url':'/cms/ajax/form/members/edit/{{_id}}','html':'.members-edit-modal','modal':'#{{_form}}ModalEdit'}"
                class="tx-13 tx-inverse mg-b-0">
                <span class="badge badge-secondary"><i class="ri-barcode-line"></i> {{card}}</span>
                <i class="ri-user-3-line"></i> {{name}}
              </a>
            </div>

          <a href="javascript:" data-ajax="{'url':'/cms/ajax/form/members/edit/{{_id}}','html':'.members-edit-modal'}"
            class="pos-absolute r-40"><i class="ri-file-edit-line"></i></a>
          <div class="dropdown dropright pos-absolute r-10 p-0 m-0" style="line-height: normal;">
            <a href="javascript:" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">
              <i class="ri-more-2-fill"></i>
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#" data-ajax="{'url':'/cms/ajax/form/members/edit/{{_id}}','html':'.members-edit-modal'}">Изменить</a>
              <a class="dropdown-item" href="#">Переименовать</a>
              <a class="dropdown-item" href="javascript:"
                 data-ajax="{'url':'/ajax/rmitem/{{_form}}/{{_id}}','update':'cms.list.members','html':'.members-edit-modal'}">Удалить</a>
            </div>
          </div>
        </div>
      </wb-foreach>
      <wb-jq wb="{'append':'#{{_form}}List template','render':'client'}" >
        <wb-snippet wb-name="pagination"/>
      </wb-jq>
    </div>


</div>
<div class="members-edit-modal"></div>

</html>
