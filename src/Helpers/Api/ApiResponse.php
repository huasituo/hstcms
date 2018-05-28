<?php

namespace Huasituo\Hstcms\Helpers\Api;

use Symfony\Component\HttpFoundation\Response as FoundationResponse;
use Response;

trait ApiResponse
{
    /**
     * @var int
     */
    protected $stateCode = FoundationResponse::HTTP_OK;

    /**
     * @return mixed
     */
    public function getStateCode()
    {
        return $this->stateCode;
    }

    /**
     * @param $stateCode
     * @return $this
     */
    public function setStateCode($stateCode)
    {
        $this->stateCode = $stateCode;
        return $this;
    }

    /**
     * @param $data
     * @param array $header
     * @return mixed
     */
    public function respond($data, $header = [])
    {
        return Response::json($data, $this->getStateCode(), $header);
    }

    /**
     * @param $message
     * @param string $state
     * @return mixed
     */
    public function message($message, $state = 0, $data = [], $code = null)
    {
        if(is_array($state)) {
            $data = $state;
            $state = 0;
        }
        $datas = [
            'message' => $message
        ];
        if($data) {
            $datas['data'] = $data;
        }
        return $this->state($state, $datas, $code);
    }

    /**
     * @param $state
     * @param array $data
     * @param null $code
     * @return mixed
     */
    public function state($state, array $data, $code = null)
    {
        if ($code) {
            $this->setStateCode($code);
        }
        $state = [
            'state' => $state,
            'code' => $this->stateCode
        ];
        $data = array_merge($state, $data);
        return $this->respond($data);

    }

    /**
     * @param $message
     * @param int $code
     * @param string $state
     * @return mixed
     */
    public function failed($message, $code = FoundationResponse::HTTP_BAD_REQUEST, $state = '-1'){

        return $this->setStateCode($code)->message($message, $state);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function internalError($message = "Internal Error!")
    {
        return $this->failed($message, FoundationResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function created($message = "created")
    {
        return $this->setStateCode(FoundationResponse::HTTP_CREATED)
            ->message($message);
    }

    /**
     * @param $data
     * @param string $state
     * @return mixed
     */
    public function toSuccess($data, $state = "0")
    {
        return $this->state($state, compact('data'));
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function notFond($message = 'Not Fond!')
    {
        return $this->failed($message, Foundationresponse::HTTP_NOT_FOUND);
    }
}