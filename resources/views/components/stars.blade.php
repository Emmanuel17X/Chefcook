@php
    $fullstar2 = floor($note_u);
    $remains2 = ($note_u - $fullstar);
    $halfstar2 = 0;
    if ($remains2 >= 0.5){
        $halfstar = 1;
    }
    $voidstar2 = 5 - $fullstar2 - $halfstar2;
@endphp
@for ($i=0; $i < $fullstar2; $i++)
    <i class="fa-solid fa-star text-yellow-400"></i>
@endfor
@for ($j=0; $j < $halfstar2; $j++)
    <i class="fa-solid fa-star-half-stroke text-yellow-400"></i>
@endfor
@for ($k=0; $k < $voidstar2; $k++)
    <i class="fa-solid fa-star"></i>
@endfor
