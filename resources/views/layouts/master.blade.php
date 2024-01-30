<!doctype html>
<!--<html lang="tr" class="color-sidebar sidebarcolor1 color-header headercolor1">-->
<html lang="tr" class="color-sidebar sidebarcolor8">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{storage(setting('favicon'))}}" type="image/png" />
    <!--plugins-->
    <link href="/backend/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="/backend/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="/backend/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <link href="/backend/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-responsive-bs4/2.4.0/responsive.bootstrap4.css"/>
    <!-- loader-->
    <link href="/backend/css/pace.min.css" rel="stylesheet" />
    <script src="/backend/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="/backend/css/bootstrap.min.css" rel="stylesheet">
    <link href="/backend/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    <link href="/backend/css/app.css" rel="stylesheet">
    <link href="/backend/css/icons.css" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="/backend/css/dark-theme.css" />
    <link rel="stylesheet" href="/backend/css/semi-dark.css" />
    <link rel="stylesheet" href="/backend/css/header-colors.css" />

    <link href="/backend/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="/backend/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />

    <title>@yield('title','Maç Takip Sistemi')</title>
</head>

<body>
<!--wrapper-->
<div class="wrapper">
    <!--sidebar wrapper -->
    @include('layouts.menu')
    <!--end sidebar wrapper -->
    <!--start header -->
    @include('layouts.header')
    <!--end header -->
    <!--start page wrapper -->
    @yield('content')
    <!--end page wrapper -->
    <!--start overlay-->
    @include('layouts.footer')
</div>
<!--end wrapper-->
<!-- Bootstrap JS -->
<script src="/backend/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="/backend/plugins/simplebar/js/simplebar.min.js"></script>
<script src="/backend/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="/backend/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="/backend/plugins/chartjs/chart.min.js"></script>
<script src="/backend/plugins/peity/jquery.peity.min.js"></script>
<script src="/backend/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="/backend/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-responsive-bs4/2.4.0/responsive.bootstrap4.min.js"></script>
@if(request()->routeIs('home'))
    <script src="/backend/js/dashboard-eCommerce.js"></script>

    <script>
        new PerfectScrollbar('.product-list');
        new PerfectScrollbar('.customers-list');
    </script>
@endif

{{-- Cdn --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.8/jquery.mask.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.tiny.cloud/1/l15hrkm1n7u234c8zwlxgoqjmxxysx00u8mt4k62zgndxi2k/tinymce/6/tinymce.min.js?apikey=l15hrkm1n7u234c8zwlxgoqjmxxysx00u8mt4k62zgndxi2k" referrerpolicy="origin"></script>
<script src="/backend/plugins/select2/js/select2.min.js"></script>
<script src="/backend/js/jquery.mask.min.js"></script>

<script src="/backend/js/app.js"></script>

<!-- Custom JS -->
<script>
    let csrf_token = "{{csrf_token()}}";
    let ajax_urls = {
        'updateFeaturedUrl' : ''
    }
</script>
<script src="/backend/custom/js/main.js"></script>
@yield('page-scripts')

<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    @if(session('response'))
    Toast.fire({
        icon: '{{session('response.status')}}',
        title: '{{session('response.message')}}'
    })
    @endif
</script>

</body>

</html>
