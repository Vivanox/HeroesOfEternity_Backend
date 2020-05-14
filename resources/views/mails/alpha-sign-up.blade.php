@component('mail::message')
    # Thanks for signing up for {{ config('app.name') }} Alpha!

    With any luck, you'll receive an alpha key soon.

    Thanks,
    {{ config('app.name') }}
@endcomponent
