function resort_users() {
    var users = $("#users tbody").children(".users").toArray();
    var users_new = new Array();
    for(var i = 0; i < users.length; i++) {
        var index = users_new.length;
        for(var j = 0; j < users_new.length; j++) {
            var val1, val2;
            switch($("#users-order-type").val()) {
                case '0':
                    val2 = $(users_new[j]).find(".user-name a").text();
                    val1 = $(users[i]).find(".user-name a").text();
                    break;
                case '1':
                    val2 = $(users[i]).find(".user-updated").text();
                    val1 = $(users_new[j]).find(".user-updated").text();
                    break;
                case '2':
                    val1 = Number($(users_new[j]).find(".user-gpa").text());
                    val2 = Number($(users[i]).find(".user-gpa").text());
                    break;
            }
            if (val1 < val2) {
                index = j;
                break;
            }
        }
        users_new.splice(index, 0, $(users[i]));
    }
    $("#users tbody").append(users_new);
}

function resort_grades() {
    var grades = $("#grades tbody").children(".grade").toArray();
    var grades_new = new Array();
    for(var i = 0; i < grades.length; i+=2) {
        if($("#assignment-type").val() == '0' || $(grades[i]).hasClass("assignment-"+$("#assignment-type").val())) {
            $(grades[i]).show();
            var index = grades_new.length;
            for(var j = 0; j < grades_new.length; j+=2) {
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
            grades_new.splice(index, 0, $(grades[i+1]));
            grades_new.splice(index, 0, $(grades[i]));
        } else {
            $(grades[i]).hide();
            var index = grades_new.length;
            grades_new.splice(index, 0, $(grades[i+1]));
            grades_new.splice(index, 0, $(grades[i]));
        }
    }
    $("#grades tbody").append(grades_new);
    $("#grades tbody").append($("#new-grade"));
}

function create_grade() {
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

function edit_grade(gradediv) {
    var name = $(gradediv).find("#edit-grade-name").val();
    var assignment = $(gradediv).find("#edit-grade-assignment").val();
    var grade = $(gradediv).find("#edit-grade-grade").val();

    if(name == null || grade == null || name == "" || grade == "") {
        alert("All entries must be filled");
    } else if(name.indexOf("@") != -1 || name.indexOf(";") != -1) {
        alert("Assignment Name cannot contain @ or ;");
    } else if(isNaN(parseFloat(grade)) || !isFinite(grade)) {
        alert("Grade must be a number");
    } else if(Number(grade) < 0 || Number(grade) > 150) {
        alert("Grade must be between 0 and 150");
    } else {
        $(gradediv).find("input[name='name']").val(name);
        $(gradediv).find("input[name='assignment']").val(assignment);
        $(gradediv).find("input[name='grade']").val(Math.round(Number(grade)*100)/100);
        $(gradediv).find("form").submit();
    }
}

function create_category() {
    var name, weight;
    while(true) {
        name = window.prompt("Please enter the category name.", "Homework");
        if (name == null) return;
        else if(name.indexOf("@") != -1 || name.indexOf(";") != -1)
            alert("Category Name cannot contain @ or ;");
        else
            break;
    }
    while(true) {
        weight = window.prompt("Please enter the weight in percent.", "20");
        if (weight == null) return;
        else if(isNaN(parseFloat(weight)) || !isFinite(weight))
            alert("Weight must be a number");
        else if(Number(weight) < 0 || Number(weight) > 100)
            alert("Weight must be between 0 and 100");
        else
            break;
    }
    $("#createcategory input[name='name']").val(name);
    $("#createcategory input[name='weight']").val(weight);
    $("#createcategory").submit();
}

function delete_category() {
    var assignment = $("#assignment-type").val();
    if (assignment <= 0)
        return;
    if (confirm('Are you sure you want to delete?')) {
        $("#deletecategory input[name='deletecat']").val(assignment);
        $("#deletecategory").submit();
    }
}

function create_class() {
    var name = $("#new-class #new-class-name").val();
    var credits = $("#new-class #new-class-credits").val();
    name = name.toUpperCase();

    var regex = /[A-Z][A-Z][A-Z][A-Z]-[0-9][0-9][0-9][0-9]?-[0-9][0-9][0-9][0-9]?/;

    if(name == null || credits == null || name == "" || credits == "") {
        alert("All entries must be filled");
    } else if(name.match(regex) == null) {
        alert("Name must match expression (CRSE-NUM-SEC)");
    } else if(isNaN(parseFloat(credits)) || !isFinite(credits)) {
        alert("Credits must be a number");
    } else if(Number(credits) < 0 || Number(credits) > 5) {
        alert("Credits must be between 0 and 5");
    } else if(Math.round(Number(credits)) != Number(credits)) {
        alert("Credits must be a whole number");
    } else {
        $("#new-class input[name='name']").val(name);
        $("#new-class input[name='credits']").val(Number(credits));
        $("#new-class form").submit();
    }
}

$(document).ready(function () {
    resort_grades();

    $("#assignment-type").on('change', function() {if($("#assignment-type").val() == -1) create_category(); else resort_grades();});
    $("#order-type").on('change', resort_grades);
});