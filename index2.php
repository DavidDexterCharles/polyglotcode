<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>

 <script type="text/javascript">
 //$.getJSON("http://en.wikipedia.org/w/api.php?action=parse&format=json&callback=?", {page:"Football", prop:"text"}, function(data) {console.log(data);});
 
 $.getJSON("https://en.wikipedia.org/w/api.php?format=json&action=parse&amp&callback=?", {page:"List_of_programming_languages", prop:"text",section:"1"}, function(data)
     {

         console.log(data.parse.text["*"]);
         document.write(data.parse.text["*"]);

         // document.write(data.parse.title);

         //window.alert(data.parse.text.*);
     }

 );
 $.getJSON(" https://api.github.com/users/ICE-WOLF/followers", function(data)
     {

         //console.log(data.parse.text["*"]);
        // document.write(data[3].login);
         document.write(data[0].login);
         // document.write(data.parse.title);

         //window.alert(data.parse.text.*);
     }

 );









/*
 $.getJSON("https://en.wikipedia.org/w/api.php?format=json&action=parse&amp&callback=?", {page:"List_of_programming_languages", prop:"text",section:"2"}, function(data)
 {console.log(data.parse.text["*"]);
 	//window.alert(data.parse.text.*);
 }

 );
*/
 //https://en.wikipedia.org/w/api.php?format=json&action=parse&page=List_of_programming_languages&prop=sections
 </script>
 </html>