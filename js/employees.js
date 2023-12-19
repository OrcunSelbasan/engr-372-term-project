const Fields = (function getFields() {
    const btnReset = $("#employee-reset");
    const btnCreate = $("#employee-create");
    const btnUpdate = $("#employee-update");
    const fname = $("#employee-fname");
    const lname = $("#employee-lname");
    const email = $("#employee-email");
    const phone = $("#employee-phone");
    const salary = $("#employee-salary");
    // const salaryUnit = $("#employee-salary-unit");
    const form = $("#employee-form");

    return {
        btnReset,
        btnCreate,
        fname,
        lname,
        email,
        phone,
        salary,
        // salaryUnit,
        form,
        btnUpdate,
    };
})();

function validate(event) {
    console.log("Validating");
    const erroredFields = [];
    const fields = Object.entries(Fields)
        .filter(
            ([fieldIdentifier, field]) =>
                fieldIdentifier !== "btnReset" &&
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
        event.preventDefault();
    }

    if (erroredFields.length > 0) {
        $("#validate-error").text("Please fill all fields!");
        $("#employee-form-container").css("border", "2px solid red");
        setTimeout(() => {

            $("#validate-error").text("");
            $("#employee-form-container").css("border", "2px solid var(--dark-green)");
        }, 1000);
    }

    return isValid;
}

Fields.btnReset.on("click", () => {
    console.log("reset pressed");
    const fields = Object.values(Fields);
    fields.forEach((field) => {
        if (!field.is("button") && !field.is("form")) {
            field.val("");
        }
    });
});


Fields.btnCreate.on("click", (event) => {
    console.log("create pressed");
    const isValid = validate(event);
    if (isValid) {
        $("#form-submission-type").val("EMPLOYEES");
        Fields.form.submit();
    }
});

Fields.btnUpdate.on("click", async function (event) {
    console.log("Update pressed");
    const isValid = validate(event);
    if (isValid) {
        console.log("fine");
        const id = $("#employee-object-id").data("identifier")
        $("#form-submission-type").val("EMPLOYEES");
        $("#employee-method").val("PUT");
        $("#employee-object-id").val(id);
        Fields.form.submit();
        console.log("form sent");
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
            const redirectUrl = origin.concat('/view/employees.php');
            window.location.replace(redirectUrl);
        }
    }
}
function editItem(id) {
    console.log("Edit " + id);
    window.location.href = `employee-view-entry.php?id=${id}`;
}
function addEmployee() {
    window.location.href = "add-employee.php";
}
function sortTable() {
    var sortAttribute = document.getElementById('sortAttribute').value;
    var descCheckbox = document.getElementById("desc");
    var isDescending = descCheckbox.checked;
    if (isDescending) {
        window.location.href = `employees.php?sort=${sortAttribute}&desc=true`;
    } else {
        window.location.href = `employees.php?sort=${sortAttribute}&desc=false`;
    }
}
