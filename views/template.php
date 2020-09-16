<?php


function fillPage($title, $content)
{
    echo "<html xmlns='http://www.w3.org/1999/xhtml'>
        <head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <title>$title</title></head>
        <script src='https://code.jquery.com/jquery-3.5.0.min.js'></script>
        <script src='/project/web/scripts/handler.js'></script>
        <body><div id='content'>$content</div></body>
        </html>";
}


