<?php
include_once "Router.php";

$Router = new Router(
    [
        "/"          => "example.html",
        "/index.php" => "example.html",
        "/hello"     => "example.html",
        "/index"     => function() {
            echo("It's the index route, and this inscription is derived using the function.");
        },
        "/get"       => function() {
            if (sizeof($_GET) > 0)
                var_dump($_GET);
            else
                throw new Exception("No get params provided", 100);
        }
    ]
);

$Router->serve();
