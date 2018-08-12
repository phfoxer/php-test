<?php
class Tools {

    public $filePath = 'file.txt';

    public function setfilePath($filePath){
        $this->filePath = $filePath;
    }

    public function getfilePath($filePath){
        $this->filePath = $filePath;
    }

    /**
     * Create a file data
     *
     * @param string $txt
     * @return String
     */
    public function createFile($data = [], $newValue = []):String {
        try {
            $file = fopen($this->filePath, "w");
            $txt = '';
            if ($file && count($data)) {
                if (count($newValue)) {
                    $newValue   = (array) $newValue;
                    $txt        .= json_encode($newValue).PHP_EOL;
                }
                foreach ($data as $value) {
                    $txt .= json_encode($value).PHP_EOL;
                }
                fwrite($file, $txt);
                fclose($file);
                return 'done';
            } else {
               throw new Exception("fail", 1);
            }
        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }
    
    /**
     * Create a file data
     *
     * @return String
     */
    public function readFile():Array {
        try {
            $result = [];
            $file = fopen($this->filePath, "r");
            if ($file) {
                while(!feof($file)) {
                    $json = str_replace( "\\r\\n", "", fgets($file));
                    array_push($result, json_decode($json,1));
                }
                fclose($file);
                return array_filter($result);
            } else {
               throw new Exception("Unable to open file!", 1);
            }
        } catch(\Exception $e) {
            return [];
        }
    }

    /**
     * Read request object
     * @param boolean $asJson 
     * @return Object
     */
    public function request():Object {
        $request = file_get_contents('php://input');
        return ($request)? json_decode($request) : (object) $_GET;
    }

    public function getByKey($key, $value):Array {
        $fileData = $this->readFile();
        foreach ($fileData as $object) {
            if ($object) {
                $data       = (array) $object;
                $arrayValue = (isset($data[$key])) ? $data[$key] : '';
                if ($arrayValue==$value) {
                    return $data;
                }
            }
        }
        return [];
    }

    public function removeItemByKey($key, $value):Array {
        $fileData = $this->readFile();
        foreach ($fileData as $object) {
            if ($object) {
  
            }
        }
        return $this->readFile();
    }

    public function clearFile() {
        if ($this->filePath) {
            $file = fopen($this->filePath, "w");
            fwrite($file, '');
            fclose($file);
            return true;
        } else {
            return false;
        }
    }

    public function segment($index){
        $segments = explode('/',$_SERVER['REQUEST_URI']);
        return isset($segments[$index]) ? $segments[$index] : '';
    }
}
