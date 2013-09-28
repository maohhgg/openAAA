<?php
	
	class AAA{
		
		protected $client;
		protected $version="1.0.0.0";
		
		public function __construct($str){
			$this->client = new SoapClient($str);
			if(!$this->client){
				return false;
			}
		}
		
		public function GetTokenPicture(){				
			$res = $this->client->GetTokenPictureBytes();
			$data = $res->GetTokenPictureBytesResult;
			$jpg = imagecreatefromstring($data);
			if ($jpg == false)
				return false;
			header('Content-Type: image/jpeg');
			imagejpeg($jpg);
			imagedestroy($jpg);
		}
		
		public function Goin($data){
			$res = $this->client->Login($data);
			if($res)
				return $res;
			else
				return false;
		}

		public function keeplogin($data){
			$res = $this->client->KeepSession($data);
			if($res !== ture)
				return $res;
		}

		public function Goout($data){
			$res = $this->client->Logout($data);
			if($res !== ture)
				return $res;
		}

	}

?>