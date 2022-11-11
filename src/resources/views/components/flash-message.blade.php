@php
if (session('flashStatus') === 'info') $bgColor = 'bg-blue-300';
if (session('flashStatus') === 'error') $bgColor = 'bg-red-500';   
@endphp

@if (session('flashMessage'))
    <div {{ $attributes->merge(['class' => $bgColor.' w-1/2 mx-auto p-2 text-white']) }}>
        {{ session('flashMessage') }}
    </div>
@endif