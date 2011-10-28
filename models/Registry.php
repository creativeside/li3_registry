<?php

namespace li3_registry\models;

class Registry extends \lithium\data\Model {

    protected $_schema = array(
        'key' => array('type' => 'id'),
        'value' => array('type' => 'string', 'null' => false),
    );

    /*
     * Writes new key with it's value to the registry collection or -table or
     * updates the key when it does already exist.
     */
    static function write($key, $value) {

        // When update
        if (self::exists($key)) {
            return self::update(array('value' => $value), array('conditions' => array('key' => $key)));
        }

        // When create
        else {
            return self::create(array('key' => $key, 'value' => $value))->save();
        }
    }

    /*
     * Reads the key's value or when it does not exist, return $default
     */
    static function read($key, $default = null) {
        if (self::exists($key)) {
            $result = self::first(array('conditions' => array('key' => $key)));
            return $result['value'];
        } else {
            return $default;
        }
    }

    /*
     * Checks if the key does exist
     * @return bool
     */
    static function exists($key) {
        return (self::count(array('conditions' => array('key' => $key))));
    }

}