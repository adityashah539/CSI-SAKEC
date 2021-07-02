<!-- this is code for printing the page  -->
<!-- code for word -->
<!DOCTYPE html>
<?php 
 	//header("Content-Type: application/vnd.ms-word");
    //header("content-disposition: attachment;filename=Report.doc");
?>
<html>
<body>
    <h2>The window.print() Method</h2>
    <p>Click the button to print the current page.</p>
    <button id="i" onclick="a()">Print this page</button>
    <?php 
    //  from database
    // echo $quetions;
    echo '<iframe src="https://docs.google.com/forms/d/e/1FAIpQLSdSoDtiRw2SfLNsayGbkWBiO53zFcj3ITbE2SIw71Gann1dPw/viewform?embedded=true" width="640" height="718" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>';?>
    <input type="hidden" name="user" value="<?php echo "rahul"; ?>">
    <form action="https://forms.gle/DVF5u62SSvia2RUn6">
    <label for="FNAME">First Name</label>
        <input name="entry.1499702011" type="text" id="FNAME" />
    <label for="LNAME">Last Name</label>
        <input name="entry.738838864" type="text" id="LNAME" />
        <button type="submit" >Print this page</button>
    </form>
    <div id="ff-compose"></div>
<script 
async defer src="https://formfacade.com/include/115161416928571533811/form/1FAIpQLSdSoDtiRw2SfLNsayGbkWBiO53zFcj3ITbE2SIw71Gann1dPw/classic.js?div=ff-compose"></script>

    <!-- <script>
        function a(){
        document.getElementById("i").style.display ="NONE"; 
        window.print();
        document.getElementById("i").style.display ="block"; 
        }
    </script> -->
</body>
</html>