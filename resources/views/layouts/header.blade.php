{{-- Floating Top Button --}}
<button id="topButton" type="button" class="btn btn-primary btn-circle btn-lg" title="Go to top" onclick="topFunction()" style="display: none;"><i class="fa fa-arrow-up"></i></button>
{{-- Navigation Bar --}}
<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <div style="min-width:250px; max-width:250px;">
        <a class="sidebar-toggle text-light mr-3"><i class="fa fa-bars"></i></a>
        @if ( strpos(url()->current(), 'admin') !== false )
            <a class="navbar-brand" href="{{ URL::to('/') }}/admin"><i class="fa fa-code-branch"></i>{{ str_replace('Office', 'Admin', config('app.name', 'Application Name')) }}</a>
        @else
            <a class="navbar-brand" href="{{ URL::to('/') }}"><i class="fa fa-code-branch"></i>{{ config('app.name', 'Application Name') }}</a>
        @endif
    </div>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="fa fa-bars"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        
        <ul class="navbar-nav mr-auto">
            @auth
            <li id="menu_members" class="nav-item">
                <a class="nav-link" href="{{ route('memberList') }}">{{__('messages.top_menu.members')}}</a></li>
            <!-- TODO: This is the temporary menu for member detail view.  It will be remvoed later -->
            <li id="menu_member_detail" class="nav-item">
                <a class="nav-link" href="#">{{__('messages.top_menu.member_details')}}</a></li>
            <li id="menu_finance" class="nav-item hide">
                <a class="nav-link" href="#">{{__('messages.top_menu.finance')}}</a></li>
            <li id="menu_inventory" class="nav-item hide">
                <a class="nav-link" href="#">{{__('messages.top_menu.inventory')}}</a></li>
            @endauth 
        </ul>
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
            <li><a class="btn btn-outline-light btn-sm" href="{{ route('login') }}" role="button">{{ __('Sign In') }}</a></li>
            @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <!-- Dropdown menu for logout -->
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out fa-lg"></i>&nbsp&nbsp&nbsp{{ __('Log Out') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @endguest
           
        </ul>
    </div>
</nav>