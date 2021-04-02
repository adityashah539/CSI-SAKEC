<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="plugins/css/mdb.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="css/admin.css">

    <title>Team members list</title>
</head>

<body>
    <div class="spacer" style="height:10px;"></div>
    <!-- Members List -->
    <div class="members">

        <h2 style="text-align: center;">Team Members List</h2>
        <div class="spacer" style="height:30px;"></div>
        <div class="row">
            <div class="col-sm-6"></div>
            <button onclick="location.href='addmember.html'" type="button" class="btn btn-primary">Add Member</button>
        </div>
        <div class="spacer" style="height:10px;"></div>
        <table class="table">
            <thead class="black white-text">
                <tr>
                    <th scope="col">NAME</th>
                    <th>DESIGNITION</th>
                    <th>IMAGE</th>

                    <th>EDIT</th>
                    <th>Delete</th>

                </tr>
            </thead>
            <tbody>
                <div class="table-content" style="font-size: large;">
                    <tr>
                        <th scope="row">Dhruvi Jain</th>
                        <td>CSI HEAD</td>

                        <td>
                            <a target="_blank" href="images/Dhruvi-jain.jpg">
                                <img src="images/Dhruvi-jain.jpg" alt="Forest" style="width:80px">
                            </a>
                        </td>
                        <td> <button onclick="location.href='addmember.html'" type="button"
                                class="btn btn-success">Edit</button> </td>
                        <td><button type="button" class="btn btn-danger">Delete</button> </td>
                    </tr>
                </div>
            </tbody>
        </table>
        <div class="spacer" style="height:30px;"></div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>