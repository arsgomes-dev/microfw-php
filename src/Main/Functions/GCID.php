<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Microfw\Src\Main\Functions;

use Microfw\Src\Main\Common\Settings\MagicalMethods;

/**
 * Description of GCID
 *
 * @author Ricardo Gomes
 */
class GCID {

    use MagicalMethods;

    public function getGeneratorGCID() {
        $timestamp = time();
        $hexa = dechex($timestamp);
        $groupOne = substr($hexa, 0, 4);
        $groupTwo = substr($hexa, 4, 8);
        $groupThree = dechex(rand(0000, 9999));
        $groupFour = dechex(rand(0000, 9999));
        return $groupOne . "-" . $groupTwo . "-" . $groupThree . "-" . $groupFour;
    }

    public function getGeneratorGCID32() {
        $timestamp = time();
        $hexa = dechex($timestamp);
        $groupOne = substr($hexa, 0, 8);
        $groupTwo = dechex(rand(1000, 9999));
        $groupThree = dechex(rand(1000, 9999));
        $groupFour = dechex(rand(1000, 9999));
        $groupFive = dechex(rand(1000, 999999999999));
        $groupFive = dechex(rand(1000, 999999999999));
        echo $groupOne . "-" . $groupTwo . "-" . $groupThree . "-" . $groupFour . "-" . $groupFive;
    }

    public function getGuidv4($data = null) {
        // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
        $data = $data ?? random_bytes(16);
        assert(strlen($data) == 16);

        // Set version to 0100
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        // Set bits 6-7 to 10
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        // Output the 36 character UUID.
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}
