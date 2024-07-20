const hargaElements = document.querySelectorAll(".price");
const searchInput = document.getElementById("searchInput");
const searchBtn = document.getElementById("searchBtn");
const searchForm = document.getElementById("searchForm");
const container = document.querySelector(".container");

const currency = hargaElements.forEach((hargaElement) => {
  let harga = parseFloat(hargaElement.textContent);

  const hargaFormat = new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
    minimumFractionDigits: 0,
    maximumFractionDigits: 0,
  }).format(harga);

  hargaElement.textContent = hargaFormat;
});

searchInput.addEventListener("keyup", (e) => {
  const xhr = new XMLHttpRequest();
  xhr.open("GET", `./views/search.php?keyword=${searchInput.value}`, true);

  xhr.onreadystatechange = function () {
    if ((xhr.readyState = 4 && xhr.status == 200)) {
      container.innerHTML = this.responseText;
      console.log(this);
    }
  };

  xhr.send();
});

searchForm.addEventListener("submit", (event) => {
  const trimmedValue = searchInput.value.trim();

  // Check if trimmed value is empty (only spaces)
  if (trimmedValue === "") {
    searchInput.value = ""; // Empty the input
  } else {
    searchInput.value = trimmedValue; // Update input value with trimmed version
  }
});
