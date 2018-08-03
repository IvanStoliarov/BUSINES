let buildingStatus = document.querySelector(".building-status__value");
let statusValue = buildingStatus.innerHTML;
let progressPassedBlock = document.querySelector(".building-progress_passed");
progressPassedBlock.style.width = statusValue;
