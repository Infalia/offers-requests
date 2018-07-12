<?php

namespace App\Http\Terranet\Administrator\Modules;

use Terranet\Administrator\Filters\FilterElement;
use Terranet\Administrator\Modules\Users as CoreUsersModule;

/**
 * Administrator Users Module.
 */
class Users extends CoreUsersModule
{
    public function columns()
    {
        return $this->scaffoldColumns()
                    ->without(['id']);
    }
}
