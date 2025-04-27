const subjects = ["Matematika", "Fizika", "Irodalom", "Történelem", "Kémia"];

const subjectList = document.getElementById("subject-list");
const timetable = document.getElementById("timetable");
const alertElement = document.getElementById("alert");

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

let html = "<thead><tr><th></th>";
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

window.onload = getSavedTimetable();

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
    showNotification(subject + " óra sikeresen hozzáadva", "success");
  } else showNotification("Ebben az időpontban már van óra!", "danger");
});

const deleteText = "Törlés";
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

function saveTimetable() {
  const data = [];
  cells.forEach((cell) => data.push(cell.textContent));
  localStorage.setItem("timetable", JSON.stringify(data));
  if (localStorage.getItem("timetable")) {
    showNotification("Órarend sikeresen mentve", "success");
  }
}

function getSavedTimetable() {
  const savedData = localStorage.getItem("timetable");
  if (savedData) {
    const data = JSON.parse(savedData);
    cells.forEach((cell, index) => {
      cell.textContent = data[index];
      if (data[index] !== "") cell.classList.add("deletable");
    });
  }
}

function deleteTimetable() {
  localStorage.removeItem("timetable");
  cells.forEach((cell) => {
    cell.textContent = "";
    cell.classList.remove("deletable");
  });
  showNotification("Órarend sikeresen törölve", "success");
}

function showNotification(message, type) {
  alertElement.className = `alert alert-${type}`;
  alertElement.classList.remove("d-none");
  console.log("alerted");
  alertElement.textContent = message;
  setTimeout(() => {
    alertElement.classList.add("d-none");
  }, 3000);
}
