<?php

namespace App\Services\HomeOwner;

use Maatwebsite\Excel\Facades\Excel;
use App\Interfaces\FileImportManager;
use App\Utilities\PersonName;

class StoreService implements FileImportManager
{
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function run()
    {
        $homeowners = $this->import($this->request);
        array_shift($homeowners);
        $users = [];
        foreach ($homeowners as $name) {
            $users = array_merge($users, PersonName::getPersonName($name[0]));
        }            
        //Since we are not persisting the data in the database, let's put the records in the session so we could access the data on the same page.
        if (session()->has('users')) {
            session()->forget('users');
        }
        session()->put('users', $users);
    }

    public function import()
    {
        return Excel::toArray([], $this->request)[0];
    }
}