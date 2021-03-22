<html>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <td>№</td>
            <td>ФИО</td>
            <td>Год рождения</td>
            <td>Ребёнок</td>
            <td>Сумма взноса</td>
        </tr>
    </thead>
    <tbody>
    <wb-foreach wb="table=members&sort=name" wb-filter="{'archive':'','aaac':'on'}">
    <tr>
        <td>{{_ndx}}</td>
        <td>{{name}} <span class="badge badge-warning" wb-if = "images.0.img == ''">Нет фото</span></td>
        <td>{{ date("Y",strtotime({{bdate}})) }} г.р.</td>
        <td><span wb-if="child == 'on'">+</span></td>
        <td>{{aaac_amount}} ₽</td>
    </tr>
    </wb-foreach>
    </tbody>
</table>
</html>