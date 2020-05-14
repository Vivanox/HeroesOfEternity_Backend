@component('mail::message')
    # Congratulations!

    You have been selected for alpha testing!
    Here is your key.

    {{ $alphaKey->key }}

    Happy testing,
    {{ config('app.name') }}
@endcomponent
