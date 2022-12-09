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
                    swal({
                        icon: 'success',
                        title: 'Account',
                        text: "Changed password successfully!",
                        buttons: 'Okay',
                      })
                      .then((willRetrieve) => {
                        if (willRetrieve) {
                            window.location.href = './index.php';
                        }
                    });
                    break;

                case 'PasswordDoesNotMatch':
                    swal("Error", "Password Does Not Match!", "error", {
                        button: "Okay",
                    });
                    break;

                case 'PasswordNotFound':
                    swal("Error", "Incorrect Old Password!", "error", {
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