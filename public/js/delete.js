const hargaElements = document.querySelectorAll(".price");
const hapus = document.getElementById("delete");
const id = hapus.getAttribute("identitas");

hargaElements.forEach((hargaElement) => {
  let harga = parseFloat(hargaElement.textContent);

  const hargaFormat = new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
    minimumFractionDigits: 0,
    maximumFractionDigits: 0,
  }).format(harga);

  hargaElement.textContent = hargaFormat;
});

hapus.addEventListener("click", (e) => {
  const rm = confirm("apakah anda ingin menghapus data ini??");

  if (rm === true) {
    location.href = `delete.php?id=${id}`;
  } else {
    location.href = `detail.php?id=${id}`;
  }
  e.preventDefault();
});
