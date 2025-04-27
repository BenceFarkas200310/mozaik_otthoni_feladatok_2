const subjects = ["Matematika", "Fizika", "Irodalom", "Történelem", "Kémia"];

const subjectList = document.getElementById("subject-list");
const timetable = document.getElementById("timetable");
const notification = document.getElementById("notification");

subjects.forEach((subject) => {
  const item = document.createElement("div");
  item.className = "list-group-item list-group-item-action";
  item.textContent = subject;
  item.draggable = true;
  item.addEventListener("dragstart", (e) => {
    e.dataTransfer.setData("text/plain", subject);
  });
  subjectList.appendChild(item);
});
