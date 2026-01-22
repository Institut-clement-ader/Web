<script type="text/javascript">
console.log('debut');
$("select#show").change(function () {
    console.log('change cat1');
 var cat = document.getElementById("show");
 var xmlhttp = new XMLHttpRequest();
 xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
         document.getElementById("moyen").innerHTML = this.response;
      }
    };
 xmlhttp.open("GET","getMoyen?cate="+cat.value ,true);
 xmlhttp.send();
});

$("select#show").change(function () {
    console.log('change cat2');
 var cat = document.getElementById("show");
 var moyen = document.getElementById("moyen");
 var xmlhttp = new XMLHttpRequest();
 xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
         document.getElementById("tableau").innerHTML = this.response;
      }
    };
 xmlhttp.open("GET","getCalendrier?cate="+cat.value+"&moy="+moyen.value ,true);
 xmlhttp.send();
});

$("select#moyen").change(function () {
    console.log('change moy');
 var moyen = document.getElementById("moyen");
 var xmlhttp = new XMLHttpRequest();
 xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
         document.getElementById("tableau").innerHTML = this.response;
      }
    };
 xmlhttp.open("GET","getCalendrier?moy="+moyen.value ,true);
 xmlhttp.send();
});
console.log('fin');
</script>