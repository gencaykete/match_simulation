<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{storage(setting('favicon'))}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Lig Takip</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{route('home')}}">
                <div class="parent-icon"><i class="bx bx-home-circle"></i>
                </div>
                <div class="menu-title">Puan Durumu</div>
            </a>
        </li>

        <li>
            <a href="{{route('team.index')}}">
                <div class="parent-icon"><i class="bx bx-home-circle"></i>
                </div>
                <div class="menu-title">Takımlar</div>
            </a>
        </li>

        <li>
            <a href="{{route('match.index')}}">
                <div class="parent-icon"><i class="bx bx-home-circle"></i>
                </div>
                <div class="menu-title">Maçlar</div>
            </a>
        </li>

        <li>
            <hr>
        </li>

        <li>
            <a href="{{route('league.advance')}}">
                <div class="parent-icon"><i class="bx bx-right-arrow"></i>
                </div>
                <div class="menu-title">Ligi İlerlet</div>
            </a>
        </li>

        <li>
            <a href="{{route('league.finish')}}">
                <div class="parent-icon"><i class="bx bx-flag"></i>
                </div>
                <div class="menu-title">Ligi Bitir</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>