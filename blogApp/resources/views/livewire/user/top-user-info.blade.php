<div class="user-info-dropdown">
    <div class="dropdown">
        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
            <span class="user-icon nav-img">
                <img src="{{ $user->picture }}" alt="" class="rounded-full object-cover" />
            </span>
            <span class="user-name">{{ $user->name }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
            <a class="dropdown-item" href="{{ route('user.profile') }}"><i class="dw dw-user1"></i> Profile</a>
            <a class="dropdown-item" href="{{ route('user.logout') }}"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                    class="dw dw-logout"></i> Log Out</a>
            <form action="{{ route('user.logout') }}" id="logout-form" method="POST">
                @csrf
            </form>
        </div>
    </div>
</div>
