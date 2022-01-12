var sort = "q";
function changerSort(s){
	sort = s;
	questions();
}

function questions(){
	var eventSelect = document.getElementById('eventSelect');
	var eventValue = eventSelect.options[eventSelect.selectedIndex].value;
	var yearSelect = document.getElementById('yearSelect');
	var yearValue = yearSelect.options[yearSelect.selectedIndex].value;
	var classSelect = document.getElementById('classSelect');
	var classValue = classSelect.options[classSelect.selectedIndex].value;
	var typSelect = document.getElementById('typSelect');
	var categorySelect = document.getElementById('categorySelect');
	var disSelect = document.getElementById('disSelect');
	var categoryValue = typSelect.options[typSelect.selectedIndex].value+'II'+categorySelect.options[categorySelect.selectedIndex].value+'II'+disSelect.options[disSelect.selectedIndex].value;
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function() { 
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
			var r = "";
			var r = xmlHttp.responseText;
			var html = "";
			if(r.includes(";")){
				var row = r.split(';');
				row.forEach(function(item){
					var part = item.split("@");
					if(part.length>1){
						var row = "<tr>";
						row += "<td>"+part[0]+"</td>";//id
						if(part[2].slice(-1).includes("t")||part[2].slice(-1).includes("v")){//year
							row += "<td>20"+part[2].slice(-3,-1)+"</td>";
							row += "<td>"+part[2].slice(0,-3).toUpperCase()+"</td>";
						}else{
							row += "<td>20"+part[2].slice(-2)+"</td>";
							row += "<td>"+part[2].slice(0,-2).toUpperCase()+"</td>";
						}
						row += "<td>"+part[4]+"</td>";
						if(part[1].length>100){//question shorter
							part[1] = part[1].slice(0,100)+"...";
						}
						row += "<td>"+part[1].split('<ul')[0].replaceAll("<br>"," ")+"</td>";
						row += '<td><button onclick="openQuestion('+part[0]+')" type="button" class="btn btn-primary btn-sm">Show</button></td>';
						row += "</tr>";
						html += row;
					}
				});
				document.getElementById("count").innerHTML = "Found: "+row.length;
			}else{
				html += "<tr><td class='text-center' colspan='6'>No question found</td></tr>";
				document.getElementById("count").innerHTML = "Found: 0";
			}
			document.getElementById("doc").innerHTML = html;
		}
	xmlHttp.open( "GET", "/php/search/searchQuestion.php?event="+eventValue+yearValue+"&category="+categoryValue+"&class="+classValue+"&sort="+sort, true );
	xmlHttp.send( null );
}

function openQuestion(id){
	location.href = "http://www.fs-quiz.eu/content/question.php?id="+id;
}

function documents(){
	year = document.getElementById("yearSelect").value;
	event = document.getElementById("eventSelect").value;
	window.history.pushState({ additionalInformation: 'Search Documents' }, "FS-Quiz - Documents'", "https://fs-quiz.eu/documents/"+event+"/"+year);
	searchDocuments();
}

function searchDocuments(){
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function() { 
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
			var r = "";
			var r = xmlHttp.responseText;
			var html = "";
			var links = r.split(';');
			if(r.includes(";")){
				links.forEach(function(item){
					var info = item.split("@");
					var row = "<tr>";
					row += "<td>20"+info[1].slice(-2)+"</td>";
					if(info[1].includes("fs")){
						row += "<td>"+info[1].slice(0,-2).toUpperCase()+"</td>";
					}else{
						row += "<td>All</td>";
					}
					row += "<td>"+info[0]+"</td>";
					row += "</tr>";
					html += row;
				});
				document.getElementById("count").innerHTML = "Found: "+links.length;
			}else{
				html += "<tr><td class='text-center' colspan='3'>No question found</td></tr>";
				document.getElementById("count").innerHTML = "Found: 0";
			}
			document.getElementById("doc").innerHTML = html;
		}
	xmlHttp.open( "GET", "/php/getDocuments.php?y="+year+"&e="+event, true );
	xmlHttp.send( null );
}

var currentSortColumn = -1;
var currentSearchDirection = false;
function SortTable(column, isNumber){
	var items = [];
	const table = document.getElementById("doc");
	table.childNodes.forEach((x) => {items.push(x)});
	table.innerHTML = "";
	
	currentSearchDirection = currentSortColumn == column ? !currentSearchDirection : false;
	currentSortColumn = column;
	items.sort(isNumber ? compareNum : compareString);
	
	items.forEach((x) => {table.appendChild(x);});
}


function compareString(x,y){
	var result = x.childNodes[currentSortColumn].innerText < y.childNodes[currentSortColumn].innerText;
	return (currentSearchDirection ? result : !result) ? 1:-1;
}

function compareNum(x,y){
	var result = parseInt(x.childNodes[currentSortColumn].innerText) - parseInt(y.childNodes[currentSortColumn].innerText);
	return currentSearchDirection ? -result : result;
}
