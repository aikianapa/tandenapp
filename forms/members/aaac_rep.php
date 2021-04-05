<html>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <td>№</td>
            <td>ФИО</td>
            <td>Уровень</td>
            <td>Экзамен</td>
            <td>Возраст</td>
            <td>Ребёнок</td>
            <td>Сумма взноса</td>
        </tr>
    </thead>
    <tbody>
    <wb-foreach wb="table=members&sort=name&total=aaac_amount;age&group=child" wb-filter="{'archive':'','aaac':'on'}">
    <tr wb-if='_total == ""'>
        <td>{{_ndx}}</td>
        <td>{{name}} <span class="badge badge-warning" wb-if = "images.0.img == ''">Нет фото</span></td>
        <td>{{level}}</td>
        <td>{{ldate}}</td>
        <td>{{age}}</td>
        <td><span wb-if="child == 'on'">+</span></td>
        <td>{{aaac_amount}}</td>
    </tr>
    <tr wb-if='_total > ""' class='{{_class}}'>
        <td></td>
        <td></td>
        <td></td>
        <td>Итого</td>
        <td>{{sum.age}}</td>
        <td></td>
        <td>{{sum.aaac_amount}}</td>
    </tr>

    </wb-foreach>
    </tbody>
</table>
</html>