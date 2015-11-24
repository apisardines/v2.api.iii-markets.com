<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models;
use App\Models\Users;
use App\Models\CUser;
use App\Models\ResultMessage;
//use App\Class\CUser;
use App\Models\CInput;
use Response;
use Input;

class UserController extends Controller
{
	//Controller UserDB----------------
	
	
	protected $user = null;
	
	public function __construct(Users $user)
	{
		$this->user=$user;
	}	

	public function getUsersByID($id)
	{
		//$resultmessage = array('ResultMessage');
		$userinfo = array('Data');
		$data = Models\Users::func_getUsers($id);
		
		foreach ($data as $key) {
	     $user = new CUser();
         $result2 = json_encode($key);
         $result3 = json_decode($result2,true);	
         //dd($result3);
         
	     $user->ID = $result3['ID'];
	     $user->LoginName = $result3['LoginName'];
	     $user->EmailAddress = $result3['EmailAddress'];
	     $user->PhoneNumber = $result3['PhoneNumber'];
	     $user->Provider = $result3['Provider'];
	     $user->Seekers = $result3['Seekers'];
	     $user->Referees = $result3['Referees'];
	     $user->LastPageDisplay = $result3['LastPageDisplay'];
	     $user->CreatedDateTime = $result3['CreatedDateTime'];
	     $user->UpdatedDateTime = $result3['UpdatedDateTime'];
	     dd($user);
	     
	     array_push($userinfo, $user);	
	     //return Response::json($userinfo,200);
	     			
		}		
		/*
		foreach ($data as $key) {
			$message = new ResultMessage();
		    $result1 = json_encode($key);
		    $result2 = json_decode($result1,true);	
			$message->Result = $result2['Result'];
			$message->ResultMessage = $result2['ResultMessage'];
			$message->ResultID = $result2['ResultID'];
			array_push($resultmessage, $message);
		}
		*/

		//$userinfo = array('Data');
		//$data1 = Models\Users::func_getUsers($loginname,$password);
		
		//if (!$resultmessage) {
			
		//	return Response::json(['response' => 'loi'],404);
		//}
		//return json_encode($data);
		//dd($userinfo);
		//return Response::json($userinfo,200);
				
	}	


	public function func_Login()
	{
		$input = Input::all();
		//dd($input);
		$cinput = new CInput();
		$cinput->loginname = $input['LoginName'];
		$cinput->password = $input['Password'];
		$loginname = $cinput->loginname;
		$password = $cinput->password;

		$data = Models\Users::func_Login($loginname,$password);
		//dd($data);
		
		foreach ($data as $key) {
			$message = new ResultMessage();
		    $result1 = json_encode($key);
		    $result2 = json_decode($result1,true);	
			$message->Result = $result2['Result'];
			$message->ResultMessage = $result2['ResultMessage'];
			$message->ResultID = $result2['ResultID'];

			if ($message->Result == 1)
			{
				$userid = $message->ResultID;
				//dd($userid);
				
				$data1 = Models\Users::func_getUsers($message->ResultID);
				foreach ($data1 as $key) {
			     $user = new CUser();
		         $result2 = json_encode($key);
		         $result3 = json_decode($result2,true);	
		         //dd($result3);
		         
			     $user->ID = $result3['ID'];
			     $user->LoginName = $result3['LoginName'];
			     $user->EmailAddress = $result3['EmailAddress'];
			     $user->PhoneNumber = $result3['PhoneNumber'];
			     $user->Provider = $result3['Provider'];
			     $user->Seekers = $result3['Seekers'];
			     $user->Referees = $result3['Referees'];
			     $user->LastPageDisplay = $result3['LastPageDisplay'];
			     $user->CreatedDateTime = $result3['CreatedDateTime'];
			     $user->UpdatedDateTime = $result3['UpdatedDateTime'];
			     //dd($message);

			     return Response::json(array('ResultMessage'=>$message, 'Data' => $user),200);
		
				}
			}
			else
			{
				return Response::json(array('ResultMessage'=>$message),200);
			}
			
		}					
	}

	public function func_Insert_New()
	{
		$input = Input::all();
		//dd($input);
		

		$cinput = new CInput();
		
		//dd($cinput);
		$cinput->emailaddress = '';
		$cinput->phonenumber = '';
		$cinput->registermethod = 0;
		$cinput->password = '';		
		$cinput->provider = 0;
		$cinput->seekers = 0;
		$cinput->referees = 0;
		$cinput->lastpagedisplay = 0;

		//dd($cinput);
		
		 
 		if (isset($input['EmailAddress'])) {
		 	$cinput->emailaddress = $input['EmailAddress'];
		 } 
		if (isset($input['PhoneNumber'])) {
		 	$cinput->phonenumber = $input['PhoneNumber'];
		 } 
		if (isset($input['RegisterMethod'])) {
		 	$cinput->registermethod = $input['RegisterMethod'];
		 } 		 
		if (isset($input['Password'])) {
		 	$cinput->password = $input['Password'];
		 } 		 
 		if (isset($input['Provider'])) {
		 	$cinput->provider = $input['Provider'];
		 } 
 		if (isset($input['Seekers'])) {
		 	$cinput->seekers = $input['Seekers'];
		 } 		
  		if (isset($input['Referees'])) {
		 	$cinput->referees = $input['Referees'];
		 } 
 		if (isset($input['LastPageDisplay'])) {
		 	$cinput->lastpagedisplay = $input['LastPageDisplay'];
		 }

		 //dd($cinput);
		 
        /*
		$message = new ResultMessage();
		$message->Result = 1;//$result2['Result'];
		$message->ResultMessage = 'Success';//$result2['ResultMessage'];
		$message->ResultID = 123;//$result2['ResultID'];	
		$message->Session = 'e4e27421-7fa2-4253-92f7-10d21b85f11a';	 
		
		return Response::json(array('ResultMessage'=>$message));
		*/

		//dd($cinput);
		
				
		$emailaddress = $cinput->emailaddress;		
		$phonenumber = $cinput->phonenumber;
		$registermethod = $cinput->registermethod;
        $password = $cinput->password;		
		$provider = $cinput->provider;
		$seekers = $cinput->seekers;
		$referees = $cinput->referees;
		$lastpagedisplay = $cinput->lastpagedisplay;

		//dd($emailaddress);
		

		//----------------------
					

		$data = Models\Users::func_Insert_New($emailaddress,$phonenumber,$registermethod
			,$password,$provider,$seekers,$referees,$lastpagedisplay);
		
		foreach ($data as $key) {
			$message = new ResultMessage();

		    $result1 = json_encode($key);
		    $result2 = json_decode($result1,true);

			$message->Result = $result2['Result'];
			$message->ResultCode = $result2['ResultCode'];
			$message->ResultID = $result2['ResultID'];
			$message->Session = $result2['Session'];

			//dd($message->ResultCode );
			

	        $data1 = Models\Users::func_GetResultMessage($message->ResultCode ,29);
	        //dd($data1);
    		foreach ($data1 as $key) {			    

	           $result3 = json_encode($key);
	           $result4 = json_decode($result3,true);

	            $message1 = new ResultMessage();


	        if ($message->Result > 0)
	        {
	        	$message1->Result = 1;
	        }
	        else
	        {
	        	$message1->Result = 0;
	        }


		    
		    $message1->ResultCode = $result4['ResultCode'];
		    $message1->Tittle = $result4['Tittle'];
		    $message1->ResultMessage = $result4['ResultMessage'];
		    $message1->ResultID = $message->ResultID;
		    $message1->Session = $message->Session;

		    //Send Email And SMS		      

	        return Response::json(array('ResultMessage'=>$message1));	
	        }						

		}	
			
	}	

	public function func_Insert()
	{
		$input = Input::all();
		//dd($input);

		$cinput = new CInput();
		$cinput->loginname = $input['LoginName'];
		$cinput->password = $input['Password'];
		$cinput->emailaddress = $input['EmailAddress'];
		$cinput->phonenumber = $input['PhoneNumber'];
		$cinput->provider = $input['Provider'];
		$cinput->seekers = $input['Seekers'];
		$cinput->referees = $input['Referees'];
		$cinput->lastpagedisplay = $input['LastPageDisplay'];


		$loginname = $cinput->loginname;
		$emailaddress = $cinput->emailaddress;
		$password = $cinput->password;
		$phonenumber = $cinput->phonenumber;
		$provider = $cinput->provider;
		$seekers = $cinput->seekers;
		$referees = $cinput->referees;
		$lastpagedisplay = $cinput->lastpagedisplay;		

		$data = Models\Users::func_Insert($loginname,$password,$emailaddress
			,$phonenumber,$provider,$seekers,$referees,$lastpagedisplay);
		
		foreach ($data as $key) {
			$message = new ResultMessage();
		    $result1 = json_encode($key);
		    $result2 = json_decode($result1,true);	
			$message->Result = $result2['Result'];
			$message->ResultMessage = $result2['ResultMessage'];
			$message->ResultID = $result2['ResultID'];

			if ($message->Result == 1)
			{
				$userid = $message->ResultID;
				//dd($userid);
				
				$data1 = Models\Users::func_getUsers($message->ResultID);
				foreach ($data1 as $key) {
			     $user = new CUser();
		         $result2 = json_encode($key);
		         $result3 = json_decode($result2,true);	
		         //dd($result3);
		         
			     $user->ID = $result3['ID'];
			     $user->LoginName = $result3['LoginName'];
			     $user->EmailAddress = $result3['EmailAddress'];
			     $user->PhoneNumber = $result3['PhoneNumber'];
			     $user->Provider = $result3['Provider'];
			     $user->Seekers = $result3['Seekers'];
			     $user->Referees = $result3['Referees'];
			     $user->LastPageDisplay = $result3['LastPageDisplay'];
			     $user->CreatedDateTime = $result3['CreatedDateTime'];
			     $user->UpdatedDateTime = $result3['UpdatedDateTime'];

			     return Response::json(array('ResultMessage'=>$message, 'Data' => $user));
		
				}
			}
			else
			{
				return Response::json(array('ResultMessage'=>$message));
			}

		}	
					
	}	

	public function func_Update()
	{
		$input = Input::all();
		//dd($input);

		$cinput = new CInput();
		
		//dd($cinput);
		$cinput->id = 0;
		$cinput->loginname = '';
		$cinput->password = '';
		$cinput->emailaddress = '';
		$cinput->phonenumber = '';
		$cinput->provider = 0;
		$cinput->seekers = 0;
		$cinput->referees = 0;
		$cinput->lastpagedisplay = 0;

		if (isset($input['ID'])) {
		 	$cinput->id = $input['ID'];
		 } 
		if (isset($input['LoginName'])) {
		 	$cinput->loginname = $input['LoginName'];
		 } 		 
		if (isset($input['Password'])) {
		 	$cinput->password = $input['Password'];
		 } 
 		if (isset($input['EmailAddress'])) {
		 	$cinput->emailaddress = $input['EmailAddress'];
		 } 
		if (isset($input['PhoneNumber'])) {
		 	$cinput->phonenumber = $input['PhoneNumber'];
		 } 
 		if (isset($input['Provider'])) {
		 	$cinput->provider = $input['Provider'];
		 } 
 		if (isset($input['Seekers'])) {
		 	$cinput->seekers = $input['Seekers'];
		 } 		
  		if (isset($input['Referees'])) {
		 	$cinput->referees = $input['Referees'];
		 } 
 		if (isset($input['Provider'])) {
		 	$cinput->provider = $input['Provider'];
		 } 
 		if (isset($input['LastPageDisplay'])) {
		 	$cinput->lastpagedisplay = $input['LastPageDisplay'];
		 }
		 //dd($cinput);

		/*
		$cinput->password = $input['Password'];
		$cinput->emailaddress = $input['EmailAddress'];
		$cinput->phonenumber = $input['PhoneNumber'];
		$cinput->provider = $input['Provider'];
		$cinput->seekers = $input['Seekers'];
		$cinput->referees = $input['Referees'];
		$cinput->lastpagedisplay = $input['LastPageDisplay'];
		dd($cinput);
		*/

		$id = $cinput->id;
		$loginname = $cinput->loginname;
		$emailaddress = $cinput->emailaddress;
		$password = $cinput->password;
		$phonenumber = $cinput->phonenumber;
		$provider = $cinput->provider;
		$seekers = $cinput->seekers;
		$referees = $cinput->referees;
		$lastpagedisplay = $cinput->lastpagedisplay;		

		$data = Models\Users::func_Update($id,$loginname,$password,$emailaddress
			,$phonenumber,$provider,$seekers,$referees,$lastpagedisplay);
		//dd($data);
		foreach ($data as $key) {
			$message = new ResultMessage();
		    $result1 = json_encode($key);
		    $result2 = json_decode($result1,true);	
			$message->Result = $result2['Result'];
			$message->ResultMessage = $result2['ResultMessage'];
			$message->ResultID = $result2['ResultID'];

			if ($message->Result == 1)
			{
				$userid = $message->ResultID;
				//dd($userid);
				
				$data1 = Models\Users::func_getUsers($message->ResultID);
				foreach ($data1 as $key) {
			     $user = new CUser();
		         $result2 = json_encode($key);
		         $result3 = json_decode($result2,true);	
		         //dd($result3);
		         
			     $user->ID = $result3['ID'];
			     $user->LoginName = $result3['LoginName'];
			     $user->EmailAddress = $result3['EmailAddress'];
			     $user->PhoneNumber = $result3['PhoneNumber'];
			     $user->Provider = $result3['Provider'];
			     $user->Seekers = $result3['Seekers'];
			     $user->Referees = $result3['Referees'];
			     $user->LastPageDisplay = $result3['LastPageDisplay'];
			     $user->CreatedDateTime = $result3['CreatedDateTime'];
			     $user->UpdatedDateTime = $result3['UpdatedDateTime'];

			     return Response::json(array('ResultMessage'=>$message, 'Data' => $user));
		
				}
			}
			else
			{
				return Response::json(array('ResultMessage'=>$message));
			}

		}	
					
	}	

	public function UserLogin($loginname,$password)
	{
		$resultmessage = array('ResultMessage');
		$userinfo = array('Data');
		$data = Models\Users::func_Login($loginname,$password);
		
		foreach ($data as $key) {
			$message = new ResultMessage();
		    $result1 = json_encode($key);
		    $result2 = json_decode($result1,true);	
			$message->Result = $result2['Result'];
			$message->ResultMessage = $result2['ResultMessage'];
			$message->ResultID = $result2['ResultID'];
			array_push($resultmessage, $message);
			//dd($resultmessage);
			//return Response::json($resultmessage,200);

			if ($message->Result == 1)
			{
				$userid = $message->ResultID;
				//dd($userid);
				
				$data1 = Models\Users::func_getUsers($message->ResultID);
				foreach ($data1 as $key) {
			     $user = new Users();
		         $result2 = json_encode($key);
		         $result3 = json_decode($result2,true);	
		         //dd($result3);
		         
			     $user->ID = $result3['ID'];
			     $user->LoginName = $result3['LoginName'];
			     $user->EmailAddress = $result3['EmailAddress'];
			     $user->PhoneNumber = $result3['PhoneNumber'];
			     $user->Provider = $result3['Provider'];
			     $user->Seekers = $result3['Seekers'];
			     $user->Referees = $result3['Referees'];
			     $user->LastPageDisplay = $result3['LastPageDisplay'];
			     $user->CreatedDateTime = $result3['CreatedDateTime'];
			     $user->UpdatedDateTime = $result3['UpdatedDateTime'];
			     //dd($user);
			     
			     array_push($userinfo, $user);	
			     //return Response::json($userinfo,200);
			     			
				}
				//dd($userinfo);

				//array_push($resultmessage, $userinfo);

			}

			//dd($resultmessage);
			//dd($userinfo);
			//$count = $count + 2;
			//dd($count);
			//return Response::json($userid,200);
		}
		//dd($resultmessage);
		//dd($userinfo);		
		array_push($resultmessage, $userinfo);
		//dd($resultmessage);
		//return Response::json($resultmessage,200);

		//$userinfo = array('Data');
		//$data1 = Models\Users::func_getUsers($loginname,$password);
		
		if (!$resultmessage) {
			# code...
			return Response::json(['response' => 'loi'],404);
		}
		//return json_encode($data);
		return Response::json($resultmessage,200);
				
	}	


	public function UserLogin2()
	{
		$input = Input::all();
		//dd($input);
		$cinput = new CInput();
		$cinput->loginname = $input['LoginName'];
		$cinput->password = $input['Password'];
		$loginname = $cinput->loginname;
		$password = $cinput->password;
		//dd($password);
		//$resultmessage = array('ResultMessage');
		//$userinfo = array('Data');
		$data = Models\Users::func_Login($loginname,$password);
		
		foreach ($data as $key) {
			$message = new ResultMessage();
		    $result1 = json_encode($key);
		    $result2 = json_decode($result1,true);	
			$message->Result = $result2['Result'];
			$message->ResultMessage = $result2['ResultMessage'];
			$message->ResultID = $result2['ResultID'];
			//array_push($resultmessage, $message);
			//dd($resultmessage);
			//return Response::json($resultmessage,200);

			if ($message->Result == 1)
			{
				$userid = $message->ResultID;
				//dd($userid);
				
				$data1 = Models\Users::func_getUsers($message->ResultID);
				foreach ($data1 as $key) {
			     $user = new CUser();
		         $result2 = json_encode($key);
		         $result3 = json_decode($result2,true);	
		         //dd($result3);
		         
			     $user->ID = $result3['ID'];
			     $user->LoginName = $result3['LoginName'];
			     $user->EmailAddress = $result3['EmailAddress'];
			     $user->PhoneNumber = $result3['PhoneNumber'];
			     $user->Provider = $result3['Provider'];
			     $user->Seekers = $result3['Seekers'];
			     $user->Referees = $result3['Referees'];
			     $user->LastPageDisplay = $result3['LastPageDisplay'];
			     $user->CreatedDateTime = $result3['CreatedDateTime'];
			     $user->UpdatedDateTime = $result3['UpdatedDateTime'];

			     return Response::json(array('ResultMessage'=>$message, 'Data' => $user));
			     //dd($user);
			     
			     //array_push($userinfo, $user);	
			     //return Response::json($userinfo,200);
			     			
				}
				//dd($userinfo);

				//array_push($resultmessage, $userinfo);

			}

			//dd($resultmessage);
			//dd($userinfo);
			//$count = $count + 2;
			//dd($count);
			//return Response::json($userid,200);
		}
		//dd($resultmessage);
		//dd($userinfo);		
		
		//array_push($resultmessage, $userinfo);
		
		//dd($resultmessage);
		//return Response::json($resultmessage,200);

		//$userinfo = array('Data');
		//$data1 = Models\Users::func_getUsers($loginname,$password);
		
		//if (!$resultmessage) {
			# code...
			//return Response::json(['response' => 'loi'],404);
		//}
		//return json_encode($data);
		//return Response::json($resultmessage,200);
			
	}		
	

	public function UserLogin1($loginname,$password)
	{
		//$input = Input::all();
		//$user = new Users();
		//$user->loginname = $input['username'];
		//$user->password = $input['password'];
		//return 'Username is '.$username . ' Password is '.$password;
		//$username = ,
		//$password
		$ResultMessage = array('ResultMessage');
		//return 'login user';
		$data = Models\Users::func_Login($loginname,$password);
		//$result1 = json_encode($data);
		//$result2 = json_decode($result1,true);
		//dd($result2);

		/*	
		foreach ($data as $key) {
			$message = new ResultMessage();
			$result1 = json_encode($key);
			$result2 = json_decode($result1,true);
			$message->result = $result2['Result'];
			$message->resultmessage = $result2['ResultMessage'];
			$message->resultid = $result2['ResultID'];
			array_push($ResultMessage, $message);
		}
		*/		

		//dd($data);
		//if (!$data) {
		//	# code...
		//	return Response::json(['response' => 'loi'],404);
		//}
		//return json_encode($data);
		return Response::json($data,200);
				
	}		

	public function test($username,$password)
	{
		//return 'Username is '.$username . ' Password is '.$password;

		$ResultMessage = array('ResultMessage');
		//return 'login user';
		$data = Models\Users::func_Login($username,$password);
		//$result1 = json_encode($data);
		//$result2 = json_decode($result1,true);
		//dd($result2);

		/*	
		foreach ($data as $key) {
			$message = new ResultMessage();
			$result1 = json_encode($key);
			$result2 = json_decode($result1,true);
			$message->result = $result2['Result'];
			$message->resultmessage = $result2['ResultMessage'];
			$message->resultid = $result2['ResultID'];
			array_push($ResultMessage, $message);
		}
		*/		

		//dd($data);
		//if (!$data) {
		//	# code...
		//	return Response::json(['response' => 'loi'],404);
		//}
		//return json_encode($data);
		return Response::json($data,200);
				
	}	
/*
	public function allUsers()
	{
		$data = Models\Users::func_GetAll();
        $user = new Users();
        //$data1 = $data[0];
        $result = json_encode($data);
        $result1 = json_decode($result,true);

		return Response::json($result1,200);
		//dd($result1);

	}
	public function getUsers($id)
	{
		//return 'abc';
		$data = Models\Users::func_getUsers($id);
        $user = new Users();
        $data1 = $data[0];
        $result = json_encode($data1);
        $result1 = json_decode($result,true);
        $user->id = $result1['ID'];
        $user->username = $result1['UserName'];
        $user->password = $result1['Password'];		
		return Response::json($user,200);
		//return Response::json($data[0]['ID'],200);
		//dd($result1);
	}
	public function saveUsers()
	{
		
		//$input = Input::all();
		//$user = new Users();
		//$user->username = $input['username'];
		//$user->password = $input['password'];
		//$user->fullname	= $input['fullname'];		
		//dd($input['password']);
		//$username = $user->get('username');
		//return Response::json($user,200);
		return Input::all();

		//return $this->user->func_SaveUser();

		//$username = Input::get('usersname');
		//return Response::json($username,200);
		//return Response::json(['response' => 'loi saveUsers'],404);
		//return 'get2 user by id ';
	}
	public function updateUsers($id)
	{
		return 'update user by id '.$id;
	}
	

	//----------------------------------

	//Controller UserCheck--------------

	public function loginUser($loginname,$userpass)
	{
		//return 'login user';
		$data = Models\Users::func_Login($loginname,$userpass);
		if (!$data) {
			# code...
			return Response::json(['response' => 'loi'],404);
		}
		//return json_encode($data);
		return Response::json($data,200);
	}	

	public function loginUserError($loginname,$userpass)
	{
		return Response::json(['response' => 'Loi dang nhap'],404);
	}	
	*/
	//----------------------------------
}
