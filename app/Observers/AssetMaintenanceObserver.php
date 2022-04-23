<?php

namespace App\Observers;

use App\Models\Actionlog;
use App\Models\AssetMaintenance;
use App\Models\Setting;
use Auth;

class AssetMaintenanceObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  AssetMaintenance  $assetMaintenance
     * @return void
     */
    public function updating(AssetMaintenance $assetMaintenance)
    {

        // If the asset isn't being checked out or audited, log the update.
        // (Those other actions already create log entries.)
        
            $changed = [];

            foreach ($assetMaintenance->getOriginal() as $key => $value) {
                if ($assetMaintenance->getOriginal()[$key] != $assetMaintenance->getAttributes()[$key]) {
                    $changed[$key]['old'] = $assetMaintenance->getOriginal()[$key];
                    $changed[$key]['new'] = $assetMaintenance->getAttributes()[$key];
                }
            }


            $logAction = new Actionlog();
            $logAction->item_type = AssetMaintenance::class;
            $logAction->item_id = $assetMaintenance->id;
            $logAction->created_at =  date("Y-m-d H:i:s");
            $logAction->user_id = Auth::id();
            $logAction->log_meta = json_encode($changed);
            $logAction->logaction('update');

        

    }


    /**
     * Listen to the Asset created event, and increment 
     * the next_auto_tag_base value in the settings table when i
     * a new asset is created.
     *
     * @param  AssetMaintenance  $assetMaintenance
     * @return void
     */
    public function created(AssetMaintenance $assetMaintenance)
    {

        $logAction = new Actionlog();
        $logAction->item_type = AssetMaintenance::class;
        $logAction->item_id = $assetMaintenance->id;
        $logAction->created_at =  date("Y-m-d H:i:s");
        $logAction->user_id = Auth::id();
        $logAction->logaction('create');

    }

    /**
     * Listen to the Asset deleting event.
     *
     * @param  AssetMaintenance  $assetMaintenance
     * @return void
     */
    public function deleting(AssetMaintenance $assetMaintenance)
    {
        $logAction = new Actionlog();
        $logAction->item_type = AssetMaintenance::class;
        $logAction->item_id = $assetMaintenance->id;
        $logAction->created_at =  date("Y-m-d H:i:s");
        $logAction->user_id = Auth::id();
        $logAction->logaction('delete');
    }
}
