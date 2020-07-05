<html>

<div class="p-2">
  <form id="repMonth">
    <input type="month" name="month" value="{{_post.formdata.month}}" class="form-control"
      data-ajax="{'url':'/cms/ajax/form/visits/rep_month/','form':'#repMonth','html':'.content-body'}"
    />
  </form>
  <table class="tx-14 table table-bordered table-hover table-sm table-striped">
    <thead>
      <tr>
        <th class="p-1">
          #
        </th>
        <th class="p-1">
          Клиент
        </th>

        <wb-foreach wb="from=days">
          <th class="p-1 text-center">
            {{_ndx}}
          </th>
        </wb-foreach>
      </tr>
    </thead>
    <tbody>
      <wb-foreach wb="from=rep&sort=name">
        <tr>
          <td class='tx-12 p-1'>
            {{_ndx}}
          </td>
          <td class='tx-12 p-1'>
            {{name}}
          </td>
          <wb-foreach wb="from=days">
            <td wb-if='"{{_val}}"=="on"' class="p-1">
              <i class="ri-check-fill tx-success tx-bold" title="{{_ndx}}"></i>
            </td>
            <td wb-if='"{{_val}}"==""' class="p-1">
              <i class="ri-close-line tx-gray-300"></i>
            </td>

          </wb-foreach>
        </tr>
      </wb-foreach>
    </tbody>
  </table>
</div>

</html>
