$(".auth-input").keyup(function(event) {
    if (event.which === 13) {
        $("#btn-login").click();
    }
});

$('#btn-login').click(function(){
    let email = $('#email').val();
    let password = $('#password').val();
    checkIfValid(email, password);
});

const checkIfValid =(email, password)=> {
    if(email != "" && password != ""){
        requestLogin(email, password);
    }else{
        swal("Error", "Please fill the empty field(s).", "error", {
            button: "Okay",
          });
    }
};

const requestLogin =(email, password)=> {
    $.ajax({
        type: "POST",
        url: "../services/router/auth.php",
        data: {choice: 'login', email:email, password:password},
        success: function(data) {
            switch(data){
                case 'success':
                    swal("Login Account", "Logged In Sucessfully!", "success", {
                        button: "Okay",
                    });
                    setInterval('location.reload()', 1000);
                    break;

                case 'failedLogin':
                    swal("Error", "Invalid Credentials!", "error", {
                        button: "Okay",
                    });
                    break;
            }
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    })
};