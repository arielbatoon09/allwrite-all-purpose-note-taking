// Press Enter Key for Search Box
$(".search-box").keyup(function(event) {
    if (event.which === 13) {
        $("#btn-search").click();
    }
});

$('#btn-add').click(function(){
    window.location.href = "./add_notes.php";
})

$(document).ready(function(){
    // To View All the Data in Subject Notes
    requestDoViewSubNotes();
    // To Search Specific Data in Subject Notes
    $('#btn-search').click(function(){
        let searchInp = $('#search-input').val();
        if(searchInp != ""){
            requestDisplaySearch(searchInp);
        }else{
            requestDoViewSubNotes();
        }
    });
});

const requestDoViewSubNotes =()=> {
    $.ajax({
        type: "POST",
        url: "../../services/router/subnotes.php",
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
                $('.btn-delete').click(function(){
                    let boxId = $(this).attr("id");
                    swal({
                        title: "Are you sure?",
                        icon: "warning",
                        dangerMode: false,
                        buttons: true,
                      })
                      .then((willDelete) => {
                        if (willDelete) {
                          requestDoDeleteSubNotes(boxId);
                          setInterval('location.reload()', 200);
                        }
                      });
                });
                $('.btn-edit').click(function(){
                    let boxId = $(this).attr("id");
                    swal({
                        text: "Are you sure you want to do this?",
                        buttons: true,
                      })
                      .then((willEdit) => {
                        if (willEdit) {
                          requestNoteIdSession(boxId);
                          window.location.href = "./edit_notes.php";
                        }
                      });
                });
                $('.btn-view').click(function(){
                    let boxId = $(this).attr("id");
                    swal({
                        text: "Do you want to view your notes?",
                        buttons: true,
                      })
                      .then((willEdit) => {
                        if (willEdit) {
                            requestNoteIdSession(boxId);
                            window.location.href = "./view_notes.php";
                        }
                      });
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
        url: "../../services/router/subnotes.php",
        data: {choice:'deleteSubNotes', boxId:boxId},
        success: function(data){
            //success request delete
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    })
};

const requestNoteIdSession =(boxId)=> {
    $.ajax({
        type: "POST",
        url: "../../services/router/subnotes.php",
        data: {choice:'setSessionBoxId', boxId:boxId},
        success: function(data){
            //success add noteid  session
        }
    })
};

const requestDisplaySearch =(searchInp)=> {
    $.ajax({
        type: "POST",
        url: "../../services/router/subnotes.php",
        data: {choice:'getSearchDisplay', searchInp:searchInp},
        success: function(data){
            if(data != 'Not Found Data'){
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
                    $('.btn-delete').click(function(){
                        let boxId = $(this).attr("id");
                        swal({
                            title: "Are you sure?",
                            icon: "warning",
                            dangerMode: false,
                            buttons: true,
                          })
                          .then((willDelete) => {
                            if (willDelete) {
                              requestDoDeleteSubNotes(boxId);
                              setInterval('location.reload()', 200);
                            }
                          });
                    });
                    $('.btn-edit').click(function(){
                        let boxId = $(this).attr("id");
                        swal({
                            text: "Are you sure you want to do this?",
                            buttons: true,
                          })
                          .then((willEdit) => {
                            if (willEdit) {
                              requestNoteIdSession(boxId);
                              window.location.href = "./edit_notes.php";
                            }
                          });
                    });
                    $('.btn-view').click(function(){
                        let boxId = $(this).attr("id");
                        swal({
                            text: "Do you want to view your notes?",
                            buttons: true,
                          })
                          .then((willView) => {
                            if (willView) {
                                requestNoteIdSession(boxId);
                                window.location.href = "./view_notes.php";
                            }
                          });
                    });
                });
            }else{
                swal({
                    title: "Something went wrong",
                    text: "Search Not Found!",
                    icon: "error",
                    button: "Okay",
                  });
                requestDoViewSubNotes();
            }
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    })
};