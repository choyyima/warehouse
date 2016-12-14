<?php include './config.php'; ?>

<!doctype html>
<html lang="en"><head>
        <meta charset="utf-8">
        <title>Warehouse</title>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!--<link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">-->
        <link rel="stylesheet" href="lib/font-awesome/css/font-awesome.css">
        <link rel="shortcut icon" href="assets/ico/warehouse.png">
        <link rel="stylesheet" href="css/dataTables.bootstrap.css">
        <!--<script src="lib/jquery-1.11.1.min.js" type="text/javascript"></script>-->
        <link href="css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="stylesheets/theme.css">
        <link rel="stylesheet" type="text/css" href="stylesheets/premium.css">
        <script src="js/jquery-1.11.1.min.js"></script>
        <style>
            #data_wrapper{
                overflow-x: auto;
            }
        </style>
    </head>
    <body class=" theme-blue">
        <style>
            select{position:absolute; width:160px; height:23px; left:0; top:0; border:0;}
            input{position: absolute; width: 140px;height:17px; left:0; top:0;}
            p{position: relative; margin-top:50px;}
        </style>

        <div class="content">
            <select class="form-control" name="">
                <option value="200">200</option>
                <option value="300">300</option>
                <option value="400">400</option>
            </select>
            <input type="text" name="" value="" class="form-control" id="inputer">    
            <p>value:</p>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function () {

                function search() {

                    var title = $("#search").val();

                    if (title !== "") {
                        $("#result").html("<img alt="ajax search" src='ajax-loader.gif'/>");
                                $.ajax({
                                    type: "post",
                                    url: "search.php",
                                    data: "title=" + title,
                                    success: function (data) {
                                        $("#result").html(data);
                                        $("#search").val("");
                                    }
                                });
                    }
                }

                $("#button").click(function () {
                    search();
                });

                $('#search').keyup(function (e) {
                    if (e.keyCode === 13) {
                        search();
                    }
                });
            });
        </script>
    </body>
</html>