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
                    `<span>`+element.created_date+`</span>`+
                `</div>`+
                `<div class="right-box d-flex gap-2 gap-lg-3 mt-2 mt-lg-0">`+
                    `<i class="fa-solid fa-pen"></i>`+
                    `<i class="fa-solid fa-trash"></i>`+
                `</div>`+
                `</div>`;
                document.getElementById("dashboard-content-list").innerHTML = str;
            });
            let txt= $('.descr').text();
            if(txt.length > 80)
                $('.descr').text(txt.substring(0,80) + '...');
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    });
};