<html>
<wb-module  wb="{'module':'barcode'}" />
<script>
$(document).on("modBarcode",function(e,code){
      wbapp.ajax({url:"/cms/ajax/form/members/view/"+code,"html":".content-body"});
});
</script>
</html>
