class Books {
    constructor(id, name, author, pbName, year, pAmount, cAmount) {
        this.id = id;
        this.name = name;
        this.auth = author;
        this.publishYear = year;
        this.publishName = pbName;
        this.pageAmount = pAmount;
        this.copyAmount = cAmount;
    }
}


//================================Загрузка данных=====================================
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "books.json", true);

    xhr.onloadend = function() {
        if (this.status < 300) {
            localStorage.setItem("books", this.responseText);
    } else {
            console.log(xhr.status + ": " + xhr.statusText);
        }
    }
    xhr.send();
//=======================================================================================

var table = document.createElement('table');
table.setAttribute('contentEditable', 'true');


function getData() {

    let th = document.createElement('th');
    let tr = document.createElement('tr');

    th.textContent = 'ID';
    th.classList.add('idColumn');
    tr.append(th);


    th = document.createElement('th');
    th.textContent = 'Name';
    tr.append(th);

    th = document.createElement('th');
    th.textContent = 'Author';
    th.classList.add("authorColumn");
    tr.append(th);

    th = document.createElement('th');
    th.textContent = 'Year';
    tr.append(th);

    th = document.createElement('th');
    th.textContent = 'Publish';
    tr.append(th);

    th = document.createElement('th');
    th.textContent = 'Pages amount';
    tr.append(th);

    th = document.createElement('th');
    th.textContent = 'Copies amount';
    th.classList.add("copiesColumn");
    tr.append(th);
    
    th = document.createElement('th');
    th.textContent = 'Options';
    tr.append(th);
    
    th = document.createElement('th');
    th.textContent = 'Options';
    tr.append(th);

    table.append(tr);


    var booksArr = JSON.parse(localStorage.getItem("books"));

    booksArr.forEach(function (item, index) {

        td = document.createElement('td');
        tr = document.createElement('tr');

        td.textContent = item.id;

        tr.append(td);

        td = document.createElement('td');
        td.textContent = item.name;
        tr.append(td);

        td = document.createElement('td');
        td.textContent = item.auth;
        tr.append(td);

        td = document.createElement('td');
        td.textContent = item.publishYear;
        tr.append(td);

        td = document.createElement('td');
        td.textContent = item.publishName;
        tr.append(td);

        td = document.createElement('td');
        td.textContent = item.pageAmount;
        tr.append(td);

        td = document.createElement('td');
        td.textContent = item.copyAmount;
        tr.append(td);

        var button = document.createElement('button');
        button.textContent = '\u232B';
        button.id = item.id;
        
        td = document.createElement('td');
        td.append(button);
        tr.append(td);
        
        var editButton2 = document.createElement('button');
        editButton2.textContent = '\u270E';
        editButton2.id = item.id;
        
        td = document.createElement('td');
        td.append(editButton2);
        tr.append(td);

        table.append(tr);
        
//удаление книги
        button.addEventListener('click', function() {
            var elem2 = this.id;
                      
            var index2 = booksArr.findIndex(x => x.id === elem2);
           
            booksArr.splice(index2, 1);
            localStorage.setItem('books', JSON.stringify(booksArr));
            this.closest('tr').remove();
        });
//редактировать
        editButton2.addEventListener('click', function() {
            
            let books = JSON.parse(localStorage.getItem('books'));
            let editBook = books.findIndex(x => x.id === this.id);
            
            $("#bookId").val(books[editBook].id);
            $("#bookName").val(books[editBook].name);
            $("#bookAuth").val(books[editBook].auth);
            $("#bookYear").val(books[editBook].publishYear);
            $("#bookPublish").val(books[editBook].publishName);
            $("#bookPages").val(books[editBook].pageAmount);
            $("#bookCopies").val(books[editBook].copyAmount);
            
            $("#editbooks").dialog({
            dialogClass: "no-close",
            title: "Edit",
            buttons: [
                {
                    text: "Save",
                    click: function() {
                        let inputs = $('.formEdit');
                        
                        let newBooks = new Books($("#bookId").val(), $("#bookName").val(), $("#bookAuth").val(), 
                                   $("#bookYear").val(), $("#bookPublish").val(), $("#bookPages").val(), $("#bookCopies").val());

                        if ($(inputs).hasClass('error')) {
                            event.preventDefault();
                            return;
                        } else {
                            
                            let newbooksArr = JSON.parse(localStorage.getItem("books"));
                            newbooksArr[editBook] = newBooks;
                            localStorage.setItem("books", JSON.stringify(newbooksArr));

                            $(table).empty();
                            $(this).dialog("close");
                            getData();
                        }
                    }
                }
            ]
        });
        })    
        

    });
    document.getElementById('table').append(table);
}

getData();



//+++++++++++++++++++++++++++++Добавить книгу+++++++++++++++++++++++++++++++++++++++++++++

var inputs = document.querySelectorAll('.form');

$("#add").click(function () {
    $("#books").dialog({
        dialogClass: "no-close",
        title: "Добавить книгу",
        buttons: [
            {
                text: "Добавить",
                click: function() {

                    let newBooks = new Books(inputs[0].value, inputs[1].value, inputs[2].value, 
                                   inputs[3].value, inputs[4].value, inputs[5].value, inputs[6].value);

                    if ($(inputs).hasClass('error')) {
                        event.preventDefault();

                        return;
                    } else {
                        let newbooksArr = JSON.parse(localStorage.getItem("books"));
                        newbooksArr.push(newBooks);
                        localStorage.setItem("books", JSON.stringify(newbooksArr));

                        while (table.rows.length > 0) {
                            table.deleteRow(0);
                        }

                        $(this).dialog("close");
                        getData();
                    }
                }
            }
        ]
    });
});
//=========================================================================================


//валидация ID
$("#id").on("blur", function () {
    let val = $(this).val();
    if (isNaN(val) === true) {
        $(this).addClass('error');
        $(this).val("Введите число");
    } else if (val == "") {
        $(this).addClass('error');
        $(this).val("Заполните поле");
    } else {
        return
    }
});
$("#id").on("focus", function () {
    $(this).removeClass('error');
});

$("#bookId").on("blur", function () {
    let val = $(this).val();
    if (isNaN(val) === true) {
        $(this).addClass('error');
        $(this).val("Введите число");
    } else if (val == "") {
        $(this).addClass('error');
        $(this).val("Заполните поле");
    } else {
        return
    }
});


$("#bookId").on("focus", function () {
    $(this).val();
    $(this).removeClass('error');
});

//валидация Name

$("#name").on("blur", function () {
    let val = $(this).val();
    if ($(this).val() == "") {
        $(this).addClass('error');
        $(this).val("Заполните поле")
    }
});
$("#bookName").on("blur", function () {
    let val = $(this).val();
    if ($(this).val() == "") {
        $(this).addClass('error');
        $(this).val("Заполните поле")
    }
});

$("#name").on("focus", function () {
    $(this).removeClass('error');
    $(this).val("");
});
$("#bookName").on("focus", function () {
    $(this).removeClass('error');
});

//валидация auth

$("#auth").on("blur", function () {
    let val = $(this).val();
    if (isNaN(val) === false) {
        $(this).addClass('error');
        $(this).val("Цифры недопустимы");
    } else if (val == "") {
        $(this).addClass('error');
        $(this).val("Заполните поле");
    } else {
        return
    }
});

$("#bookAuth").on("blur", function () {
    let val = $(this).val();
    if (isNaN(val) === false) {
        $(this).addClass('error');
        $(this).val("Цифры недопустимы");
    } else if (val == "") {
        $(this).addClass('error');
        $(this).val("Заполните поле");
    } else {
        return
    }
});

$("#auth").on("focus", function () {
    $(this).removeClass('error');
    $(this).val("");
});

$("#bookAuth").on("focus", function () {
    $(this).removeClass('error');
});


//валидация year

$("#year").on("blur", function () {
    let val = $(this).val();
    if (isNaN(val) === true) {
        $(this).addClass('error');
        $(this).val("Введите год 'xxxx'");
    } else if (val == "") {
        $(this).addClass('error');
        $(this).val("Заполните поле");
    } else if (val.length < 4) {
        $(this).addClass('error');
        $(this).val("Введите год 'xxxx'");
    } else {
        return
    }
});

$("#bookYear").on("blur", function () {
    let val = $(this).val();
    if (isNaN(val) === true) {
        $(this).addClass('error');
        $(this).val("Введите год 'xxxx'");
    } else if (val == "") {
        $(this).addClass('error');
        $(this).val("Заполните поле");
    } else if (val.length < 4) {
        $(this).addClass('error');
        $(this).val("Введите год 'xxxx'");
    } else {
        return
    }
});

$("#year").on("focus", function () {
    $(this).removeClass('error');
    $(this).val("");
});

$("#bookYear").on("focus", function () {
    $(this).removeClass('error');
});


//валидация publish

$("#publish").on("blur", function () {
    let val = $(this).val();
    if (isNaN(val) === false) {
        $(this).addClass('error');
        $(this).val("Введите название");
    } else if (val == "") {
        $(this).addClass('error');
        $(this).val("Заполните поле");
    } else {
        return
    }
});

$("#bookPublish").on("blur", function () {
    let val = $(this).val();
    if (isNaN(val) === false) {
        $(this).addClass('error');
        $(this).val("Введите название");
    } else if (val == "") {
        $(this).addClass('error');
        $(this).val("Заполните поле");
    } else {
        return
    }
});

$("#publish").on("focus", function () {
    $(this).removeClass('error');
    $(this).val("");
});

$("#bookPublish").on("focus", function () {
    $(this).removeClass('error');
});

//валидация pages

$("#pages").on("blur", function () {
    let val = $(this).val();
    if (isNaN(val) === true) {
        $(this).addClass('error');
        $(this).val("Введите количество");
    } else if (val == "") {
        $(this).addClass('error');
        $(this).val("Заполните поле");
    } else {
        return
    }
});

$("#bookPages").on("blur", function () {
    let val = $(this).val();
    if (isNaN(val) === true) {
        $(this).addClass('error');
        $(this).val("Введите количество");
    } else if (val == "") {
        $(this).addClass('error');
        $(this).val("Заполните поле");
    } else {
        return
    }
});


$("#pages").on("focus", function () {
    $(this).removeClass('error');
    $(this).val("");
});

$("#bookPages").on("focus", function () {
    $(this).removeClass('error');
});


//валидация exempls

$("#exempls").on("blur", function () {
    let val = $(this).val();
    if (isNaN(val) === true) {
        $(this).addClass('error');
        $(this).val("Введите количество");
    } else if (val == "") {
        $(this).addClass('error');
        $(this).val("Заполните поле");
    } else {
        return
    }
});

$("#bookCopies").on("blur", function () {
    let val = $(this).val();
    if (isNaN(val) === true) {
        $(this).addClass('error');
        $(this).val("Введите количество");
    } else if (val == "") {
        $(this).addClass('error');
        $(this).val("Заполните поле");
    } else {
        return
    }
});

$("#exempls").on("focus", function () {
    $(this).removeClass('error');
    $(this).val("");
});

$("#bookCopies").on("focus", function () {
    $(this).removeClass('error');
});
//=================================сортировка========================================

var sortId = document.querySelector("table");

$(sortId).click(function (event) {
    
    let books = JSON.parse(localStorage.getItem("books"));

    var target = event.target;

    if (target.tagName !== "TH") {
        return;
    } else if ($(target).hasClass('idColumn')) {
        books.sort(function (a, b) {
            return a.id - b.id
        });

    } else if($(target).hasClass('authorColumn')) {
     
        books.sort(function (a, b) {

            var nameA = a.auth.toLowerCase(),
                nameB = b.auth.toLowerCase()
            if (nameA < nameB)
                return -1
            if (nameA > nameB)
                return 1
            return 0
        });
    } else if($(target).hasClass('copiesColumn')) {
        books.sort(function (a, b) {

            var nameA = a.copyAmount.toLowerCase(),
                nameB = b.copyAmount.toLowerCase()
            if (nameA < nameB)
                return -1
            if (nameA > nameB)
                return 1
            return 0
        });
    } else {
        return;
    }
        
    localStorage.setItem("books", JSON.stringify(books));

    $(table).empty();
    getData();
});

//========================поиск===================================
$(function () {
    $.ajax({
        url: "booksName.json",
        dataType: "json",
        method: "GET",
        success: function (data) {
            $("#search").autocomplete({
                source: data
            });
        },
        error: function () {
            console.warn(error);

        }
    });

});




