<?php
return [
    '/' => [
        'method' => 'get',
        'target' => 'HomeController@index',
    ],
    '/posts' => array(
        'method' => 'get|post',
        'target' => 'PostController@archive'
    ),

];