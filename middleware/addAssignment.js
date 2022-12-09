$('#btn-add-assignment').click(function(){
    let title = $('#title').val();
    let description = $('#description').val();
    let date = $('#date').val();
    let time = $('#time').val();
    let duedate = date + " " + time;
    requestDoAddNotes(title, description, duedate);
})

const requestDoAddNotes =(title, description, duedate)=> {
    $('#btn-add-assignment').addClass('visually-hidden');
    $('#btn-request').removeClass('visually-hidden');
    $.ajax({
        type: "POST",
        url: "../../services/router/assignlist.php",
        data: {choice: 'addAssignment', title:title, description:description, duedate:duedate },
        success: function(data) {
            $('#btn-add-assignment').removeClass('visually-hidden');
            $('#btn-request').addClass('visually-hidden');
            setInterval('location.reload()', 200);
            window.location.href = "./assignment.php";
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    });
};