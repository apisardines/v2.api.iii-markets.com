<?php

namespace App\Models;
use SoapClient;
use App\Models\CParaEmail;

class CThreadWorker extends Thread
{	
	
  /*
	  private $object;
    public function __construct($object)
    {
        $this->object=$object;
    } 
    */

    public function run()
    {
      dd('run');
      
      /*

       $client = new SoapClient("http://100.100.100.181/Sardines.Service.Callcenter/Service.asmx?WSDL");
       //www.iii-markets.com/#/active?email=abc@gmail.com&token=abc
       $param = array('strProvider' => '01'
           	,'iFuntionNumber' => '99'
           	,'iOutputType' => '3'
           	,'strOutputLocation' => $object->emailaddress
           	,'strContent' => $object->Tittle .'|[HTML] '. $object->BodyText .' <a href="http://www.iii-markets.com/#/active?email=' . $object->emailaddress . '&token='. $object->Token .'"> http://iii-markets.com/#/active?email=' . $object->emailaddress . '&token='. $object->Token .'<a/>');
       $client->CallCenterProcess($param); 
       //dd($param);    
       
       dd($object);
       */
    }
    

}
