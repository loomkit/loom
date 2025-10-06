@props([
    'mobile' => false,
])
@auth
<x-nav.button :href="route('dashboard')" text="Dashboard" $mobile {{ $attributes }}/>
@else
<x-nav.button :href="route('login')" text="Login" $mobile {{ $attributes }}/>
@endif
