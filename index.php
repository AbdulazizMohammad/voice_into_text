<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Voice into Text</title>
    <script src='https://code.jquery.com/jquery-2.1.3.min.js'></script>
    <link rel="icon" type="image/png" href="imgs/microphone.png" />
</head>
<body>
    <button id="recordButton" name="recordButton" onclick="vit()">Rec</button>
    <p><span id="action"></span></p>
    <div id="output" class="hide"></div>
    <script>
        function vit() {
            var output = document.getElementById("output");
            var action = document.getElementById("action");
            var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
            var recognition = new SpeechRecognition();

            recognition.onstart = function() {
                action.innerHTML = "<small>I'm listening...</small>";
            };

            recognition.onspeechend = function() {
                action.innerHTML = "<small>Stopped listening, fetching result..</small>";
                recognition.stop();
            }

            recognition.onresult = function(event) {
                var transcript = event.results[0][0].transcript;
                var confidence = event.results[0][0].confidence;
                output.innerHTML = transcript;
                output.classList.remove("hide");
                update(transcript);
            };

            recognition.start();
        }

        function update(t) {
            $(document).ready(function() {
                    var data = {
                        text: t,
                    };

                    $.ajax({
                        type: 'POST',
                        url: 'insert.php', 
                        data: data,
                        success: function(response) {
                            console.log(response); 
                        }
                    });
            });

        }
    </script>
</body>
</html>