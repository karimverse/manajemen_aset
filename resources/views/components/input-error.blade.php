@props(['messages'])

 @if ($messages)
     <div {{ $attributes->merge(['class' => 'input-error']) }}> <ul class="mt-1 space-y-1">
             @foreach ((array) $messages as $message)
                 <li>{{ $message }}</li>
             @endforeach
         </ul>
     </div>
 @endif
