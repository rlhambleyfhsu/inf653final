function formChange(type = "GET") {
  let element = document.getElementById("form-change");
    element.method = type;
  element.submit();
}

function clearFilters(submit = true) {
  document.getElementById("authorID").value = 0;
  document.getElementById("categoryId").value = 0;
  document.getElementById("authorIDSubmit").value = 0;
  document.getElementById("categoryIDSubmit").value = 0;
  submit ? this.formChange() : null;
}

function openSubmit() {
  document.getElementById("filter-grp").style.display = "none";
  document.getElementById("quote-container").style.display = "none";
  document.getElementById("submit-grp").style.display = "block";
  clearFilters(false);
}

function closeSubmit() {
  document.getElementById("filter-grp").style.display = "block";
  document.getElementById("quote-container").style.display = "block";
  document.getElementById("submit-grp").style.display = "none";
}

function checkValid(submit = false) {
  let count = 0;
  document.getElementById("categoryIDSubmit").value == 0 ? count++ : "";
  document.getElementById("authorIDSubmit").value == 0 ? count++ : "";
  document.getElementById("textsubmit").value.length < 10 ? count++ : "";
  if (count == 0) {
    document.getElementById("submit-quote-btn").classList.remove("disabled");
    document.getElementById("warning").innerHTML = "";
  } else {
    document.getElementById("submit-quote-btn").classList.add("disabled");
  }

  if (submit == true) {
    if (count == 0) {
      document.getElementById("action").value = "submit";
      formChange("POST");
    } else {
      document.getElementById("warning").innerHTML = "Must Complete Form";
    }
  }
}

function navControl(action) {
  history.pushState(null, "", location.href.split("?")[0]);
  const navControl = document.getElementById("admin-control");
  let navInput = document.getElementById("admin-input");
  navInput.value = action;
  navControl.submit();
}

function updateEntry(ID, type) {
  document.getElementById("quoteID").value = ID;
  document.getElementById("action").value = type;
  this.formChange("POST");
}
