<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models;
use App\Models\MCompany;
use App\Models\CCompany;
use App\Models\ResultMessage;
use App\Models\CInput;
use Response;
use Input;
use SoapClient;

class CompanyController extends Controller
{

    protected $company = null;
    
    public function __construct(MCompany $company)
    {
        $this->company=$company;
    } 

   public function func_SendEmail()
    {

       $client = new SoapClient("http://100.100.100.181/Sardines.Service.Callcenter/Service.asmx?WSDL");
       //www.iii-markets.com/#/active?email=abc@gmail.com&token=abc
       $param = array('strProvider' => '01'
           	,'iFuntionNumber' => '99'
           	,'iOutputType' => '3'
           	,'strOutputLocation' => 'su.q.phan@pmsa.com.vn'
           	,'strContent' => 'Sardines activator|[HTML] activator <a href="http://www.iii-markets.com/#/active?email=' . 'su.q.phan@pmsa.com.vn' . '&token=abc"> http://iii-markets.com/#/active?email=' . 'su.q.phan@pmsa.com.vn' . '&token=abc<a/>');
       $client->CallCenterProcess($param); 
       dd($param);

    }

    public function func_CompanyAll()
    {
        $input = Input::all();
        //dd($input);
        $cinput = new CInput();
        $cinput->latitude = $input['Latitude'];
        $cinput->longtitude = $input['Longtitude'];
        $cinput->radius = $input['Radius'];
        $latitude = $cinput->latitude;
        $longtitude = $cinput->longtitude;
        $radius = $cinput->radius;       

        $message = new ResultMessage();
        $message->Result = 1;
        $message->ResultMessage = 'Successfully...';
        $message->ResultID = 0;  
        //dd($message);      
   
        $data1 = Models\MCompany::func_getCompanyList($latitude,$longtitude,$radius);
        $arrayCompany = array();
        foreach ($data1 as $key) {
         $company = new CCompany();
         $result2 = json_encode($key);
         $result3 = json_decode($result2,true); 
         //dd($result3);
         
         $company->ID = $result3['ID'];
         $company->Code = $result3['Code'];
         $company->Name = $result3['Name'];
         $company->NationalName = $result3['NationalName'];
         $company->TradeName = $result3['TradeName'];
         $company->Address = $result3['Address'];
         $company->TaxNo = $result3['TaxNo'];
         $company->LicenseNumber = $result3['LicenseNumber'];
         $company->IssueDate = $result3['IssueDate'];
         $company->Phone = $result3['Phone'];

         $company->Fax = $result3['Fax'];
         $company->CEO = $result3['CEO'];
         $company->Email = $result3['Email'];
         $company->Latitude = $result3['Latitude'];
         $company->Longtitude = $result3['Longtitude'];
         $company->Star = $result3['Star'];

         //dd($message);
         array_push($arrayCompany, $company);

         

        }
        //dd($arrayCompany);
        return Response::json(array('ResultMessage'=>$message, 'Data' => $arrayCompany),200);                                   
    }   
}
