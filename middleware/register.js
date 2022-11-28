$(".auth-input").keyup(function(event) {
    if (event.which === 13) {
        $("#btn-register").click();
    }
});
$('#btn-register').click(function(){
    let firstname = $('#firstname').val();
    let lastname = $('#lastname').val();
    let fullname = firstname + " "+lastname;
    let email = $('#email').val();
    let password = $('#password').val();
    let confirmpass = $('#confirmpass').val();
    checkIfValid(fullname, email, password, confirmpass);
    //checkIfValid(fullname, email, password, confirmpass);
});

const checkIfValid =(fullname, email, password, confirmpass)=> {
    if($('#firstname').val() != "" && $('#lastname').val() != "" 
    && email != "" && password != "" && confirmpass != ""){
        if(password == confirmpass){
            if($('#agreePolicy').is(":checked")){
                requestRegister(fullname, email, password, confirmpass);
            }else{
                swal("Error", "Read the Terms and Conditions.", "error", {
                    button: "Okay",
                  });
            }
        }else{
            swal("Error", "Password does not match!", "error", {
                button: "Okay",
              });
        }
    }else{
        swal("Error", "Please fill the empty field(s).", "error", {
            button: "Okay",
          });
    }
};   

const requestRegister =(fullname, email, password, confirmpass)=> {
    $.ajax({
        type: "POST",
        url: "../services/router/auth.php",
        data: {choice: 'register', fullname:fullname, email:email, 
        password:password, confirmpass:confirmpass},
        success: function(data) {
            switch(data){
                case 'successCreateAccount':
                    swal("Register Account", "You created sucessfully. Login Now!", "success", {
                        button: "Okay",
                    })
                    setInterval('window.location.href="./login.php"', 1000);
                    break;
                case 'emailTaken':
                    swal("Error", "Email is already existing!", "error", {
                        button: "Okay",
                    });
                    break;
                case 'passwordNotMeetRequirements':
                    $('#password').addClass('is-invalid');
                    $('#email').removeClass('is-invalid');
                    break;
                case 'failedCreateAccount':
                    swal("Error", "Failed to create your account!", "error", {
                        button: "Okay",
                    });
                    break;
                case 'passwordNotMatch':
                    swal("Error", "Password does not match!", "error", {
                        button: "Okay",
                    });
                    break;
                case 'invalidCredentials':
                    $('#email').addClass('is-invalid');
                    break;
                }
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    })
};