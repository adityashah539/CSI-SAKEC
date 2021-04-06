<!-- this is code for printing the page  -->
<!-- code for word -->
<!DOCTYPE html>
<?php 
 	header("Content-Type: application/vnd.ms-word");
    header("content-disposition: attachment;filename=Report.doc");
?>
<html>
<body>
    <h2>The window.print() Method</h2>
    <p>Click the button to print the current page.</p>
    <button id="i" onclick="a()">Print this page</button>
    <script>
        function a(){
        document.getElementById("i").style.display ="NONE"; 
        window.print();
        document.getElementById("i").style.display ="block"; 
        }
    </script>
</body>
</html>