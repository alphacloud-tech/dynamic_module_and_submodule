@if (Auth::user()->usertype == 1)
    {{-- <li class="list-divider"></li> --}}


    {{-- <li class="submenu">
        <a href="#"><i class="fe fe-vector"></i> <span> Technical Setting</span> <span class="menu-arrow"></span></a>
        <ul style="display: none;">
            <li><a href="{{ url('/sub-module/create') }}">Manage Sub-module</a></li>
            <li><a href="{{ url('/module/create') }}">Manage Module</a></li>
            <li><a href="{{ url('/assign-module/create') }}">User Privileges</a></li>
        </ul>
    </li> --}}

    <li class="nav-item">
        <a class="nav-link menu-link" href="#sidebarAdvanceUI" data-bs-toggle="collapse" role="button" aria-expanded="false"
            aria-controls="sidebarAdvanceUI">
            <i class="ri-settings-2-line"></i> <span data-key="t-advance-ui">
                Technical Setting
            </span>
        </a>
        <div class="collapse menu-dropdown" id="sidebarAdvanceUI">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a href="{{ url('/module/create') }}" class="nav-link" data-key="t-sweet-alerts">Manage Module</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/sub-module/create') }}" class="nav-link" data-key="t-nestable-list">Manage
                        Sub-module</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/assign-module/create') }}" class="nav-link" data-key="t-nestable-list">User
                        Privileges</a>
                </li>

            </ul>
        </div>
    </li>
@endif
