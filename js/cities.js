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