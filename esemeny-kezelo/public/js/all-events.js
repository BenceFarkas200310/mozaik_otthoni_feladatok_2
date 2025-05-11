const publics = document.querySelector("#publics");
const privates = document.querySelector("#privates");
const publicsBtn = document.querySelector("#publics-btn");
const privatesBtn = document.querySelector("#privates-btn");

function showPublics() {
    publics.classList.remove("hidden");
    privates.classList.add("hidden");

    publicsBtn.classList.remove("btn-outline-primary");
    publicsBtn.classList.add("btn-primary");

    privatesBtn.classList.remove("btn-primary");
    privatesBtn.classList.add("btn-outline-primary");
}

function showPrivates() {
    privates.classList.remove("hidden");
    publics.classList.add("hidden");

    privatesBtn.classList.remove("btn-outline-primary");
    privatesBtn.classList.add("btn-primary");

    publicsBtn.classList.remove("btn-primary");
    publicsBtn.classList.add("btn-outline-primary");
}
