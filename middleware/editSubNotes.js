$(document).ready(function(){
    requestDoViewSubNotes();
});
$('#btn-edit-notes').click(function(){
    let newTitle = $('#title').val();
    let newDescription = $('#description').val();
    requestDoGetNewSubNotes(newTitle, newDescription);
    requestUnsetNoteIdSession();
});

$('#btn-back').click(function(){
    requestUnsetNoteIdSession();
});

const requestDoGetNewSubNotes =(newTitle, newDescription)=> {
    $.ajax({
        type: "POST",
        url: "../../services/router/subnotes.php",
        data: {choice:'updateSubNotes', title:newTitle, description:newDescription},
        success: function(data){
            alert(data);
            setInterval('location.reload()', 200);
            window.location.href = "./subject.php";
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
        url: "../../services/router/router-dashboard.php",
        data: {choice:'unsetSessionBoxId'}
    });
};