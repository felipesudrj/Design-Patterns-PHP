<?php
require './vendor/autoload.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {

        $file_name = $_FILES['file'] ?? null;

        if(empty($file_name)){
            throw new Exception('Sem nenhum arquivo selecionado');
        }

        $objFacade = new ClassFacade();
        $objFacade->upload($file_name['tmp_name']);


    } catch (Exception $exception) {

        $response = $exception->getMessage();
    }
}
?>
<form action="" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>
