const Fields = (function getFields() {
  const btnReset = $("#storage-reset");
  const btnCreate = $("#storage-create");
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
  };
})();

function validate(event) {
  const erroredFields = [];
  const fields = Object.values(Fields);
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

  if (isValid) {
    $("#form-submission-type").val("STORAGE");
    Fields.form.submit();
  }
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
Fields.btnCreate.on("click", validate);
