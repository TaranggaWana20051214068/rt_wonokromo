<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class SessionHelper extends Model
{
    /**
     * Sets a success message in the session flash data.
     *
     * @param string $message The success message to be displayed.
     * @return void
     */
    public static function setSuccessMessage($message)
    {
        Session::flash('sweetAlert', [
            'icon' => 'success',
            'title' => $message
        ]);
        Session::flash('success', $message);
    }

    public static function setErrorMessage($message)
    {
        Session::flash('sweetAlert', [
            'icon' => 'error',
            'title' => $message
        ]);
    }
}
