$(document).ready(function(){
    requestDoViewName();
    requestSubNotesCount();
    requestAssignmentCount();
    requestResourcesCount();
    requestToDoCount();
    $('#btn-pincode').click(function(){
        window.location.href = './pin.php';
    });
    $('#btn-changepass').click(function(){
        window.location.href = './changepassword.php';
    });

});
$('#btn-logout').click(function(){
    requestLogout();
});

const requestDoViewName =()=> {
    $.ajax({
        type: "POST",
        url: "../../services/router/dashboard.php",
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
        url: "../../services/router/dashboard.php",
        data: {choice: 'logout'},
        success: function(data) {
            window.location.href = "../login";
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    });
};

const requestSubNotesCount =() =>{
    $.ajax({
        type: "POST",
        url: "../../services/router/dashboard.php",
        data: {choice: 'subnotesCount'},
        success: function(data) {
            $('#totalSubNote').html(data);
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    });
};

const requestAssignmentCount =() =>{
    $.ajax({
        type: "POST",
        url: "../../services/router/dashboard.php",
        data: {choice: 'assignmentCount'},
        success: function(data) {
            $('#totalAssignment').html(data);
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    });
};

const requestResourcesCount =() =>{
    $.ajax({
        type: "POST",
        url: "../../services/router/dashboard.php",
        data: {choice: 'resourcesCount'},
        success: function(data) {
            $('#totalResources').html(data);
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    });
};

const requestToDoCount =() =>{
    $.ajax({
        type: "POST",
        url: "../../services/router/dashboard.php",
        data: {choice: 'todoCount'},
        success: function(data) {
            $('#totalTodo').html(data);
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    });
};