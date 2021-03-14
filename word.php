<?php
    // Load library 
include_once 'HtmlToDoc.class.php';  
 
// Initialize class 
$htd = new HTML_TO_DOC();
$htmlContent = ' 
    <h1>Hello World!</h1> 
    <p>This document is created from HTML.</p>';
$wordDoc = $htd->createDoc($htmlContent, "my-document");
if($wordDoc){
    echo "done";
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<h1>
    hello world
</h1>
</body>
</html>