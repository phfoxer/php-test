<?php
class Tools {

    /**
     * Create a file data
     *
     * @param string $filePath
     * @param string $txt
     * @return String
     */
    public function createFile($filePath, $data = [],$newValue):String {
        try {
            if (!trim($newValue)) { throw new Exception("fail", true); }
            $file = fopen($filePath, "w");
            $txt = '';
            if ($file) {
                array_push($data,$newValue.PHP_EOL);
                foreach ($data as $value) {
                    $txt .= $value;
                }
                fwrite($file, $txt);
                fclose($file);
                return 'done';
            } else {
               throw new Exception("fail", true);
            }
        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }
    
    /**
     * Create a file data
     *
     * @param string $filePath
     * @return String
     */
    public function readFile($filePath):Array {
        try {
            $result = [];
            $file = fopen($filePath, "r");
            if ($file) {
                while(!feof($file)) {
                    array_push($result, fgets($file));
                }
                fclose($file);
                return array_filter($result);
            } else {
               throw new Exception("Unable to open file!", true);
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
        return json_decode($request);
    }
}
