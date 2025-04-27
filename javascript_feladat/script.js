const subjects = ["Matematika", "Fizika", "Irodalom", "Történelem", "Kémia"];

const subjectList = document.getElementById("subject-list");
const timetable = document.getElementById("timetable");

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

let cells = document.querySelectorAll("td");

timetable.addEventListener("dragover", (e) => e.preventDefault());
timetable.addEventListener("drop", (e) => {
  e.preventDefault();
  const subject = e.dataTransfer.getData("text/plain");
  const target = e.target.closest("td");

  if (
    target &&
    target.classList.contains("dropzone") &&
    target.innerHTML.trim() === ""
  ) {
    target.textContent = subject;
    target.classList.add("deletable");
  }
});

let deleteText = "Törlés";
cells.forEach((cell) => {
  cellContent = "";
  cell.addEventListener("mouseover", (e) => {
    cellContent = cell.innerHTML;
    if (cellContent !== "") cell.innerHTML = deleteText;
  });
  cell.addEventListener("mouseout", (e) => {
    if (cell.innerHTML === deleteText) cell.innerHTML = cellContent;
  });

  cell.addEventListener("click", (e) => {
    console.log(cellContent);
    if (cell.innerHTML === deleteText) {
      cell.innerHTML = "";
      cellContent = "";
      cell.classList.remove("deletable");
    }
  });
});
