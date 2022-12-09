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
                    swal({
                        icon: 'success',
                        title: 'Login Account',
                        text: "Logged in successfully!",
                        buttons: 'Okay',
                      })
                      .then((willLogin) => {
                        if (willLogin) {
                            setInterval('location.reload()', 200);;
                        }
                    });
                    break;

                case 'failedLogin':
                    swal("Error", "Invalid Credentials!", "error", {
                        button: "Okay",
                    });
                    break;

                case 'invalidCredentials':
                    $('#email').addClass('is-invalid');
                    break;

                default:
                    console.log('Not Found Functionality...');
                    break;
            }
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    })
};