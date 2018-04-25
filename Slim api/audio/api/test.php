<form id="ajax-contact" method="post" action="mailer.php">
    <div class="field">
        <label for="name">name:</label>
        <input type="text" id="username" name="username" required>
    </div>

    <div class="field">
        <label for="band">email:</label>
        <input type="text" id="email" name="email" required>
    </div>

    <div class="field">
        <label for="status">password:</label>
        <input id="password" name="password" required>
    </div>

    <div class="field">
        <button type="button" onclick="submitForm();">Send</button>
    </div>
</form>
<script
              src="http://code.jquery.com/jquery-3.3.1.min.js"
              integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
              crossorigin="anonymous"></script>

<script type="text/javascript">
    function submitForm(){
        var username = $('#username').val();
        var email = $('#email').val();
        var password = $('#password').val();
        //var id = '302';

        var values = {'email':'numairsaif@gmail.com'};
//         var values = {
//     "playlists": [{
//         "id": "766",
//         "songs": [{
//                 "name": "stargazing",
//                 "artist": "kygos",
//                 "image": "http:testingserver/audio/api/image",
//                 "album_id": 1,
//                 "songUrl": "http:testingserver/audio/api/image",
//                 "profile_id": "83"
//             },
//             {
//                 "name": "stargazing",
//                 "artist": "kgo",
//                 "image": "http:testingserver/audio/api/image",
//                 "album_id": 1,
//                 "songUrl": "http:testingserver/audio/api/image",
//                 "profile_id": "83"
//             }
//         ]
//     }]
// }
        var data = JSON.stringify(values);
console.log(data);
        $.ajax({
        url: "http://testingserver.net/testapi/audio/api/forgetpassword",
        type: "post",
        data: {'data':data} ,
        success: function (response) {
           console.log(response);                 

        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }


    });
    }
</script>