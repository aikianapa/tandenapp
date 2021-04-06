<html>
<div class="p-2">
  <form id="repMonth">
    <wb-var month="{{_post.formdata.month}}" />
    <wb-var month='{{date("Y-m")}}' wb-if='"{{_var.month}}" == ""' />

    <input type="month" name="month" value="{{_var.month}}" class="form-control"
      data-ajax="{'url':'/cms/ajax/form/finance/payments/','form':'#repMonth','html':'.content-body'}"
    />
  </form>

<table class="table table-striped table-responsive">
    <wb-foreach wb="{
        'table':'finance',
        'sort':'date',
        'filter': {
            'month':'{{_var.month}}',
            'wallet': {'$not':''},
            'tariff': {'$not':'credit'},
            'summ': {'$gt':'0'}
        },
        'group': 'wallet',
        'total': 'summ'
    }">
        <tr>
            <td>{{_ndx}}</td>
            <td>{{date}}</td>
            <td>{{wbCorrelation("members",{{member}},"name")}}</td>
            <td>{{tarif}}</td>
            <td>{{wallet}}</td>
            <td>{{summ}}</td>
        </tr>
    </wb-foreach>
</table>
</div>
</html>
