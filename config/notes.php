<?php

use App\Models\Note;

return [

    'model' => Note::class,

    /** @phpstan-ignore-next-line */
    'user' => \App\Models\User::class,

];