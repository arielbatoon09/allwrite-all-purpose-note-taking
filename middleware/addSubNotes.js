$('#btn-add-notes').click(function(){
    let title = $('#title').val();
    let description = $('#description').val();
    requestDoAddNotes(title, description);
})

const requestDoAddNotes =(title, description)=> {
    $('#btn-add-notes').addClass('visually-hidden');
    $('#btn-request').removeClass('visually-hidden');
    $.ajax({
        type: "POST",
        url: "../../services/router/subnotes.php",
        data: {choice: 'addSubNotes', title:title, description:description },
        success: function(data) {
            $('#btn-add-notes').removeClass('visually-hidden');
            $('#btn-request').addClass('visually-hidden');
            setInterval('location.reload()', 200);
            window.location.href = "./subject.php";
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    });
};