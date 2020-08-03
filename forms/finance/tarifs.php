<html>
<div class="p-3">
   <h4 class="text-center">Клуб "Тандэн" - тарифы на 2020-2021 учебный год</h4>
   <table class="table table-striped">
      <thead>
          <tr>
              <th>Наименование</th>
              <th class="text-right">Длительность<br/>(месяцев)</th>
              <th class="text-right">Количество<br/>занятий</th>
              <th class="text-right">Стоимость ₽</th>
          </tr>
      </thead>
       <tbody wb-tree="table=catalogs&item=tarifs&field=tree">
        <tr wb-if='"{{id}}"!="credit"'>
            <td>{{name}}</td>
            <td class="text-right">{{data.month}}</td>
            <td class="text-right">{{data.lessons}}</td>
            <td class="text-right">{{data.price}} ₽</td>
        </tr>
       </tbody>
   </table>

</div>
</html>