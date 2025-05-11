let selectedUsersArray = [];
$(document).ready(function () {
    $("#is-public").change(function () {
        if ($(this).is(":checked")) {
            $("#user-select-container").hide();
        } else {
            $("#user-select-container").show();
        }
    });

    $("#user-select").change(function () {
        let selectedUserId = $(this).val();
        let selectedUserText = $("#user-select option:selected").text();
        if (selectedUserId && !selectedUsersArray.includes(selectedUserId)) {
            $("#selected-users").append(
                `<div class="selected-user-bubble" data-user-id="` +
                    selectedUserId +
                    `"><b>` +
                    selectedUserText +
                    `</b> <button class="clear-user" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                    </svg>
                    </button>
                </div>`
            );
            selectedUsersArray.push(selectedUserId);
            console.log(selectedUsersArray);
        }
    });

    $("#selected-users").on("click", ".clear-user", function () {
        const userId = $(this).closest(".selected-user-bubble").data("user-id");
        const index = selectedUsersArray.indexOf(String(userId));
        if (index > -1) {
            selectedUsersArray.splice(index, 1);
        }
        console.log(selectedUsersArray);
        $(this).closest(".selected-user-bubble").remove();
    });
});

$("#create-event-form").on("submit", function (event) {
    event.preventDefault();
    $("#selected-users-input").val(JSON.stringify(selectedUsersArray));
    let formData = new FormData(this);

    $.ajax({
        url: "/events/create",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            $("#form-message").html(
                '<div class="alert alert-success">Esemény sikeresen létrehozva!</div>'
            );
            $("#create-event-form")[0].reset();
            selectedUsersArray = [];
            $("#selected-users").empty();
            const newCard = `
                    <div class="galery-cell">
                        ${response.eventCard}
                    </div>`;
            $("#users-event-carousel").flickity("append", newCard);
        },
        error: function (xhr) {
            let errors = xhr.responseJSON.errors;
            if (errors) {
                $("#event-name-error")
                    .text(errors["event-name"] ? errors["event-name"][0] : "")
                    .show();
                $("#event-location-error")
                    .text(
                        errors["event-location"]
                            ? errors["event-location"][0]
                            : ""
                    )
                    .show();
                $("#event-type-error")
                    .text(errors["event-type"] ? errors["event-type"][0] : "")
                    .show();
                $("#event-date-error")
                    .text(errors["event-date"] ? errors["event-date"][0] : "")
                    .show();
                $("#event-description-error")
                    .text(
                        errors["event-description"]
                            ? errors["event-description"][0]
                            : ""
                    )
                    .show();
            }
        },
    });
});
