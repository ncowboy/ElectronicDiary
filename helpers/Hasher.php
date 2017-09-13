<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Hasher
 *
 * @author i.borisov
 */
namespace app\helpers;

class Hasher {
    public static function hash($string) {
        return md5($string);
    }
}
