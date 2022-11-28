$('#btn-add-notes').click(function(){
    let title = $('#title').val();
    let description = $('#description').val();
    let date = $('#date').val();
    let time = $('#time').val();
    let duedate = date + " " + time;
    requestDoAddNotes(title, description, duedate);
})

const requestDoAddNotes =(title, description, duedate)=> {
    $.ajax({
        type: "POST",
        url: "../../services/router/assignlist.php",
        data: {choice: 'addAssignment', title:title, description:description, duedate:duedate },
        success: function(data) {
            alert(data);
            setInterval('location.reload()', 200);
            window.location.href = "./assignment.php";
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    });
};