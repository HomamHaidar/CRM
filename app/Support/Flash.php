<?php

namespace App\Support;

class Flash
{
    public function success(string $message, string $title = 'Success'): void
    {
        session()->flash('flash', [
            'type'    => 'success',
            'title'   => $title,
            'message' => $message,
        ]);
    }

    public function error(string $message, string $title = 'Error'): void
    {
        session()->flash('flash', [
            'type'    => 'error',
            'title'   => $title,
            'message' => $message,
        ]);
    }

    public function info(string $message, string $title = 'Info'): void
    {
        session()->flash('flash', [
            'type'    => 'info',
            'title'   => $title,
            'message' => $message,
        ]);
    }
}
