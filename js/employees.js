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
        // console.log(field);
        // Check if the field is input except checkbox(it is optional field).
        if (!field.is("button") && !field.is("form") && !field.is(":checkbox")) {
            // Check if field is filled. Falsy values(null, undefined, 0, "", false, NaN)
            // can be seen as empty field. If field value is falsy field.val() will be false
            // If it is false we should prevent submission. Therefore we'll apply negation and
            // exit from loop.
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
    // Iterate over fields array to set fields to empty
    fields.forEach((field) => {
        if (field.is(":checkbox") && field.is(":checked")) {
            // Checkbox value is stored in the checked
            field.prop("checked", false);
        } else if (!field.is("button") && !field.is("form")) {
            // If the field is not checkbox then this condition will be checked
            // Here, we also check if the field is not form and the field is not
            // button. If it is not both, then we can set this field's value to
            // empty string.
            field.val("");
        }
    });
});


// We've created a validation function above, both click event of the create button
// and submit event of the form element triggers the submission. Therefore, I've added validate
// function to both elements.
Fields.btnCreate.on("click", (event) => {
    console.log("create pressed");
    const isValid = validate(event);
    if (isValid) {
        $("#form-submission-type").val("EMPLOYEES");
        Fields.form.submit();
    }
});

Fields.btnUpdate.on("click", async function (event) {
    // const isValid = validate(event);
    // const origin = window.location.origin;
    // const pathname = "utils/submission.php";
    // const url = `${origin}/${pathname}`;
    // console.log(isValid);
    // if (isValid) {
    //   const body = buildPutRequestBody();
    //   const response = await fetch(url, {
    //     method: "PUT",
    //     headers: {
    //       "Content-Type": "application/x-www-form-urlencoded",
    //       Accept: "*/*",
    //     },
    //     body,
    //   });
    //   const text = await response.text();
    //   console.log(text);
    console.log("Update pressed");
    const isValid = validate(event);
    // console.log(isValid);
    if (isValid) {

        console.log("fine");
        const id = $("#employee-object-id").data("identifier")
        $("#form-submission-type").val("EMPLOYEES");
        $("#storage-method").val("PUT");
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
        console.log("fetched");
        const text = await response.text();
        console.log(text);
        console.log(url);
        if (text === "true") {
            window.location.assign("http://localhost/view/employees.php");
        }
    }
}
