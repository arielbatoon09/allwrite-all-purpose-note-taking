$(".auth-input").keyup(function(event) {
    if (event.which === 13) {
        $("#btn-savepin").click();
    }
});
$('#btn-savepin').click(function(){
    let pincode = $('#pincode').val();
    let confirmpincode = $('#confirmpincode').val();
    checkIfValid(pincode, confirmpincode);
});

const checkIfValid =(pincode, confirmpincode)=> {
    if(pincode != "" && confirmpincode != ""){
        requestPinCode(pincode, confirmpincode);
    }else{
        swal("Error", "Please fill the empty field(s).", "error", {
            button: "Okay",
          });
    }
};

const requestPinCode =(pincode, confirmpincode) => {
    $.ajax({
        type: "POST",
        url: "../../services/router/auth.php",
        data: {choice: 'setpincode', pincode:pincode, confirmpincode:confirmpincode},
        success: function(data) {
            switch(data){
                case 'setPinSuccess':
                    swal({
                        icon: 'success',
                        title: 'PIN Code',
                        text: "Successfully setup your PIN Code!",
                        buttons: 'Okay',
                      })
                      .then((willRetrieve) => {
                        if (willRetrieve) {
                            window.location.href = './index.php';
                        }
                    });
                    break;
                case 'pinCodeDoesNotMeetRequirements':
                    $('#pincode').addClass('is-invalid');
                    break;

                case 'failedSetPin':
                    swal("Error", "Failed PIN Code Setup.", "error", {
                        button: "Okay",
                    });
                    break;
                case 'pinCodeDoesNotMatch':
                    swal("Error", "PIN Code does not match!", "error", {
                        button: "Okay",
                    });
                    break;
                case 'invalidPIN':
                    swal("Error", "Invalid PIN Code. Must be a digit code!", "error", {
                        button: "Okay",
                    });
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