<?php

if (!function_exists('validateData')) {
    /**
     * Returns whether the instance is of CompanyAdmin.
     *
     * @param  User $userable
     * @return Boolean
     */
    function validateData(array $data, $rules)
    {
        return Illuminate\Support\Facades\Validator::make($data, $rules)->validate();
    }
}

if (!function_exists('isSuperAdmin')) {
    /**
     * Returns whether the instance is of CompanyAdmin.
     *
     * @param  User $userable
     * @return Boolean
     */
    function isSuperAdmin($userable)
    {
        return ($userable instanceof \App\Models\Users\SuperAdministrator);
    }
}
