function validateCampID(campusID) {

  new Ajax.Request("ids.php",
  {
    method: "get",
    parameters: {name: campusID},
    onSuccess: displayResult
  });
}

function displayResult(ajax) {

  $("idbox").innerHTML = ajax.responseText;
}