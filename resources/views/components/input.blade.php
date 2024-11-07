@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['style' => 'border: 2px solid #382B19; border-radius: 5px; outline: none; background-color: transparent', 'onfocus' => 'this.style.boxShadow="none";']) !!}>
