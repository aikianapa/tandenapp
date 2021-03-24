<html>
<style>
#aaacForms {
    margin: 0;
    padding: 0;
    background-color: #FAFAFA;
    font: 12pt "Tahoma";
    box-sizing: border-box;
    -moz-box-sizing: border-box;
}

#aaacForms .page {
    background: white;
    width: 210mm;
    height: 297mm;
    display: block;
    margin: 0 auto;
    margin-bottom: 0.5cm;
    box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
}

@page {
    size: A4;
    margin: 0;
    padding:0;
}

@media print {
    body {
        width: 210mm;
        display: block;
        overflow-x: hidden;
        padding: 0;
        background: white;

    }

    #aaacForms {
        position: relative;
        display: block;
        width: 210mm;
    }

    #aaacForms .page {
        width: 210mm;
        height: 297mm;
        display: block;
        overflow: hidden;
        box-shadow: none;
        border: none;
        clear: both;
        page-break-after: always;
        position: relative;
        margin: 0;
        padding: 0;
        zoom: 150%;
    }
}

#aaacForms .page label {
    font-weight: bold;
}

#aaacForms .page label+span {
    border-bottom: 1px #333 solid;
    min-width: 100px;
    display: inline-block;
}

#aaacForms .page .logo {
    display: inline-flex;
    position: relative;
    background-color: brown;
    font-size: 1.5cm;
    padding: 0.5cm;
    margin-left: auto;
    margin-right: auto;
    color: white;
}

#aaacForms .page .photo {
    width: 3cm;
    height: 4cm;
    border: 1px #eee solid;
}
</style>

<div>
    <a href="javascript:aaacFormsPrint();" class="btn btn-success">Печать</a>
    <script>
    var aaacFormsPrint = function() {
        var a = window.open('', '', 'height=500, width=500');
        a.document.write($('style').outer());
        a.document.write(
            '<link href="/engine/modules/cms/tpl/assets/css/dashforge.css" rel="stylesheet" type="text/css">');
        a.document.write($("#aaacForms").outer());
        a.document.close();
        a.print();
    }
    </script>
</div>

<div id="aaacForms">
    <wb-foreach wb="table=members&sort=name" wb-filter="{'archive':'','aaac':'on'}">
        <div class="page text-center">
            <div class="row">
                <div class="col">
                    <div class="logo mb-3">А.К.А.А.</div>
                    <h1 class="text-center mb-3">Ассоциация Клубов Айкидо Айкикай</h1>

                    <h2 class="text-center mb-5">Анкета члена АКАА</h2>
                    <div class="text-left mt-5 px-5">
                        <div class="row mb-3">
                            <div class="col-6">
                                <label>Дата вступления</label>: <span>{{ dateout({{adate}}) }}</span>
                            </div>
                            <div class="col-6">
                                <label>Регистрационный номер</label>: <span>{{regnum}}</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-8">
                                <div><label>Ф.И.О.</label>: <span>{{name}}</span></div>
                                <div><label>Дата рождения</label>: <span>{{ dateout({{bdate}}) }}</span></div>
                            </div>
                            <div class="col-4 text-right">
                                <img width="300" height="400" src="/thumbc/300x400/src/{{images.0.img}}" class="photo">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label>Адрес</label>: <span>{{address}}</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label>Телефон</label>: <span></span>
                            </div>
                            <div class="col-6">
                                <label>Мобильный</label>: <span>{{ wbPhoneFormat({{phone}}) }}</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label>Дополнительно</label>: <span></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label>Email</label>: <span>{{email}}</span>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-12 text-right">
                                <label>Подпись</label>: <span></span>
                            </div>
                        </div>

                        <h4 class="text-center">Регистрация на кю</h4>

                        <div class="row my-2">

                            <wb-foreach wb="count=9;1">
                                <div class="col-sm-4 my-1">
                                    <label>{{_value}} кю</label>:
                                    <span>
                                        <wb-foreach wb-from="_parent.exam"
                                            wb-filter="{'kudan': 'ku', 'level':'{{_value}}'}">
                                            <span>{{ dateout({{ ldate }}) }} </span>
                                        </wb-foreach>
                                    </span>
                                </div>
                            </wb-foreach>
                        </div>

                        <h4 class="text-center">Регистрация на дан</h4>
                        <div class="row my-2">
                            <wb-foreach wb="count=1;6">
                                <div class="col-sm-4 my-1">
                                    <label>{{_value}} дан</label>:
                                    <span>
                                        <wb-foreach wb-from="_parent.exam"
                                            wb-filter="{'kudan': 'dan', 'level':'{{_value}}'}">
                                            <span>{{ dateout({{ ldate }}) }} </span>
                                        </wb-foreach>
                                    </span>
                                </div>
                            </wb-foreach>
                        </div>

                    </div>
                </div>
            </div>
        </div>
</div>
</wb-foreach>
</div>

</html>