$('#btn-add-notes').click(function(){
    let title = $('#title').val();
    let url = $('#url').val();
    requestDoAddResources(title, url);
})

const requestDoAddResources =(title, url)=> {
    $.ajax({
        type: "POST",
        url: "../../services/router/resrc.php",
        data: {choice: 'addResources', title:title, url:url },
        success: function(data) {
            alert(data);
            setInterval('location.reload()', 200);
            window.location.href = "./resources.php";
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    });
};