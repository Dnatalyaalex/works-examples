class Cards {
    constructor(id, user, book) {
        this.id = id;
        this.userID = user.id;
        this.user = user.fullname;
        this.bookID = book.id;
        this.book = book.name;
        this.firstDate = new Date().toLocaleDateString();
        this.lastDate = "<button>↺</button>";
    }
}

//==================Загрузка данных=====================================

let xhr = new XMLHttpRequest();
xhr.open("GET", "cards.json", true);

xhr.onloadend = function() {
    if (this.status < 300) {
        localStorage.setItem("cards", this.responseText);
} else {
        console.log(xhr.status + ": " + xhr.statusText);
    }
}
xhr.send();

//=========================================================================

let cardsarr = JSON.parse(localStorage.getItem("cards"));

getData(cardsarr);


$("#add").click(addCards);

function addCards() {
    
    createVisitorsOptions();
    createBooksOptions();


    $("#addCards").dialog({
                dialogClass: "no-close",
                title: "Add cards",
                buttons: [
                    {
                        text: "Save",
                        click: function() {
                            let inputs = $('.card');

                            if ($(inputs).hasClass('error')) {
                                event.preventDefault();
                                return;
                            } else {
                                createCard();

                                $(table).empty();
                                $(this).dialog("close");
                                let allCards = JSON.parse(localStorage.getItem("cards"));
                                getData(allCards);
                            }
                        }
                    }
                ]
            });
    
   
}


//==========================Cоздать карту==========================================


function createCard() {
    
    let books = JSON.parse(localStorage.getItem("books"));
    let visitors = JSON.parse(localStorage.getItem("visitors"));
    
    let bookID = $('#allBooks option:selected').val();
    let bookIndex = books.findIndex(x => x.id === bookID);
    books[bookIndex].copyAmount -= 1;
    
    localStorage.setItem("books", JSON.stringify(books));
    
    let visitorID = $('#allUsers option:selected').val();
    let visitorIndex = visitors.findIndex(x => x.id === visitorID);
    
    let card = new Cards($("#id").val(), visitors[visitorIndex], books[bookIndex]);
  
    let cardsArr = JSON.parse(localStorage.getItem("cards"));
    cardsArr.push(card);
    localStorage.setItem("cards", JSON.stringify(cardsArr));
}

//=============Cоздание выпадающих списков====================

function createVisitorsOptions() {
    var users = JSON.parse(localStorage.getItem('visitors'));
    
    users.forEach(function(item, index) {
        $("#allUsers").append($("<option>", {
            value: item.id,
            text: item.fullname
        }));
    });
}

function createBooksOptions() {
    var books = JSON.parse(localStorage.getItem('books'));
    
    books.forEach(function(item, index) {
        if (item.copyAmount != 0) {
            $("#allBooks").append($("<option>", {
            value: item.id,
            text: item.name
        }));
        } else {
            return;
        }
    });
}

//========Валидация=====================================================

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

//============getData=================================================

 let cards = JSON.parse(localStorage.getItem('cards'));

    function getData(arr) {
    
    let table = $("<table></table>");
    let tr = $(`<tr><td><b>ID</b></td><td><b>Visitor's ID</td><td><b>Name</td><td><b>Book ID</td><td><b>Book Name</td><td><b>Borrow Date</td><td><b>Return Date</td></tr>`);

    table.append(tr);
    
    arr.forEach(function(item, index) {
        let tr = $(`<tr><td>${item.id}</td><td>${item.userID}</td><td>${item.user}</td><td>${item.bookID}</td><td>${item.book}</td><td>${item.firstDate}</td><td class="returnDate" id=${item.bookID} data-id=${item.id}>${item.lastDate}</td></tr>`);
        
            table.append(tr);
        
            });
    
    $("#table").append($(table));
}

//=======================вернуть книгу=========================


    $("table").click(function(e) {
        let target = e.target;
        
        if(target.tagName != 'BUTTON') {
            return;
        } else {
 //td кнопки возврата
            let newTD = $(target).closest("td");
//дата возврата
            let text = (new Date().toLocaleDateString());
            newTD.text(text);
                        
            let cards = JSON.parse(localStorage.getItem("cards"));
            
            let newTdID = newTD.data("id");
            let cItemIndex = cards.findIndex(x => x.id == newTdID);
                
            cards[cItemIndex].lastDate = text;
            localStorage.setItem('cards', JSON.stringify(cards)); 
       
            let bookIndex = cards[cItemIndex].bookID;
        
            
            let books = JSON.parse(localStorage.getItem('books'));
            
            let bItemIndex = books.findIndex(x => x.id == bookIndex);
         
            books[bItemIndex].copyAmount = parseInt(books[bItemIndex].copyAmount) + 1;

            localStorage.setItem("books", JSON.stringify(books));
        }
       
});