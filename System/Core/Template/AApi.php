<?php

namespace Core\Template;
/**
 * Class AApi
 *
 * @date 2018/3/13
 * @author York <jason945119@gmail.com>
 */
abstract class AApi
{
    const SUCCESS = true;
    const ERROR = false;
    const SUCCESS_CODE = 200;
    const ERROR_CODE = 400;
    const SUCCESS_STRING = 'OK';
    const ERROR_STRING = 'Bad Request';

    protected $callback = false;
    protected $HTTPResponseStatusCodes  = array(
        100 => 'Continue',
        101 => 'Switching Protocols',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => '(Unused)',
        307 => 'Temporary Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported');

    protected function __construct()
    {
        if( !empty( $_GET['callback'] ) )
        {
            $this->callback = $_GET['callback'];
        }

        if( $this->callback )
        {
            \header( 'Content-Type: application/javascript; charset=utf-8' );
        }
        else
        {
            \header( 'Content-Type: application/json; charset=utf-8' );
        }
    }

    /**
     * responseSuccess
     *
     * @param null $data
     *
     * @date 2018/3/31
     * @author York <jason945119@gmail.com>
     * $this->responseSuccess();
     * $this->responseSuccess(200);
     * $this->responseSuccess($data);
     */
    protected function responseSuccess( $data = null ) : void
    {
        // 建立 Response Data
        $responseData = $this->createResponseData( self::SUCCESS, $data );
        // 檢查 Call Back
        $responseData = $this->checkCallBack( \json_encode( $responseData ) );
        // 印出 Response
        echo $responseData;
        // 結束流程
        exit;
    }

    /**
     * responseError
     *
     * @param null $data
     *
     * @date 2018/3/31
     * @author York <jason945119@gmail.com>
     * $this->responseError();
     * $this->responseError(501);
     * $this->responseError($data);
     */
    protected function responseError( $data = null ) : void
    {
        // 建立 Response Data
        $responseData = $this->createResponseData( self::ERROR, $data );
        // 檢查 Call Back
        $responseData = $this->checkCallBack( \json_encode( $responseData ) );
        // 印出 Response
        echo $responseData;
        // 結束流程
        exit;
    }

    private function createResponseData( $status, $data = null ) : array
    {
        $responseData['status'] = $status;
        $responseData['httpStatus'] = ( $status ) ? self::SUCCESS_CODE : self::ERROR_CODE;
        if( empty( $data ) )
        {
            $responseData['data'] = ( $status ) ? self::SUCCESS_STRING : self::ERROR_STRING;
        }
        else if( \is_numeric( $data ) && \array_key_exists( $data, $this->HTTPResponseStatusCodes ) )
        {
            $responseData['httpStatus'] = $data;
            $responseData['data'] = $this->HTTPResponseStatusCodes[$data];
        }
        else
        {
            $responseData['data'] = $data;
        }
        return $responseData;
    }

    private function checkCallBack( $string ) : string
    {
        if( $this->callback )
        {
            return $this->callback.'('.$string.');';
        }
        else
        {
            return $string;
        }
    }
}