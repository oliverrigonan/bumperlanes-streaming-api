<?php

namespace App\Observers;

use \Carbon\Carbon;

use App\Models\Provider;
use App\Models\ProviderLog;

class ProviderObserver
{

    /**
     * Handle the Provider "created" event.
     *
     * @param  \App\Models\Provider  $provider
     * @return void
     */
    public function created(Provider $provider)
    {
        //
    }

    /**
     * Handle the Provider "updated" event.
     *
     * @param  \App\Models\Provider  $provider
     * @return void
     */
    public function updated(Provider $provider)
    {
        $provider_log = new ProviderLog;
        
        $provider_log->log_date = Carbon::now();
        $provider_log->provider_id = $provider->id;
        $provider_log->modified_by =  $provider->modified_by;

        
        $modified_fields = [];
        $old_values = [];
        $new_value = [];
        $changes = json_encode($provider->getChanges());
/*         foreach ($changes as $change) {
            array_push($modified_fields, $change
        } */

        $modified_field = json_encode($modified_fields);
        $old_value = json_encode($old_values);
        $new_value = json_encode($new_values);

        $provider_log->modified_field = $modified_field;
        $provider_log->old_value = $old_value;
        $provider_log->new_value = $new_value;

        $provider_log->save();
    }

    /**
     * Handle the Provider "deleted" event.
     *
     * @param  \App\Models\Provider  $provider
     * @return void
     */
    public function deleted(Provider $provider)
    {
        //
    }

    /**
     * Handle the Provider "restored" event.
     *
     * @param  \App\Models\Provider  $provider
     * @return void
     */
    public function restored(Provider $provider)
    {
        //
    }

    /**
     * Handle the Provider "force deleted" event.
     *
     * @param  \App\Models\Provider  $provider
     * @return void
     */
    public function forceDeleted(Provider $provider)
    {
        //
    }
}
