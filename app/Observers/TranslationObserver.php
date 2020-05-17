<?php

namespace App\Observers;

use App\Translation;

class TranslationObserver
{
    /**
     * Handle the translation "created" event.
     *
     * @param  \App\Translation  $translation
     * @return void
     */
    public function created(Translation $translation)
    {
        //
    }

    /**
     * Handle the translation "updated" event.
     *
     * @param  \App\Translation  $translation
     * @return void
     */
    public function updated(Translation $translation)
    {
        //
    }

    /**
     * Handle the translation "deleted" event.
     *
     * @param  \App\Translation  $translation
     * @return void
     */
    public function deleted(Translation $translation)
    {
        //
    }

    /**
     * Handle the translation "restored" event.
     *
     * @param  \App\Translation  $translation
     * @return void
     */
    public function restored(Translation $translation)
    {
        //
    }

    /**
     * Handle the translation "force deleted" event.
     *
     * @param  \App\Translation  $translation
     * @return void
     */
    public function forceDeleted(Translation $translation)
    {
        //
    }
}
