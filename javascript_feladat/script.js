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

const days = ["Hétfő", "Kedd", "Szerda", "Csütörtök", "Péntek"];
const hours = [
  "8:00",
  "9:00",
  "10:00",
  "11:00",
  "12:00",
  "13:00",
  "14:00",
  "15:00",
  "16:00",
];

let html = "<thead><tr><th>Óra</th>";
days.forEach((day) => (html += `<th>${day}</th>`));
html += "</tr></thead><tbody>";

hours.forEach((hour) => {
  html += `<tr><th>${hour}</th>`;
  days.forEach(() => (html += `<td class="dropzone"></td>`));
  html += "</tr>";
});
html += "</tbody>";
timetable.innerHTML = html;
