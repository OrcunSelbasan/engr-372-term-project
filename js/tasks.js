const Fields = (function getFields() {
    // const btnReset = $("#task-reset");
    const btnCreate = $("#task-create");
    // const btnUpdate = $("#employee-update");
    const title = $("#task-title");
    const team = $("#task-team");
    const bin = $("#employee-email");
    const truck = $("#employee-phone");

    // const salaryUnit = $("#employee-salary-unit");
    const form = $("#task-form");

    return {
        // btnReset,
        btnCreate,
        title,
        team,
        // salaryUnit,
        form,
        // btnUpdate,
    };
})();

function validate(event) {
    console.log("Validating");
    const erroredFields = [];
    const fields = Object.entries(Fields)
        .filter(
            ([fieldIdentifier, field]) =>
                // fieldIdentifier !== "btnReset" &&
                fieldIdentifier !== "btnCreate" &&
                fieldIdentifier !== "form" &&
                fieldIdentifier !== "btnUpdate"
        )
        .map((field) => field[1]);
    console.log(fields);
    let isValid = true;
    for (const field of fields) {
        if (!field.is("button") && !field.is("form") && !field.is(":checkbox")) {
            if (!field.val()) {
                isValid = false;
                erroredFields.push(field);
            }
        }
    }
    console.log("Error Fields: " + erroredFields);

    if (!isValid) {
        console.log("not valid");
        event.preventDefault();
    }

    if (erroredFields.length > 0) {
        $("#validate-error").text("Please fill all fields!");
        $("#employee-form-container").css("border", "2px solid red");
        setTimeout(() => {

            $("#validate-error").text("");
            $("#employee-form-container").css("border", "2px solid var(--light-blue)");
        }, 1000);
    }

    return isValid;
}

// Fields.btnReset.on("click", () => {
//     console.log("reset pressed");
//     const fields = Object.values(Fields);
//     fields.forEach((field) => {
//         if (!field.is("button") && !field.is("form")) {
//             field.val("");
//         }
//     });
// });


Fields.btnCreate.on("click", (event) => {
    console.log("create pressed");
    const isValid = validate(event);
    if (isValid) {
        console.log("valid");
        $("#form-submission-type").val("TASKS");
        Fields.form.submit();
        console.log("submitted");
    }
});

async function deleteItem(id) {
    console.log("Delete pressed");
    const origin = window.location.origin;
    const pathname = "utils/submission.php";
    const query = `id=${id}`;
    const url = `${origin}/${pathname}?${query}`;
    if (confirm("Are you sure you want to delete?")) {
        const response = await fetch(url, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
                Accept: "*/*",
            },
        });
        const text = await response.text();
        console.log(text);
        console.log(url);
        if (text === "true") {
            // window.location.reload();
            // history.back();
            const redirectUrl = origin.concat('/view/tasks/tasks.php');
            window.location.replace(redirectUrl);
        }
    }
}

$("#task-reset").on("click", function () {
    console.log("Reset pressed");
    $("#task-title").val("");
    $("#task-team").val("1");
    $('input[type="radio"]').prop('checked', false);
});

// Fields.btnUpdate.on("click", async function (event) {
//     console.log("Update pressed");
//     const isValid = validate(event);
//     if (isValid) {
//         console.log("fine");
//         const id = $("#employee-object-id").data("identifier")
//         $("#form-submission-type").val("EMPLOYEES");
//         $("#employee-method").val("PUT");
//         $("#employee-object-id").val(id);
//         Fields.form.submit();
//         console.log("form sent");
//     }
// });