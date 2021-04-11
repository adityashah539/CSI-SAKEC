<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css" rel="stylesheet" />
</head>

<body>
    <div id="status">
        <button type="submit" id="button_live" onclick="status_change()" class="btn btn-success">Live</button>
    </div>
    <script>
        function status_change() {
            var x = document.getElementById("button_live");
            if (JSON.stringify(x) != "null") {
                document.getElementById("status").innerHTML = '<button type="submit" name="delete_event_btn" onclick="status_change()" class="btn btn-danger"> Delete</button>';
            } else {
                document.getElementById("status").innerHTML = '<button type="submit" id ="button_live" onclick="status_change()" class="btn btn-success">Live</button>';
            }
        }

        function eventfuvtion(data) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "eventfuction.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>
</body>

</html>