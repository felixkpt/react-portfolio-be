<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $about->name }} - Resume</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        html,
        body {
            font-size: 16px !important;
        }


        .custom-container {
            margin-bottom: 16px;
            padding: 0;
        }

        .resume-header {
            height: 210px !important;
            overflow: hidden;
            width: 100%;
            margin: 0;
            background: #434E5E !important;
            color: rgba(255, 255, 255, 0.9) !important;
            margin-bottom: 16px;
        }

        .resume-header .contact-link {
            cursor: pointer;
            color: rgba(255, 255, 255, 0.6) !important;
        }

        .resume-header .contact-link:hover {
            color: white !important;
            text-decoration: underline;
        }


        .resume-table {
            width: 100%;
            border-collapse: collapse;
            border: none;
            padding: 0 5px !important;
            margin: 0;
            border-radius: 8px;
        }

        .resume-table td {
            vertical-align: top;
            padding: 0;
        }

        .image-container {
            width: 100%;
            height: 100%;
        }

        .image-container img {
            width: 100%;
            height: 100%;
        }

        .name-title {
            margin: 0;
        }

        .slogan {
            margin-bottom: 8px;
        }

        .section-divider {
            border: none;
            border-top: 1px solid #000;
        }

        .resume-section-title {
            font-size: 1.7rem;
            position: relative;
            color: #434E5E;
        }

        .resume-sub-title {
            font-size: 1.3rem;
            color: #434E5E !important;
            text-decoration: none;
        }

        .resume-sub-title:hover {
            color: #434E5E !important;
        }

        .resume-sub-title-sm {
            font-size: 1rem;
            color: #434E5E !important;
            text-decoration: none;
        }

        .resume-sub-title-sm:hover {
            color: #434E5E !important;
        }

        .cursor-default {
            cursor: default;
        }

        .col-auto {
            flex: 0 0 auto;
            width: auto;
        }

        /* Avoid page break after the about section */
        .no-page-break {
            page-break-inside: avoid;
            break-inside: avoid;
        }

        /* Force page break after the first table row set */
        .page-break {
            page-break-after: always;
            break-after: page;
        }

        .custom-progress-bar {
            background-color: #ccc;
            border-radius: 4px;
            overflow: hidden;
            height: 12px;
            margin-top: 5px;
        }

        .custom-progress {
            background-color: #434E5E;
            height: 100%;
            border-radius: 4px;
            transition: width 0.3s ease-in-out;
        }


        .companies-card {
            font-size: 0.85rem;
            border-radius: 0.25rem;
            background: #434E5E;
            color: white;
            padding: 5px 10px;
            margin: 5px;
            display: inline-block;
            cursor: default;
        }

        .pb-2 {
            padding-bottom: 10px;
        }

        .pt-0 {
            padding-top: 0;
        }

        .d-flex {
            display: flex;
        }

        .flex-wrap {
            flex-wrap: wrap;
        }

        .cursor-default {
            cursor: default;
        }

        .text-black-50 {
            color: rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body>
    @yield('content')
</body>

</html>
