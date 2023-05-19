<!DOCTYPE html>
            <html lang="en">
            
            <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<style>
    .error input {
        border-color: red;
        border-width: 2px;
    }
    
    .success input {
        border-color: green;
        border-width: 2px;
    }
    
    .error span {
        color: red;
    }
    
    .success span {
        color: green;
    }
    
    span.error {
        color: red;
    }
    
    i {
        font-weight: 900;
        font-family: 'Font Awesome 5 Free';
    }
    .alert-warning {
    color: white;
    background-color: #FF6347;
    border-color: #ffeeba;
}
    </style>
</head>
<body class="bg-light">
    <div class="container p-3">
        <div class="col-lg-6 m-auto d-block p-3 bg-white">
            <h2 class="pb-3 text-success">
                Form Create Data
            </h2>
            <div id="message"></div>
            <form method="POST" id="myform">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="user1">
                            Username:
                        </label>
                        <input type="text" name="username" id="username" class="form-control">
                        <span class="error" id="username_err"> </span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="user1">
                            Umur:
                        </label>
                        <input type="text" name="umur" id="umur" class="form-control">
                        <span class="error" id="umur_err"> </span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="user1">
                            Alamat:
                        </label>
                        <input type="text" name="alamat" id="alamat" class="form-control">
                        <span class="error" id="alamat_err"> </span>
                    </div>
                

                


                    <div class="col-md-12">
                        <button type="button" id="submitbtn" class="btn btn-primary  ">Submit</button>
                    </div>

                </div>

            </form>
        </div>
    </div>


    <!--call js here-->
    <script>
$(document).ready(function () {
    $('#username').on('input', function () {
        checkuser();
    });
    $('#umur').on('input', function () {
        checkumur();
    });
    $('#alamat').on('input', function () {
        checkalamat();
    });

    $('#submitbtn').click(function () {


        if (!checkuser() && !checkumur() && !checkalamat()) {
            console.log("er1");
            $("#message").html(`<div class="alert alert-warning">Harap isi semua bidang yang wajib diisi!</div>`);
        } else if (!checkuser() && !checkumur() && !checkalamat()) {
            $("#message").html(`<div class="alert alert-warning">Harap isi semua bidang yang wajib diisi!</div>`);
            console.log("er");
        }
        else {
            console.log("ok");
            $("#message").html("");
            var form = $('#myform')[0];
            var data = new FormData(form);
            $.ajax({
                type: "POST",
                url: "tabeljquery.php",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                beforeSend: function () {
                    $('#submitbtn').html('<i class="fa-solid fa-spinner fa-spin"></i>');
                    $('#submitbtn').attr("disabled", true);
                    $('#submitbtn').css({ "border-radius": "50%" });
                },

                success: function (data) {
                    $('#message').html(data);
                },
                complete: function () {
                    setTimeout(function () {
                        $('#myform').trigger("reset");
                        $('#submitbtn').html('Submit');
                        $('#submitbtn').attr("disabled", false);
                        $('#submitbtn').css({ "border-radius": "4px" });
                    }, 50000);
                }
            });
        }
    });
});


function checkuser() {
    var pattern = /^[A-Za-z0-9]+$/;
    var user = $('#username').val();
    var validuser = pattern.test(user);
    if ($('#username').val().length < 4) {
        $('#username_err').html('username harus diisi terlebih dahulu!');
        return false;
    } else if (!validuser) {
        $('#username_err').html('username harus a-z ,A-Z saja');
        return false;
    } else {
        $('#username_err').html('');
        return true;
    }
}
function checkumur() {
    var pattern1 = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    var umur = $('#umur').val();
    var validumur = pattern1.test(umur);
    if (umur == "") {
        $('#umur_err').html('kolom yang harus diisi!');
        return false;
    } else if (!validumur) {
        $('#umur_err').html('harus 0-9 saja');
        return false;
    } else {
        $('#umur_err').html('');
        return true;
    }
}
function checkalamat() {
    var pattern1 = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    var alamat = $('#alamat').val();
    var validalamat = pattern1.test(alamat);
    if (alamat == "") {
        $('#alamat_err').html('alamat harus diisi!');
        return false;
    } else if (!validalamat) {
        $('#alamat_err').html('minimal 24 karakter');
        return false;
    } else {
        $('#alamat_err').html('');
        return true;
    }
}


</script>
</body>
</html>