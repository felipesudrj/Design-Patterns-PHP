<?php
require './vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

class ClassFacade
{

    public function upload($file_name)
    {

        $bucket_name = $this->getNameBucket();
        $s3client = new Aws\S3\S3Client($this->getConfigs());
        
        try {

            $s3client->putObject([
                'Bucket' => $bucket_name,
                'Key' => $file_name,
                'SourceFile' => 'testfile.txt'
            ]);

            $response =  "Uploaded $file_name to $bucket_name.\n";
        } catch (Exception $exception) {

            $response = "Failed to upload $file_name with error: " . $exception->getMessage();
        }

        return $response;
    }

    private function getNameBucket()
    {
        return 'BucketProduction';
    }
    private function getConfigs()
    {
        return ['region' => 'us-west-2', 'version' => 'latest'];
    }
}
