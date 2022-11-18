$('#btn-add-notes').click(function(){
    let title = $('#title').val();
    let description = $('#description').val();
    requestDoAddNotes(title, description);
})

const requestDoAddNotes =(title, description)=> {
    $.ajax({
        type: "POST",
        url: "../../services/router/router-dashboard.php",
        data: {choice: 'addSubNotes', title:title, description:description },
        success: function(data) {
            alert(data);
            setInterval('location.reload()', 2000);
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    });
};