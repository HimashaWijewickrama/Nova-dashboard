<?php

namespace App\Observers;

use App\Models\User;
use Laravel\Nova\Notifications\NovaNotification;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {

        $this->getNovaNotifivcation($user, 'New User: ', 'success');
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        $this->getNovaNotifivcation($user, 'Updated User: ', 'warning');

    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        $this->getNovaNotifivcation($user, 'Deleted User: ', 'error');

    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        $this->getNovaNotifivcation($user, 'Restored User: ', 'info');

    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        $this->getNovaNotifivcation($user, 'Force Deleted User: ', 'error');

    }

    private function getNovaNotifivcation($user, $message, $type)
    {
        foreach (User::all() as $u) {
            $u->notify(NovaNotification::make()
                ->message($message . ' ' . $user->name)
                ->icon('user')
                ->type($type));
        }
    }
}
