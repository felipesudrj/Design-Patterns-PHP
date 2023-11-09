<?php
require './../vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\Exception\AwsException;
/**
 * Design Patterns com PHP FACADE
 */

 if($_SERVER['REQUEST_METHOD'] =='POST'){
    
    try {

    $file_name = $_FILES['file'] ?? null;
    
    if(empty($file_name)){
        throw new Exception('Sem nenhum arquivo selecionado');
    }
    
    $bucket_name = 'BucketProduction';
    $s3client = new Aws\S3\S3Client($this->getConfigs());
    

        $s3client->putObject([
            'Bucket' => $bucket_name,
            'Key' => $file_name,
            'SourceFile' => $file_name['tmp_name']
        ]);

        $response =  "Uploaded $file_name to $bucket_name.\n";
    } catch (Exception $exception) {

        $response = "Failed to upload $file_name with error: " . $exception->getMessage();
    }


    echo $response;
    
 }
?>

<form action="" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>
