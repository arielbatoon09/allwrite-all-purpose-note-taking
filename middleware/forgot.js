$(".auth-input").keyup(function(event) {
    if (event.which === 13) {
        $("#btn-forgot").click();
    }
});

$('#btn-forgot').click(function(){
    let email = $('#email').val();
    let pincode = $('#pincode').val();
    let newpassword = $('#newpassword').val();
    checkIfValid(email, pincode, newpassword);
});

const checkIfValid =(email, pincode, newpassword)=> {
    if(email != "" && pincode != ""){
        requestRetrieve(email, pincode, newpassword);
    }else{
        swal("Error", "Please fill the empty field(s).", "error", {
            button: "Okay",
          });
    }
};

const requestRetrieve =(email, pincode, newpassword)=> {
    $.ajax({
        type: "POST",
        url: "../services/router/auth.php",
        data: {choice: 'retrievePass', email:email, pincode:pincode, newpassword:newpassword},
        success: function(data) {
            switch(data){
                case 'retrieveSuccessfully':
                    swal("Retrieve Account", "Changed Password Successfully!", "success", {
                        button: "Okay",
                    });
                    setInterval('location.reload()', 1000);
                    break;

                case 'accountNotFound':
                    swal("Error", "Email / PIN Code is not found!", "error", {
                        button: "Okay",
                    });
                    break;
                
                case 'passwordNotMeetRequirements':
                    $('#newpassword').addClass('is-invalid');
                    break;          
                
                case 'invalidCredentials':
                    swal("Error", "Invalid Credentials. Please try again!", "error", {
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