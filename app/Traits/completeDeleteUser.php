<?php

namespace App\Traits;

use DB;
use App\Models\Users\User;

trait completeDeleteUser
{
    /**
    * Ensures that the parent item is deleted and deletes itself
    *
    * @return boolean
    */
    public function completeDeleteUser()
    {
        DB::transaction(function () {
            try {
                $this->user()->delete();
                $this->delete();
            } catch (\Exception $e) {
                return false;
            }
        });
        return true;
    }
}
