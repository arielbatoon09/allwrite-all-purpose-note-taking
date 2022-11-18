$(document).ready(function(){
    requestDoViewName();

});
$('#btn-logout').click(function(){
    requestLogout();
});
$('#btn-add').click(function(){
    window.location.href = "./add_notes.php";
})

const requestDoViewName =()=> {
    $.ajax({
        type: "POST",
        url: "../../services/router/router-dashboard.php",
        data: {choice: 'profileName'},
        success: function(data) {
            $('#profile-name').html(data);
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    });
};

const requestLogout =() => {
    $.ajax({
        type: "POST",
        url: "../../services/router/router-dashboard.php",
        data: {choice: 'logout'},
        success: function(data) {
            window.location.href = "../login.php";
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    });
};