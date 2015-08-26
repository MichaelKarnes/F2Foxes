function resort_grades() {
    var grades = $("#grades tbody").children(".grade").toArray();
    var grades_new = new Array();
    for(var i in grades) {
        if($("#assignment-type").val() == '0' || $(grades[i]).hasClass("assignment-"+$("#assignment-type").val())) {
            $(grades[i]).css("display", "table-row");
            var index = grades_new.length;
            for(var j in grades_new) {
                var val1, val2;
                switch($("#order-type").val()) {
                    case '0':
                        val2 = $(grades_new[j]).find(".grade-name").text();
                        val1 = $(grades[i]).find(".grade-name").text();
                        break;
                    case '1':
                        val2 = $(grades[i]).find(".grade-updated").text();
                        val1 = $(grades_new[j]).find(".grade-updated").text();
                        break;
                    case '2':
                        val1 = Number($(grades_new[j]).find(".grade-val").text().replace("%",""));
                        val2 = Number($(grades[i]).find(".grade-val").text().replace("%",""));
                        break;
                }
                if (val1 < val2) {
                    index = j;
                    break;
                }
            }
            grades_new.splice(index, 0, $(grades[i]));
        } else {
            $(grades[i]).css("display", "none");
            grades_new.splice(grades_new.length, 0, $(grades[i]));
        }
    }
    $("#grades tbody").append(grades_new);
    $("#grades tbody").append($("#new-grade"));
}

function prepare_create() {
    var name = $("#new-grade #new-grade-name").val();
    var assignment = $("#new-grade #new-grade-assignment").val();
    var grade = $("#new-grade #new-grade-grade").val();

    if(name == null || grade == null || name == "" || grade == "") {
        alert("All entries must be filled");
    } else if(name.indexOf("@") != -1 || name.indexOf(";") != -1) {
        alert("Assignment Name cannot contain @ or ;");
    } else if(isNaN(parseFloat(grade)) || !isFinite(grade)) {
        alert("Grade must be a number");
    } else if(Number(grade) < 0 || Number(grade) > 150) {
        alert("Grade must be between 0 and 150");
    } else {
        $("#new-grade input[name='name']").val(name);
        $("#new-grade input[name='assignment']").val(assignment);
        $("#new-grade input[name='grade']").val(Math.round(Number(grade)*100)/100);
        $("#new-grade form").submit();
    }
}

$(document).ready(function () {
    resort_grades();

    $("#assignment-type").on('change', resort_grades);
    $("#order-type").on('change', resort_grades);
});