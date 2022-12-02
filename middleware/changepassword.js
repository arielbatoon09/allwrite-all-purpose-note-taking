$(".auth-input").keyup(function(event) {
    if (event.which === 13) {
        $("#btn-changepass").click();
    }
});

$('#btn-changepass').click(function(){ 
    let oldpassword = $('#oldpassword').val();
    let newpassword = $('#newpassword').val();
    let confirmpassword = $('#confirmpassword').val();
    checkIfValid(oldpassword, newpassword, confirmpassword);
});

const checkIfValid =(oldpassword, newpassword, confirmpassword)=> {
    if(oldpassword != "" && newpassword != "" && confirmpassword != ""){
        requestChangePassword(oldpassword, newpassword, confirmpassword);
    }else{
        swal("Error", "Please fill the empty field(s).", "error", {
            button: "Okay",
          });
    }
};

const requestChangePassword =(oldpassword, newpassword, confirmpassword)=> {
    $.ajax({
        type: "POST",
        url: "../../services/router/auth.php",
        data: {choice: 'changepassword', oldpassword:oldpassword, newpassword:newpassword, confirmpassword:confirmpassword},
        success: function(data) {
            switch(data){
                case 'changedPassword':
                    swal("Account", "Changed password successfully!", "success", {
                        button: "Okay",
                    });
                    setInterval('location.reload()', 1000);
                    break;

                case 'PasswordDoesNotMatch':
                    swal("Error", "Password Does Not Match!", "error", {
                        button: "Okay",
                    });
                    break;

                case 'PasswordNotFound':
                    swal("Error", "Password Not Found!", "error", {
                        button: "Okay",
                    });
                    break; 
                    
                case 'invalidCredentials':
                    swal("Error", "Invalid Credentials!", "error", {
                        button: "Okay",
                    });
                    break;   
                    
                case 'passwordNotMeetRequirements':
                    $('#newpassword').addClass('is-invalid');
                    break;                   
            }
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    })
};