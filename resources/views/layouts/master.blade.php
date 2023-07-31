<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="Keywords"
        content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4" />
@include('layouts.head')
<meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
 
        <!-- alternatively you can use the font awesome icon library if using with `fas` theme (or Bootstrap 4.x) by uncommenting below. -->
        <!-- link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" crossorigin="anonymous" -->
         
        <!-- the fileinput plugin styling CSS file -->
         
</head>

<body class="main-body">
    <!-- Loader -->
    <div id="global-loader">
        <div class="spinner-grow text-info loader-img" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        
    </div>
    <!-- /Loader -->
    @include('layouts.main-sidebar')
    @include('layouts.sidebar')

    <!-- main-content -->
    <div class="main-content app-content">
        @include('layouts.main-header')
        <!-- container -->
        <div class="container-fluid">
            @yield('page-header')
            @yield('content')
            @include('layouts.models')
            @include('layouts.footer')
            @include('layouts.footer-scripts')

            <script>
                Echo.channel('notifications')
                    .listen('.NewNotification', (notification) => {
                        // handle the notification
                    })
            </script>
        </div>
    </div>
    



</body>

</html>

<script>
    setInterval(function() {
        $("#notifications_count").load(window.location.href + " #notifications_count");
        $("#unreadNotifications").load(window.location.href + " #unreadNotifications");
    }, 5000);
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('b2a780cba5cdd4198606', {
        cluster: 'ap1'
    });


    var channel = pusher.subscribe('popup-channel');
    channel.bind('user-register', function(data) {
        toastr.success('لديك مستخدم جديد')
        // alert(JSON.stringify(data))

    });

    var channel2 = pusher.subscribe('popup-channel');
    channel.bind('new-order', function(data) {
        toastr.warning('لديك طلب جديد')
        // alert(JSON.stringify(data))

    });

    var channel3 = pusher.subscribe('popup-channel');
    channel.bind('sim-alert', function(data) {
        toastr.warning('الاشتراك اوشك علي الانتهاء ')
        // alert(JSON.stringify(data))

    });
</script>
