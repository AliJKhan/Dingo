<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConstantsController extends Controller
{
    const OK = 200;
    const CREATED = 201;
    const ACCEPTED = 202;
    const NONAUTHORITATIVE_INFORMATION = 203;
    const NO_CONTENT = 204;
    const RESET_CONTENT = 205;
    const PARTIAL_CONTENT = 206;
    const MULTIPLE_CHOICES = 300;
    const MOVED_PERMANENTLY = 301;
    const MOVED_TEMPORARILY = 302;
    const SEE_OTHER = 303;
    const NOT_MODIFIED = 304;
    const USE_PROXY = 305;
    const BAD_REQUEST = 400;
    const UNAUTHORIZED = 401;
    const PAYMENT_REQUIRED = 402;
    const FORBIDDEN = 403;
    const NOT_FOUND = 404;
    const METHOD_NOT_ALLOWED = 405;
    const NOT_ACCEPTABLE = 406;
    const PROXY_AUTHENTICATION_REQUIRED = 407;
    const REQUEST_TIMEOUT = 408;
    const CONFLICT = 408;
    const GONE = 410;
    const LENGTH_REQUIRED = 411;
    const PRECONDITION_FAILED = 412;
    const REQUEST_ENTITY_TOO_LARGE = 413;
    const REQUESTURI_TOO_LARGE = 414;
    const UNSUPPORTED_MEDIA_TYPE = 415;
    const REQUESTED_RANGE_NOT_SATISFIABLE = 416;
    const EXPECTATION_FAILED = 417;
    const IM_A_TEAPOT = 418;
    const INTERNAL_SERVER_ERROR = 500;
    const NOT_IMPLEMENTED = 501;
    const BAD_GATEWAY = 502;
    const SERVICE_UNAVAILABLE = 503;
    const GATEWAY_TIMEOUT = 504;
    const HTTP_VERSION_NOT_SUPPORTED = 505;

    /* API CODES */

    const FAILURE  = 0;
    const SUCCESS   = 1;
    const OTP_SUCCESSFULLY_SENT  = 2;
    const OTP_VERIFIED_NEW_USER_SIGNED_UP   = 3;
    const OTP_VERIFIED_USER_ALREADY_EXITS  = 4;
    const OTP_NOT_VERIFIED  = 5;
    const ERROR_IN_NUMBER  = 6;
    const USER_EXISTS_NO_CARS_FOUND  = 7;


    /* SERVICE TYPES */
    const OIL_CHANGE  = 1;
    const BRANDS_SERVICE   = 2;
    const FIXED_COST_SERVICE  = 3;


}
