class Person {
    constructor(id, fullname, phone) {
        this.id = id;
        this.fullname = fullname; 
        this.phone = phone;
    }
}

//==================Загрузка данных=====================================
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "visitors.json", true);
    xhr.onloadend = function() {

         if (this.status < 300) {
            localStorage.setItem("visitors", this.responseText);
        } else {
            console.log(xhr.status + ": " + xhr.statusText);
        }  
    }
    xhr.send();

//=======================================================

var table = document.createElement('table');
table.setAttribute('contentEditable', 'true');


function getData() {
        
    let th = document.createElement('th');
    let tr = document.createElement('tr');

    th.textContent = 'id';
    tr.append(th);

    th = document.createElement('th');
    th.textContent = 'ФИО';
    tr.append(th);

    th = document.createElement('th');
    th.textContent = 'Телефон';
    tr.append(th);
    
    th = document.createElement('th');
    th.textContent = 'Options';
    tr.append(th);
    
    th = document.createElement('th');
    th.textContent = 'Options';
    tr.append(th);

    table.append(tr);
    
    
    var visitorsArr = JSON.parse(localStorage.getItem("visitors")); 
    
        visitorsArr.forEach(function(item, index) {
            
            td = document.createElement('td');
            tr = document.createElement('tr');

            td.textContent = item.id; 
            tr.append(td);

            td = document.createElement('td');
            td.textContent = item.fullname;
            tr.append(td);

            td = document.createElement('td');
            td.textContent = item.phone;
            tr.append(td);

            var deleteBut = document.createElement('button');
            deleteBut.textContent = '\u232B';
            deleteBut.id = item.id;

            td = document.createElement('td');
            td.append(deleteBut);
            tr.append(td);
            
            var editButton = document.createElement('button');
            editButton.textContent = '\u270E';
            editButton.id = item.id;

            td = document.createElement('td');
            td.append(editButton);
            tr.append(td);


            deleteBut.addEventListener('click', function() {
                var elem = this.id;
                let index = visitorsArr.findIndex(x => x.id === elem);
                visitorsArr.splice(index, 1);
                localStorage.setItem('visitors', JSON.stringify(visitorsArr));
                this.closest('tr').remove();
            });
            
            editButton.addEventListener('click', function() {
                
                let visitors = JSON.parse(localStorage.getItem('visitors'));
                let editVisitor = visitors.findIndex(x => x.id === this.id);
               
                $("#visitorsId").val(visitors[editVisitor].id);
                $("#visitorsName").val(visitors[editVisitor].fullname);
                $("#visitorsAuth").val(visitors[editVisitor].phone);
                
                $("#editVisitors").dialog({
                dialogClass: "no-close",
                title: "Edit",
                buttons: [
                    {
                        text: "Save",
                        click: function() {
                            let inputs = $('.edVsitor');

                            let editedVisitors = new Person($("#visitorsId").val(), $("#visitorsName").val(), $("#visitorsAuth").val());

                            if ($(inputs).hasClass('error')) {
                                event.preventDefault();
                                return;
                            } else {
                                let allVisitors = JSON.parse(localStorage.getItem("visitors"));
                                allVisitors[editVisitor] = editedVisitors;
                                localStorage.setItem("visitors", JSON.stringify(allVisitors));

                                $(table).empty();
                                $(this).dialog("close");
                                getData();
                            }
                        }
                    }
                ]
            });
            });

        table.append(tr);      
    });    
    
    document.getElementById('table').append(table);
}

getData();





//=============================================================================

var inputs = document.querySelectorAll('.visitor');
    
    $("#newVisitor").click(function() {
    $("#visitor").dialog({
  dialogClass: "no-close",
    title: "Добавить посетителя",
  buttons: [
    {
      text: "Добавить",
      click: function() {
        let newVisitor = new Person(inputs[0].value, inputs[1].value, inputs[2].value);
          
        

        for(var n = 0; n < inputs.length; n++) {
            if($(inputs).hasClass('error')) {
                event.preventDefault();
                return;
            } else {
                let newVisitorsArr = JSON.parse(localStorage.getItem("visitors"));
                newVisitorsArr.push(newVisitor);
                localStorage.setItem("visitors", JSON.stringify(newVisitorsArr));
                
                while (table.rows.length > 0) {
                    table.deleteRow(0);
                    $( this ).dialog( "close" );
                    getData();
                }
            }
        }
      }
    }
  ]
});
});


//================================ sort==============

$("#sortUsers").change(function() {
    
    var visitorsID = JSON.parse(localStorage.getItem("visitors"));
    
    function notId(a, b) {
        var nameA = a.fullname.toLowerCase(), nameB = b.fullname.toLowerCase();
            
        if (nameA < nameB) 
          return -1
        if (nameA > nameB)
          return 1
        return 0
    }
    
    function id(a, b) {
        return a.id - b.id;
    }
    
    visitorsID.sort($(this).val() === "id" ? id : notId);
    
    $(table).empty();
    
    localStorage.setItem("visitors", JSON.stringify(visitorsID));
    
    getData();
});

//================================ поиск==============


$(function() {
    $.ajax({
        url: "visitorsName.json",
        dataType: "json",
        method: "GET",
        success: function(data) {
            $("#search").autocomplete({
            source: data
            })
        },
        error: function() {
            console.warn(error);
            
        }
    });
    
});
//===========================валидация==============

//валидация ID

$("#id").on("blur", function() {
        let val = $(this).val();
        if(isNaN(val) === true) {
            $(this).addClass('error');
            $(this).val("Введите число");
        } else if(val == "") {
            $(this).addClass('error');
            $(this).val("Заполните поле");
        } else {
            return
        }
    }); 

$("#visitorsId").on("blur", function() {
        let val = $(this).val();
        if(isNaN(val) === true) {
            $(this).addClass('error');
            $(this).val("Введите число");
        } else if(val == "") {
            $(this).addClass('error');
            $(this).val("Заполните поле");
        } else {
            return
        }
    }); 
    


//валидация Name

 $("#name").on("blur", function() {
        let val = $(this).val();
        if(val == "") {
            $(this).addClass('error');
            $(this).val("Заполните поле");
        } else if(isNaN(val) === false) {
            $(this).addClass('error');
            $(this).val("Цифры недопустимы");
        } else {
            return
        }
    });

$("#visitorsName").on("blur", function() {
        let val = $(this).val();
        if(val == "") {
            $(this).addClass('error');
            $(this).val("Заполните поле");
        } else if(isNaN(val) === false) {
            $(this).addClass('error');
            $(this).val("Цифры недопустимы");
        } else {
            return
        }
    });
    

//валидация phone

$("#auth, #visitorsAuth").on("blur", function() {
    let val = $(this).val();
    if(isNaN(val) === true) {
        $(this).addClass('error');
        $(this).val("Введите число");
    } else if(val == "") {
        $(this).addClass('error');
        $(this).val("Заполните поле");
    } else if(val.length < 7) {
        $(this).addClass('error');
        $(this).val("Некорректный номер ");
    } else {
        return
    }
});   

$("#auth, #visitorsAuth, #name, #visitorsName, #VisitorsId, #id").on("focus", function() {
    $(this).removeClass('error');
    $(this).val("");
});
