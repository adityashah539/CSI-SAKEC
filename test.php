<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>test </title>
    <style>
        *,
        *:before,
        *:after {
            box-sizing: border-box;
        }

        .toolbar {}

        .tool-list {
            display: flex;
            flex-flow: row nowrap;
            list-style: none;
            padding: 0;
            margin: 1rem;
            overflow: hidden;
            border-raduis: 10px;
        }

        .tool {}

        .tool--btn {
            display: block;
            border: none;
            padding: .5rem;
            font-size: 20px;
        }

        #output {
            height: auto;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
            margin: 1rem;
            padding: 1rem;
        }
    </style>

</head>

<body>
    <div class="toolbar">
        <ul class="tool-list">
            <li class="tool">
                <button type="button" data-command='justifyLeft' class="tool--btn">
                    <i class=' fas fa-align-left'></i>
                </button>
            </li>
            <li class="tool">
                <button type="button" data-command='justifyCenter' class="tool--btn">
                    <i class=' fas fa-align-center'></i>
                </button>
            </li>
            <li class="tool">
                <button type="button" data-command='justifyRight' class="tool--btn">
                    <i class=' fas fa-align-right'></i>
                </button>
            </li>
            <li class="tool">
                <button type="button" data-command="bold" class="tool--btn">
                    <i class=' fas fa-bold'></i>
                </button>
            </li>
            <li class="tool">
                <button type="button" data-command="italic" class="tool--btn">
                    <i class=' fas fa-italic'></i>
                </button>
            </li>
            <li class="tool">
                <button type="button" data-command="underline" class="tool--btn">
                    <i class=' fas fa-underline'></i>
                </button>
            </li>
            <li class="tool">
                <button type="button" data-command="insertOrderedList" class="tool--btn">
                    <i class=' fas fa-list-ol'></i>
                </button>
            </li>
            <li class="tool">
                <button type="button" data-command="insertUnorderedList" class="tool--btn">
                    <i class=' fas fa-list-ul'></i>
                </button>
            </li>
            <li class="tool">
                <button type="button" data-command="createlink" class="tool--btn">
                    <i class=' fas fa-link'></i>
                </button>
            </li>
        </ul>
    </div>

    <div id="output" contenteditable="true"></div>
    <script>
        let output = document.getElementById('output');
        let buttons = document.getElementsByClassName('tool--btn');
        for (let btn of buttons) {
            btn.addEventListener('click', () => {
                let cmd = btn.dataset['command'];
                if (cmd === 'createlink') {
                    let url = prompt("Enter the link here: ", "http:\/\/");
                    document.execCommand(cmd, false, url);
                } else {
                    document.execCommand(cmd, false, null);
                }
            })
        }
    </script>
</body>

</html>