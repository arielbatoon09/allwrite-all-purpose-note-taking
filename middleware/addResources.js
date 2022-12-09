$('#btn-add-resources').click(function(){
    let title = $('#title').val();
    let url = $('#url').val();
    requestDoAddResources(title, url);
})

const requestDoAddResources =(title, url)=> {
    $('#btn-add-resources').addClass('visually-hidden');
    $('#btn-request').removeClass('visually-hidden');
    $.ajax({
        type: "POST",
        url: "../../services/router/resrc.php",
        data: {choice: 'addResources', title:title, url:url },
        success: function(data) {
            $('#btn-add-resources').removeClass('visually-hidden');
            $('#btn-request').addClass('visually-hidden');
            setInterval('location.reload()', 200);
            window.location.href = "./resources.php";
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    });
};