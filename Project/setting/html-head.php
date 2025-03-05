<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= empty($title) ? '海優斯健康管理平台' : "$title - 海優斯健康管理平台" ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!--bootstrap-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.2/css/bootstrap.min.css">
    <!--bootstrap icon-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <!--jquery-->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
        }
        .sidebar {
            width: 250px; /* 設定導覽列寬度 */
            background-color: #f8f9fa; /* 設定導覽列背景顏色 */
            padding: 20px;
        }
        .sidebar-brand {
            text-align: center;
            margin-bottom: 20px;
        }
        .sidebar-nav .nav-link {
            padding: 10px;
            color: #333;
        }
        .sidebar-nav .nav-link.active {
            background-color: #e9ecef; /* 設定活動連結背景顏色 */
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
        .list-group-item {
            border-bottom: none;
            font-weight: bold;
            font-size: large;
        }
        .form-text {
        color: red;
        font-weight: bold;
    }
    </style>
</head>

<body class="bg-white" style="overflow-x:hidden">