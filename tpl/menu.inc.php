   <nav class="navbar navbar-expand-md navbar-dark bg-dark">
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample01">
           <ul class="navbar-nav">
               <li class="nav-item">
                   <a class="nav-link" href="/"><i class='fa fa-home'></i> Главная</a>
               </li>
               <li class="nav-item">
                   <a class="nav-link" href="/dogovor">Договор</a>
               </li>
               <li class="nav-item">
                   <a class="nav-link" href="/raspisanie">Расписание</a>
               </li>
               <li class="nav-item">
                   <a class="nav-link" href="/contacts">Контакты</a>
               </li>
               <!--li class="nav-item dropdown">
                   <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                   <div class="dropdown-menu" aria-labelledby="dropdown01">
                       <a class="dropdown-item" href="#">Action</a>
                       <a class="dropdown-item" href="#">Another action</a>
                       <a class="dropdown-item" href="#">Something else here</a>
                   </div>
               </li-->
           </ul>
       </div>
       <script type="wbapp">
            $(".navbar-nav .nav-link[href='{{_route.uri}}']").parent().addClass('active');
            $(".navbar-nav .nav-link[href='{{_route.uri}}']").append('<span class="sr-only">(current)</span>');
       </script>
   </nav>