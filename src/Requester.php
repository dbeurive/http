<?php

/**
 * This file implements a very basic HTTP requester.
 */

namespace dbeurive\Http;

/**
 * Class Requester
 *
 * This class implements a very basic HTTP requester.
 *
 * @package dbeurive\Rest
 */

class Requester extends AbstractRequester
{
    /**
     * Perform a GET request.
     * @param string $in_url The URL.
     * @param array $in_opt_additional_curl_options Additional CURL options.
     * @return Report The execution report.
     * @throws ExceptionParameter
     * @throws ExceptionRuntime
     */
    public function doGet($in_url, array $in_opt_additional_curl_options=array()) {
        return parent::_doGet($in_url, $in_opt_additional_curl_options);
    }

    /**
     * Perform a POST request.
     * @param string $in_url The URL.
     * @param string $in_content The request content.
     * @param string $in_content_type The content type.
     * @param array $in_opt_additional_curl_options $in_additional_curl_options Additional CURL options.
     * @return Report The execution report.
     * @throws ExceptionParameter
     * @throws ExceptionRuntime
     */
    public function doPost($in_url, $in_content, $in_content_type, array $in_opt_additional_curl_options=array()) {
        return parent::_doPost($in_url, $in_content, $in_content_type, $in_opt_additional_curl_options);
    }

    /**
     * Perform a PUT request.
     * @param string $in_url The URL.
     * @param string $in_content The request content.
     * @param string $in_content_type The content type.
     * @param array $in_opt_additional_curl_options $in_additional_curl_options Additional CURL options.
     * @return Report The execution report.
     * @throws ExceptionParameter
     * @throws ExceptionRuntime
     */
    public function doPut($in_url, $in_content, $in_content_type, array $in_opt_additional_curl_options=array()) {
        return parent::_doPut($in_url, $in_content, $in_content_type, $in_opt_additional_curl_options);
    }

    /**
     * Perform a DELETE request.
     * @param string $in_url The URL.
     * @param array $in_opt_additional_curl_options Additional CURL options.
     * @return Report The execution report.
     * @throws ExceptionParameter
     * @throws ExceptionRuntime
     */
    public function doDelete($in_url, array $in_opt_additional_curl_options=array()) {
        return parent::_doDelete($in_url, $in_opt_additional_curl_options);
    }
}