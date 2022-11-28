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
    // To View All the Data in Subject Notes
    requestDoViewAssignment();
    // To Search Specific Data in Subject Notes
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
                    `<span>Due Date: `+element.due_date+`</span>`+
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
                $('.mark-Completed').remove();
                
                // Button Functionality
                $('.btn-delete').click(function(){
                    let boxId = $(this).attr("id");
                    requestDoDeleteAssignment(boxId);
                    setInterval('location.reload()', 200);
                });
                $('.btn-complete').click(function(){
                    let boxId = $(this).attr("id");
                    requestDoCompleteAssignment(boxId);
                    alert('Completed');
                    setInterval('location.reload()', 200);
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
            alert(data);
        }
    })
};
const requestDoCompleteAssignment =(boxId)=> {
    $.ajax({
        type: "POST",
        url: "../../services/router/assignlist.php",
        data: {choice:'completeAssignment', boxId:boxId},
        success: function(data){
            alert(data);
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
                        `<p class="descr">`+element.description+`</p>`+
                        `<span>Due Date: `+element.due_date+`</span>`+
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
                    $('.mark-Completed').remove();
                    
                    // Button Functionality
                    $('.btn-delete').click(function(){
                        let boxId = $(this).attr("id");
                        requestDoDeleteAssignment(boxId);
                        setInterval('location.reload()', 200);
                    });
                    $('.btn-complete').click(function(){
                        let boxId = $(this).attr("id");
                        requestDoCompleteAssignment(boxId);
                        alert('Completed');
                        setInterval('location.reload()', 200);
                    });
                });
            }else{
                alert(data);
                requestDoViewAssignment();
            }
        }
    })
};