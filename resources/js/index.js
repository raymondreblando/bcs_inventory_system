// showLoader();

// window.addEventListener('load', () => {
//   hideLoader();
// })

window.addEventListener("DOMContentLoaded", () => {
  const stocks = document.querySelectorAll(".inv-stocks");
  const reorderLevels = document.querySelectorAll(".inv-reorder-level");

  if(stocks.length){
    stocks.forEach((stock, index) => {
      const stockLevel = parseInt(stock.textContent.trim());
      const reorderLevel = parseInt(reorderLevels[index].textContent.trim());

      if(stockLevel <= reorderLevel){
        stock.style.color = "#dc2626";
      }
    })
  }
})

addEvent("body", "click", () => {
  const searchbar = document.querySelector(".searchbar");
  
  if(isNull(".searchbar") && window.innerWidth < 768) searchbar.style.display = "none";

  const select = document.querySelector(".select-wrapper");
  if(isNull(".select-wrapper")) select.classList.add("hidden");
})

addEvent(".toggle-password", "click", (e) => {
  togglePassword(e);
}, "all")

addEvent(".menu-btn", "click", () => {
  dynamicStyling(".sidebar", "show");
})

addEvent(".close-sidebar", "click", () => {
  dynamicStyling(".sidebar", "show", "remove");
})

addEvent(".search-btn", "click", (e) => {
  e.stopPropagation();
  const searchbar = document.querySelector(".searchbar");
  searchbar.style.display = "flex";
})

addEvent(".searchbar", "click", (e) => {
  e.stopPropagation();
})

addEvent(".upload-container", "click", (e) => {
  const uploadInput = e.target.querySelector("input");
  uploadInput.click();
})

addEvent(".upload-input", "change", (e) => {
  previewUpload(e);
})

addEvent(".profile-upload", "click", () => {
  const uploadInput = document.querySelector(".dp-input");
  uploadInput.click();
})

addEvent(".dp-input", "change", (e) => {
  const accepted = ["image/jpeg", "image/png", "image/svg+xml"];
  
  if(!accepted.includes(e.target.files[0].type)){
    toast("Invalid image extension", "error");
    return
  }

  const image = document.querySelector(".profile-image");

  const fileReader = new FileReader();

  fileReader.onload = (e) => {
    image.src = e.target.result;
  }

  fileReader.readAsDataURL(e.target.files[0]);
})

addEvent(".supplier-select", "change", ({ target }) => {
  const supplierInput = document.querySelector(".supplier-input");

  if(target.value === "Others"){
    supplierInput.classList.remove("hidden");
    target.parentElement.style.display = "none";
  }
})

addEvent(".custom-select", "click", (e) => {
  e.stopPropagation();
})

addEvent(".search-product", "focus", ({ target }) => {
  const removeBtn = document.querySelector(".remove-search");
  const select = document.querySelector(".select-wrapper");
  const price = document.querySelector("#price");

  if(target.value === ""){
    if(price !== null) price.value = "";
  } else{
    removeBtn.classList.remove("hidden");
  }

  select.classList.remove("hidden");
})

addEvent(".search-product", "keyup", ({ target }) => {
  const filter = target.value.toLowerCase();
  const options = document.querySelectorAll(".select-option");
  const removeBtn = document.querySelector(".remove-search");
  const price = document.querySelector("#price");
  const input = document.querySelector(".select-value");

  if(target.value === ""){
    removeBtn.classList.add("hidden");
    input.value = "";
    if(price !== null) price.value = "";
  } else{
    removeBtn.classList.remove("hidden");
  }

  options.forEach((option) => {
    const optionText = option.textContent.toLowerCase();
    if (optionText.includes(filter)) {
      option.style.display = 'block';
    } else {
      option.style.display = 'none';
    }
  });
})

addEvent(".remove-search", "click", ({ target }) => {
  const searchInput = document.querySelector(".search-product");
  const input = document.querySelector(".select-value");

  searchInput.value = "";
  input.value = "";

  target.classList.add("hidden");

  const options = document.querySelectorAll(".select-option");
  options.forEach(option => option.style.display = "block")

  searchInput.focus();
})

addEvent(".select-option", "click", ({ target }) => {
  const searchInput = document.querySelector(".search-product");
  const input = document.querySelector(".select-value");
  const price = document.querySelector("#price");
  const select = document.querySelector(".select-wrapper");

  searchInput.value = target.textContent.trim();
  input.value = target.dataset.value;
  if(price !== null) price.value = target.dataset.price;
  select.classList.add("hidden");
}, "all")