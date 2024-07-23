@props(['user'])
@php
    $logs = [];
    if (isset($user)) {
        $logs = DB::table('g59_logs')
            ->where('user_id', $user->username)
            ->get();
    }
@endphp

<li class="onhover-dropdown">
    <div class="notification-box">
        <svg>
            <use href="{{ asset('assets/svg/icon-sprite.svg#notification') }}"></use>
        </svg><span class="badge rounded-pill badge-secondary"> {{ count($logs) }} </span>
    </div>
    <div class="onhover-show-div notification-dropdown">
        <h6 class="f-18 mb-0 dropdown-title">Notitications </h6>
        <ul>

            @forelse ($logs as $item)
                @if ($item->status == 'success')
                    <li class="b-l-success border-4">
                        {{ $item->message }}
                    </li>
                @elseif ($item->status == 'multi-error')
                    <li class="b-l-danger border-4">
                        @php
                            $message = json_decode($item->message, true);

                            // Initialize an empty array to store formatted messages
                            $formattedMessages = [];

                            // Iterate over each key-value pair in the message
                            foreach ($message as $key => $value) {
                                // Format the message and add it to the formattedMessages array
                                $formattedMessages[] = "- $key: $value[0]";
                            }

                            // Apply nl2br() to insert line breaks
                            $formattedMessage = nl2br(implode("\n", $formattedMessages));
                            // Output the formatted message
                            echo $formattedMessage;
                        @endphp
                    </li>
                @endif
            @empty
                <li><a class="f-w-700" href="#">Check all</a></li>
            @endforelse
        </ul>
    </div>
</li>
