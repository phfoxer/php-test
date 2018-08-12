<?php
function xmlToCsv($xmlFile, $csvOutput='file.csv'):Array{
     try {
        if (!file_exists($xmlFile)) {
        throw new Exception("O arquivo xml não foi encontrado", 1);
        }
        libxml_use_internal_errors(true);
        $xml=simplexml_load_file($xmlFile);
        $fp = fopen($csvOutput, 'w');
        // criando o header
        $headers = [];
        if ($xml) {
            foreach ($xml->children()->children() as $children) {
                array_push($headers,$children->getName());
            }
            fputcsv($fp, $headers);
            // resgatando valores
            $values = [];
            foreach ($xml->children() as $children) {
                $line = [];
                foreach ($children as $key => $node) {
                    $data = current(get_object_vars($node));
                    array_push($line,$data);
                }
                fputcsv($fp, $line);
            }
            fclose($fp);
        } else {
            throw new Exception("Erro ao ler XML",1);
        }
    } catch(Exception $e){
        return ['code' => 'fail', 'message' => $e->getMessage()];
    }
    return ['code' => 'done', 'message' => "CSV criado com sucesso!"];
}

$result = xmlToCsv('arquivo.xml','file.csv');
print_r($result);