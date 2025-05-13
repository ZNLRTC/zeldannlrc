<?php 

class Session {
	public static function exists($name){
		return (isset($_SESSION[$name])) ? true:false;
	}
	public static function put($name, $value){
		return $_SESSION[$name] = $value;
	}

	public function get($name){
		return $_SESSION[$name];
	}
	public static function delete($name){
		if(self::exists($name)){
			unset($_SESSION[$name]);
		}
	}
    public function redirectTo($location = null){
            if($location){
                //if it cannot find the specefic location it will go to error 404
                if(is_numeric($location)){
                    switch ($location) {
                        case 404:
                        header('HTTP/1.0 404 Not Found');
                        exit();
                        break;
                    }
                }
                //redirect to the page
                header('Location:'.$location);
                exit();
        }
    }

}
