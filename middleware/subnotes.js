$(document).ready(function(){
    requestDoViewSubNotes();
});

const requestDoViewSubNotes =()=> {
    $.ajax({
        type: "POST",
        url: "../../services/router/router-dashboard.php",
        data: {choice: 'viewSubNotes'},
        success: function(data) {
            let json = JSON.parse(data);
            let str = "";
            json.forEach(element => {
                str = str +
                `<div class="dashboard-box d-lg-flex justify-content-between align-items-center">`+
                `<div class="left-box">`+
                    `<h5>`+element.title+`</h5>`+
                    `<p class="descr">`+element.description+`</p>`+
                    `<span>`+element.updated_date+`</span>`+
                `</div>`+
                `<div class="right-box d-flex gap-2 gap-lg-3 mt-2 mt-lg-0">`+
                    `<i class="fa-regular fa-eye btn-view" id=`+element.id+`></i>`+
                    `<i class="fa-solid fa-pen btn-edit" id=`+element.id+`></i>`+
                    `<i class="fa-solid fa-trash btn-delete" id=`+element.id+`></i>`+
                `</div>`+
                `</div>`;
                document.getElementById("dashboard-content-list").innerHTML = str;
                let boxId = $(this).attr("id");
                $('.btn-delete').click(function(){
                    let boxId = $(this).attr("id");
                    requestDoDeleteSubNotes(boxId);
                    setInterval('location.reload()', 200);
                });
                $('.btn-edit').click(function(){
                    let boxId = $(this).attr("id");
                    requestNoteIdSession(boxId);
                    window.location.href = "./edit_notes.php";
                });
                $('.btn-view').click(function(){
                    let boxId = $(this).attr("id");
                    requestNoteIdSession(boxId);
                    window.location.href = "./view_notes.php";
                });
            });
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    });
};

const requestDoDeleteSubNotes =(boxId)=> {
    $.ajax({
        type: "POST",
        url: "../../services/router/router-dashboard.php",
        data: {choice:'deleteSubNotes', boxId:boxId},
        success: function(data){
            alert(data);
        }
    })
};

const requestNoteIdSession =(boxId)=> {
    $.ajax({
        type: "POST",
        url: "../../services/router/router-dashboard.php",
        data: {choice:'setSessionBoxId', boxId:boxId},
        success: function(data){
            alert(data);
        }
    })
}