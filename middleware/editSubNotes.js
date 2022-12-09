$(document).ready(function(){
    requestDoViewSubNotes();
});
$('#btn-edit-notes').click(function(){
    let newTitle = $('#title').val();
    let newDescription = $('#description').val();
    requestDoUpdateSubNotes(newTitle, newDescription);
    requestUnsetNoteIdSession();
});

$('#btn-back').click(function(){
    requestUnsetNoteIdSession();
});

const requestDoUpdateSubNotes =(newTitle, newDescription)=> {
    $('#btn-edit-notes').addClass('visually-hidden');
    $('#btn-request').removeClass('visually-hidden');
    $.ajax({
        type: "POST",
        url: "../../services/router/subnotes.php",
        data: {choice:'updateSubNotes', title:newTitle, description:newDescription},
        success: function(data){
            $('#btn-edit-notes').removeClass('visually-hidden');
            $('#btn-request').addClass('visually-hidden');
            setInterval('location.reload()', 200);
            window.location.href = "./subject.php";
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    });
};

const requestDoViewSubNotes =()=> {
    $.ajax({
        type: "POST",
        url: "../../services/router/subnotes.php",
        data: {choice: 'displaySubNotes'},
        success: function(data) {
            let json = JSON.parse(data);
            json.forEach(element => {
                $('#title').val(element.title);
                $('#description').val(element.description);

            });
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    });
};

const requestUnsetNoteIdSession =()=> {
    $.ajax({
        type: "POST",
        url: "../../services/router/subnotes.php",
        data: {choice:'unsetSessionBoxId'}
    });
};