<?php

namespace App\Utilities;

class PersonName
{
    protected static $titles = [
        "mr", "mrs", "prof", "dr", "mister", "miss", "ms"
    ];

    public static function getPersonName($name)
    {
        $names = array_reverse(preg_split('/(&|and)/', $name));
        $parsed = [];
        foreach ($names as $index => $name) {
            $name = trim($name);
            $formatted = self::parseName($name);
            if(count($formatted)) {
                $parsed[] = $formatted;
            } else if(in_array(strtolower($name), self::$titles) && isset($parsed[$index - 1])) {
                $parsed[] = array_merge($parsed[$index - 1], ["title" => ucfirst($name)]);
            } else {
                $parsed[] = null;
            }
        }
        return $parsed;
    }

    public static function parseName($name)
    {
        $titles = implode("|", self::$titles);
        preg_match("/^(" . $titles .")( {1,}[a-z-]{2,})?( {1,}[a-z-]{1}\.?)?( {1,}[a-z-]*)$/i", $name, $match);
        $users = [];
        if ($match && count($match)) {
            $users = [
                "title" => ucfirst(trim($match[1])),
                "initial" => ucfirst(trim($match[3])),
                "first_name" => ucfirst(trim($match[2])),
                "last_name" => ucfirst(trim($match[4])),
            ];
        }
        return $users;
    }

}