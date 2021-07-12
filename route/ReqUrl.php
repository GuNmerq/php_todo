<?php 
    class getUrl{
            public function getBaseUrl(){
                $request_uri = $_SERVER['REQUEST_URI'];
                $script_name = $_SERVER['SCRIPT_NAME'];

                if(0 === strpos($request_uri,$script_name)){
                    return $script_name;
                }elseif(0 === strpos($request_uri,dirname($script_name))){
                    return rtrim(dirname($script_name),'/');
                }
            }

            public function getPath(){
                $baseUrl = $this->getBaseUrl();
                $request_uri = $_SERVER['REQUEST_URI'];
                if(false !== ($pos = strpos($request_uri,'?'))){
                    $request_uri = substr($request_uri,0,$pos);
                }
                $path = (string) substr($request_uri,strlen($baseUrl));
                return $path;
            }
    }
?>