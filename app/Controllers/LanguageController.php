<?php

namespace App\Controllers;

use App\Controllers\BoroumeController;

class LanguageController extends BoroumeController
{
    public function switchLanguage($locale)
    {
        $session = session();
        $session->remove('lang');
        $session->set('lang', $locale);
        return redirect()->back();
    }
}

