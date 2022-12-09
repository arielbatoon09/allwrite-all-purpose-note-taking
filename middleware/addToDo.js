$('#btn-add-todo').click(function(){
    let title = $('#title').val();
    let description = $('#description').val();
    requestDoAddNotes(title, description);
})

const requestDoAddNotes =(title, description)=> {
    $('#btn-add-todo').addClass('visually-hidden');
    $('#btn-request').removeClass('visually-hidden');
    $.ajax({
        type: "POST",
        url: "../../services/router/todolist.php",
        data: {choice: 'addToDo', title:title, description:description },
        success: function(data) {
            $('#btn-add-todo').removeClass('visually-hidden');
            $('#btn-request').addClass('visually-hidden');
            setInterval('location.reload()', 200);
            window.location.href = "./todo.php";
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    });
};