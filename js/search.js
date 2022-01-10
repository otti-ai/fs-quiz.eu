counter();
var questionsIDArray;
function counter(){
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
			questionsIDArray = r.split(';');
			maxCount = questionsIDArray.length;
			document.getElementById("count").innerHTML = "Found: "+maxCount;
		}
	xmlHttp.open( "GET", "/php/countQuestions.php?event="+eventValue+yearValue+"&category="+categoryValue+"&class=", true );
	xmlHttp.send( null );
}