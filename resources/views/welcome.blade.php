<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Colored balls</title>

        //We add Fontawesome for the + - buttons
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        //This is the stylesheet file containing Bootstrap & our custom styles
        <link href="/css/app.css" rel="stylesheet">

    </head>
    <body class="antialiased">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Test bile</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12 dynamic-wrap">
                    <form action="" method="post" id="frm">
                        <div class="input-group mb-2 mr-sm-2 entry">
                            <span class="input-group-prepend"></span>
                            <input type="text" class="form-control" name="balls[]" placeholder="Nr. bile"/>
                            <div class="input-group-append">
                                <button class="btn btn-success btn-add" type="button"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Rezolvă</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger d-none" role="alert" id="errors"></div>
                    <ul class="list-group" id="groups"></ul>
                </div>
            </div>
        </div>
        //This is the javascript file for our UI
        <script src="/js/app.js"></script>
    </body>
</html>
