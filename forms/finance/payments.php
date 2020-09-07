<html>
<table class="table table-striped table-responsive">
    <wb-foreach wb="{
        'table':'finance',
        'sort':'date',
        'filter': {
            'month':'2020-08',
            'wallet': {'$not':''}
        }
    }">
        <tr>
            <td>{{date}}</td>
            <td>{{wbCorrelation("members",{{member}},"name")}}</td>
            <td>{{tarif}}</td>
            <td>{{wallet}}</td>
            <td>{{summ}}</td>
        </tr>
    </wb-foreach>
</table>
</html>