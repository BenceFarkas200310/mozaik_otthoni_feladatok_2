$(document).ready(function () {
    $("#searchBar").on("input", function () {
        let query = $(this).val().toLowerCase();

        $(".event-card").each(function () {
            let name = $(this).data("name").toLowerCase();
            let location = $(this).data("location").toLowerCase();
            let date = $(this).data("date").toLowerCase();
            let type = $(this).data("type").toLowerCase();

            if (
                name.includes(query) ||
                location.includes(query) ||
                date.includes(query) ||
                type.includes(query)
            ) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});
