<!DOCTYPE html>
<html>
<head>
    <!--
      If you are serving your web app in a path other than the root, change the
      href value below to reflect the base path you are serving from.

      The path provided below has to start and end with a slash "/" in order for
      it to work correctly.

      Fore more details:
      * https://developer.mozilla.org/en-US/docs/Web/HTML/Element/base
    -->
    <base href="/">

    <meta charset="UTF-8">
    <meta content="IE=Edge" http-equiv="X-UA-Compatible">
    <meta name="description" content="A new Flutter project.">

    <!-- iOS meta tags & icons -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="puzzle">
    <link rel="apple-touch-icon" href="icons/Icon-192.png">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="favicon.png"/>

    <title>puzzle</title>
{{--    <link rel="manifest" href="manifest.json">--}}
</head>
<style>
    .loading {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
    }

    .loader {
        border: 16px solid #60a53a;
        border-radius: 50%;
        border: 15px solid ;
        border-top: 16px solid #60a53a;
        border-right: 16px solid white;
        border-bottom: 16px solid #60a53a;
        border-left: 16px solid white;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }

    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>
<body>
<div class="loading">
    <div class="loader"></div>
</div>

<script src="main.dart.js" type="application/javascript"></script>
</body>
</html>