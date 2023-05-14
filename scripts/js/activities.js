document.getElementById("allABtn").addEventListener("click", allATab);
document.getElementById("leaderBtn").addEventListener("click", leaderTab);

function allATab(){
  let allTab = document.getElementById("allATab");
  let leaderTab = document.getElementById("leaderTab");
  let allNav = document.getElementById("allABtn");
  let leaderNav = document.getElementById("leaderBtn");
  allTab.className = "visibleTab";
  leaderTab.className = "hiddenTab";
  allNav.classList.add("active");
  leaderNav.classList.remove("active");
}

function leaderTab(){
  let allTab = document.getElementById("allATab");
  let leaderTab = document.getElementById("leaderTab");
  let allNav = document.getElementById("allABtn");
  let leaderNav = document.getElementById("leaderBtn");
  allTab.className = "hiddenTab";
  leaderTab.className = "visibleTab";
  allNav.classList.remove("active");
  leaderNav.classList.add("active");
}