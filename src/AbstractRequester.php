<?php

/**
 * This class implements the base class for all requesters.
 */

namespace dbeurive\Http;

/**
 * Class Requester
 *
 * This class implements the basic functionalities for all HTTP requesters.
 *
 * @package dbeurive\Rest
 */

abstract class AbstractRequester
{
    /** @var HeadersContainer The list of recorded headers in the HTTP response.  */
    private $__responseHeaders = null;
    /** @var array List of additional CURL options. */
    private $__additionalCurlOptions = array();

    /**
     * Requester constructor.
     * @param array $in_additional_curl_options List of additional CURL options.
     *        Use this parameter if you want to specify a list of CURL options that will be systematically added to all
     *        requests.
     */
    public function __construct(array $in_additional_curl_options=array()) {
        $this->__additionalCurlOptions = $in_additional_curl_options;
        $this->__responseHeaders = new HeadersContainer();
    }

    /**
     * Generate a query string from a given list of couples (name=value).
     * @param array $in_parameters_list The given list of couples (name=value).
     * @return string The query string.
     * @throws ExceptionParameter
     */
    static public function generateQueryString(array $in_parameters_list) {
        $result = array();
        foreach ($in_parameters_list as $_name => $_value) {
            if (self::_isNotSet($_name)) {
                throw new ExceptionParameter('Invalid name detected in the list of parameters! The value is either null, false, or an empty string.');
            }
            $result[] = sprintf('%s=%s', urlencode($_name), (self::_isNotSet($_value) ? '' : urlencode("${_value}")));
        }
        return join('&', $result);
    }

    /**
     * Callback function used to record the response headers.
     * @param string $in_url URL.
     * @param string $in_header The header to record.
     * @return int The function returns the number of bytes of the header.
     */
    public function responseHeaderCallback($in_url, $in_header) {
        $this->__responseHeaders->addHeader(preg_replace('/\r?\n$/', '', $in_header));
        return strlen($in_header);
    }

    /**
     * Send the request.
     * @param string $in_url URL.
     * @param string $in_method Method.
     * @param null|string $in_content Request content (maybe null if the request has no content).
     *        Set this value to null if the request does not have content.
     * @param null|string $in_content_type The content type.
     *        Set this value to null if the request does not have content.
     * @param array $in_opt_additional_curl_options Additional CURL options.
     * @return Report The execution report.
     * @throws ExceptionParameter
     * @throws ExceptionRuntime
     * @note Be aware that the value for the CURL option "CURLOPT_HTTPHEADER" is an array!
     *       The manipulation of this option must be done with great care!
     */
    private function  __doRequest($in_url, $in_method, $in_content, $in_content_type, array $in_opt_additional_curl_options=array())
    {
        // Sanity checks
        if ((!is_null($in_content)) && is_null($in_content_type)) {
            throw new ExceptionParameter('Invalid value (null) for parameter "$in_content_type". Since you specify a request content, you must also declare its type.');
        }
        if (is_null($in_content) && (!is_null($in_content_type))) {
            throw new ExceptionParameter(sprintf('Invalid value "%s" for parameter "$in_content_type". Since you do not specify any request content, you should not specify a content type.'));
        }

        $this->__responseHeaders->reset();
        $session = curl_init($in_url);
        // The setting below allows us to retrieve the HTTP header of the the request string sent.
        curl_setopt($session, CURLINFO_HEADER_OUT, true);
        // Set a handler that will be called for each header found in the request response.
        curl_setopt($session, CURLOPT_HEADERFUNCTION, AbstractRequester::class . '::responseHeaderCallback');
        curl_setopt($session, CURLOPT_HEADER, false);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($session, CURLOPT_CUSTOMREQUEST, $in_method);

        if (! is_null($in_content)) {
            curl_setopt($session, CURLOPT_POSTFIELDS, $in_content);
            // Be aware that the value for the CURL option "CURLOPT_HTTPHEADER" is an array!
            // The manipulation of this option must be done with great care!
            if (! array_key_exists(CURLOPT_HTTPHEADER, $in_opt_additional_curl_options)) {
                $in_opt_additional_curl_options[CURLOPT_HTTPHEADER] = array();
            }
            $in_opt_additional_curl_options[CURLOPT_HTTPHEADER][] = sprintf('Content-Type: %s', $in_content_type);
        }

        if ('POST' == $in_method) {
            curl_setopt($session, CURLOPT_POST, true);
        }

        // Merge the two provided list of Curl options:
        //   - $in_opt_additional_curl_options: the list of "specific" additional Curl options (that apply for this request only).
        //   - $this->__additionalCurlOptions: the list of "generic" Curl options (that apply for all requests).
        //
        // Sanity check : the two list should not contain options in common (except for the option CURLOPT_HTTPHEADER).
        //
        // WARNING: do not use the function array_merge() !
        //
        //      If, however, the arrays contain numeric keys, the later value will not overwrite the original
        //      value, but will be appended. Values in the input array with numeric keys will be renumbered
        //      with incrementing keys starting from zero in the result array.
        //
        // Curl options IDs are numerical values !

        foreach ($this->__additionalCurlOptions as $_key => $_value) {
            $v = $_value;

            if (array_key_exists($_key, $in_opt_additional_curl_options)) {
                if (CURLOPT_HTTPHEADER == $_key) {

                    // WARNING !!!
                    //
                    // Be aware that the value for the CURL option "CURLOPT_HTTPHEADER" is an array!
                    // The manipulation of this option must be done with great care!
                    // Some headers from the first list may be redefined within the second list.
                    // TODO: make sure that the intersection between the two lists of headers is empty.
                    //
                    // While header names (for example: "Content-Type") should not be numerical values, the safe
                    // implementation of the merge function is used below.

                    $v = $this->_safeAssociativeArrayMerge(
                        $in_opt_additional_curl_options[CURLOPT_HTTPHEADER],
                        $this->__additionalCurlOptions[CURLOPT_HTTPHEADER]
                    );
                } else {
                    // WARNING !!!
                    // Other Curl options (than CURLOPT_HTTPHEADER) may take arrays as value.
                    // TODO: check whether it is necessary to process special cases other than the one for the option CURLOPT_HTTPHEADER.
                    throw new ExceptionParameter(sprintf('Duplicated Curl option detected! Option is "%s".', $_key));
                }
            }

            // Merging the lists.
            $in_opt_additional_curl_options[$_key] = $v;
        }

        // Set the options.
        foreach ($in_opt_additional_curl_options as $_key => $_value) {
            curl_setopt($session, $_key, $_value);
        }

        $body = curl_exec($session); // Option CURLOPT_RETURNTRANSFER is set.
        if (false === $body) {
            $error = curl_error($session);
            $error = '' === $error ? 'No error message is available.' : $error;
            throw new ExceptionRuntime(sprintf('An error occurred while sending the request to the server. %s', $error));
        }

        $response = new Response(
            $this->__responseHeaders,
            $body,
            curl_getinfo($session, CURLINFO_HTTP_CODE),
            curl_getinfo($session, CURLINFO_CONTENT_TYPE), // may be null
            curl_getinfo($session, CURLINFO_CONTENT_LENGTH_DOWNLOAD)
        );

        // Build the request object.

        $requestHeaders = new HeadersContainer();
        $information = curl_getinfo($session);
        if (array_key_exists('request_header', $information)) {
            $lines = preg_split('/\r?\n/', $information['request_header']);
            foreach ($lines as $_line) {
                // $_line = preg_replace('/\r?\n$/', '', $_line);
                if (1 === preg_match('/^[\s\r\n]*$/', $_line)) { continue; }
                $requestHeaders->addHeader($_line);
            }
            unset($information['request_header']);
        }

        $request = new Request(
            $requestHeaders,
            $in_content
        );

        curl_close($session);

        return new Report($request, $response, new Information($information));
    }

    /**
     * Perform a GET request.
     * @param string $in_url The URL.
     * @param array|null $in_additional_curl_options Additional CURL options.
     *        Set this value to null if the request does not need additional CURL options.
     * @return Report The execution report.
     * @throws ExceptionParameter
     * @throws ExceptionRuntime
     */
    protected function _doGet($in_url, $in_additional_curl_options=array()) {
        return $this->__doRequest($in_url, 'GET', null, null, $in_additional_curl_options);
    }

    /**
     * Perform a POST request.
     * @param string $in_url The URL.
     * @param string $in_content The request content.
     * @param string $in_content_type The content type.
     * @param array|null $in_additional_curl_options $in_additional_curl_options Additional CURL options.
     *        Set this value to null if the request does not need additional CURL options.
     * @return Report The execution report.
     * @throws ExceptionParameter
     * @throws ExceptionRuntime
     */
    protected function _doPost($in_url, $in_content, $in_content_type, $in_additional_curl_options=array()) {
        return $this->__doRequest($in_url, 'POST', $in_content, $in_content_type, $in_additional_curl_options);
    }

    /**
     * Perform a PUT request.
     * @param string $in_url The URL.
     * @param string $in_content The request content.
     * @param string $in_content_type The content type.
     * @param array|null $in_additional_curl_options $in_additional_curl_options Additional CURL options.
     *        Set this value to null if the request does not need additional CURL options.
     * @return Report The execution report.
     * @throws ExceptionParameter
     * @throws ExceptionRuntime
     */
    protected function _doPut($in_url, $in_content, $in_content_type, $in_additional_curl_options=array()) {
        return $this->__doRequest($in_url, 'PUT', $in_content, $in_content_type, $in_additional_curl_options);
    }

    /**
     * Perform a DELETE request.
     * @param string $in_url The URL.
     * @param array|null $in_additional_curl_options Additional CURL options.
     *        Set this value to null if the request does not need additional CURL options.
     * @return Report The execution report.
     * @throws ExceptionParameter
     * @throws ExceptionRuntime
     */
    protected function _doDelete($in_url, $in_additional_curl_options=array()) {
        return $this->__doRequest($in_url, 'DELETE', null, null, $in_additional_curl_options);
    }

    /**
     * Test whether a given value is null, false or an empty string.
     * @param mixed $in_value The value to test.
     * @return bool The method returns the value true of the given value is null, false or an empty string.
     *         Otherwise, it returns the value false.
     */
    static protected function _isNotSet($in_value) {
        return is_null($in_value) || (false === $in_value) || ('' === $in_value);
    }

    /**
     * This method safely merges the content of two associative arrays.
     * @param array $in_associative_array_1 First array.
     * @param array $in_associative_array_2 Second array.
     * @return array The method returns an array that is the merge of the two arrays.
     * @note This method has been introduced because the function array_merge() is dangerous:
     *       Values in the input array with numeric keys will be renumbered with incrementing keys starting from zero in
     *       the result array. Curl options are identified by integers.
     * @see http://php.net/manual/en/function.array-merge.php
     */
    protected function _safeAssociativeArrayMerge(array $in_associative_array_1, array $in_associative_array_2) {
        $result = $in_associative_array_1;
        foreach ($in_associative_array_2 as $_key => $_value) {
            if (array_key_exists($_key, $result)) {
                if ($result[$_key] !== $_value) {
                    trigger_error(
                        sprintf('Merging two associative arrays with identical key "%s" (with different values).', $_key),
                        E_USER_WARNING
                    );
                } else {
                    trigger_error(
                        sprintf('Merging two associative arrays with identical key "%s" (with same values).', $_key),
                        E_USER_WARNING
                    );
                }
            }

            $result[$_key] = $_value;
        }
        return $result;
    }
}