<?php

namespace App\Observers;

use App\Models\Notes_recette;

class Notes_recetteObserver
{
    /**
     * Handle the Notes_recette "created" event.
     */
    public function created(Notes_recette $notes_recette): void
    {
        //
    }

    /**
     * Handle the Notes_recette "updated" event.
     */
    public function updated(Notes_recette $notes_recette): void
    {
        //
    }

    /**
     * Handle the Notes_recette "deleted" event.
     */
    public function deleted(Notes_recette $notes_recette): void
    {
        //
    }

    /**
     * Handle the Notes_recette "restored" event.
     */
    public function restored(Notes_recette $notes_recette): void
    {
        //
    }

    /**
     * Handle the Notes_recette "force deleted" event.
     */
    public function forceDeleted(Notes_recette $notes_recette): void
    {
        //
    }

    public function saved(Notes_recette $note1){
        $note1->recette->update([
            'note' => $note1->recette->notes_recettes->avg('value')
        ]);
    }
}
