<?php
namespace Application;

class York extends \Template\AApi
{
    public function testSuccess()
    {
        $data = array('id'=>'9527','web_id'=>$this->web_id);
        $this->responseSuccess($data);
    }

    public function testError()
    {
        $data = array('id'=>'0000','name'=>'查無此人');
        $this->responseError($data);
    }
}