<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <div id="status">
        <button type="submit" id="button_live" onclick="status_change()" class="btn btn-success">Live</button>
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
  <label class="btn btn btn-outline-success active">
    <input type="radio" name="options" id="option1" checked> Active
  </label>
  <label class="btn btn-outline-danger">
    <input type="radio" name="options" id="option2"> Radio
  </label>
  
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</div>
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