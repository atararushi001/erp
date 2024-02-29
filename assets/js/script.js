document.querySelectorAll("aside nav a").forEach(function (item) {
  item.addEventListener("click", function () {
    document.querySelectorAll("aside nav a").forEach(function (menuItem) {
      menuItem.classList.remove("active");
    });

    this.classList.add("active");
  });
});

function toggleNavbarText() {
  const mediaQuery = window.matchMedia("(max-width: 768px)");
  const sidebar = document.getElementById("sidebar");
  const mydiv = document.getElementById("mydiv");
  const navMenuImgs = document.querySelectorAll(".nav-menu-img");

  if (mediaQuery.matches) {
    sidebar.classList.toggle("open-from-right");
  } else {
    sidebar.classList.toggle("w-60");
    mydiv.classList.toggle("ml-60");
  }
}

function toggleSubmenu(submenuId) {
  const submenu = document.getElementById(submenuId);
  if (submenu.style.display === "block") {
    submenu.style.display = "none";
  } else {
    submenu.style.display = "block";
  }
}

function removeCustomer(button) {
  let deleteDiv = button.parentNode.parentNode.parentNode;
  deleteDiv.remove();
  CustomerAddressNumber--;

  let countdata = CustomerAddressNumber;

  let currentId = "customeraddress" + countdata;

  while (document.querySelector("#" + currentId)) {
    let newname = countdata - 1;
    document.querySelector("#" + currentId).innerHTML =
      "Customer Address " + newname;
    console.log(newname);
    countdata++;
    currentId = "customeraddress" + countdata;
  }
}

// $(document).ready(function () {
//   var totalSalesDiv = $("#totalsections");

//   if (ProductNumber > 0) {
//     totalSalesDiv.show();
//   } else {
//     totalSalesDiv.hide();
//   }
// });
function addProduct() {
  ProductNumber++;
  // console.log(ProductNumber);
  let newProductDiv = document.createElement("div");

  newProductDiv.innerHTML = `<div class="max-w-full mb-4" id="productsdiv">
        <div class="bg-white rounded-sm shadow-md mb-4">
            <div class="w-full border-b flex">
                <h2 class="text-gray-700 font-semibold p-4 text-lg">Product ${ProductNumber}</h2>
                <button class="ml-auto mr-4 flex mt-auto mb-auto" onclick="removeProduct(this)">
                    <svg class="mr-2 mt-1" width="23" height="23" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M15 9L9 15" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9 9L15 15" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>                                
                    <p class="text-red-500 text-lg">Remove Product</p>
                </button>
            </div>
            <div class="grid lg:grid-cols-4 md:grid-cols-1 sm:grid-cols-1 p-4 gap-4">
                <div>
                  <label for="product_category${ProductNumber}" class="text-gray-700 font-semibold">Product Category</label>
                  <select
                    name="product_category${ProductNumber}"
                    id="product_category${ProductNumber}"
                    class="select2-init border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important"
                  >
                    <option value="Product Category">Product Category</option>
                    ${product_categoryOptionsHTML}
                  </select>
                </div>
                <div class="lg:col-span-3">
                    <label for="product_description${ProductNumber}" class="text-gray-700 font-semibold">Product Description</label>
                    <input type="text" id="product_description${ProductNumber}" name="product_description${ProductNumber}" placeholder="Product Description" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                </div>
            </div>
            <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 p-4 pt-0 gap-4">
                <div class="col-span-2">
                  <label for="product_group${ProductNumber}" class="text-gray-700 font-semibold">Product Group</label>
                  <select
                    name="product_group${ProductNumber}"
                    id="product_group${ProductNumber}"
                    class="select2-init border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important"
                  >
                    <option value="Product Category">Product Group</option>
                ${product_groupOptionsHTML}
                  </select>
                </div>
                <div>
                    <label for="part_number${ProductNumber}" class="text-gray-700 font-semibold">Part Number</label>
                    <input type="text" id="part_number${ProductNumber}" name="part_number${ProductNumber}" placeholder="Part Number" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                </div>
                <div>
                    <label for="product_hsn_code${ProductNumber}" class="text-gray-700 font-semibold">HSN Code</label>
                    <input type="text" id="product_hsn_code${ProductNumber}" name="product_hsn_code${ProductNumber}" placeholder="HSN Code" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                </div>
            </div>
            <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 p-4 pt-0 gap-4">
                <div>
                    <label for="product_quantity${ProductNumber}" class="text-gray-700 font-semibold">Quantity</label>
                    <input type="text" id="product_quantity${ProductNumber}"  onchange="calculateAmount(${ProductNumber})" name="product_quantity${ProductNumber}" placeholder="Quantity" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                </div>
                <div>
                    <label for="product_rate${ProductNumber}" class="text-gray-700 font-semibold">Rate</label>
                    <input type="text" id="product_rate${ProductNumber}"  onchange="calculateAmount(${ProductNumber})" name="product_rate${ProductNumber}" placeholder="Rate" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                </div>
                <div class="col-span-2">
                    <label for="product_amount${ProductNumber}" class="text-gray-700 font-semibold">Amount</label>
                    <input type="text" id="product_amount${ProductNumber}" name="product_amount${ProductNumber}" placeholder="Amount" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                </div>
            </div>
        </div>
    </div>`;

  document.getElementById("add-product").appendChild(newProductDiv);

  document.getElementById("addpopup").innerHTML +=
    `<div class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 p-4 transition-all duration-300" style="  z-index: 99; display: none;" id="product_groupPopup${ProductNumber}"> <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-sm shadow-lg" style="width: 600px;">` +
    `<div class="flex justify-between border-b">` +
    `<h2 class="text-gray-800 font-semibold p-4 text-xl">Create product group</h2>` +
    `<svg id="closeCCategory" onclick="closeModal('product_groupPopup${ProductNumber}')" class="cursor-pointer mt-3 mr-2 close-button" width="35" height="35" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">` +
    `<path d="M37.5 12.5L12.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>` +
    `<path d="M12.5 12.5L37.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>` +
    `</svg>` +
    `</div>` +
    `<form class="p-4" name="product_groupform" action="../include/function.php" id="product_groupform">` +
    `<div>` +
    `<label for="customer_type" class="text-gray-700 font-semibold">Product group</label>` +
    `<input type="text" name="product_group" id="product_group" placeholder="Product group" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">` +
    `</div>` +
    `<div class="flex items-center justify-start gap-4 mt-32">` +
    `<button class="text-white text-sm px-4 py-2 w-28" onclick="savedata3('product_groupform','#product_group${ProductNumber}','product_group','product_groupPopup${ProductNumber}')" type="button" id="openButton" style="background-color: #007bff;">Save</button>` +
    `<button type="button" class="border bg-white text-sm px-4 py-2 w-28" onclick="closeModal('product_groupPopup${ProductNumber}')" style="color: #007bff; border: 1px solid #007bff;">Cancel</button>` +
    `</div>` +
    `</form>` +
    `</div>` +
    `</div>`;
  document.getElementById("addpopup").innerHTML +=
    `<div class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 p-4 transition-all duration-300" style="  z-index: 99; display: none;" id="product_categoryPopup${ProductNumber}"> <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-sm shadow-lg" style="width: 600px;">` +
    `<div class="flex justify-between border-b">` +
    `<h2 class="text-gray-800 font-semibold p-4 text-xl">Create product category</h2>` +
    `<svg id="closeCCategory" onclick="closeModal('product_categoryPopup${ProductNumber}')" class="cursor-pointer mt-3 mr-2 close-button" width="35" height="35" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">` +
    `<path d="M37.5 12.5L12.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>` +
    `<path d="M12.5 12.5L37.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>` +
    `</svg>` +
    `</div>` +
    `<form class="p-4" name="product_categoryform" action="../include/function.php" id="product_categoryform">` +
    `<div>` +
    `<label for="customer_type" class="text-gray-700 font-semibold">Product category</label>` +
    `<input type="text" name="product_category" id="product_category" placeholder="Product category" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">` +
    `</div>` +
    `<div class="flex items-center justify-start gap-4 mt-32">` +
    `<button class="text-white text-sm px-4 py-2 w-28" onclick="savedata3('product_categoryform','#product_category${ProductNumber}','product_category','product_categoryPopup${ProductNumber}')" type="button" id="openButton" style="background-color: #007bff;">Save</button>` +
    `<button type="button" class="border bg-white text-sm px-4 py-2 w-28" onclick="closeModal('product_categoryPopup${ProductNumber}')" style="color: #007bff; border: 1px solid #007bff;">Cancel</button>` +
    `</div>` +
    `</form>` +
    `</div>` +
    `</div>`;

  $(`#product_category${ProductNumber}`).select2({
    width: "100%",
    placeholder: "Add Product Category",
    language: {
      // noResults: function () {
      //   return $(
      //     `<button class='w-full p-2 text-center text-white' style='background-color: #007bff;' onclick="openModal('product_categoryPopup${ProductNumber}','#product_category${ProductNumber}')">Add Product Category</button>`
      //   );
      // },
    },
  });
  $(`#product_group${ProductNumber}`).select2({
    width: "100%",
    placeholder: "Add Product Group",
    language: {
      // noResults: function () {
      //   return $(
      //     `<button class='w-full p-2 text-center text-white' style='background-color: #007bff;' onclick="openModal('product_categoryPopup${ProductNumber}','#product_category${ProductNumber}')">Add Product Category</button>`
      //   );
      // },
    },
  });
  //  console.log(`product_groupPopup${ProductNumber}`);
  document.getElementById(`product_groupPopup${ProductNumber}`).style.display =
    "none";
  document.getElementById("totalsections").style.display = "block";
  
}
function calculateAmount(productNumber) {
  let quantity =
    parseFloat(
      document.getElementById(`product_quantity${productNumber}`).value
    ) || 0;
  let rate =
    parseFloat(document.getElementById(`product_rate${productNumber}`).value) ||
    0;
  let amount = quantity * rate;
  document.getElementById(`product_amount${productNumber}`).value =
    amount.toFixed(2);
  calculateTotal();
}

function calculateTotal() {
  let total = 0,
    total_quantity = 0;

  for (let i = 1; i <= ProductNumber; i++) {
    if (document.getElementById(`product_amount${i}`)) {
      let amount =
        parseFloat(document.getElementById(`product_amount${i}`).value) || 0;
      total += amount;
    }
  }
  for (let i = 1; i <= ProductNumber; i++) {
    if (document.getElementById(`product_quantity${i}`)) {
      let quantity =
        parseFloat(document.getElementById(`product_quantity${i}`).value) || 0;
      total_quantity += quantity;
    }
  }

  document.getElementById("total").value = total.toFixed(2);
  document.getElementById("total_quantity_nos").value =
    total_quantity.toFixed(2);
  document.getElementById("total_in_word").value = numberToWords.toWords(total);
}

function removeProduct(button) {
  let deleteProduct = button.parentNode.parentNode.parentNode;
  deleteProduct.remove();
  ProductNumber--;

  if (ProductNumber == 0) {
    $(document).ready(function () {
      var totalSalesDiv = $("#totalsections");

      if (ProductNumber > 0) {
        totalSalesDiv.show();
      } else {
        totalSalesDiv.hide();
      }
    });
  }
  let productDivs = document.querySelectorAll("#productsdiv");
  productDivs.forEach((productDiv, index) => {
    let newProductNumber = index + 1;
    productDiv.querySelector("h2").textContent = `Product ${newProductNumber}`;
    productDiv.querySelectorAll("input, select").forEach((input) => {
      let id = input.id;
      let name = input.name;
      let newId = id.replace(/\d+$/, newProductNumber);
      let newName = name.replace(/\d+$/, newProductNumber);
      input.id = newId;
      input.name = newName;
    });
    let removeButton = productDiv.querySelector("button");
    removeButton.setAttribute("onclick", `removeProduct(this)`);
  });
  calculateTotal();
}

function closeModal(elementname) {
  // console.log(elementname);
  document.getElementById(elementname).style.display = "none";
}
//open all mdoel

function openModal(elementname, selcterelement) {
  $(selcterelement).select2("close");
  document.getElementById(elementname).style.display = "block";
}

//function to get data while edit option

//save data of any add button of selecter
function savedata(formname, selecter, inputselecter) {
  var form = $("#" + formname);
  var url = form.attr("action");
  var addtext = form.find("input[name='" + inputselecter + "']");
  $.ajax({
    type: "POST",
    url: url,
    data: form.serialize(),
    success: function (data) {
      console.log(inputselecter);
      var newOption = new Option(addtext.val(), data, false, false);
      $(selecter).append(newOption).trigger("change");
      addtext.val("");

      alert("Form Submited Successfully");
      closeModal(inputselecter + "Popup");
    },
    error: function (data) {
      alert("some Error");
    },
  });
}

function savedata3(formname, selecter, inputselecter, popupname) {
  var form = $("#" + formname);
  var url = form.attr("action");
  var addtext = form.find("input[name='" + inputselecter + "']");
  $.ajax({
    type: "POST",
    url: url,
    data: form.serialize(),
    success: function (data) {
      // console.log(inputselecter);
      var newOption = new Option(addtext.val(), data, false, false);
      $(selecter).append(newOption).trigger("change");
      addtext.val("");

      // var i =0 ;
      // var selecter = "#"+inputselecter + i;
      // while($(selecter).length > 0) {
      //   $(selecter).append(newOption.clone()).trigger("change");
      //   i++;
      //   selecter = "#"+inputselecter + i;
      // }

      alert("Form Submited Successfully");
      closeModal(popupname);
    },
    error: function (data) {
      alert("some Error");
    },
  });
}
