<html>
<table class="table table-striped table-hover">
    <tbody>
    <wb-foreach wb="table=members&sort=name" wb-filter="{'archive':'','aaac':'on'}">
    <tr>
        <td>{{_ndx}}</td>
        <td>{{name}}</td>
        <td>{{aaac_amount}}</td>
    </tr>
    </wb-foreach>
    </tbody>
</table>
</html>