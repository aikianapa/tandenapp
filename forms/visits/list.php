
<html>
<div class="chat-wrapper chat-wrapper-two">


    <nav class="nav navbar navbar-expand-md col">
      <a class="navbar-brand tx-bold tx-spacing--2 order-1" href="javascript:">Посещения</a>
      <button class="navbar-toggler order-2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="wd-20 ht-20 fa fa-ellipsis-v"></i>
      </button>

      <div class="collapse navbar-collapse order-2" id="navbarSupportedContent">
        <form class="form-inline mg-t-10 mg-lg-0">
              <input class="form-control search-header" type="search" placeholder="Поиск..." aria-label="Поиск..."
               data-ajax="{'target':'#{{_form}}List','filter_add':{'$or':[{ 'name': {'$like' : '$value'} }, { 'card': {'$like' : '$value'} }  ]} }">

          <button class="btn btn-success" type="button" data-ajax="{'url':'/cms/ajax/form/{{_form}}/edit/_new','html':'.visits-edit-modal'}">Создать</button>
        </form>
      </div>
    </nav>


    <div class="list-group m-2" id="{{_form}}List">
      <wb-foreach data-ajax="{'url':'/ajax/form/visits/list/','size':'15','sort':'id:d','filter':{  },'bind':'cms.list.visits','render':'client'}">
        <div class="list-group-item d-flex align-items-center">

            <div>
              <a href="javascript:" data-ajax="{'url':'/cms/ajax/form/visits/edit/{{_id}}','html':'.visits-edit-modal','modal':'#{{_form}}ModalEdit'}"
                class="tx-13 tx-inverse mg-b-0">
                <i class="ri-calendar-line"></i> {{show.date}}
                <span class="badge badge-secondary"><i class="ri-group-line"></i> {{show.count}}</span>
              </a>
            </div>

          <a href="javascript:" data-ajax="{'url':'/cms/ajax/form/visits/edit/{{_id}}','html':'.visits-edit-modal'}"
            class="pos-absolute r-40"><i class="ri-file-edit-line"></i></a>
          <div class="dropdown dropright pos-absolute r-10 p-0 m-0" style="line-height: normal;">
            <a href="javascript:" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">
              <i class="ri-more-2-fill"></i>
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#" data-ajax="{'url':'/cms/ajax/form/visits/edit/{{_id}}','html':'.visits-edit-modal'}">Изменить</a>
              <a class="dropdown-item" href="#">Переименовать</a>
              <a class="dropdown-item" href="javascript:"
                 data-ajax="{'url':'/ajax/rmitem/{{_form}}/{{_id}}','update':'cms.list.visits','html':'.visits-edit-modal'}">Удалить</a>
            </div>
          </div>
        </div>

        {{#if pagination}}
          {{#if @last===@index}}

            <ul class="pagination mg-b-0 mt-3">
              {{#each pagination}}
                {{#if this.label=="prev" }}
                  <li class="page-item">
                    <a class="page-link page-link-icon" data-page="{{this.page}}" href="#"><i class="fa fa-chevron-left"></i></a>
                  </li>
                  {{elseif this.label == "next"}}
                  <li class="page-item">
                    <a class="page-link page-link-icon" data-page="{{this.page}}" href="#"><i class="fa fa-chevron-right"></i></a>
                  </li>
                {{else}}
                  <li class="page-item">
                    <a class="page-link" data-page="{{this.page}}" href="#">{{this.label}}</a>
                  </li>
                {{/if}}
              {{/each}}
            </ul>

          {{/if}}
        {{/if}}
      </wb-foreach>
    </div>


</div>
<div class="visits-edit-modal"></div>

</html>
