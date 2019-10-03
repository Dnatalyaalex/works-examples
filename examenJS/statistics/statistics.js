class Books {
    constructor(readers, bookName) {
        this.bookName = bookName;
        this.readers = readers;
    }
} 

class Visitor {
    constructor(booksAmount, fullName) {
        this.books = booksAmount;
        this.name = fullName;
    }
} 



var books = JSON.parse(localStorage.getItem('books'));
let cards = JSON.parse(localStorage.getItem('cards'));
let booksLeader = [];

function findBooks() {
    
    for (var b = 0; b < books.length; b++) {
        for (var i = 0; i < cards.length; i++) {
            var result = cards.filter(x => x.bookID == books[b].id).length;
        }
        var booksCandidate = new Books(result, books[b].name);
        booksLeader.push(booksCandidate);
        
        booksLeader.sort(function(a,b) {
             return b.readers - a.readers;
        });
    }
   createBooksTable(booksLeader);
}

findBooks();

//==============================================================================================

let visitorsLeader = [];
let visitors = JSON.parse(localStorage.getItem('visitors'));

function findVisitor() {
    for (let v = 0; v < visitors.length; v++) {
        for (let i = 0; i < cards.length; i++) {
            var result = cards.filter(x => x.userID == visitors[v].id).length;
        }
        let visitorsCandidate = new Visitor(result, visitors[v].fullname);
        visitorsLeader.push(visitorsCandidate);
        
        visitorsLeader.sort(function(a,b) {
             return b.books - a.books;
        });
    }
    createVisitorsTable(visitorsLeader);
}

findVisitor();

//========================================table========================================================

function createVisitorsTable(arr) {
    let table = $("<table></table>");
    let tr = $("<tr><td><b>Place</td><td><b>Visitor</td><td><b>Books amount</td></tr>");
    table.append(tr);
    
        arr.forEach(function(item, i) {
            if(i < 5) {
            let tr = $(`<tr><td>${i+1}</td><td>${item.name}</td><td>${item.books}</td></tr>`);
            table.append(tr);
            } else {
                return;
            }
        });
    
    $("#visitorsLeaders").append(table);
}

//=================================================

function createBooksTable(arr) {
    let table = $("<table></table>");
    let tr = $("<tr><td><b>Place</td><td><b>Book name</td><td><b>Readers</td></tr>");
    table.append(tr);
    
        arr.forEach(function(item, i) {
            if(i < 5) {
            let tr = $(`<tr><td>${i+1}</td><td>${item.bookName}</td><td>${item.readers}</td></tr>`);
            table.append(tr); 
            } else {
                return;
            }
        });
    
    $("#booksLeaders").append(table);
}