function showHint(inputString)
{
  if (inputString.length==0)
  { 
     $("txtHint").innerHTML="";
     return;
  }
  
  new Ajax.Request( "getHint.php", 
  { 
    method: "get", 
    parameters: {uname:inputString},
    onSuccess: ajaxSuccess
  } );
}

//function to execute when ajax request is successful
function ajaxSuccess(ajax){
  $("txtHint").value=ajax.responseText;
}
//function to execute when ajax request is unsuccessful
function ajaxFailure(){
  alert("Ajax request failed");
}