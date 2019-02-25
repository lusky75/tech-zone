var item = [];

function buyimmediatly(picture, id, name, id_user, price, quantity) {
    Array.prototype.replaceContents = function (array2) {
        var newContent = array2.slice(0);
        this.length = 0;
        this.push.apply(this, newContent);
    };
    var tab = JSON.parse(localStorage.getItem('item'));
    var testObject = {'picture':picture, 'id': id, 'name': name, 'id_user': id_user, 'price':price, 'quantity':quantity};
    if (localStorage.getItem('item')) {
        item.replaceContents(JSON.parse(localStorage.getItem('item')));
    }
    item.push(testObject);
    localStorage.setItem('item', JSON.stringify(item));
    location.reload();
}

function update() {
    var table = document.getElementById("info");
    var sum = 0;
    var total=document.getElementById("total");
    if (table != null) {
        for (var i = 1; i < table.rows.length; i++) {
            for (var j = 0; j < table.rows[i].cells.length; j++)
                if (j == 3 && i > 0) {
                    sum += parseInt(table.rows[i].cells[j].innerText) * parseInt(document.getElementById(i - 1).selectedIndex + 1);
                }
        }
    }
    total.value = sum;
    total.innerHTML = sum + ",00 $";
}

function display() {
    var student;
    var k = 1;
    for (var i = 0; i < JSON.parse(localStorage.item).length; i++) {
        student = {
            picture: "<img src=\"" + JSON.parse(localStorage.getItem('item'))[i]['picture'] + "\">",
            name: JSON.parse(localStorage.getItem('item'))[i]['name'],
            price: JSON.parse(localStorage.getItem('item'))[i]['price'],
            select:JSON.parse(localStorage.getItem('item'))[i]['quantity']
        };
        var table = document.getElementById("info");
        var row = table.insertRow(i + 1);
        row.className="tr";
        var cell0 = row.insertCell(0);
        var cell1 = row.insertCell(1);
        cell1.className = "ok";
        var cell2 = row.insertCell(2);
        var cell3 = row.insertCell(3);
        var label = document.createElement('label');
        label.htmlFor = 'text';
        cell3.appendChild(label);
        var cell4 = row.insertCell(4);
        var input = document.createElement('input');
        input.setAttribute('onclick', 'remove(' + JSON.parse(localStorage.getItem('item'))[i]['id'] +')');
        input.type = 'submit';
        input.value = "Delete";
        var cell5 = row.insertCell(5);
        var select = document.createElement('select');
        select.id = i;
        cell5.appendChild(input);
        select.onclick = function (k) {
            var change = k.target.value;
            var stored = localStorage.getItem('item');
            stored = stored ? JSON.parse(stored) : {};
            stored[select.id]['quantity'] = change;
            localStorage.setItem('item',JSON.stringify(stored));
            console.log(JSON.parse(localStorage.getItem('item'))[select.id]['quantity']);
            update(select);

        };

        for (var j = 1; j < 5; j++) {
            var option = document.createElement('option');
            option.value = j;
            option.innerHTML = j;
            select.append(option);
        }
        cell4.append(select);
        cell0.innerHTML = i;
        cell1.innerHTML = student.picture,
        cell2.innerHTML = student.name,
        label.innerHTML = student.price + ",00 $";
        //console.log(student);
        k++;
    }
    //console.log(document.getElementsByTagName("select").selectedIndex);
}

function pay(total) {
    var stockage = [];
    Array.prototype.replaceContents = function (array2) {
        var newContent = array2.slice(0);
        this.length = 0;
        this.push.apply(this, newContent);
    };
    stockage.replaceContents(JSON.parse(localStorage.getItem('item')));
    var string = JSON.stringify(stockage);
    $.ajax({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        url: '/ajax',
        type: 'POST',
        dataType: 'JSON',
        data: {
           myData:string,
           total:total
        },
        success: function (data) {
           $('.ajax').empty();
           $('.ajax').append(data);
        },
    });
    localStorage.removeItem('item');
    location.reload();
}

function createButton() {
    var pay = document.getElementById("pay");
    var button = document.createElement("button");
    var label = document.getElementById('total').value;
    button.setAttribute("onclick", "pay(" + label + ")");
    button.style = "border:none; background:none;";
    var div = document.createElement("div");
    div.className="enjoy-css";
    div.innerHTML = "Pay";
    button.appendChild(div);
    pay.appendChild(button);
}

function remove(id) {
    var product = [];
    Array.prototype.replaceContents = function (array2) {
        var newContent = array2.slice(0);
        this.length = 0;
        this.push.apply(this, newContent);
    };
    product.replaceContents(JSON.parse(localStorage.getItem('item')));
    for (var i = 0; i < product.length; i++) {
        if (product[i]['id'] == id) {
            product.splice(i, 1);
        }
    }
    localStorage.setItem('item', JSON.stringify(product));
    location.reload();
}
