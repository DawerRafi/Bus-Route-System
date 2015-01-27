function addRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	if(rowCount < 20){							// limit the user from creating fields more than your limits
		var row = table.insertRow(rowCount);
		var colCount = table.rows[1].cells.length;
		for(var i=0; i<colCount; i++) {
			var newcell = row.insertCell(i);
			newcell.innerHTML = table.rows[1].cells[i].innerHTML;
		}
	}else{
		 alert("No of Stops Cannot Exceed 20.");
			   
	}
}

function deleteRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	for(var i=0; i<rowCount; i++) {
		var row = table.rows[i];
		var chkbox = row.cells[0].childNodes[0];
		if(null != chkbox && true == chkbox.checked) {
			if(rowCount <= 1) { 						// limit the user from removing all the fields
				alert("Cannot Remove all the Passenger.");
				break;
			}
			table.deleteRow(i);
			rowCount--;
			i--;
		}
	}
}

  function addFields(){
            // Number of inputs to create
            var number = document.getElementById("numberofstops").value;
			var count = document.getElementById("numberofstops");
			var counter = parseInt(number);
			count.value=(counter+1);
console.log(count.value);
            // Container <div> where dynamic content will be placed
            var container = document.getElementById("stops");
            // Clear previous contents of the container
            //while (container.hasChildNodes()) {
             //   container.removeChild(container.lastChild);
            //}
          //  for (i=0;i<number;i++){
                // Append a node with a random text
               // container.appendChild(document.createTextNode("Member " + (i+1)));
                // Create an <input> element, set its type and name attributes
				
				
                container.appendChild(document.createElement("br"));
				var select = document.createElement("select");
				select.name="stop"+ (counter+1);
				container.appendChild(select);
				$.ajax({
						url:'populateDropDown.php',
						complete: function (response) {
							select.innerHTML=response.responseText;
						},
						error: function () {
							//
						}
					});
				
				var label = document.createElement("label");
				label.For="From "+ (counter+1);
				label.innerHTML=" From ";
				container.appendChild(label);
                var input = document.createElement("input");
                input.type = "text";
                input.name = "From "+ (counter+1);
                container.appendChild(input);
				
				var label = document.createElement("label");
				label.For="To"+ (counter+1);
				label.innerHTML=" To " ;
				container.appendChild(label);
                var input = document.createElement("input");
                input.type = "text";
                input.name = "To "+ (counter+1);
                container.appendChild(input);
				
				var label = document.createElement("label");
				label.For="dur "+ (counter+1);
				label.innerHTML=" Duration ";
				container.appendChild(label);
                var input = document.createElement("input");
                input.type = "text";
                input.name = "dur "+ (counter+1);
                container.appendChild(input);
                // Append a line break 
                container.appendChild(document.createElement("br"));
            
        }