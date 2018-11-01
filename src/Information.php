<?php

/**
 * This file implements the container used to store the data, provided by the HTTP client (here, Curl), that gives
 * information about a request execution.
 */

namespace dbeurive\Http;

/**
 * Class ExecutionInformation
 *
 * This class implements the container used to store the data, provided by the HTTP client (here, Curl), that gives
 * information about a request execution.
 *
 * @package dbeurive\Rest
 */

class Information
{
    /** @var null|array Information about the HTTP exchange. */
    private $__information = null;

    /**
     * ExecutionInformation constructor.
     * @param array $in_information List of lines that represents information about the executed request.
     */
    public function __construct(array $in_information=array()) {
        $this->__information = $in_information;
    }

    /**
     * Return the data about the request that has been executed.
     * @return array|null If data is available, then it is returned as an associative array.
     *         Otherwise, the method returns the value null.
     */
    public function getAsArray() {
        return $this->__information;
    }

    /**
     * Return a text that represents the data about the request that has been executed.
     * @param bool $in_pretty This parameter indicates whether the returned text must be pretty formatted or not.
     * @return null|string If data is available, then the method returns a text that represents the data about the
     *         request that has been executed.
     *         Otherwise, the method returns the value null.
     */
    public function getAsString($in_pretty=false) {
        if (is_null($this->__information)) {
            return null;
        }

        $keys = array_keys($this->__information);
        sort($keys);

        $max = '';
        if ($in_pretty) {
            /** @var string $_key */
            foreach ($keys as $_key) {
                $max = strlen($_key) > $max ? strlen($_key) : $max;
            }
            $max = '-' . "$max";
        }

        $lines = array();
        /** @var string $_keys */
        foreach ($keys as $_key) {
            $value = $this->__information[$_key];
            if (is_array($value)) {
                $value = preg_replace('/\r?\n/m', "\n    ", print_r($value, true));
                $value = sprintf("This value is an array.\n\n    %s\n\n", $value);
                $value = preg_replace('/(\r?\n)+$/', '', $value);
            }

            $lines[] = sprintf("%${max}s : %s", $_key, $value);
        }
        return join("\n", $lines);
    }

}