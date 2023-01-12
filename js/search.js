function searchQuestions(){
	var questions = jsondata.questions;
	var questionArray = [];
	questions.forEach(function(item){
		questionArray.push(item);
	});
	//auswahl
	var eventclass = document.getElementById("classSelect").value;
	var typSelect = document.getElementById("typSelect").value;
	var categorySelect = document.getElementById("categorySelect").value;
	var disSelect = document.getElementById("disSelect").value;
	var imgSelect = document.getElementById("imgSelect");
	var solutionSelect = document.getElementById("solutionSelect");
	var yearSelect = document.getElementById("yearSelect").value;
	var eventSelect = document.getElementById("eventSelect").value;
	var textSearch = document.getElementById("textSearch").value;
	//filter todo
	if(eventclass == "ev" || eventclass == "cv" || eventclass == "dv"){
		questionArray = questionArray.filter(item => item.class == eventclass);
	}
	if(typSelect == "math"){
		questionArray = questionArray.filter(item => item.math == true);
	}
	if(typSelect == "rule"){
		questionArray = questionArray.filter(item => item.rule == true);
	}
	if(typSelect == "scoring"){
		questionArray = questionArray.filter(item => item.scoring == true);
	}
	if(categorySelect == "electronic"){
		questionArray = questionArray.filter(item => item.electronic == true);
	}
	if(categorySelect == "mechanical"){
		questionArray = questionArray.filter(item => item.mechanical == true);
	}
	if(disSelect == "dynamic"){
		questionArray = questionArray.filter(item => item.dynamic == true);
	}
	if(disSelect == "static"){
		questionArray = questionArray.filter(item => item.static == true);
	}
	if(imgSelect.checked){
		questionArray = questionArray.filter(item => item.images.length > 0);
	}
	if(solutionSelect.checked){
		questionArray = questionArray.filter(item => item.solution.length > 0);
	}
	if(yearSelect>0){
		questionArray = questionArray.filter(item => item.year == yearSelect);
	}
	if(eventSelect>0){
		questionArray = questionArray.filter(item => item.event_id == eventSelect);
	}
	if(textSearch){
		questionArray = questionArray.filter(item => item.text.toUpperCase().replace(/\\n/g," ").includes(textSearch.toUpperCase()));
	}
	//render
	var html = '';
	if(questionArray.length>0){
		questionArray.forEach(function(item){
			html += "<tr><td>"+item.question_id+"</td>"
			html +='<td>'+item.year+'</td>';
			html +='<td>'+item.class+'</td>';
			if(item.text.length>50){}
			html +='<td>'+item.text.replace(/\\n/g," ").slice(0,50);
			if(item.text.length>50){ html += '...';}
			html += '</td><td><a target="_blank" href="https://fs-quiz.eu/question/'+item.question_id+'" class="btn btn-primary btn-sm">Show</a></td>';
			document.getElementById("count").innerHTML = "Found: "+questionArray.length;
		});
	}else{
		html += "<tr><td class='text-center' colspan='5'>No questions found</td></tr>";
		document.getElementById("count").innerHTML = "Found: 0";
	}
	document.getElementById("doc").innerHTML = html;
}

//documents
function documents(){
	year = document.getElementById("yearSelect").value;
	type = document.getElementById("typeSelect").value;
	event = document.getElementById("eventSelect").value;
	typeString = "";
	switch (type) {
		case 'Rulebook':
		  typeString = 'rulebook';
		  break;
		case 'Hybrid Rules':
		  typeString = 'hybrid';
		  break;
		case 'Additional Rules':
		  typeString = 'additional';
		  break;
		case 'Handbook':
		  typeString = 'handbook';
		  break;
		case 'registration':
		  typeString = 'Registration';
		  break;
		case 'docs':
		  typeString = 'Additional Documents';
		  break;
		case 'Rulebook':
		  typeString = 'rulebook';
		  break;
	  }
	window.history.pushState({ additionalInformation: 'Search Documents' }, "FS-Quiz - Documents'", "https://fs-quiz.eu/search/documents/"+event+"/"+year+"/"+typeString);
	searchDocuments();
}

function searchDocuments(){
	var docs = jsondata.documents;
	var docArray = [];
	docs.forEach(function(item){
		docArray.push(item);
	});
	//event
	if(event>0){
		if(year>0){
			docArray = docArray.filter(item => item.event_id == event || item.event_id == 0);
		}else{
			docArray = docArray.filter(item => item.event_id == event);
		}
	}
	//year
	if(year>0){
		docArray = docArray.filter(item => item.year == year);
	}
	//type
	if(type!=''){
		docArray = docArray.filter(item => item.type == type);
	}
	//render
	var html = '';
	if(docArray.length>0){
		docArray.forEach(function(item){
			html += "<tr><td>"+item.year+"</td><td>"
			if(item.event_id>0){
				var ev = eventData.events[item.event_id-1];
				html += ev.event_name.replace('Formula Student', 'FS').replace('Formula', '');
			}else{
				html += 'Any';
			}
			html +='</td><td>'+item.type+'</td><td>'+item.version+'</td>';
			html += '<td><a target="_blank" href="https://doc.fs-quiz.eu/'+item.path+'" class="btn btn-primary btn-sm">Open</a></td>';
			document.getElementById("count").innerHTML = "Found: "+docArray.length;
		});
	}else{
		html += "<tr><td class='text-center' colspan='5'>No documents found</td></tr>";
		document.getElementById("count").innerHTML = "Found: 0";
	}
	document.getElementById("doc").innerHTML = html;
}

//sort table
var currentSortColumn = -1;
var currentSearchDirection = false;
function SortTable(element, column, isNumber){
	//sort
	var items = [];
	const table = document.getElementById("doc");
	table.childNodes.forEach((x) => {items.push(x)});
	table.innerHTML = "";
	
	currentSearchDirection = currentSortColumn == column ? !currentSearchDirection : false;
	currentSortColumn = column;
	items.sort(isNumber ? compareNum : compareString);
	
	items.forEach((x) => {table.appendChild(x);});
	//icon
	document.getElementsByName('sort').forEach((x) => {x.setAttribute('class','fas fa-sort');});

	if(currentSearchDirection){
		element.childNodes[1].childNodes[0].setAttribute('class','fas fa-sort-up');
	}else{
		element.childNodes[1].childNodes[0].setAttribute('class','fas fa-sort-down');
	}
}
function compareString(x,y){
	var result = x.childNodes[currentSortColumn].innerText < y.childNodes[currentSortColumn].innerText;
	return (currentSearchDirection ? result : !result) ? 1:-1;
}
function compareNum(x,y){
	var result = parseInt(x.childNodes[currentSortColumn].innerText) - parseInt(y.childNodes[currentSortColumn].innerText);
	return currentSearchDirection ? -result : result;
}
