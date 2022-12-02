$('#btn-add-notes').click(function(){
    let title = $('#title').val();
    let description = $('#description').val();
    requestDoAddNotes(title, description);
})

const requestDoAddNotes =(title, description)=> {
    $.ajax({
        type: "POST",
        url: "../../services/router/todolist.php",
        data: {choice: 'addToDo', title:title, description:description },
        success: function(data) {
            alert(data);
            setInterval('location.reload()', 200);
            window.location.href = "./todo.php";
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    });
};