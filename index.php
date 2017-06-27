<?php
    session_start();
    $_SESSION['todo'] = array();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="content-type">
            <title>
                Simple Rest API
            </title>
        </meta>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <style type="text/css">
            .records {
                height: 320px;
                overflow: auto;
                border: 1px solid #ccc;
            }

            .records ._record ._label {
                display: inline-block;
                width: 220px;
            }

            .records ._record ._status {
                display: inline-block;
                width: 10px;
            }

            .records ._record .a_rem,
            .records ._record .a_done {
                margin: 0px 10px;
                color: #000;
            }

            
        </style>
    </head>
    <body>
        <div class="records">
            
        </div>
        <a class="a_add">Add new record</a>
    </body>
    <script type="text/javascript" src="./todo.js"></script>
</html>
