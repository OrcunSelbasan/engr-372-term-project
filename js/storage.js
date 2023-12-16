const Fields = (function getFields() {
  const btnReset = $("#storage-reset");
  const btnCreate = $("#storage-create");
  const btnUpdate = $("#storage-update");
  const category = $("#storage-category");
  const volume = $("#storage-volume");
  const volumeUnit = $("#storage-volume-unit");
  const type = $("#storage-type");
  const initStatus = $("#storage-initial-status");
  const value = $("#storage-value");
  const valueUnit = $("#storage-value-unit");
  const autonotifier = $("#storage-notifier");
  const quantity = $("#storage-quantity");
  const estimatedLifetime = $("#storage-estimated-lifetime");
  const estimatedLifetimeUnit = $("#storage-estimated-lifetime-unit");
  const form = $("#storage-form");

  return {
    btnReset,
    btnCreate,
    category,
    volume,
    volumeUnit,
    type,
    initStatus,
    value,
    valueUnit,
    autonotifier,
    quantity,
    estimatedLifetime,
    estimatedLifetimeUnit,
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

  if (!isValid) {
    event.preventDefault();
  }

  // Highlight errored field for 1.5 seconds, after turn the bottom border's color back to black.
  if (erroredFields.length > 0) {
    for (const field of erroredFields) {
      field.css("border-bottom-color", "red");
      setTimeout(() => {
        field.css("border-bottom-color", "black");
      }, 1500);
    }
  }

  return isValid;
}

Fields.btnReset.on("click", () => {
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
  console.log("Create clicked");
  const isValid = validate(event);
  if (isValid) {
    $("#form-submission-type").val("STORAGE");
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
  console.log(isValid);
  if (isValid) {
    const id = $("#storage-object-id").data("identifier")
    $("#form-submission-type").val("STORAGE");
    $("#storage-method").val("PUT");
    $("#storage-object-id").val(id);
    Fields.form.submit();
  }
});

// function buildPutRequestBody() {
//   const fields = Object.entries(Fields).filter(
//     ([fieldIdentifier, field]) =>
//       fieldIdentifier !== "btnReset" &&
//       fieldIdentifier !== "btnCreate" &&
//       fieldIdentifier !== "form" &&
//       fieldIdentifier !== "btnUpdate"
//   );
//   const body = Object.values(fields).reduce(
//     (prev, [fieldIdentifier, field], index) => {
//       const name = field.attr("name");
//       const value = field.val();
//       const pair = encodeURIComponent(name)
//         .concat("=")
//         .concat(encodeURIComponent(value));
//       const seperator = index === 0 ? "" : "&";
//       const newString = prev.concat(seperator).concat(pair);
//       return newString;
//     },
//     ""
//   );

//   return body;
// }

async function deleteItem(id) {
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
    if (text === "true") {
      window.location.reload();
    }
  }
}

document.querySelectorAll(".change-loc").forEach(el => el.addEventListener("click", activateInput));

// $('#change-loc').on('click', activateInput);

function activateInput(params) {
  console.log(params);
  const currentPath = window.location.href;
  const url = `${currentPath}&edit=1`;
  window.location.replace(url);
}
