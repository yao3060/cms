<?php
/**
 * Created by PhpStorm.
 * User: Yao
 * Date: 2018/11/21
 * Time: 21:34
 */
?>
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div style="width: 600px;  margin: auto; border: 1px solid #ccc;">

        <header style="text-align: center; height: 100px; border-bottom: 1px solid #ccc; line-height: 100px">Header</header>

        <section style="min-height: 200px;">

            <h1>{{ $lastName }}</h1>
            <h2>{{ $firstName }}</h2>

        </section>

        <footer style="text-align: center;height: 100px; border-top: 1px solid #ccc; line-height: 100px">Footer</footer>

    </div>
</body>
</html>

