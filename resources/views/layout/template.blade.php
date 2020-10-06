<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>
        @yield('title')
    </title>
</head>
<body>
<div id="app">
    <header-component></header-component>
    <div id="main">
        @yield('content')
    </div>
    <footer-component></footer-component>
</div>
    <script src="/js/app.js"></script>
</body>
</html>