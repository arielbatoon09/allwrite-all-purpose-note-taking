$('#btn-add-notes').click(function(){
    let title = $('#title').val();
    let description = $('#description').val();
    requestDoAddNotes(title, description);
})

const requestDoAddNotes =(title, description)=> {
    $.ajax({
        type: "POST",
        url: "../../services/router/subnotes.php",
        data: {choice: 'addSubNotes', title:title, description:description },
        success: function(data) {
            alert(data);
            setInterval('location.reload()', 200);
            window.location.href = "./subject.php";
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    });
};