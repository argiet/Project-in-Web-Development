
//INSERT

function Function_Enter() {

    var x = document.getElementById("myURL").value;
    var urlPathArray = x.split('/');

    var i=urlPathArray.length-2;

    var y = urlPathArray[2].split('.');

    if (urlPathArray[2] !== "www.facebook.com")
    {
      var  n = new XMLHttpRequest();
        n.onreadystatechange = function() {
            if (n.readyState == 4 && n.status == 200) {
                document.getElementById("admin").innerHTML = n.responseText;
            }
          }
         n.open("GET", "test.php?finalurl=" + finalurl, true);
         n.send();
      
       
    }else if (y[1]== "facebook"){

      if (urlPathArray[i]=="timeline")
      {
        var i1=urlPathArray[i-1];
        var url1=i1.split('-');
        var i2=url1.length-1;
        var finalurl=url1[i2];
        var count=0;

      }else {
        var finalurl1=urlPathArray[i+1].split('?');
        var finalurl=finalurl1[0];
        var count=0;
      }
       var  xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("admin").innerHTML = xmlhttp.responseText;
            }
          }
         xmlhttp.open("GET", "execute_insert.php?finalurl=" + finalurl, true);
         xmlhttp.send();

    }
    
}



//UPDATE

function Function_Updates() {

    var re = new XMLHttpRequest();
    re.onreadystatechange = function() {
        if (re.readyState == 4 && re.status == 200) {
            document.getElementById("admin").innerHTML = re.responseText;
        }
      }
     re.open("GET", "updates_admin.php", true);
     re.send();
}



//DELETE

function Function_Delete() {

var x = document.getElementById("myURL").value;

var urlPathArray = x.split('/');

var i=urlPathArray.length-2;

if (urlPathArray[2]=="www.facebook.com")
{
  if (urlPathArray[i]=="timeline")
  {

    var i1=urlPathArray[i-1];
    
    var url1=i1.split('-');
    
    var i2=url1.length-1;
    var finalurl=url1[i2];
    var count=0;

  
  }else {

    var finalurl1=urlPathArray[i+1].split('?');
    var finalurl=finalurl1[0];
    var count=0;
  }

}
else{
  
   var finalurl=x;
}

    var redel = new XMLHttpRequest();
    redel.onreadystatechange = function() {
        if (redel.readyState == 4 && redel.status == 200) {
            document.getElementById("admin").innerHTML = redel.responseText;
        }
      }
     redel.open("GET", "delete_url_admin.php?finalurl=" + finalurl, true);
     redel.send();
   
}

