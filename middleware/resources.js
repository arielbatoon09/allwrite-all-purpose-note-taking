// Press Enter Key for Search Box
$(".search-box").keyup(function(event) {
    if (event.which === 13) {
        $("#btn-search").click();
    }
});

$('#btn-add').click(function(){
    window.location.href = "./add_resources.php";
})

$(document).ready(function(){
    // To View All the Data in Resources
    requestDoViewResources();
    // To Search Specific Data in Resources
    $('#btn-search').click(function(){
        let searchInp = $('#search-input').val();
        if(searchInp != ""){
            requestDisplaySearch(searchInp);
        }else{
            requestDoViewResources();
        }
    });
});

const requestDoViewResources =()=> {
    $.ajax({
        type: "POST",
        url: "../../services/router/resrc.php",
        data: {choice: 'displayResources'},
        success: function(data) {
            let json = JSON.parse(data);
            let str = "";
            json.forEach(element => {
                str = str +
                `<div class="dashboard-box-2 d-lg-flex justify-content-between align-items-center">`+
                `<a href=`+element.url_link+` target="_blank">`+
                `<div class="left-box">`+
                    `<h5><i class="fa-solid fa-arrow-right"></i>`+element.title+`</h5>`+
                `</div>`+
                `</a>`+
                `<div class="right-box d-flex gap-2 gap-lg-3 mt-2 mt-lg-0">`+
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
                            requestDoDeleteResources(boxId);
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

const requestDoDeleteResources =(boxId)=> {
    $.ajax({
        type: "POST",
        url: "../../services/router/resrc.php",
        data: {choice:'deleteResources', boxId:boxId},
        success: function(data){
            //success deleted
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    })
};


const requestDisplaySearch =(searchInp)=> {
    $.ajax({
        type: "POST",
        url: "../../services/router/resrc.php",
        data: {choice:'getSearchDisplay', searchInp:searchInp},
        success: function(data){
            if(data != 'Not Found Data'){
                let json = JSON.parse(data);
                let str = "";
                json.forEach(element => {
                    str = str +
                    `<div class="dashboard-box-2 d-lg-flex justify-content-between align-items-center">`+
                    `<a href=`+element.url_link+` target="_blank">`+
                    `<div class="left-box">`+
                        `<h5><i class="fa-solid fa-arrow-right"></i>`+element.title+`</h5>`+
                    `</div>`+
                    `</a>`+
                    `<div class="right-box d-flex gap-2 gap-lg-3 mt-2 mt-lg-0">`+
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
                                requestDoDeleteResources(boxId);
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
                requestDoViewResources();
            }
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    })
};