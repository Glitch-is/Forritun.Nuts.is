<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Skráning í forritunarklúbbinn</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    {{HTML::style('css/bootstrap.css')}}
    {{HTML::style('css/style.css')}}
    <style type="text/css">

    </style>
    {{ HTML::style('css/bootstrap-responsive.css')}}

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="ico/favicon.ico">

  </head>

  <body>

    <div class="container">
      <div class="logo">
        <img class="heading" src="img/forritunlogo.png" />
      </div>
      <div class="row">

        <div class="span12" id="terminal">
          <table class="table">
            <thead>
              <th>ID</th>
              <th>Name</th>
            </thead>
          @foreach($members as $member)
            <tr>
              <td>{{$member->id}}</td>
              <td>{{$member->name}}</td>
            </tr>
          @endforeach
          </table>
        </div>
      </div>
    </div>
  </body>
</html>
