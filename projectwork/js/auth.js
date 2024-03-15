const showFormButton = document.querySelectorAll(".showFormButton");
if (showFormButton) {
  const formContainer = document.getElementById("formContainer");

  showFormButton.forEach((showBtn) => {
    showBtn.addEventListener("click", function () {
      var search = showBtn.textContent;
      var formattedSearch = search.replace(/\s+/g, "").toLowerCase();
      formContainer.classList.remove("hidden");
      formContainer.querySelector("h3 span").textContent = search;
      formContainer.querySelector("#searchItem").value = formattedSearch;
    });
  });
  window.addEventListener("click", function (event) {
    if (event.target === formContainer) {
      formContainer.classList.add("hidden");
    }
  });
}
