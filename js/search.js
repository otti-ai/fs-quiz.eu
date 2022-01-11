questions();
var questionsIDArray;
function questions(){
	var eventSelect = document.getElementById('eventSelect');
	var eventValue = eventSelect.options[eventSelect.selectedIndex].value;
	var yearSelect = document.getElementById('yearSelect');
	var yearValue = yearSelect.options[yearSelect.selectedIndex].value;
	var classSelect = document.getElementById('classSelect');
	var classValue = classSelect.options[classSelect.selectedIndex].value;
	var categorySelect = document.getElementById('categorySelect');
	var categoryValue = categorySelect.options[categorySelect.selectedIndex].value;
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function() { 
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
			var r = "";
			var r = xmlHttp.responseText;
			var row = r.split(';');
			var html = "";
			row.forEach(function(item){
				var part = item.split("@");
				if(part.length>1){
					var row = "<tr>";
					row += "<td>"+part[0]+"</td>";//id
					if(part[2].includes("t")){//year
						row += "<td>20"+part[2].slice(-3,-1)+"</td>";
						row += "<td>"+part[2].slice(0,-3).toUpperCase()+"</td>";
					}else{
						row += "<td>20"+part[2].slice(-2)+"</td>";
						row += "<td>"+part[2].slice(0,-2).toUpperCase()+"</td>";
					}
					if(part[1].length>100){//question shorter
						part[1] = part[1].slice(0,100)+"...";
					}
					row += "<td>"+part[1].replace("<br>"," ")+"</ul></td>";
					row += '<td><button onclick="openQuestion('+part[0]+')" type="button" class="btn btn-primary btn-sm">Show</button></td>';
					row += "</tr>";
					html += row;
				}
			});
			document.getElementById("count").innerHTML = "Found: "+row.length;
			document.getElementById("doc").innerHTML = html;
		}
	xmlHttp.open( "GET", "/php/search/searchQuestion.php?event="+eventValue+yearValue+"&category="+categoryValue+"&class=", true );
	xmlHttp.send( null );
}

function openQuestion(id){
	location.href = "http://www.fs-quiz.eu/content/question.php?id="+id;
}