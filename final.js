function payment_type(val) {
  document.getElementById("paid_via").innerText = val;
}

function updatePrice() {
  var elements = document.getElementsByClassName("bill_quantity");
  if (elements.length > 0) {
    var firstElement = elements[0];
    var elementId = firstElement.id;
    elementId = elementId.toString();
    elementId = elementId.slice(13, 33);
  } else {
    location.reload();
  }
  var str = document.getElementById("bill_quantity" + elementId).value;
  billTotal(str, elementId);
}

var at = 0;
var at_id = 0;
var wt = 0;
var wt_id = 0;
var caw = 0;
var acw_id = 0;
var ymc = 0;
var ymc_id = 0;
var ymf = 0;
var ymf_id = 0;
var price = "";

function changeprice(val) {
  if (document.getElementById("ticket_types").innerText != null) {
    const package_name = document.querySelectorAll("#ticket_types");
    // Get the first element using index
    var selectedTicket = package_name[val].innerText;

    if (selectedTicket == "AMUSEMENT") {
      if (at <= 0) {
        price = "508.47";
        document.getElementById(val).style =
          "box-shadow: rgba(3, 102, 214, 0.3) 0px 0px 0px 3px;";
        at_id = addRow();
        at = 1;
      } else {
        add_item(at_id);
      }
    } else if (selectedTicket == "WUNDER WATER") {
      if (wt <= 0) {
        price = "1059.32";
        document.getElementById(val).style =
          "box-shadow: rgba(3, 102, 214, 0.3) 0px 0px 0px 3px;";
        wt_id = addRow();
        wt = 1;
      } else {
        add_item(wt_id);
      }
    } else if (selectedTicket == "COMBO") {
      if (caw <= 0) {
        price = "1101.69";
        document.getElementById(val).style =
          "box-shadow: rgba(3, 102, 214, 0.3) 0px 0px 0px 3px;";
        caw_id = addRow();
        caw = 1;
      } else {
        add_item(caw_id);
      }
    } else if (selectedTicket == "COUPLE") {
      if (ymc <= 0) {
        price = "5076.27";
        document.getElementById(val).style =
          "box-shadow: rgba(3, 102, 214, 0.3) 0px 0px 0px 3px;";
        ymc_id = addRow();
        ymc = 1;
      } else {
        add_item(ymc_id);
      }
    } else if (selectedTicket == "FAMILY") {
      if (ymf <= 0) {
        price = "9313.56";
        document.getElementById(val).style =
          "box-shadow: rgba(3, 102, 214, 0.3) 0px 0px 0px 3px;";
        ymf_id = addRow();
        ymf = 1;
      } else {
        add_item(ymf_id);
      }
    }

    function addRow() {
      var id = Math.random(10);
      // document.getElementById('add_item').innerHTML += '<tr id="' + id + '"><td id="package_name">' + selectedTicket + '</td><td><div class="row"><div class="col-md-2 d-flex justify-content-center align-items-center"><button type="button" onclick="add_item(' + id + ')" class="btn btn-inverse-dark btn-md btn-rounded btn-icon"><i class="mdi mdi-plus"></i></button></div><div class="col-md-8 d-flex justify-content-center align-items-center"><input type="number" min="1" value="1" name="bill_quantity" id="bill_quantity' + id + '" onchange="billTotal(this.value, ' + id + ')" class="form-control form-control-lg"></div><div class="col-md-2 d-flex justify-content-center align-items-center"><button type="button" onclick="subtract_item(' + id + ')" class="btn btn-inverse-dark btn-md btn-rounded btn-icon"><i class="mdi mdi-minus"></i></button></div></div></td><td><p class="">₹ <z id="package_price' + id + '">' + price + '</z></p></td><td><p class="">₹ <z id="total_ticket_price' + id + '"></z></p></td><td><button type="button" onclick="remove_item(' + id + ')" class="btn btn-inverse-danger btn-sm btn-rounded btn-icon"><i class="mdi mdi-close"></i></button></td></tr>';
      // Create a new element
      document.getElementById("new_bill_row").innerHTML +=
        '<tr style="border-top: 1px solid #000;" class="service" id="' +
        id +
        '"><td class="tableitem" id="package_name_new"><p class="itemtext">' +
        selectedTicket +
        '</p></td><td class="tableitem"><p class="itemtext" id="print_bill_quantity' +
        id +
        '"></p></td><td class="tableitem"><p class="itemtext">₹' +
        price +
        '</p></td><td class="tableitem"><p class="itemtext" id="print_ticket_discount' +
        id +
        '"></p></td><td class="tableitem"><p class="itemtext" id="print_ticket_price' +
        id +
        '">₹00.00</p></td>';
      var newElement = document.createElement("tr");
      var myContainer = document.getElementById("add_item");
      newElement.innerHTML =
        '<td id="package_name">' +
        selectedTicket +
        '</td><td><div class="row"><div class="col-md-2 d-flex justify-content-center align-items-center"><button type="button" onclick="add_item(' +
        id +
        ')" class="btn btn-inverse-dark btn-sm btn-rounded btn-icon"><i class="mdi mdi-plus"></i></button></div><div class="col-md-8 d-flex justify-content-center align-items-center"><input type="number" min="1" value="1" name="bill_quantity" id="bill_quantity' +
        id +
        '" onchange="billTotal(this.value, ' +
        id +
        ')" class="form-control form-control bill_quantity"></div><div class="col-md-2 d-flex justify-content-center align-items-center"><button type="button" onclick="subtract_item(' +
        id +
        ')" class="btn btn-inverse-dark btn-sm btn-rounded btn-icon"><i class="mdi mdi-minus"></i></button></div></div></td><td><p class="">₹<span id="package_price' +
        id +
        '">' +
        price +
        '</span></td><td><p class=""><div class="input-group"><input id="package_discount_inclusive' +
        id +
        '" type="number" class="form-control" onblur="getDisccount(' +
        id +
        ", " +
        price +
        ',this.value)" min="0" max="' +
        price +
        '" placeholder="00.00" step="0.01"></td><td><p class="">₹ <z id="total_ticket_price' +
        id +
        '"></z></p></td><td><button type="button" onclick="remove_item(' +
        id +
        ')" class="btn btn-inverse-danger btn-sm btn-rounded btn-icon"><i class="mdi mdi-close"></i></button></td>';
      newElement.id = id;
      // Append the new element to the container
      myContainer.appendChild(newElement);
      billTotal(1, id);
      return id;
    }
  }
}

function getDisccount(id, price, discount) {
  var bill_quantity_discount = document.getElementById(
    "bill_quantity" + id
  ).value;
  console.log("Disccount Price: " + discount);
  if (discount > price) {
    document.getElementById(
      "package_discount_inclusive" + id
    ).style.borderColor = "red";
  } else {
    document.getElementById(
      "package_discount_inclusive" + id
    ).style.borderColor = "";
    billTotal(bill_quantity_discount, id);
  }
}

function billTotal(str, id) {
  str = str.toString();
  var finalvalue = 0;
  var print_bill_quantity_final = 0;
  if (str.length > 0) {
    var quantity = str;
  }
  var package_price = document.getElementById("package_price" + id).innerText;
  var total = package_price * quantity;
  // GST rate (in decimal form)
  const gstRate = 0.18;

  // Calculate GST amount
  var newAmount = total * gstRate;
  var gstAmount = newAmount / 2;
  // Calculate total value including GST
  var totalValue = total + newAmount;

  console.log("totalValue amount : " + totalValue);
  var package_discount_inclusive = document.getElementById(
    "package_discount_inclusive" + id
  ).value;
  package_discount_inclusivestr = package_discount_inclusive.toString();
  if (package_discount_inclusivestr.length > 0) {
    var package_discount_inclusive_final =
      package_discount_inclusive * quantity;
    totalValue = totalValue - package_discount_inclusive_final;
  } else {
    var total = package_price * quantity;
  }
  var package_price = document.getElementById("package_price" + id).innerText;
  var total = package_price * quantity;

  totalValue = Math.round(totalValue, 3);
  var discount = document.getElementById("discount").value;
  if (discount.length > 0) {
    totalValue = totalValue - discount;
  }
  console.log(totalValue);

  gstAmount = gstAmount.toFixed(2);
  var mathtotal = total;
  document.getElementById("total_ticket_price" + id).innerText = totalValue;
  var add_amount = document.querySelectorAll("[id^='total_ticket_price']");
  add_amount.forEach((add_amount) => {
    finalvalue += parseInt(add_amount.innerText);
  });

  function calculateExcludingGST(totalAmount, gstPercentage) {
    var excludingGST = totalAmount / (1 + gstPercentage / 100);
    return excludingGST.toFixed(0);
  }

  // Example usage
  var totalAmount = finalvalue; // Total amount including GST
  var gstPercentage = 18; // GST percentage

  var excludingGST = calculateExcludingGST(totalAmount, gstPercentage);
  var newAmount = calculateExcludingGST(totalAmount, gstPercentage);
  excludingGST = excludingGST * 0.18;
  excludingGST = excludingGST / 2;
  excludingGST = excludingGST.toFixed(2);

  document.getElementById("sgst_amount").innerHTML = excludingGST;
  document.getElementById("cgst_amount").innerHTML = excludingGST;
  document.getElementById("bill_total").innerHTML = finalvalue;
  document.getElementById("print_ticket_price" + id).innerText =
    "₹" + totalValue;
  document.getElementById("print_ticket_discount" + id).innerText =
    package_discount_inclusive;
  document.getElementById("print_bill_quantity" + id).innerText =
    "x" + quantity;
  document.getElementById("sgst_print").innerText = "₹" + excludingGST;
  document.getElementById("cgst_print").innerText = "₹" + excludingGST;
  document.getElementById("hidden_print").innerText = excludingGST;
  document.getElementById("print_grand_total").innerText = "₹" + finalvalue;
  document.getElementById("gstAmount_fill").innerText = "₹" + newAmount;
  document.getElementById("bill_invoice").innerText =
    document.getElementById("bill_invoice_value").value;
  var print_bill_quantity1 = document.querySelectorAll("[id^='bill_quantity']");
  print_bill_quantity1.forEach((print_bill_quantity1) => {
    print_bill_quantity_final += parseInt(print_bill_quantity1.value);
  });
  console.log(print_bill_quantity_final);
  document.getElementById("ttl_quantity").innerText = print_bill_quantity_final;

  var radioButtons = document.getElementsByName("radioGroup");

  for (var i = 0; i < radioButtons.length; i++) {
    if (radioButtons[i].checked) {
      var selectedValue = radioButtons[i].value;
      document.getElementById("paid_via").innerText = selectedValue;
      break;
    }
  }
}

function printDivc(divname) {
  var contentDiv = document.getElementById(divname);

  // Get the HTML content
  var htmlContent = contentDiv.innerHTML;

  // Get the CSS styles
  var styleContent = "";
  var styleTags = contentDiv.getElementsByTagName("style");
  for (var i = 0; i < styleTags.length; i++) {
    styleContent += styleTags[i].innerHTML;
  }
  // Create a new window
  var newWindow = window.open("", "_blank");
  var style =
    '<link rel="stylesheet" type="text/css" href="./test.css"></link></head>';
  // Set the content of the new page
  newWindow.document.open();
  newWindow.document.write(
    "<!DOCTYPE html><html><head><title>Invoice</title><link rel='stylesheet' type='text/css' href='./test.css'></link></head>" +
      "<style>* {font-weight: 700 !important;}.line {height: 1px;color: black;width: 100%;background-color: black;border: 1px solid black;}.details {border: 0px;}</style><body>" +
      htmlContent +
      "</body></html><script>window.onload = function () {window.print();};</script>"
  );
  newWindow.onload = function () {
    newWindow.print();
  };
  newWindow.document.close();
}

function removeToCart() {
  remove = document.querySelectorAll("#delete");
  remove.forEach((box) => {
    box.remove();
  });
  document.getElementById("product_total").innerHTML = "";
}

let numberValue = 0;
const myObj = [];

function addToCart() {
  var product_name = document.getElementById("product_name");
  var product_quantity = document.getElementById("product_quantity").value;
  var [product_name, product_price] =
    product_name.options[product_name.selectedIndex].text.split(" || ₹ ");
  document.getElementById("bill_prod").innerHTML +=
    '<div class="col-xl-10" id="delete"><p id="arrText">' +
    product_name +
    '</p></div><div id="delete" class="col-xl-2"><p class="float-end" id="arrVal">X' +
    product_quantity +
    "</p></div>";
  var sum = product_quantity * product_price;
  const myPara = document.getElementById("product_total");
  if (myPara.innerHTML.length > 0) {
    // Get the value of the innerHTML and convert it to a number
    var innerValue = parseInt(myPara.innerHTML);
    sum = innerValue + sum;
  }
  document.getElementById("product_total").innerHTML = sum;
  var str = document.getElementById("bill_quantity").innerHTML;

  billTotal(str);

  var product_id = document.getElementById("product_name").value;
  myObj[product_id] = product_quantity + "," + product_name;
  var new_obj = myObj.join(",");
}

const tickets_name = [];
const quantity_name = [];

function onSubmitButton() {
  var username = document.getElementById("username").value;
  var client_code = document.getElementById("client_code").value;
  var email = document.getElementById("email").value;
  var mobile = document.getElementById("mobile").value;
  var discount = document.getElementById("discount").value;
  var payment_method = document.getElementById("paid_via").innerText;
  var date = document.getElementById("date").value;
  var created_by = document.getElementById("created_by").value;
  var gstblah = document.getElementById("hidden_print").innerText;

  const ticketsname = Array.from(document.querySelectorAll("#package_name"));
  const tickets_name = ticketsname
    .map((element) => element.innerHTML)
    .join(",");
  const quantityname = Array.from(
    document.querySelectorAll('[id^="bill_quantity"]')
  );
  const quantity_name = quantityname.map((element) => element.value).join(",");

  const fetch_discount_pt = Array.from(
    document.querySelectorAll('[id^="package_discount_inclusive"]')
  );
  const discount_pt = fetch_discount_pt
    .map((element) => element.value)
    .join(",");
  console.log(quantity_name.length);
  if (quantity_name.length > 0) {
    // Create a new XMLHttpRequest object
    const xhr = new XMLHttpRequest();
    // Define the AJAX request
    xhr.open(
      "GET",
      "./helpers/process.php?username=" +
        username +
        "&&payment_method=" +
        payment_method +
        "&&gst=" +
        gstblah +
        "&&ticket_check_in_date=" +
        date +
        "&&discount=" +
        discount +
        "&&ticket_types=" +
        tickets_name +
        "&&email=" +
        email +
        "&&phone=" +
        mobile +
        "&&client_code=" +
        client_code +
        "&&quantity=" +
        quantity_name +
        "&&discount_pt=" +
        discount_pt +
        "&&created_by=" +
        created_by
    );
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        const response = xhr.responseText;
        document.getElementById("notification").innerHTML = response;
        // Do something with the response data
      }
    };
    // Send the AJAX request with the data
    xhr.send();
    printDivc("printed");
  } else {
    alert("Please Select a ticket.");
  }
}

function getUsername(str) {
  var username = str;
  document.getElementById("bill_username").innerText = username;
}

function getEmail(str) {
  var email = str;
  document.getElementById("bill_email").innerHTML = email;
}

function getMobile(str) {
  var mobile = str;
  document.getElementById("bill_mobile").innerHTML = mobile;
}

function add_item(id) {
  var newValue = document.getElementById("bill_quantity" + id).value++;
  newValue++;
  if (newValue >= 0) {
    billTotal(newValue, id);
  }
}

function subtract_item(id) {
  var newValue = document.getElementById("bill_quantity" + id).value;
  if (newValue > 1) {
    var newValue = document.getElementById("bill_quantity" + id).value--;
    newValue--;
    newValue = newValue.toString();
    billTotal(newValue, id);
  }
}

function remove_item(id) {
  if (id == at_id) {
    document.getElementById("0").style.boxShadow = "none";
    at_id = 0;
    at = 0;
    document.getElementById(id).remove();
    var newValue = 0;
    newValue = newValue.toString();
  } else if (id == wt_id) {
    document.getElementById("1").style.boxShadow = "none";
    wt_id = 0;
    wt = 0;
    document.getElementById(id).remove();
    var newValue = 0;
    newValue = newValue.toString();
  } else if (id == caw_id) {
    document.getElementById("2").style.boxShadow = "none";
    caw_id = 0;
    caw = 0;
    document.getElementById(id).remove();
    var newValue = 0;
    newValue = newValue.toString();
  } else if (id == ymc_id) {
    document.getElementById("3").style.boxShadow = "none";
    ymc_id = 0;
    ymc = 0;
    document.getElementById(id).remove();
    var newValue = 0;
    newValue = newValue.toString();
  } else if (id == ymf_id) {
    document.getElementById("4").style.boxShadow = "none";
    ymf_id = 0;
    ymf = 0;
    document.getElementById(id).remove();
    var newValue = 0;
    newValue = newValue.toString();
  }
  updatePrice();
}
