<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>

<body>
    <div class="container">
        <img id="header" src="images/CSI-header.jpg" alt="CSI" style="width: 967px; height: 238px;"> <br>
        <div id="exportContent">
            <br>
            <div class="head" style="display: flex;
            justify-content: space-between;"><span><b>REF NO.:__</b></span> <span><b>DATE:_/_/__</b></span></div>
            <div class="spacer" style="height: 50px;"></div>
            <p>
                To, <br>
                The Principal, <br>
                Shah & Anchor Kutchhi Engineering College <br>
                Chembur, Mumbai 400088
                <br><br>
                Subject: Permission to conduct an event on Introduction to ML with Tensor-flow 2.0. {{ EVENT NAME}}
                <br><br>
                Respected Sir,
                <br><br>
                {{ DETAILS }}<br>
                CSI-SAKEC is organising an event <b>'Introduction to ML with Tensor-flow 2.0'</b>,in
                collaboration with Computer Department on 10th August, 2019. For the same, permission
                is required to access lab 209 and 210 along with screen and projectors as well as social
                media publicity. <br>
                Thus, kindly give us permission to access the above mentioned venue from 9:00 AM to 5:00 PM on 10th August,
                2019.
                <br><br>
                Thanking You. <br>
                Yours sincerely, <br>
                {{ SIGNATURE OF SECRETARY }}<br>
                <!-- <img src="images/Chintan-sign.jpg" alt="signature" style="width: 147px;"> --> <br> <br>
                General Secretary <br>
                (CSI-SAKEC 2019-20)
            </p>
            <br> <br>
            <form style="text-align:center" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <!-- <button name="doc" id="i" onclick="a()">EXPORT TO DOC</button> -->
                <button class="btn btn-primary" id="i" onclick="Export2Word('exportContent', 'word-content.docx');"><i class="fa-solid fa-phone"></i>Export as .docx</button>
                
            </form>
            <br> <br>
        </div>
        <!-- Your content here -->
    </div>

    <script>
        // function a(){
        // document.getElementById("i").style.display ="NONE"; 
        // //window.print();
        // document.getElementById("i").style.display ="block"; 
        // }
        function Export2Word(element, filename = '') {
            document.getElementById("i").style.display = "NONE";
            document.getElementById("header").style.display = "NONE";
            //window.print();
            var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>";
            var postHtml = "</body></html>";
            var html = preHtml + document.getElementById(element).innerHTML + postHtml;
            var blob = new Blob(['\ufeff', html], {
                type: 'application/msword'
            });
            // Specify link url
            var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);
            // Specify file name
            filename = filename ? filename + '.doc' : 'document.doc';
            // Create download link element
            var downloadLink = document.createElement("a");
            document.body.appendChild(downloadLink);
            if (navigator.msSaveOrOpenBlob) {
                navigator.msSaveOrOpenBlob(blob, filename);
            } else {
                // Create a link to the file
                downloadLink.href = url;
                // Setting the file name
                downloadLink.download = filename;
                //triggering the function
                downloadLink.click();
            }
            document.body.removeChild(downloadLink);
            //window.print();
            document.getElementById("i").style.display = "block";
            document.getElementById("header").style.display = "NONE";
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>