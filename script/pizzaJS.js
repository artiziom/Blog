window.addEventListener("load", ()=>{
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.open("get", "pizza.xml", true);
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            showResult(this);
        }
    };
    xmlhttp.send(null);
    
});


function showResult(xmlhttp) {
    const xmlDoc = xmlhttp.responseXML.documentElement;
    removeWhitespace(xmlDoc);
    const outputResult = document.getElementById("BodyRows");
    const rowData = xmlDoc.getElementsByTagName("zamowienie");

    addTableRowsFromXmlDoc(rowData,outputResult);
    count();
}

function addTableRowsFromXmlDoc(xmlNodes,tableNode) {
    const theTable = tableNode.parentNode;
    let newRow, newCell, i;
    for (i=0; i<xmlNodes.length; i++) {
        newRow = tableNode.insertRow(i);
        newRow.className = (i%2) ? "OddRow" : "EvenRow";
        for (j=0; j<xmlNodes[i].childNodes.length; j++) {
            newCell = newRow.insertCell(newRow.cells.length);
            if (xmlNodes[i].childNodes[j].firstChild) {
                newCell.innerHTML = xmlNodes[i].childNodes[j].firstChild.nodeValue;
                newCell.className = "count";
            } else {
                newCell.innerHTML = "-";
            }
        }
        }
        theTable.appendChild(tableNode);
}

function removeWhitespace(xml) {
    let loopIndex;
    for (loopIndex = 0; loopIndex < xml.childNodes.length; loopIndex++)
    {
        var currentNode = xml.childNodes[loopIndex];
        if (currentNode.nodeType == 1)
        {
            removeWhitespace(currentNode);
        }
        if (!(/\S/.test(currentNode.nodeValue)) && (currentNode.nodeType == 3))
        {
            xml.removeChild(xml.childNodes[loopIndex--]);
        }
    }
}

function count(){
    let cheese = 0,corn = 0, beef = 0,champignons = 0, salami = 0, amount = 0;
    const count = document.querySelectorAll('.count');
    const chesseDisplay = document.querySelector('.cheese');
    const cornDisplay = document.querySelector('.corn')
    const salamiDisplay = document.querySelector('.salami')
    const beefDisplay = document.querySelector('.beef')
    const champignonsDisplay = document.querySelector('.champignons')
    const amountDisplay = document.querySelector('.amount');

    count.forEach((item) => {
        if(item.innerText.includes('Ser'))cheese++;
        if(item.innerText.includes('Kukurydza'))corn++;
        if(item.innerText.includes('Salami'))salami++;
        if(item.innerText.includes('Wolowina'))beef++;
        if(item.innerText.includes('Pieczarki'))champignons++;
        if(Number(item.innerText)) amount +=  Number(item.innerText);
    })
    
    chesseDisplay.textContent = `Ser: -${cheese}`;
    cornDisplay.textContent = `Kukurydza: -${corn}`;
    salamiDisplay.textContent = `Salami: -${salami}`;
    beefDisplay.textContent = `Wolowia: -${beef}`;
    champignonsDisplay.textContent = `Pieczarki: -${champignons}`;
    amountDisplay.textContent = `Suma zamówień: ${amount}`;
}





