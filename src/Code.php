<?php

/**
 * This file lists the HTTP status codes.
 */

namespace dbeurive\Http;

/**
 * Class Code
 *
 * @see https://www.iana.org/assignments/http-status-codes/http-status-codes.xhtml
 * @see Please see the script "tools/http-status-codes.php"
 *
 * @note The code of this class has been generated from the data found on the link given below:
 *       https://www.iana.org/assignments/http-status-codes/http-status-codes-1.csv
 *
 * @package dbeurive\Http
 */
class Code
{
    const HTTP_CONTINUE = 100;
    const HTTP_SWITCHING_PROTOCOLS = 101;
    const HTTP_PROCESSING = 102;
    const HTTP_EARLY_HINTS = 103;
    const HTTP_OK = 200;
    const HTTP_CREATED = 201;
    const HTTP_ACCEPTED = 202;
    const HTTP_NON_AUTHORITATIVE_INFORMATION = 203;
    const HTTP_NO_CONTENT = 204;
    const HTTP_RESET_CONTENT = 205;
    const HTTP_PARTIAL_CONTENT = 206;
    const HTTP_MULTI_STATUS = 207;
    const HTTP_ALREADY_REPORTED = 208;
    const HTTP_IM_USED = 226;
    const HTTP_MULTIPLE_CHOICES = 300;
    const HTTP_MOVED_PERMANENTLY = 301;
    const HTTP_FOUND = 302;
    const HTTP_SEE_OTHER = 303;
    const HTTP_NOT_MODIFIED = 304;
    const HTTP_USE_PROXY = 305;
    const HTTP_UNUSED = 306;
    const HTTP_TEMPORARY_REDIRECT = 307;
    const HTTP_PERMANENT_REDIRECT = 308;
    const HTTP_BAD_REQUEST = 400;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_PAYMENT_REQUIRED = 402;
    const HTTP_FORBIDDEN = 403;
    const HTTP_NOT_FOUND = 404;
    const HTTP_METHOD_NOT_ALLOWED = 405;
    const HTTP_NOT_ACCEPTABLE = 406;
    const HTTP_PROXY_AUTHENTICATION_REQUIRED = 407;
    const HTTP_REQUEST_TIMEOUT = 408;
    const HTTP_CONFLICT = 409;
    const HTTP_GONE = 410;
    const HTTP_LENGTH_REQUIRED = 411;
    const HTTP_PRECONDITION_FAILED = 412;
    const HTTP_PAYLOAD_TOO_LARGE = 413;
    const HTTP_URI_TOO_LONG = 414;
    const HTTP_UNSUPPORTED_MEDIA_TYPE = 415;
    const HTTP_RANGE_NOT_SATISFIABLE = 416;
    const HTTP_EXPECTATION_FAILED = 417;
    const HTTP_MISDIRECTED_REQUEST = 421;
    const HTTP_UNPROCESSABLE_ENTITY = 422;
    const HTTP_LOCKED = 423;
    const HTTP_FAILED_DEPENDENCY = 424;
    const HTTP_TOO_EARLY = 425;
    const HTTP_UPGRADE_REQUIRED = 426;
    const HTTP_PRECONDITION_REQUIRED = 428;
    const HTTP_TOO_MANY_REQUESTS = 429;
    const HTTP_REQUEST_HEADER_FIELDS_TOO_LARGE = 431;
    const HTTP_UNAVAILABLE_FOR_LEGAL_REASONS = 451;
    const HTTP_INTERNAL_SERVER_ERROR = 500;
    const HTTP_NOT_IMPLEMENTED = 501;
    const HTTP_BAD_GATEWAY = 502;
    const HTTP_SERVICE_UNAVAILABLE = 503;
    const HTTP_GATEWAY_TIMEOUT = 504;
    const HTTP_HTTP_VERSION_NOT_SUPPORTED = 505;
    const HTTP_VARIANT_ALSO_NEGOTIATES = 506;
    const HTTP_INSUFFICIENT_STORAGE = 507;
    const HTTP_LOOP_DETECTED = 508;
    const HTTP_NOT_EXTENDED = 510;
    const HTTP_NETWORK_AUTHENTICATION_REQUIRED = 511;


    /**
     * Returns the description that applies to the given HTTP code.
     * @param int $in_code HTTP status code.
     * @return string The method returns the description that applies to the given HTTP code.
     */
    static public function getDescription($in_code) {
        switch ($in_code) {
            case self::HTTP_CONTINUE: { return "See [RFC7231, Section 6.2.1]"; }
            case self::HTTP_SWITCHING_PROTOCOLS: { return "See [RFC7231, Section 6.2.2]"; }
            case self::HTTP_PROCESSING: { return "See [RFC2518]"; }
            case self::HTTP_EARLY_HINTS: { return "See [RFC8297]"; }
            case self::HTTP_OK: { return "See [RFC7231, Section 6.3.1]"; }
            case self::HTTP_CREATED: { return "See [RFC7231, Section 6.3.2]"; }
            case self::HTTP_ACCEPTED: { return "See [RFC7231, Section 6.3.3]"; }
            case self::HTTP_NON_AUTHORITATIVE_INFORMATION: { return "See [RFC7231, Section 6.3.4]"; }
            case self::HTTP_NO_CONTENT: { return "See [RFC7231, Section 6.3.5]"; }
            case self::HTTP_RESET_CONTENT: { return "See [RFC7231, Section 6.3.6]"; }
            case self::HTTP_PARTIAL_CONTENT: { return "See [RFC7233, Section 4.1]"; }
            case self::HTTP_MULTI_STATUS: { return "See [RFC4918]"; }
            case self::HTTP_ALREADY_REPORTED: { return "See [RFC5842]"; }
            case self::HTTP_IM_USED: { return "See [RFC3229]"; }
            case self::HTTP_MULTIPLE_CHOICES: { return "See [RFC7231, Section 6.4.1]"; }
            case self::HTTP_MOVED_PERMANENTLY: { return "See [RFC7231, Section 6.4.2]"; }
            case self::HTTP_FOUND: { return "See [RFC7231, Section 6.4.3]"; }
            case self::HTTP_SEE_OTHER: { return "See [RFC7231, Section 6.4.4]"; }
            case self::HTTP_NOT_MODIFIED: { return "See [RFC7232, Section 4.1]"; }
            case self::HTTP_USE_PROXY: { return "See [RFC7231, Section 6.4.5]"; }
            case self::HTTP_UNUSED: { return "See [RFC7231, Section 6.4.6]"; }
            case self::HTTP_TEMPORARY_REDIRECT: { return "See [RFC7231, Section 6.4.7]"; }
            case self::HTTP_PERMANENT_REDIRECT: { return "See [RFC7538]"; }
            case self::HTTP_BAD_REQUEST: { return "See [RFC7231, Section 6.5.1]"; }
            case self::HTTP_UNAUTHORIZED: { return "See [RFC7235, Section 3.1]"; }
            case self::HTTP_PAYMENT_REQUIRED: { return "See [RFC7231, Section 6.5.2]"; }
            case self::HTTP_FORBIDDEN: { return "See [RFC7231, Section 6.5.3]"; }
            case self::HTTP_NOT_FOUND: { return "See [RFC7231, Section 6.5.4]"; }
            case self::HTTP_METHOD_NOT_ALLOWED: { return "See [RFC7231, Section 6.5.5]"; }
            case self::HTTP_NOT_ACCEPTABLE: { return "See [RFC7231, Section 6.5.6]"; }
            case self::HTTP_PROXY_AUTHENTICATION_REQUIRED: { return "See [RFC7235, Section 3.2]"; }
            case self::HTTP_REQUEST_TIMEOUT: { return "See [RFC7231, Section 6.5.7]"; }
            case self::HTTP_CONFLICT: { return "See [RFC7231, Section 6.5.8]"; }
            case self::HTTP_GONE: { return "See [RFC7231, Section 6.5.9]"; }
            case self::HTTP_LENGTH_REQUIRED: { return "See [RFC7231, Section 6.5.10]"; }
            case self::HTTP_PRECONDITION_FAILED: { return "See [RFC7232, Section 4.2][RFC8144, Section 3.2]"; }
            case self::HTTP_PAYLOAD_TOO_LARGE: { return "See [RFC7231, Section 6.5.11]"; }
            case self::HTTP_URI_TOO_LONG: { return "See [RFC7231, Section 6.5.12]"; }
            case self::HTTP_UNSUPPORTED_MEDIA_TYPE: { return "See [RFC7231, Section 6.5.13][RFC7694, Section 3]"; }
            case self::HTTP_RANGE_NOT_SATISFIABLE: { return "See [RFC7233, Section 4.4]"; }
            case self::HTTP_EXPECTATION_FAILED: { return "See [RFC7231, Section 6.5.14]"; }
            case self::HTTP_MISDIRECTED_REQUEST: { return "See [RFC7540, Section 9.1.2]"; }
            case self::HTTP_UNPROCESSABLE_ENTITY: { return "See [RFC4918]"; }
            case self::HTTP_LOCKED: { return "See [RFC4918]"; }
            case self::HTTP_FAILED_DEPENDENCY: { return "See [RFC4918]"; }
            case self::HTTP_TOO_EARLY: { return "See [RFC8470]"; }
            case self::HTTP_UPGRADE_REQUIRED: { return "See [RFC7231, Section 6.5.15]"; }
            case self::HTTP_PRECONDITION_REQUIRED: { return "See [RFC6585]"; }
            case self::HTTP_TOO_MANY_REQUESTS: { return "See [RFC6585]"; }
            case self::HTTP_REQUEST_HEADER_FIELDS_TOO_LARGE: { return "See [RFC6585]"; }
            case self::HTTP_UNAVAILABLE_FOR_LEGAL_REASONS: { return "See [RFC7725]"; }
            case self::HTTP_INTERNAL_SERVER_ERROR: { return "See [RFC7231, Section 6.6.1]"; }
            case self::HTTP_NOT_IMPLEMENTED: { return "See [RFC7231, Section 6.6.2]"; }
            case self::HTTP_BAD_GATEWAY: { return "See [RFC7231, Section 6.6.3]"; }
            case self::HTTP_SERVICE_UNAVAILABLE: { return "See [RFC7231, Section 6.6.4]"; }
            case self::HTTP_GATEWAY_TIMEOUT: { return "See [RFC7231, Section 6.6.5]"; }
            case self::HTTP_HTTP_VERSION_NOT_SUPPORTED: { return "See [RFC7231, Section 6.6.6]"; }
            case self::HTTP_VARIANT_ALSO_NEGOTIATES: { return "See [RFC2295]"; }
            case self::HTTP_INSUFFICIENT_STORAGE: { return "See [RFC4918]"; }
            case self::HTTP_LOOP_DETECTED: { return "See [RFC5842]"; }
            case self::HTTP_NOT_EXTENDED: { return "See [RFC2774]"; }
            case self::HTTP_NETWORK_AUTHENTICATION_REQUIRED: { return "See [RFC6585]"; }
        }
        return "There is no description for this HTTP status code. See https://www.iana.org/assignments/http-status-codes/http-status-codes.xhtml";
    }
}