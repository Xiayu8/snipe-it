<?php

namespace App\Policies;

class AssetMaintenancePolicy extends SnipePermissionsPolicy
{
    protected function columnName()
    {
        return 'assetMaintenances';
    }
}
