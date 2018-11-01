<?php

/**
 * This file implements the container used to store the execution report of the request.
 */

namespace dbeurive\Http;

/**
 * Class Report
 *
 * This class implements the container used to store the execution report of the request.
 * The report presents:
 * - the executed request.
 * - the received response.
 * - information about the request execution.
 *
 * @package dbeurive\Rest
 */

class Report
{
    /** @var Request The request that has been sent. */
    private $__request;
    /** @var Response The response that has been received.  */
    private $__response;
    /** @var Information Information about HTTP exchange. */
    private $__information;

    /**
     * Report constructor.
     * @param Request $in_request The request that has been sent.
     * @param Response $in_response The response that has been received.
     * @param Information $in_information The information about the HTTP exchange.
     */
    public function __construct($in_request, $in_response, $in_information) {
        $this->__request = $in_request;
        $this->__response = $in_response;
        $this->__information = $in_information;
    }

    /**
     * Return the object that represents the request that was executed.
     * @return Request The executed request.
     * @see Request
     */
    public function getRequest() {
        return $this->__request;
    }

    /**
     * Return the object that represents the request's response.
     * @return Response The request's response.
     * @see Response
     */
    public function getResponse() {
        return $this->__response;
    }

    /**
     * Return the object that contains the information, provided by the HTTP client, about the executed request.
     * @return Information The information about the executed request.
     * @see Information
     */
    public function getInformation() {
        return $this->__information;
    }
}