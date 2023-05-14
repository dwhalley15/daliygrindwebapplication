document.getElementById("updateIcon").addEventListener("click", validation);
const categories = document.getElementById("categories");

categories.addEventListener('input', function(){
  let selected = categories.options[categories.selectedIndex].value;
  document.getElementById('category').value = selected;
});

function validation(){
  let name = document.forms["updateActivity"]["name"].value;
  let description = document.forms["updateActivity"]["description"].value;
  let startDate = document.forms["updateActivity"]["startTime"].value;
  let endDate = document.forms["updateActivity"]["endTime"].value;
  let startDateFormat = new Date(startDate);
  let endDateFormat = new Date(endDate);
  let currentDate = new Date();

  if(name == "" || description == "" || startDate == "" || endDate == ""){
    showError();
  }
  else if(startDateFormat < currentDate){
    document.forms["updateActivity"]["startTime"].value = "";
    showError();
  }
  else if(endDateFormat < startDateFormat){
    document.forms["updateActivity"]["endTime"].value = "";
    showError();
  }
  else{
    document.forms["updateActivity"].submit();
  }
}

function showError(){
  let error = document.getElementById("errorHidden");
  error.style.display = "inline";
}