 <!-- ========== App Menu ========== -->
 <div class="app-menu navbar-menu">
     <!-- LOGO -->
     <div class="navbar-brand-box">
         <!-- Dark Logo-->
         <a href="{{ route('dashboard') }}" class="logo logo-dark">
             <span class="logo-sm">
                 <img src=" {{ asset('backend/assets/images/logo-sm.png') }} " alt="" height="22">
             </span>
             <span class="logo-lg">
                 <img src=" {{ asset('backend/') }} assets/images/logo-dark.png" alt="" height="17">
             </span>
         </a>
         <!-- Light Logo-->
         <a href="{{ route('dashboard') }}" class="logo logo-light">
             <span class="logo-sm">
                 <img src=" {{ asset('backend/assets/images/logo-sm.png') }} " alt="" height="22">
             </span>
             <span class="logo-lg">
                 <img src=" {{ asset('backend/assets/images/logo-light.png') }} " alt="" height="17">
             </span>
         </a>
         <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
             id="vertical-hover">
             <i class="ri-record-circle-line"></i>
         </button>
     </div>

     @php
         $userModule = DB::table('assign_role_modules')
             ->join('submodules', 'submodules.id', '=', 'assign_role_modules.submoduleid')
             ->join('modules', 'modules.id', '=', 'submodules.moduleid')
             ->where('assign_role_modules.roleid', '=', Auth::user()->userrole)
             ->where('submodules.status', '=', 1)
             ->groupBy('submodules.moduleid')
             ->groupBy('modules.module')
             ->groupBy('modules.id')
             ->select('modules.module', 'modules.id')
             ->groupBy('modules.module')
             ->groupBy('modules.id')
             ->orderBy('modules.module_rank', 'ASC')
             ->get();
     @endphp

     <div id="scrollbar">
         <div class="container-fluid">

             <div id="two-column-menu">
             </div>
             <ul class="navbar-nav" id="navbar-nav">
                 <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                 <li class="nav-item">
                     <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button"
                         aria-expanded="false" aria-controls="sidebarDashboards">
                         <i class="mdi mdi-speedometer"></i> <span data-key="t-dashboards">Dashboards</span>
                     </a>
                     <div class="collapse menu-dropdown" id="sidebarDashboards">
                         <ul class="nav nav-sm flex-column">
                             <li class="nav-item">
                                 <a href="index.html" class="nav-link" data-key="t-ecommerce"> Ecommerce </a>
                             </li>
                         </ul>
                     </div>
                 </li> <!-- end Dashboard Menu -->

                 <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Pages</span>
                 </li>
                 @if ($userModule)
                     @foreach ($userModule as $module)
                         @php
                             $userLinks = DB::table('assign_role_modules')
                                 ->join('submodules', 'submodules.id', '=', 'assign_role_modules.submoduleid')
                                 ->join('modules', 'modules.id', '=', 'submodules.moduleid')
                                 ->where('assign_role_modules.roleid', '=', Auth::user()->userrole)
                                 ->where('submodules.moduleid', '=', $module->id)
                                 ->where('submodules.status', '=', 1)
                                 ->distinct()
                                 ->select('submodules.*')
                                 ->orderBy('submodules.rank', 'ASC')
                                 ->get();
                         @endphp

                         <li class="nav-item">
                             <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button"
                                 aria-expanded="false" aria-controls="sidebarAuth">
                                 <i class="mdi mdi-account-circle-outline"></i> <span
                                     data-key="t-authentication">Authentication</span>
                             </a>
                             <div class="collapse menu-dropdown" id="sidebarAuth">
                                 <ul class="nav nav-sm flex-column">
                                     <li class="nav-item">
                                         <a href="#sidebarSignIn" class="nav-link" data-bs-toggle="collapse"
                                             role="button" aria-expanded="false" aria-controls="sidebarSignIn"
                                             data-key="t-signin"> Sign
                                             In
                                         </a>
                                         <div class="collapse menu-dropdown" id="sidebarSignIn">
                                             <ul class="nav nav-sm flex-column">
                                                 <li class="nav-item">
                                                     <a href="auth-signin-basic.html" class="nav-link"
                                                         data-key="t-basic">
                                                         Basic </a>
                                                 </li>
                                                 <li class="nav-item">
                                                     <a href="auth-signin-cover.html" class="nav-link"
                                                         data-key="t-cover">
                                                         Cover </a>
                                                 </li>
                                             </ul>
                                         </div>
                                     </li>
                                 </ul>
                             </div>
                         </li>
                     @endforeach
                 @endif


                 <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-components">Settings</span>
                 </li>


                 @include('backend.layouts.techsidemenu')
             </ul>
         </div>
         <!-- Sidebar -->
     </div>

     <div class="sidebar-background"></div>
 </div>
