// Press Enter Key for Search Box
$(".search-box").keyup(function(event) {
    if (event.which === 13) {
        $("#btn-search").click();
    }
});

$('#btn-add').click(function(){
    window.location.href = "./add_assignment.php";
})

$(document).ready(function(){
    // To View All the Data in Assignment Notes
    requestDoViewAssignment();
    // Get the Current Date
    let today = new Date();
    let dd = today.getDate();
    let mm = today.getMonth()+1; 
    let yyyy = today.getFullYear();
    let hour = today.getHours();
    let min = today.getMinutes();
    if(dd < 10){
        dd = "0"+dd;
    }if(mm < 10){
        mm = "0"+mm;
    }if(hour < 10){
        hour = "0"+hour;
    }if(min < 10){
        min = "0"+min;
    }
    let currentDate = yyyy+"-"+mm+"-"+dd+" "+hour+":"+min;  
    // Get the Assignment Status if Late or Not
    requestDueDateStatus(currentDate);
    // To Search Specific Data in Assignment Notes
    $('#btn-search').click(function(){
        let searchInp = $('#search-input').val();
        if(searchInp != ""){
            requestDisplaySearch(searchInp);
        }else{
            requestDoViewAssignment();
        }
    });
});

const requestDoViewAssignment =()=> {
    $.ajax({
        type: "POST",
        url: "../../services/router/assignlist.php",
        data: {choice: 'viewAssignment'},
        success: function(data) {
            let json = JSON.parse(data);
            let str = "";
            json.forEach(element => {
                str = str +
                `<div class="dashboard-box d-lg-flex justify-content-between align-items-center">`+
                `<div class="left-box">`+
                    `<h5>`+element.title+`</h5>`+
                    `<p class="mb-1">`+element.description+`</p>`+
                    `<span class="due_date">Due Date: `+element.due_date+`</span>`+
                    `<p class="`+element.status+` fw-semibold mt-1">`+element.status+`</p>`+
                `</div>`+
                `<div class="right-box d-flex gap-2 gap-lg-3 mt-2 mt-lg-0">`+
                    `<i class="mark-`+element.status+` fa-solid fa-check btn-complete" id=`+element.id+`></i>`+
                    `<i class="fa-solid fa-trash btn-delete" id=`+element.id+`></i>`+
                `</div>`+
                `</div>`;
                document.getElementById("dashboard-content-list").innerHTML = str;
                
                // To Change the Assigment Status
                $('.Pending').addClass('text-success');
                $('.Completed').addClass('text-warning');
                $('.Late').addClass('text-danger');
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
                          requestDoDeleteAssignment(boxId);
                          setInterval('location.reload()', 200);
                        }
                      });
                });
                $('.btn-complete').click(function(){
                    let boxId = $(this).attr("id");
                    swal({
                        text: "Already finished this assignment?",
                        buttons: true,
                      })
                      .then((willMark) => {
                        if (willMark) {
                            requestDoCompleteAssignment(boxId);
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

const requestDoDeleteAssignment =(boxId)=> {
    $.ajax({
        type: "POST",
        url: "../../services/router/assignlist.php",
        data: {choice:'deleteAssignment', boxId:boxId},
        success: function(data){
            // success delete
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    })
};
const requestDoCompleteAssignment =(boxId)=> {
    $.ajax({
        type: "POST",
        url: "../../services/router/assignlist.php",
        data: {choice:'completeAssignment', boxId:boxId},
        success: function(data){
            // success marked complete
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    })
};

const requestDueDateStatus =(currentDate)=> {
    $.ajax({
        type: "POST",
        url: "../../services/router/assignlist.php",
        data: {choice:'viewAssignment'},
        success: function(data){
            let json = JSON.parse(data);
                json.forEach(element => {
                    if(element.status == "Pending" && element.due_date == currentDate){
                        $.ajax({
                            type: "POST",
                            url: "../../services/router/assignlist.php",
                            data: {choice:'markAssignmentLate',currentDate:currentDate},
                            success: function(data){
                                swal({
                                    title: "Marked Late",
                                    icon: "warning",
                                    button: "Okay",
                                  })
                                  .then((willMark) => {
                                    if (willMark) {
                                        setInterval('location.reload()', 1000);
                                    }
                                  });
                            },
                            error: function(thrownError) {
                                alert(thrownError);
                            }
                        })
                    }
                })
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    })
};

const requestDisplaySearch =(searchInp)=> {
    $.ajax({
        type: "POST",
        url: "../../services/router/assignlist.php",
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
                        `<p class="mb-1">`+element.description+`</p>`+
                        `<span class="due_date">Due Date: `+element.due_date+`</span>`+
                        `<p class="`+element.status+` fw-semibold mt-1">`+element.status+`</p>`+
                    `</div>`+
                    `<div class="right-box d-flex gap-2 gap-lg-3 mt-2 mt-lg-0">`+
                        `<i class="mark-`+element.status+` fa-solid fa-check btn-complete" id=`+element.id+`></i>`+
                        `<i class="fa-solid fa-trash btn-delete" id=`+element.id+`></i>`+
                    `</div>`+
                    `</div>`;
                    document.getElementById("dashboard-content-list").innerHTML = str;
                    
                    // To Change the Assigment Status
                    $('.Pending').addClass('text-success');
                    $('.Completed').addClass('text-warning');
                    $('.Late').addClass('text-danger');
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
                            requestDoDeleteAssignment(boxId);
                            setInterval('location.reload()', 200);
                            }
                        });
                    });
                    $('.btn-complete').click(function(){
                        let boxId = $(this).attr("id");
                        swal({
                            text: "Already finished this assignment?",
                            buttons: true,
                        })
                        .then((willMark) => {
                            if (willMark) {
                                requestDoCompleteAssignment(boxId);
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
                requestDoViewAssignment();
            }
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    })
};