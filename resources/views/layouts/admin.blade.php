<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
   <title>Dashboard Massclo </title>
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
   <!-- BEGIN GLOBAL MANDATORY STYLES -->
   <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
   <link href="{{ asset('admin_theme/admin/') }}/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
   <link href="{{ asset('admin_theme/admin/') }}/assets/css/plugins.css" rel="stylesheet" type="text/css" />
   <link rel="stylesheet" type="text/css" href="{{ asset('admin_theme/admin/') }}/assets/css/forms/switches.css">
   <link href="{{ asset('admin_theme/admin/') }}/assets/css/components/tabs-accordian/custom-tabs.css" rel="stylesheet" type="text/css" />
   <link rel="stylesheet" type="text/css" href="{{ asset('admin_theme/admin/') }}/assets/css/widgets/modules-widgets.css">
   <link href="{{ asset('admin_theme/admin/') }}/plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />
   <link href="{{ asset('admin_theme/admin/') }}/assets/css/components/custom-modal.css" rel="stylesheet" type="text/css" />
   <link href="{{ asset('admin_theme/admin/') }}/assets/css/elements/breadcrumb.css" rel="stylesheet" type="text/css" />
   <link href="{{ asset('admin_theme/admin') }}/assets/css/forms/theme-checkbox-radio.css" rel="stylesheet" type="text/css">

   <link href="{{ asset('admin_theme/assets/js') }}/fileuploader/dist/font/font-fileuploader.css" media="all" rel="stylesheet">
   <link href="{{ asset('admin_theme/assets/js') }}/fileuploader/dist/jquery.fileuploader.min.css" media="all" rel="stylesheet">
   <link rel="stylesheet" href="{{ asset('admin_theme/admin/') }}/plugins/select2/select2.min.css">
   <link href="{{ asset('admin_theme') }}/assets/js/multiselect/css/multi-select.css" media="screen" rel="stylesheet" type="text/css">
   <!-- END GLOBAL MANDATORY STYLES -->

   <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->

   <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
   <link rel="stylesheet" type="text/css" href="{{ asset('admin_theme') }}/assets/js/bootstrap-fileinput/bootstrap-fileinput.css"/>
   <link rel="stylesheet" href="{{ asset('admin_theme') }}/assets/css/nestable.css?v={{ time() }}">
   <link rel="stylesheet" href="{{ asset('admin_theme') }}/assets/css/admin.css?v={{ time() }}">
   <link href="/css/loader.css" rel="stylesheet" type="text/css">

   <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

   <script src="{{ asset('admin_theme/admin/') }}/assets/js/libs/jquery-3.1.1.min.js"></script>
   <script>
      const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      const adminArea  = '{{ config("admin.path") }}';
      const editors = {};
      const ajaxPath     = '{{ config("admin.path") }}/ajax';
   </script>

</head>
<body data-spy="scroll"  data-offset="100">

<!--  BEGIN NAVBAR  -->
<div class="header-container fixed-top">
   <header class="header navbar navbar-expand-sm">

{{--      <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>--}}

      <ul class="navbar-item flex-row ml-auto">

         <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
            <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>
            </a>
            <div class="dropdown-menu position-absolute e-animated e-fadeInUp" aria-labelledby="userProfileDropdown">
               <div class="user-profile-section">
                  <div class="media mx-auto">
                     <div class="media-body">
                        <h5>{{ Auth::user()->name }}</h5>
                     </div>
                  </div>
               </div>
               <div class="dropdown-item">
                  <a href="/{{ config('admin.path') }}/profile/">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                     <span>Мой профиль</span>
                  </a>
               </div>
               <div class="dropdown-item">
                  <a href="{{ route('admin_logout') }}">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                     <span>Выйти</span>
                  </a>
               </div>
            </div>
         </li>
      </ul>
   </header>
</div>
<!--  END NAVBAR  -->

<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">

   <div class="overlay"></div>
   <div class="cs-overlay"></div>
   <div class="search-overlay"></div>

   <!--  BEGIN SIDEBAR  -->
   <div class="sidebar-wrapper sidebar-theme">

      <div id="dismiss" class="d-lg-none"><i class="flaticon-cancel-12"></i></div>

      <nav id="sidebar">

         <ul class="navbar-nav theme-brand flex-row  text-center">
            <li class="nav-item theme-logo">
               <a href="/">
                  <img src="/img/logo.png" class="navbar-logo" alt="logo">
               </a>
            </li>
         </ul>

         <ul class="list-unstyled menu-categories" id="accordionExample">

            @php
               $menu = adminMenu();
            @endphp
            @foreach($menu as $key => $value)
               @if (!empty($value['view']))
                  @php
                     $open='';
                     if ($key == 'clients') {
                        $open = \App\Models\User::count();
                     }

                     if ($open) {
                        $open = "<span class='badge badge-roundless badge-danger'>+{$open}</span>";
                     } else{
                        $open = '';
                     }
                     $active = (uri(2) == $key) ? 'active' : '';
                  @endphp

                  <li class="menu {{ $active }}">
                     <a
                       @if(!empty($value['childs']))
                           href="#menu-{{ $key }}" data-toggle="collapse" aria-expanded="false"
                       @else
                           href="{{ @$value['link'] }}"
                       @endif
                       class="dropdown-toggle"
                     >
                        <div class="">
                           {!! $value['icon'] !!}
                           <span>{{ $value['name'] }}</span>
                        </div>

                        @if(!empty($value['childs']))
                           <div>
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                           </div>
                        @endif
                     </a>
                     @if(!empty($value['childs']))
                        <ul class="collapse submenu list-unstyled {{ $active ? 'show' : '' }}"
                            id="menu-{{ $key }}"
                            data-parent="#accordionExample">
                           @foreach($value['childs'] as $child)
                              <?php
                                 $byFullUrl = (\Request::path() == rtrim(trim($child['link'], '/'), '/')) ? true : false;
                                 $active = $byFullUrl ? 'active' : '';
                              ?>
                              <li class="{{ $active }}">
                                 <a href="{{ $child['link'] }}">{{ $child['name'] }}</a>
                              </li>
                           @endforeach
                        </ul>
                     @endif
                  </li>
               @endif
            @endforeach

            @if(\Auth::user()->id == 1)
               <li class="menu">
                  <a href="{{ asset('admin_theme/admin/fonticons.html') }}" class="dropdown-toggle" target="_blank">
                     <div>
                        <i data-feather="target"></i>
                        <span>Icons</span>
                     </div>
                  </a>
               </li>
            @endif
         </ul>
      </nav>

   </div>
   <!--  END SIDEBAR  -->

   <!--  BEGIN CONTENT AREA  -->
   <div id="content" class="main-content">
      <div class="layout-px-spacing" style="margin-bottom: 50px;">

         <nav class="breadcrumb-one" aria-label="breadcrumb" style="margin-top: 20px;">
            <ol class="breadcrumb">

               <li class="breadcrumb-item">
                  <a href="{{ route('admin_menu') }}">
                     <i data-feather="home"></i>
                  </a>
               </li>

               <li class="breadcrumb-item">
                  <a href="<?=$menu[uri(2)]['link']?>"><?=$menu[uri(2)]['name']?></a>
               </li>
               <?php if (!empty($menu[uri(2)]['childs']) && uri(3)): ?>
                  <li class="breadcrumb-item">
                     <a href="<?=$menu[uri(2)]['childs'][uri(3)]['link']?>" style="text-decoration:none; cursor:pointer;"><?=$menu[uri(2)]['childs'][uri(3)]['name']?></a>

                  </li>
                  <?php if (uri(4)): ?>
                     <?php if (!empty($crumbs)): ?>
                                    <?php echo $crumbs; ?>
                                 <?php else: ?>
                     <li class="breadcrumb-item">
                        <a href="javascript:;" style="text-decoration:none; cursor:pointer;">Редактировать</a>
                     </li>
                     <?php endif ?>
                  <?php endif ?>
               <?php elseif(uri(3)): ?>
                     <?php if (!empty($crumbs)): ?>
                        <?php echo $crumbs; ?>
                     <?php else: ?>
                     <li class="breadcrumb-item">
                        <a href="javascript:;" style="text-decoration:none; cursor:pointer;">Редактировать</a>
                     </li>
                  <?php endif ?>
               <?php endif ?>
            </ol>
         </nav>

         <div class="page-header">
            <div class="page-title">
               <h3><?=!empty($pageTitle) ? $pageTitle : $menu[uri(2)]['name']?></h3>
            </div>
         </div>

         @yield('content')

      </div>
   </div>
   <!--  END CONTENT AREA  -->

</div>
<!-- END MAIN CONTAINER -->

<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset('admin_theme/admin/') }}/bootstrap/js/popper.min.js"></script>
<script src="{{ asset('admin_theme/admin/') }}/bootstrap/js/bootstrap.min.js"></script>
<script src="{{ asset('admin_theme/admin/') }}/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="{{ asset('admin_theme/admin/') }}/assets/js/app.js?v={{ time() }}"></script>
<script>
   $(document).ready(function() {
      App.init();
   });
</script>

<script src="{{ asset('admin_theme/admin/') }}/assets/js/custom.js"></script>
<script src="{{ asset('admin_theme/admin/') }}/plugins/font-icons/feather/feather.min.js"></script>
<script src="{{ asset('admin_theme/admin/') }}/plugins/notification/snackbar/snackbar.min.js"></script>

<script src="{{ asset('admin_theme/admin/') }}/plugins/select2/select2.min.js"></script>

<script type="text/javascript" src="{{ asset('admin_theme') }}/assets/js/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/19.1.1/decoupled-document/ckeditor.js"></script>
<script src="{{ asset('admin_theme/assets/js') }}/fileuploader/dist/jquery.fileuploader.min.js" type="text/javascript"></script>
<script src="{{ asset('admin_theme') }}/assets/js/multiselect/js/jquery.multi-select.js" type="text/javascript"></script>

<script src="{{ asset('admin_theme') }}/assets/js/quicksearch.js" type="text/javascript"></script>

<script type="text/javascript">
   feather.replace();
</script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- BEGIN MAIN SCRIPTS -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" integrity="sha256-xNjb53/rY+WmG+4L6tTl9m6PpqknWZvRt0rO1SRnJzw=" crossorigin="anonymous"></script>
<script src="{{ asset('admin_theme') }}/assets/js/jquery.nestable.js" type="text/javascript"></script>
<script src="{{ asset('admin_theme') }}/assets/js/ajax.js?v={{ time() }}" type="text/javascript"></script>
<script src="/js/catalog.js?v={{ time() }}" type="text/javascript"></script>
<script src="{{ asset('admin_theme') }}/assets/js/custom.js?v={{ time() }}" type="text/javascript"></script>
<script src="/js/ckinit.js" type="text/javascript"></script>

</body>
</html>