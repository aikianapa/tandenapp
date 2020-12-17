<html lang="en">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <meta name="viewport" content="width=device-width; initial-scale=1.0; user-scalable=no" />


    <section id="modBarcodeContainer" class="row">
      <div id="result_strip">
        <ul class="thumbnails"></ul>
        <ul class="collector"></ul>
      </div>
      <div id="interactive" class="viewport"></div>
    </section>
      <script type="wbapp">
          wbapp.loadScripts([
            "js/adapter.js",
            "js/quagga.min.js",
            "js/live_w_locator.js"
          ],"modBarcodeStart");

          $(document).one("modBarcodeStart",function(){
              $("#modBarcodeContainer").barcode();
          })

          wbapp.loadStyles([
            "css/styles.less"
          ]);
      </script>

  </body>
</html>
