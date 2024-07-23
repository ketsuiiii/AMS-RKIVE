@props(['user', 'role'])
@php
    $notifications = [];
    if (isset($user)) {
        $notifications = DB::table('g59_notification')
            ->where('to', $user->department_code)
            ->get();
    }
@endphp


<li class="onhover-dropdown">
    <div class="notification-box">
        <svg>
            <use href="{{ asset('assets/svg/icon-sprite.svg#notification') }}"></use>
        </svg><span class="badge rounded-pill badge-secondary"> {{ count($notifications) }} </span>
    </div>
    <div class="onhover-show-div notification-dropdown">
        <h6 class="f-18 mb-0 dropdown-title">Notifications</h6>
        <ul>
            @forelse ($notifications as $item)
                <li class="b-l-{{ $item->status }} border-4">
                    <a href="{{ route(strtolower($role) . '.new.budget.search') }}"
                        style="text-decoration: none; color: black;"
                        onclick="event.preventDefault(); document.getElementById('search-form').submit();">
                        <b>{{ $item->title }}</b>
                    </a>
                    <p>{{ $item->content }}</p>
                    <p>From: {{ $item->from }}</p>
                    <form id="search-form" action="{{ route(strtolower($role) . '.new.budget.search') }}" method="GET"
                        style="display: none;">
                        <input type="hidden" name="search" value="{{ $item->reference }}">
                        @csrf
                    </form>
                </li>
            @empty
                <li class="b-l-info border-4">
                    No notifications found
                </li>
            @endforelse
        </ul>
    </div>
</li>
