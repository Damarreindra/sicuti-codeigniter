const dateInput = document.getElementById("leave_date");
const leaveDuration = document.getElementById("leave_duration");
const today = new Date().toISOString().split("T")[0];

dateInput.setAttribute("min", today);

dateInput.addEventListener("change", function () {
  const diffTime = new Date(dateInput.value).getDate() - new Date().getDate();

  if (diffTime > 0) {
    leaveDuration.value = diffTime;
  } else {
    leaveDuration.value = 0;
  }
});
