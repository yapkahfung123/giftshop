<?php

class Postcode
{

    //return false if the postcode is invalid
    //return string 'east' / 'west' if it is valid

    //if(!Postcode::validate($postcode)) use this to validate

    public static $data = array(
        "west" => array(
            "Perlis" => array(
                array(
                    "from" => "01000", "to" => "02999",
                )
            ),
            "Kedah" => array(
                array("from" => "05000", "to" => "09810",),
                array("from" => "14290", "to" => "14290",),
                array("from" => "14390", "to" => "14390",),
                array("from" => "34950", "to" => "34950",),
            ),
            "Pulau Pinang" => array(
                array(
                    "from" => "10000", "to" => "14400",
                )
            ),
            "Kelatan" => array(
                array(
                    "from" => "15000", "to" => "18500",
                )
            ),
            "Terengganu" => array(
                array(
                    "from" => "20000", "to" => "24300",
                )
            ),
            "Pahang" => array(
                array("from" => "25000", "to" => "28800",),
                array("from" => "39000", "to" => "39200",),
                array("from" => "49000", "to" => "49000",),
                array("from" => "69000", "to" => "69000",),
            ),
            "Perak" => array(
                array(
                    "from" => "30000", "to" => "36810",
                )
            ),
            "Selangor" => array(
                array("from" => "40000", "to" => "48300",),
                array("from" => "63000", "to" => "68100",),
            ),
            "Kuala Lumpur" => array(
                array("from" => "50000", "to" => "60000",),
                array("from" => "50000", "to" => "60000",),
            ),
            "Putrajaya" => array(
                array(
                    "from" => "62000", "to" => "62988",
                )
            ),
            "Negeri Sembilan" => array(
                array(
                    "from" => "70000", "to" => "73509",
                )
            ),
            "Melaka" => array(
                array(
                    "from" => "75000", "to" => "78309",
                )
            ),
            "Johor" => array(
                array(
                    "from" => "79000", "to" => "86900",
                )
            ),
        ),
        "east" => array(
            "Labuan" => array(
                array(
                    "from" => "87000", "to" => "87033",
                )
            ),
            "Sabah" => array(
                array(
                    "from" => "88000", "to" => "91309",
                )
            ),
            "Sarawak" => array(
                array(
                    "from" => "93000", "to" => "98859",
                )
            ),
        ),
    );

    public static function validate($postcode)
    {
        $postcode = trim($postcode);

        if (preg_match("/[a-z]/i", $postcode)) return false;

        if (strlen($postcode) != 5) return false;

        $postcode = (int)$postcode;

        //do validation
        return self::check($postcode, 'exist');
    }

    public static function getRegions()
    {
        return self::$data;
    }

    public static function getStates()
    {
        return array_merge(self::$data['west'], self::$data['east']);
    }

    public static function getEastStates()
    {
        return self::$data['east'];
    }

    public static function getWestStates()
    {
        return self::$data['west'];
    }

    public static function checkState($postcode)
    {
        return self::check($postcode, 'state');
    }

    public static function checkRegion($postcode)
    {
        return self::check($postcode, 'region');
    }

    public static function check($postcode, $type)
    {
        foreach (self::$data as $region_name => $states) {
            foreach ($states as $state_name => $state_info) {
                foreach ($state_info as $state_range) {
                    if (in_array($postcode, range($state_range['from'], $state_range['to']))) {
                        if ($type == 'state') {
                            return $state_name;
                        } else if ($type == 'region') {
                            return $region_name;
                        } else {
                            return true;
                        }
                    }
                }
            }
        }

        return false;
    }

}