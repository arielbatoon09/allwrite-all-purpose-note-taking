// Press Enter Key for Search Box
$(".search-box").keyup(function(event) {
    if (event.which === 13) {
        $("#btn-search").click();
    }
});

$('#btn-add').click(function(){
    window.location.href = "./add_todo.php";
})

$(document).ready(function(){
    // To View All the Data in ToDo-List
    requestDoViewToDo();
    // To Search Specific Data in ToDo-List
    $('#btn-search').click(function(){
        let searchInp = $('#search-input').val();
        if(searchInp != ""){
            requestDisplaySearch(searchInp);
        }else{
            requestDoViewToDo();
        }
    });
});

const requestDoViewToDo =()=> {
    $.ajax({
        type: "POST",
        url: "../../services/router/todolist.php",
        data: {choice: 'viewToDo'},
        success: function(data) {
            let json = JSON.parse(data);
            let str = "";
            json.forEach(element => {
                str = str +
                `<div class="dashboard-box d-lg-flex justify-content-between align-items-center">`+
                `<div class="left-box">`+
                    `<h5>`+element.title+`</h5>`+
                    `<p class="mb-1 col-12 col-lg-11">`+element.description+`</p>`+
                    `<span>`+element.updated_date+`</span>`+
                    `<p class="`+element.status+` fw-semibold mt-1">`+element.status+`</p>`+
                `</div>`+
                `<div class="right-box d-flex gap-2 gap-lg-3 mt-2 mt-lg-0">`+
                    `<i class="mark-`+element.status+` fa-solid fa-check btn-complete" id=`+element.id+`></i>`+
                    `<i class="fa-solid fa-trash btn-delete" id=`+element.id+`></i>`+
                `</div>`+
                `</div>`;
                document.getElementById("dashboard-content-list").innerHTML = str;
                
                // To Change the Assigment Status
                $('.On-Going').addClass('text-success');
                $('.Completed').addClass('text-warning');
                $('.mark-Completed').remove();
                
                // Button Functionality
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
                            requestDoDeleteToDo(boxId);
                          setInterval('location.reload()', 200);
                        }
                      });
                });
                $('.btn-complete').click(function(){
                    let boxId = $(this).attr("id");
                    swal({
                        text: "Already finished this task?",
                        buttons: true,
                      })
                      .then((willMark) => {
                        if (willMark) {
                            requestDoCompleteToDo(boxId);
                            setInterval('location.reload()', 200);
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

const requestDoDeleteToDo =(boxId)=> {
    $.ajax({
        type: "POST",
        url: "../../services/router/todolist.php",
        data: {choice:'deleteToDo', boxId:boxId},
        success: function(data){
            // success deleted todo
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    })
};
const requestDoCompleteToDo =(boxId)=> {
    $.ajax({
        type: "POST",
        url: "../../services/router/todolist.php",
        data: {choice:'completeToDo', boxId:boxId},
        success: function(data){
            // success marked status
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    })
};


const requestDisplaySearch =(searchInp)=> {
    $.ajax({
        type: "POST",
        url: "../../services/router/todolist.php",
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
                        `<p class="mb-1 col-12 col-lg-11">`+element.description+`</p>`+
                        `<span>`+element.updated_date+`</span>`+
                        `<p class="`+element.status+` fw-semibold mt-1">`+element.status+`</p>`+
                    `</div>`+
                    `<div class="right-box d-flex gap-2 gap-lg-3 mt-2 mt-lg-0">`+
                        `<i class="mark-`+element.status+` fa-solid fa-check btn-complete" id=`+element.id+`></i>`+
                        `<i class="fa-solid fa-trash btn-delete" id=`+element.id+`></i>`+
                    `</div>`+
                    `</div>`;
                    document.getElementById("dashboard-content-list").innerHTML = str;
                    
                    // To Change the Assigment Status
                    $('.On-Going').addClass('text-success');
                    $('.Completed').addClass('text-warning');
                    $('.mark-Completed').remove();
                    
                    // Button Functionality
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
                                requestDoDeleteToDo(boxId);
                            setInterval('location.reload()', 200);
                            }
                        });
                    });
                    $('.btn-complete').click(function(){
                        let boxId = $(this).attr("id");
                        swal({
                            text: "Already finished this task?",
                            button: "Yes!",
                        })
                        .then((willMark) => {
                            if (willMark) {
                                requestDoCompleteToDo(boxId);
                                setInterval('location.reload()', 200);
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
                  requestDoViewToDo();
            }
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    })
};