document.getElementById("activityIcon").addEventListener("click", validation);
const categories = document.getElementById("categories");

categories.addEventListener('input', function(){
  let selected = categories.options[categories.selectedIndex].value;
  document.getElementById('category').value = selected;
});

function validation(){
  let name = document.forms["newActivity"]["name"].value;
  let description = document.forms["newActivity"]["description"].value;
  let startDate = document.forms["newActivity"]["startTime"].value;
  let endDate = document.forms["newActivity"]["endTime"].value;
  let startDateFormat = new Date(startDate);
  let endDateFormat = new Date(endDate);
  let currentDate = new Date();

  startDateFormat.setHours(0, 0, 0, 0);
  endDateFormat.setHours(0, 0, 0, 0);
  currentDate.setHours(0, 0, 0, 0);

  if(name == "" || description == "" || startDate == "" || endDate == ""){
    showError();
  }
  else if(startDateFormat < currentDate){
    document.forms["newActivity"]["startTime"].value = "";
    showError();
  }
  else if(endDateFormat < startDateFormat){
    document.forms["newActivity"]["endTime"].value = "";
    showError();
  }
  else{
    document.forms["newActivity"].submit();
  }
}

function showError(){
  let error = document.getElementById("errorHidden");
  error.style.display = "inline";
}