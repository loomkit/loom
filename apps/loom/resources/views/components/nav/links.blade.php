@props([
    'mobile' => false
])
<x-nav.link href="#about" text="About" :$mobile {{ $attributes }}/>
<x-nav.link href="#features" text="Features" :$mobile {{ $attributes }}/>
<x-nav.link href="#pricing" text="Pricing" :$mobile {{ $attributes }}/>
<x-nav.link href="#docs" text="Documentation" :$mobile {{ $attributes }}/>
<x-nav.link href="#contact" text="Contact" :$mobile {{ $attributes }}/>
